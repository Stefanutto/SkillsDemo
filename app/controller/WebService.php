<?php
/**
 * 
 */
class WebService extends View{
	public $json;

	function __construct(){
		parent::__construct();
	}

	public function WebServiceYahooFinance($ativo){
		//Tem que usar o error_reporting(0); por que se consultar o WEBSERVICE com o nome do ativo errado
		//retorna erro, assim consigo retornar 0.
		//Tentei usar o Try mas não funcuiona por que é só um aviso
		error_reporting(0);

		$json = json_decode(file_get_contents("https://query2.finance.yahoo.com/v8/finance/chart/" . strtoupper($ativo) . ".SA?interval=1d"));
		if($json != "" || $json->chart->error == ""){
			$this->json = $json;
		}else{
			$error = "Erro ao tentar consulta a cotação do ativo: " . $ativo;
			$log = new Log();
            $log->WriteLog($error);
            die;
		}
		//print_r($this->json);
	}

	function ConvertToDoble($value){
		return number_format($value,2,",",".");
	}

	function GetCotacaoFechamento($ativo){
		$this->WebServiceYahooFinance($ativo);
		echo  number_format($this->json->chart->result[0]->indicators->quote[0]->close[0],2,",",".");
	}

	function GetValorizacao($ativo){
		$this->WebServiceYahooFinance($ativo);
		$value = $this->json->chart->result[0]->indicators->quote[0]->close[0] - $this->json->chart->result[0]->indicators->quote[0]->open[0];
		echo $this->ConvertToDoble($value);
	}

