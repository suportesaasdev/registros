<?php
require_once 'conn.php';
Class User{
	Private $name;
	Private $email;
	Private $password;
	Private $salt;

	public function setName($var){
		$this -> name = $var;
	}
	public function setEmail($var){
		$this -> email = $var;
	}
	public function setSalt($var){
		$this -> salt = $var;
	}

	public function setPassword($var){
		$this -> password = md5($var, $salt);
	}

	public function getName(){
		return $this -> name;
	}
	public function getEmail(){
		return $this -> email;
	}
	public function getSalt(){
		return $this -> salt;
	}
	public function getPassword(){
		return $this -> password;
	}

	public function register(){
		$email = $this -> email;
		$query = mysql_query("SELECT email FROM usuarios WHERE email='$email';");
		$linha = mysql_fetch_assoc($query);
		$logarray = $linha['email'];
		
		if($logarray == $email){
			header("Location: ../index.php?error=email_in_use");
        	die();
        }else{
        	$name = $this -> name;
        	$password = $this -> password;
        	$salt = $this -> salt;


        	$query = "INSERT INTO usuarios (nome, email, senha, salt) VALUES ('$name','$email', '$password', '$salt')";
       		$insert = mysql_query($query);
        
        	if($insert){
          		header("Location: ../index.php?success=yes");
        	}else{
          		header("Location: ../index.php?success=nope");

        	}
        }
	}

	public function login($email_, $password_){
		$senha = $password_;
		$query = mysql_query("SELECT * FROM usuarios WHERE email = '$email_';") or die("erro ao selecionar") ;
		if (mysql_num_rows($query)<=0){
        	header("Location: ../index.php?error=wrong_user");  
          die();
        }else{
        	
        	if($query){
        		$ler = mysql_fetch_assoc($query);

        		if($ler['senha'] == $senha){
        			session_start();
        			$_SESSION['nome'] = $ler['nome'];
        			$_SESSION['email'] = $email_;
        		}else{
        			echo $ler['senha'];
        			echo '<hr />';
        			echo $senha;
        		}
        	}
        }
	}
}


$usuario = new User();

$usuario -> setName('nicolas');
$usuario -> setEmail('nicolasgleiser.com.br');
$usuario -> setSalt('esse é um salt Bem bacanudo !@#$%¨&*');
$usuario -> setPassword('SenhaManeira@123456');
$email = $usuario -> getEmail();
$senha = $usuario -> getPassword();

$usuario -> login($email, $senha);