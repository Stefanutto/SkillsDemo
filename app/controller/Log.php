<?php
/**
 * 
 */
class Log
{
	private $file;

	function __construct()
	{
		$this->file = "log/" . date("d-m-Y") . ".txt";
	}

	public function WriteLogPost()
	{
		$this->WriteLog($_POST['error']);
	}

	public function WriteLog($error){
		if(!file_exists($this->file)){
			$handle = fopen($this->file, 'w+');
			fwrite($handle, 
				"Projeto: " . PROJECT . "
		        Dados do banco de dados:
		        DB: " . DB . "
		        HOST: " . DB_HOST . "
		        DB NAME: " . DB_NAME . "
		        USER: " . DB_USER . "
		        PASSWORD: " . DB_PASSWD
		    );
			fclose($handle);
		}

		$handle = fopen($this->file, 'a');
		fwrite($handle, "\n\n" . $error);
		fclose($handle);

	}

	public function SendLog(){
		$dir = new DirectoryIterator("log");
		foreach ($dir as $fileInfo) {
			if($fileInfo->getExtension() == 'txt' && file_exists('log/'. $fileInfo->getFilename())){
				echo $fileInfo->getFilename();
				new sendEmail("fhstefanutto@gmail.com","Fernando","Erros do " . PROJECT . " -> Data: " . $fileInfo->getFilename(), "Segue em anexo os erros.", 'log/'. $fileInfo->getFilename());
			}
		}
		$dir = null;
	}

}