	//Func para pegar o fundamentos das empresas no site www.fundamentus.com.br
	function GetFundamentus(){
		header("Access-Control-Allow-Origin: *");                                                                            
		header('Content-Type: application/json');
		error_reporting(E_ERROR | E_PARSE);
		$time_start = microtime(true);

		$link = "http://www.fundamentus.com.br/resultado.php";
		$jsonData   = file_get_contents($link);

		$dom = new DOMDocument;
		$dom->loadHTML($jsonData);
		
		$tables = $dom->getElementsByTagName('table');
		$tbody = $dom->getElementsByTagName('tbody'); 
		
		$All = [];
		foreach ($tbody as $key => $value) {
			foreach ($value->getElementsByTagName('tr') as $key => $value2) {
				$Papel = $value2->getElementsByTagName('td')->item(0)->textContent;
				$Cotacao  = $value2->getElementsByTagName('td')->item(1)->textContent;
				$PL = $value2->getElementsByTagName('td')->item(2)->textContent;
				$PVP = $value2->getElementsByTagName('td')->item(3)->textContent;
				$PSR = $value2->getElementsByTagName('td')->item(4)->textContent;
				$DivYield = $value2->getElementsByTagName('td')->item(5)->textContent;
				$PAtivo = $value2->getElementsByTagName('td')->item(6)->textContent;
				$PCapGiro = $value2->getElementsByTagName('td')->item(7)->textContent;
				$PEBIT = $value2->getElementsByTagName('td')->item(8)->textContent;
				$PAtivCircLiq = $value2->getElementsByTagName('td')->item(9)->textContent;
				$EVEBIT = $value2->getElementsByTagName('td')->item(10)->textContent;
				$EVEBITDA = $value2->getElementsByTagName('td')->item(11)->textContent;
				$MrgEbit = $value2->getElementsByTagName('td')->item(12)->textContent;
				$MrgLiq = $value2->getElementsByTagName('td')->item(13)->textContent;
				$LiqCorr = $value2->getElementsByTagName('td')->item(14)->textContent;
				$ROIC = $value2->getElementsByTagName('td')->item(15)->textContent;
				$ROE = $value2->getElementsByTagName('td')->item(16)->textContent;
				$Liq2meses = $value2->getElementsByTagName('td')->item(17)->textContent;
				$PatrimLiq = $value2->getElementsByTagName('td')->item(18)->textContent;
				$DívBrutPatrim = $value2->getElementsByTagName('td')->item(19)->textContent;
				$CrescRec5a = $value2->getElementsByTagName('td')->item(20)->textContent;
		
				array_push($All, array(
					"Papel" => array( 'name' => 'Papel', 'value' => $Papel),
					"Cotacao" => array( 'name' => 'Cotação', 'value' => $Cotacao),
					"PL" => array( 'name' => 'P/L', 'value' => $PL),
					"PVP" => array( 'name' => 'P/VP', 'value' => $PVP),
					"PSR" => array( 'name' => 'PSR', 'value' => $PSR),
					"DivYield" => array( 'name' => 'Div. Yield', 'value' => $DivYield),
					"PAtivo" => array( 'name' => 'P/Ativo', 'value' => $PAtivo),
					"PCapGiro" => array( 'name' => 'P/Cap. Giro', 'value' => $PCapGiro),
					"PEBIT" => array( 'name' => 'P/EBIT', 'value' => $PEBIT),
					"PAtivCircLiq" => array( 'name' => 'P/Ativ Circ. Liq', 'value' => $PAtivCircLiq),
					"EVEBIT" => array( 'name' => 'EV/EBIT', 'value' => $EVEBIT),
					"EVEBITDA" => array( 'name' => 'EV/EBITDA', 'value' => $EVEBITDA),
					"MrgEbit" => array( 'name' => 'Margem Ebit', 'value' => $MrgEbit),
					"MrgLiq" => array( 'name' => 'Margem. Líq.', 'value' => $MrgLiq),
					"LiqCorr" => array( 'name' => 'Liq. Corr.', 'value' => $LiqCorr),
					"ROIC" => array( 'name' => 'ROIC', 'value' => $ROIC),
					"ROE" => array( 'name' => 'ROE', 'value' => $ROE),
					"Liq2meses" => array( 'name' => 'Liq. 2 meses', 'value' => $Liq2meses),
					"PatrimLiq" => array( 'name' => 'Patrim. Líq', 'value' => $PatrimLiq),
					"DívBrutPatrim" => array( 'name' => 'Dív.Brut/ Patrim.', 'value' => $DívBrutPatrim),
					"CrescRec5a" => array( 'name' => 'Cresc. Rec. 5a', 'value' => $CrescRec5a),
				));
			}
		}

		echo json_encode($All, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
	}

	public function HasAcoes($ativo)
	{
		header("Access-Control-Allow-Origin: *");                                                                            
		header('Content-Type: application/json');
		error_reporting(E_ERROR | E_PARSE);
		$time_start = microtime(true);

		$link = "http://www.fundamentus.com.br/detalhes.php?papel=" . strtoupper($ativo);
		$jsonData   = file_get_contents($link);

		$dom = new DOMDocument;
		$dom->loadHTML($jsonData);
		$tables = $dom->getElementsByTagName('table');
		if(count($tables) > 0){
			return true;
		}else{
			return false;
		}
	}

	public function HasFii($ativo)
	{
		header("Access-Control-Allow-Origin: *");                                                                            
		header('Content-Type: application/json');
		error_reporting(E_ERROR | E_PARSE);
		$time_start = microtime(true);

		$link = "https://www.fundsexplorer.com.br/funds/" . strtoupper($ativo);
		$jsonData   = file_get_contents($link);

		$dom = new DOMDocument;
		$dom->loadHTML($jsonData);
		$tables = $dom->getElementsByTagName('table');
		if(count($tables) > 0){
			return true;
		}else{
			return false;
		}
	}

	public function HasETF($ativo)
	{
		header("Access-Control-Allow-Origin: *");                                                                            
		header('Content-Type: application/json');
		error_reporting(E_ERROR | E_PARSE);
		$time_start = microtime(true);

		$link = "https://statusinvest.com.br/etfs/" . strtoupper($ativo);;
		$jsonData   = file_get_contents($link);

		$dom = new DOMDocument;
		$dom->loadHTML($jsonData);
		$tables = $dom->getElementsByTagName('table');
		if(count($tables) > 0){
			return true;
		}else{
			return false;
		}
	}

	//Func para pegar o fundamentos das empresas no site www.fundsexplorer.com.br
	function GetFundsexplorer()
	{
		header("Access-Control-Allow-Origin: *");                                                                            
		header('Content-Type: application/json');
		error_reporting(E_ERROR | E_PARSE);
		$time_start = microtime(true);

		$link = "https://www.fundsexplorer.com.br/ranking";
		$jsonData   = file_get_contents($link);

		$dom = new DOMDocument;
		$dom->loadHTML($jsonData);
		
		$tables = $dom->getElementsByTagName('table');
		$tbody = $dom->getElementsByTagName('tbody'); 
		
		$All = [];
		foreach ($tbody as $key => $value) {
			foreach ($value->getElementsByTagName('tr') as $key => $value2) {
				$Codigo = $value2->getElementsByTagName('td')->item(0)->textContent;
				$Setor  = $value2->getElementsByTagName('td')->item(1)->textContent;
				$PA = $value2->getElementsByTagName('td')->item(2)->textContent;
				$LD = $value2->getElementsByTagName('td')->item(3)->textContent;
				$Dividendo = $value2->getElementsByTagName('td')->item(4)->textContent;
				$DivYield = $value2->getElementsByTagName('td')->item(5)->textContent;
				$DY3MA = $value2->getElementsByTagName('td')->item(6)->textContent;
				$DY6MA = $value2->getElementsByTagName('td')->item(7)->textContent;
				$DY12MA = $value2->getElementsByTagName('td')->item(8)->textContent;
				$DY3MM = $value2->getElementsByTagName('td')->item(9)->textContent;
				$DY6MM = $value2->getElementsByTagName('td')->item(10)->textContent;
				$DY12MM = $value2->getElementsByTagName('td')->item(11)->textContent;
				$DYANO = $value2->getElementsByTagName('td')->item(12)->textContent;
				$VariacaoP = $value2->getElementsByTagName('td')->item(13)->textContent;
				$RP = $value2->getElementsByTagName('td')->item(14)->textContent;
				$RA = $value2->getElementsByTagName('td')->item(15)->textContent;
				$PL = $value2->getElementsByTagName('td')->item(16)->textContent;
				$VPA = $value2->getElementsByTagName('td')->item(17)->textContent;
				$PVPA = $value2->getElementsByTagName('td')->item(18)->textContent;
				$DYPat = $value2->getElementsByTagName('td')->item(19)->textContent;
				$VP = $value2->getElementsByTagName('td')->item(20)->textContent;
				$RPnP = $value2->getElementsByTagName('td')->item(21)->textContent;
				$RPA = $value2->getElementsByTagName('td')->item(22)->textContent;
				$VacanciaF = $value2->getElementsByTagName('td')->item(23)->textContent;
				$VacanciaFin = $value2->getElementsByTagName('td')->item(24)->textContent;
				$QtdA = $value2->getElementsByTagName('td')->item(25)->textContent;
		
				array_push($All, array(
					"Codigo" => array( 'name' => 'Código', 'value' => $Codigo),
					"Setor" => array( 'name' => 'Setor', 'value' => $Setor),
					"PA" => array( 'name' => 'Preço Atual', 'value' => $PA),
					"LD" => array( 'name' => 'Liquidez Diária', 'value' => $LD),
					"Dividendo" => array( 'name' => 'Dividendo', 'value' => $Dividendo),
					"DivYield" => array( 'name' => 'Div. Yield', 'value' => $DivYield),
					"DY3MA" => array( 'name' => 'Div. (3M) Acumulado', 'value' => $DY3MA),
					"DY6MA" => array( 'name' => 'Div. (6M) Acumulado', 'value' => $DY6MA),
					"DY12MA" => array( 'name' => 'Div. (12M) Acumulado', 'value' => $DY12MA),
					"DY3MM" => array( 'name' => 'Div. (3M) Média', 'value' => $DY3MM),
					"DY6MM" => array( 'name' => 'Div. (6M) Média', 'value' => $DY6MM),
					"DY12MM" => array( 'name' => 'Div. (12M) Média', 'value' => $DY12MM),
					"DYANO" => array( 'name' => 'Div. Yield Ano', 'value' => $DYANO),
					"VariacaoP" => array( 'name' => 'Variação Preço', 'value' => $VariacaoP),
					"RP" => array( 'name' => 'Rentab. Período', 'value' => $RP),
					"RA" => array( 'name' => 'Rentab. Acumulada', 'value' => $RA),
					"PL" => array( 'name' => 'Patrimônio Líq.', 'value' => $PL),
					"VPA" => array( 'name' => 'VPA', 'value' => $VPA),
					"PVPA" => array( 'name' => 'P/VPA', 'value' => $PVPA),
					"DYPat" => array( 'name' => 'Div. Patrimonial', 'value' => $DYPat),
					"VP" => array( 'name' => 'Variação Patrimonial', 'value' => $VP),
					"RPnP" => array( 'name' => 'Rentab. Patr. no Período', 'value' => $RPnP),
					"RPA" => array( 'name' => 'Rentab. Patr. Acumulada', 'value' => $RPA),
					"VacanciaF" => array( 'name' => 'Vacância Física', 'value' => $VacanciaF),
					"VacanciaFin" => array( 'name' => 'Vacância Financeira', 'value' => $VacanciaFin),
					"QtdA" => array( 'name' => 'Quantidade Ativos', 'value' => $QtdA),
				));
			}
		}

		echo json_encode($All, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
	}

}
