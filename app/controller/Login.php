<?php
/**
 * 
 */
class Login extends View
{
    function __construct(){
		parent::__construct();
    }
    
    function Login(){
        $this->DrawView(get_class($this));
        $this->IncludeJavaScrip("Validation","lib/func");
        $this->IncludeJavaScrip(get_class($this));
    }

    public function Signin() {
        if(!isset($_POST['email']) || !isset($_POST['senha'])) return;

        $callback = new CallBack(false);

        if(!valida_email($_POST['email'])){
            $callback->error = true;
            array_push($callback->errorField, '{ "field" : "email", "menssager": "E-mail inválido."}');
        }

        if(strlen($_POST['senha']) <= 0){
            $callback->error = true;
            array_push($callback->errorField, '{ "field" : "senha", "menssager": "Por favor informe sua senha."}');
        }

        if($callback->error){
            return json_encode($callback);
        }

        $_POST['senha'] = md5($_POST['senha']);
        $LoginDAO = new LoginDAO();
        return $LoginDAO->Signin();
    }

    public function Signup(){
        if(!isset($_POST['email']) || !isset($_POST['senha']) || !isset($_POST['resenha']) || !isset($_POST['nome'])) return;

        $callback = new CallBack(false);
        
        if(!valida_email($_POST['email'])){
            $callback->error = true;
            array_push($callback->errorField, '{ "field" : "email", "menssager": "Informe um e-mail válido."}');
        }

        if(!valida_senha($_POST['senha'])){
            $callback->error = true;
            array_push($callback->errorField, '{ "field" : "senha", "menssager": "A senha deve ter pelo menos 8 caracteres e incluir pelo menos uma letra maiúscula, um número e um caractere especial."}');
        }

        if(strlen($_POST['nome']) <= 0){
            $callback->error = true;
            array_push($callback->errorField, '{ "field" : "nome", "menssager": "Informe seu nome."}');
        }

        if($_POST['senha'] != $_POST['resenha'] || strlen($_POST['senha']) <= 0 ){
            $callback->error = true;
            array_push($callback->errorField, '{ "field" : "resenha", "menssager": "Os dois campos de senha devem ser iguais."}');
        }

        if($callback->error){
            return json_encode($callback);
        }

        $_POST['senha'] = md5($_POST['senha']);
        $LoginDAO = new LoginDAO();
        return $LoginDAO->Signup();
    }

    public function Validation($hash){
        $Crypt = new Crypt(true);
        $json = json_decode($Crypt->DeCrypt($hash));
        if($json == '' || $json == null || !property_exists($json, "email") || !property_exists($json, "senha")) {
            $callback = new CallBack();
            $callback->menssager = "Não foi possível atenticar esse email.\nTente novamente mais tarde.";
            return json_encode($callback);
        }

        $LoginDAO = new LoginDAO();
        return $LoginDAO->Validation($json);   
    }

    public function RecoverPasswd(){
        $LoginDAO = new LoginDAO();
        return $LoginDAO->RecoverPasswd();   
    }
}