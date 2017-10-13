<?php 
session_start();
include 'banco.php';

$email = $_POST['email'];
$senha = md5($_POST['senha']);
$repete_senha = md5($_POST['repete_senha']);

if(!empty($email) && !empty($senha) && !empty($repete_senha))
{
    if($senha != $repete_senha){    	
    	$_SESSION['erro'] = "<script>alert('Senhas não conferem!');</script>";
    	header('Location: ../cadastro.php');
 	}
    else
    {
    	$sql = "SELECT * FROM cadastro WHERE email = '$email'";
		$result = select($sql);

		if($result->num_rows > 0)
		{
			$_SESSION['erro']= "<script>alert('Email já cadastrado! Tente novamente!');</script>";
			header('Location: ../cadastro.php');
		}
		else
		{
			$sql = "INSERT INTO cadastro (email, senha, nivel) VALUES ('$email', '$senha', 1);";

			if(executar($sql) === TRUE)
			{
				$_SESSION['id'] = $ultimo_id;
				$_SESSION['nivel'] = 1;
				header('Location: ../principal.php');
			}
			else
			{
				$_SESSION['erro'] = "<script>alert('Impossível cadastrar!');</script>";
				header('Location: ../cadastro.php');
			}
    	}
    }
}
else
{
	$_SESSION['erro'] = "<script>alert('Algum campo está em branco!');</script>";
	header('Location: ../cadastro.php');
}


