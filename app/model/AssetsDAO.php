<?php

class AssetsDAO extends Model{

	function __construct(){ 
		parent::__construct();
    }
    
    public function Save(){
		$callback = new CallBack();
		if($this->HasAssets() == '[]') $this->InsertAssets();

        $this->pdo = $this->db->prepare("
			UPDATE system.carteira SET assets = ?  WHERE id_user = ? ;
		");
		$this->pdo->bindValue(1,json_encode($_POST));
		$this->pdo->bindValue(2,Session::Get("UserId"));
		$stmt = $this->pdo->execute();

		if(!$stmt){
			$Log = new Log();
			$Log->WriteLog("Erro em AssetsDAO->Save:\n UPDATE system.carteira SET assets = ?  WHERE id_user = ?\n" . json_encode($_POST) ."\n" . Session::Get("UserId"));
			$callback->menssager = "Ops, erro ao tentar realizar esse cadastro, tente novamente mais tarde.";
			return json_encode($callback);
		}

		$callback->error = false;
		$callback->menssager = "Categorias de ativos salvas com sucesso.";
		return json_encode($callback);
	}

	private function InsertAssets()
	{
		$this->pdo = $this->db->prepare("
			INSERT INTO system.carteira (id_user, assets) VALUES (?, ?);
		");
		$this->pdo->bindValue(1,Session::Get("UserId"));
		$this->pdo->bindValue(2,'{}');
		$this->pdo->execute();
	}
	
	public function HasAssets(){
		$this->pdo = $this->db->prepare("SELECT assets FROM system.carteira WHERE id_user = ? ;");
		$this->pdo->bindValue(1, Session::Get("UserId"));
		$this->pdo->execute();
		return json_encode($this->pdo->fetchAll(PDO::FETCH_OBJ));
	}
}
