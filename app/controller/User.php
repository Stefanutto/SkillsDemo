<?php

class User extends View {

    function __construct()
	{
		parent::__construct();
	}

    public function User()
    {
        $this->DrawViewFull(get_class($this));
        $this->IncludeJavaScrip(get_class($this));
    }
    
    public function GetUserName()
    {
        return  ucfirst(explode(" ", Session::Get("UserName"))[0]);
    }
}
