<?php
/**
 * 
 */
class Model extends Connection{
	private $sql;
    private $pdo;
    private $bindValue = array();

	function __construct(){
		parent::__construct();
	}
    
    public function __set($key, $value){
        $this->$key = $value;
    }
    public function __get($key){
        return $this->$key;
    }
    public function setBindValue($value){
        $this->bindValue[] = $value;
    }

    public function ClearVariaveis(){
        $this->sql = "";
        $this->pdo = null;
        $this->bindValue = array();
    }

    private function prepare($haveReturn = false){
        try{
            $this->pdo = $this->db->prepare($this->sql);
            foreach ($this->bindValue as $key => $value) {
                $this->pdo->bindValue(($key+1),$value);
            }
            $return = $this->pdo->execute();
            $this->ClearVariaveis();
            if(!$return){
                try {
                    return $this->WriteLog($this->pdo->errorInfo());
                } catch ( Exception $e ) {
                    return $this->WriteLog($e->getMessage());
                }
            }
            return true;
        }catch ( Exception $e ){
            $this->ClearVariaveis();
            return $this->WriteLog($e->getMessage());
        }
    }

    public function fetch(){
        try{
            if($this->prepare())
                return false;

            return $this->pdo->fetch();
        }catch ( Exception $e ){
            return $this->WriteLog($e->getMessage());
        }
    }

    public function fatchAll(){
        try{
            if($this->prepare())
                return false;

            return $this->pdo->fetchAll(PDO::FETCH_OBJ);
        }catch ( Exception $e ){
            return $this->WriteLog($e->getMessage());
        }
    }

    public function execute(){
        return $this->prepare();
    }

    public function exec($sql){
        $return = $this->db->exec($sql);
        if(!$return){
            try {
                $this->WriteLog($this->pdo->errorInfo());
            } catch ( Exception $e ) {
                $this->WriteLog($e->getMessage());
            }
        }
    }

    public function rowCount(){
        try{
            if(!$this->prepare()) 
                return 0;

            return $this->pdo->rowCount();
        }catch ( Exception $e ){
            return $this->WriteLog($e->getMessage());
        }
    }

	private function WriteLog($message){
    	$error = "SQL: " . $this->sql . " 
        BIND VALUE: " . json_encode($this->bindValue) . " 
        GET MESSAGE: " . json_encode($message);
        
        $log = new Log();
        $log->WriteLog($error);
        return false;
    }
}