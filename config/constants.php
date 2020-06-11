<?php

if($_SERVER['HTTP_HOST'] == "localhost"){
	define('URL', 'http://localhost/GerenciadorDeCarteira/');
}else{
	define('URL', 'https://www.carteiradoholder.com.br/');
}

define("PROJECT", "Carteira Do Holder");
define("LOGO_EMAIL", "URL_DO_LOGO");
define("CRYPIT_KEY", "CRYPIT_KEY");

define('DB', 'pgsql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'DB_NAME');
define('DB_USER', 'postgres');
define('DB_PASSWD', 'PASSWD');
define('DB_CHAR', 'utf8');

define("EMAIL_SMTP", "imap.gmail.com");
define("EMAIL_CHARSET", "utf-8");
define("EMAIL_SMTP_AUTH", true);
define("EMAIL_USER", "EMAIL");
define("EMAIL_PASS", "PASSWED");
define("EMAIL_SMTP_SECURE", "ssl");
define("EMAIL_PORT", "465");
define("EMAIL_IS_HTML", true);