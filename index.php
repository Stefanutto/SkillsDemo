<?php


include_once 'config/connection.php';

//INCLUDE EM TUDO QUE É PHP QUE ESTÁ NO CONFIG
$dir = new DirectoryIterator("config");
foreach ($dir as $fileInfo) {
	if($fileInfo->getExtension() == 'php'){
		include_once 'config/'. $fileInfo->getFilename();
	}
}

//SET MINHA PAGINA
$page = new Config($_GET);
echo $page->ConstructPage();
