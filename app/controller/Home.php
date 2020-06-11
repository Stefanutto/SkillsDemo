<?php 
/**
 * 
 */
class Home extends View
{

	function __construct()
	{
		parent::__construct();
	}

	function HomePage(){
		$this->DrawViewFull(get_class($this));
		$this->IncludeJavaScrip(get_class($this));
	}

	function Teste($value){
		$HomeDAO = new HomeDAO();
		$this->json['data'] = $HomeDAO->TesteDAO();
		$this->json['messagem'] = "Sucesso";

		//$this->DrawView(get_class($this));
		$this->DrawViewFull(get_class($this));
		$this->IncludeJavaScrip(get_class($this));
	}

	
}