<?php
header ("Content-Type: text/html; charset=utf8");
session_start();
if(!isset($_SESSION['id'])){
	$_SESSION['erro'] = "<script>alert('Você precisa logar para acessar essa página!');</script>";
	header('Location: index.php');
}
if($_SESSION['nivel'] == 1)
{
	include_once 'visitante.php';
} 
else if($_SESSION['nivel'] >= 2)
{
	include_once 'cadastrado.php';
}
?>