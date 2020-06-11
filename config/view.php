<?php
/**
 * 
 */
class View
{
	public $json = array(
		'error' => 0,
		'messagem' => '',
		'data' => null
	);


	function __construct()
	{

	}

	public function DrawView($value){
		if(file_exists('app/view/' . $value . '.php')){
			require 'app/view/' . $value . '.php';
		} 
	}

	public function DrawViewFull($value){
		if(file_exists('app/view/' . $value . '.php')){
			require 'app/view/includes/head.php';
			require 'app/view/includes/menu.php';
			require 'app/view/' . $value . '.php';
			require 'app/view/includes/footer.php';
			$this->IncludeJavaScrip("Validation","lib/func");
			$this->IncludeJavaScrip("Menu");
			
		} 
	}

	public function IncludeJavaScrip($value, $folder = "app/view/js"){
		echo '<script type="text/javascript" src="' . URL . $folder . '/' . $value . '.js"></script>';
	}
}