<?php
/**
 * 
 */
class LoginDAO extends Model
{
	function __construct(){ 
		parent::__construct();
    }
	
	public function Signin() {
		Session::Unset();

		$callback = new CallBack();
		$callback->menssager = "E-mail e/ou senha inválida!";

		$this->pdo = $this->db->prepare("
			SELECT id, email, passwd, valid, valid_date, name
				FROM system.user 
				WHERE email = ? AND (passwd = ? OR (md5(recover_passwd) = ? AND recover_passwd <> ''))
		");
		$this->pdo->bindValue(1,$_POST['email']);
		$this->pdo->bindValue(2,$_POST['senha']);
		$this->pdo->bindValue(3,$_POST['senha']);
		$this->pdo->execute();
		$stmt = $this->pdo->fetchAll(PDO::FETCH_OBJ);
		
		if(count($stmt) > 0){
			//VALID É PARA VER SE ELE FEZ A CONFIRMAÇÃO VIA EMAIL
			if(!$stmt[0]->valid){
				$callback->menssager = "Você ainda realizou a validação do seu email.\nEstamos enviando um novo e-mail para que seja possível realizar essa validação.";
				$this->SendValidEmail($stmt[0]->email, $stmt[0]->passwd);
				return json_encode($callback);
			}

			$callback->error = false;
			$callback->menssager = "";
			$callback->value = $stmt;
			$callback->redirect = "home/homepage";

			Session::Set("HasLogged", true);
			Session::Set("UserEmail", $stmt[0]->email);
			Session::Set("UserName", $stmt[0]->name);
			Session::Set("UserId", $stmt[0]->id);
		}


        return json_encode($callback);
	}

	public function HasEmailInBD($email){
		$this->pdo = $this->db->prepare("SELECT email FROM system.user WHERE email = ?");
		$this->pdo->bindValue(1,$email);
		$this->pdo->execute();
		$stmt = $this->pdo->fetchAll(PDO::FETCH_OBJ);

		if(count($stmt) > 0){
			return true;
		}
		return false;
	}
	
	public function Signup(){
		$callback = new CallBack();

		

		if($this->HasEmailInBD($_POST['email'])){
			$callback->menssager = "Não é possivel cadastrar esse e-mail.\nCaso tenha esquecido sua senha é possível recupera-la na tela de acesso.";
			return json_encode($callback);
		}

		$this->pdo = $this->db->prepare("INSERT INTO system.user (email, passwd, name) VALUES (?,?,?)");
		$this->pdo->bindValue(1,$_POST['email']);
		$this->pdo->bindValue(2,$_POST['senha']);
		$this->pdo->bindValue(3,$_POST['nome']);
		$stmt = $this->pdo->execute();

		if(!$stmt){
			$Log = new Log();
			$Log->WriteLog("Erro em LoginDAO->Signup:\n INSERT INTO system.user (email, passwd, name) VALUES (?,?)\n" . $_POST['email'] ."\n" . $_POST['senha'] . "\n" . $_POST['nome']);
			$callback->menssager = "Ops, erro ao tentar realizar esse cadastro, tente novamente mais tarde.";
			return json_encode($callback);
		}

		$callback->error = false;
		$callback->menssager = "Parabéns! Seu cadastro foi realizado com sucesso.\nAcesse seu e-mail para terminar seu cadastro.";

		$this->SendValidEmail($_POST['email'], $_POST['senha']);

		return json_encode($callback);
		
	}

	public function Validation($json){
		$callback = new CallBack();

		$this->pdo = $this->db->prepare("SELECT email, valid FROM system.user WHERE email = ? AND passwd = ? ");
		$this->pdo->bindValue(1,$json->email);
		$this->pdo->bindValue(2,$json->senha);
		$this->pdo->execute();
		$stmt = $this->pdo->fetchAll(PDO::FETCH_OBJ);

		if(count($stmt) == 0){
			$callback->menssager = "Não é possivel validar esse e-mail.";
			return json_encode($callback);
		}

		if($stmt[0]->valid){
			$callback->error = false;
			$callback->menssager = "Esse e-mail já foi validado antes.\nEntre na tela de login para acessar a sua carteira.";
			return json_encode($callback);
		}

		$this->pdo = $this->db->prepare("UPDATE system.user SET valid = true;");
		$stmt = $this->pdo->execute();

		if(!$stmt){
			$Log = new Log();
			$Log->WriteLog("Erro em LoginDAO->Validation:\n UPDATE system.user SET valid = true;");
			$callback->menssager = "Ops, erro ao tentar realizar essa validação, tente novamente mais tarde.";
			return json_encode($callback);
		}
		
		$callback->error = false;
		$callback->menssager = "Seu e-mail foi validado com sucesso!";
		return json_encode($callback);
	}

	public function SendValidEmail($email, $senha)
	{
		$Crypt = new Crypt(true);
		$InfoUser = $Crypt->EnCrypt('{"email":"' . $email . '", "senha":"' . $senha . '"}');

		$LayoutEmail = new LayoutEmail();
		
		
		$title = "Seja bem-vindo(a)!"; 
		$p1 = "Você está a um passo de finalizar seu cadastro!<br>Para confirmar seu cadastro basta  <a href='" . URL . "login/login/validation/" . $InfoUser . "'>clicar aqui</a>.";
		$p2 = "Caso não tenha realizado um cadastro em nosso site, favor desconsiderar esse email.";

		new sendEmail(
			$email,
			"",
			"Sejá bem vindo a Carteira do Holder",
			$LayoutEmail->GetHTML($title, $p1, $p2)
		);
	}

	public function GeneratorRecoverPasswd($NewPasswd)
	{
		$this->pdo = $this->db->prepare("UPDATE system.user SET recover_passwd = ?;");
		$this->pdo->bindValue(1,$NewPasswd);
		$stmt = $this->pdo->execute();
	}

	public function RecoverPasswd(){
		$callback = new CallBack();
		if(!$this->HasEmailInBD($_POST['email'])){
			$callback->menssager = "Essa email ainda não possui cadastro.\nVerifique se se o email foi digitado corretamente ou clique em 'Cadastre-se'";
			return json_encode($callback);
		}

		$NewPasswd = "CH-" . mt_rand(100000,999999);
		$this->GeneratorRecoverPasswd($NewPasswd);

		$LayoutEmail = new LayoutEmail();
		
		$title = "Recuperação de senha"; 
		$p1 = "Você solicitou a recuperação de sua senha em nosso site.<br>Sua nova senha é " . $NewPasswd;

		new sendEmail(
			$_POST['email'],
			"",
			"Recuperação de senha",
			$LayoutEmail->GetHTML($title, $p1)
		);

		$callback->error = false;
		$callback->menssager = "Foi enviado para seu email: " . $_POST['email'] . " uma nova senha utilize-a para acessar o sistema.";
		return json_encode($callback);
	}
}