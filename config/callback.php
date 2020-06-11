<?php
class CallBack 
{
    public $error = true;
    public $errorField = array();
    public $menssager = "";
    public $value;
    public $redirect = "#";

    function __construct($error = true){
        $this->error = $error;
    }
}
