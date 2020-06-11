<?php
spl_autoload_register(function($Class){
	if(file_exists('app/controller/' .ucfirst($Class) . '.php')){
		include_once 'app/controller/' . ucfirst($Class) . '.php';
	}
	if(file_exists('app/model/' . ucfirst($Class) . '.php')){
		include_once 'app/model/' . ucfirst($Class) . '.php';
	}
});
