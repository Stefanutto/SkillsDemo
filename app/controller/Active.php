<?php 
/**
 * 
 */
class Active extends View
{

	function __construct(){
		parent::__construct();
	}

	function Index(){
		$this->DrawViewFull(get_class($this));
        $this->IncludeJavaScrip(get_class($this));
	}

	public function GetClassActive($ativo){
		$lastOne = substr($ativo, -1);
		if(!is_numeric($lastOne)) return "Renda Fixa";
		
		$WebService = new WebService();

		$lastTwo = substr($ativo, -2);
		if(!($lastTwo == 11)) if($WebService->HasAcoes($ativo)) return "Ação";
		
		if($WebService->HasETF($ativo)) return "ETF";
		if($WebService->HasFii($ativo)) return "Fii";

		return "Renda Fixa";
	}

}