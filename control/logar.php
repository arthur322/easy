<?php 
include 'banco.php';
session_start();
header ("Content-Type: text/html; charset=utf8");

if($_POST['email'] == "" || $_POST['senha'] == "")
{
	$_SESSION['erro'] = "<script>alert('Campos em branco!');</script>";
	header('Location: ../index.php');
}
else
{
	$email = $_POST['email'];
	$senha = md5($_POST['senha']);


	$sql = "SELECT * FROM cadastro WHERE email = '$email' AND senha = '$senha'";
	$result = select($sql);


	if($result->num_rows > 0)
	{
		$row = $result->fetch_assoc();
		$_SESSION['nivel'] = $row['nivel'];
		$_SESSION['id'] = $row['id'];

		if($row['nivel'] != 3)
		{
			$sql = "SELECT * FROM usuario WHERE id_cadastro = $row[id]";
			$result = select($sql);

			if($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
				$_SESSION['id_usuario'] = $row['codigo'];
				header('Location: ../principal.php');
			}
			else
			{
				header('Location: ../perfil/add.php');
			}
		}
		else
		{
			header('Location: ../principal.php');
		}
	}
	else
	{
		$_SESSION['erro'] = "<script>alert('Usuário não encontrado!');</script>";
		header('Location: ../index.php');
	}

}
