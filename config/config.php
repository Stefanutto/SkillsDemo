<?php
/**
 * 
 */
class Config
{
	protected $LinkDaURL;
	protected $FilePHP;
	protected $Method;
	protected $Value = '';
	protected $Object;
	
	function __construct($LinkDaURL)
	{	
		if(isset($LinkDaURL['url'])){
			$this->LinkDaURL = $LinkDaURL['url'];
		}

		$this->DefiningVariables();

		//CheckBase
		new UpdatesDatabase();
	}

	function ConstructPage(){
		if(!Session::Get("HasLogged") && (strtolower($this->FilePHP) <> "login" && strtolower($this->FilePHP) <> "crypt"))
			return $this->DrawHomePage();

		if(!$this->ValidatingFilePHP())
			return $this->DrawHomePage();

		$this->Object = new $this->FilePHP;

		if(!$this->ValidatingMethod())
			return $this->DrawHomePage();

		return $this->Object->{$this->Method}($this->Value);

	}

	private function DefiningVariables(){
		if(isset(explode("/", $this->LinkDaURL)[0]))
			$this->FilePHP = ucfirst(explode("/", $this->LinkDaURL)[0]);

		if(isset(explode("/", $this->LinkDaURL)[1]))
			$this->Method = ucfirst(explode("/", $this->LinkDaURL)[1]);

		if(isset(explode("/", $this->LinkDaURL)[2]))
			$this->Value = explode("/", $this->LinkDaURL)[2];

	}

	private function ValidatingFilePHP(){
		if(file_exists('app/controller/' . $this->FilePHP . '.php'))
			return true;

		return false;
	}

	private function ValidatingMethod(){
		if(method_exists($this->Object, $this->Method))
			return true;

		return false;
	}

	private function DrawHomePage(){
		$this->Object = new Login();
		return	$this->Object->Login();
	}
}