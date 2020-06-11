<?php 
class UpdatesDatabase extends Model
{
    private $version;
    function __construct()
	{ 
        parent::__construct();

        $this->CheckSchemas();
        $this->version = $this->GetVersion();
        $this->CheckBase();
    }

    private function CheckSchemas(){
        $this->pdo = $this->db->prepare(
            "SELECT schema_name
                FROM information_schema.schemata
                WHERE schema_name = 'config'"
        );
        $RowCount = $this->pdo->rowCount();
        
        if($RowCount == 0){
            $this->pdo = $this->db->prepare("CREATE SCHEMA config;");
		    $this->pdo->execute();
        }
        
    }

    private function GetVersion(){
        $this->pdo = $this->db->prepare("SELECT version FROM config.check_base");
		$this->pdo->execute();
        $stmt = $this->pdo->fetchAll(PDO::FETCH_OBJ);
        
        if(!isset($stmt[0]->version)){
            $this->CreateVersion();
            $this->SetFistLine();
            return 0;
        }
        return $stmt[0]->version;
    }

    private function CreateVersion()
    {
        $this->__set(
            "sql",
            "CREATE TABLE config.check_base
            (
                id serial, 
                version integer DEFAULT 0
            );"
        );
        $this->execute();
    }
    private function SetFistLine(){
        $this->__set(
            "sql",
            "INSERT INTO config.check_base (version) VALUES (?);"
        );
        $this->setBindValue(0);
        $this->execute();
    }

    private function UpdateVersion(){
        $this->__set(
            "sql",
            "UPDATE config.check_base SET version = ?;"
        );
        $this->setBindValue($this->version);
        $this->execute(); 
    }
    
    private function CheckBase(){
        //PEGO TODOS OS ARQUIVOS QUE ESTÃO DENTRO DO DIRETORIO SQL
        $dir = new DirectoryIterator("sql");
        
        foreach ($dir as $fileInfo) {
            //PEGO SOMENTE OS ARQUIVOS .sql
            if($fileInfo->getExtension() == 'sql'){
                //VALIDO A VERSÂO
                if($this->version <  explode(".", $fileInfo->getFilename())[0]){
                    $lines = file($fileInfo->getPathname());
                    
                    $sql = "";
                    foreach ($lines as $kay => $line) {
                        $sql .= $line;
                    }

                    //$this->__set("sql",);
                    $this->exec($sql);
                    $this->version++;
                }
            }
            $this->UpdateVersion();
        }
    }
    
}
