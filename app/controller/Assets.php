<?php 
/**
 * 
 */
class Assets extends View
{

	function __construct(){
		parent::__construct();
	}

	function Index(){
		$this->DrawViewFull(get_class($this));
        $this->IncludeJavaScrip(get_class($this));
	}

	public function Save(){
		if(!isset($_POST['acoes']) || !isset($_POST['fiis']) || !isset($_POST['etfs']) || !isset($_POST['rf']) ) return;

		if(!(($_POST['acoes'] + $_POST['fiis'] + $_POST['etfs'] + $_POST['rf']) == 100)){
			$callback = new CallBack(true);
			$callback->menssager = "Para salvar sua carteira de investimos é necessario que a porcentagem total seja 100";
			return json_encode($callback);
		}

		$AssetsDAO = new AssetsDAO();
		return $AssetsDAO->Save();
	}

	public function GetAssets(){
		$AssetsDAO = new AssetsDAO();
		return $AssetsDAO->HasAssets();
	}
}