<?php
include "../inc/header.php";
header ("Content-Type: text/html; charset=utf8");

if(!isset($_SESSION)) session_start();

if(!isset($_SESSION['id_usuario'])){
	$_SESSION['erro'] = "<script>alert('Você tem que cadastrar um perfil primeiro!');</script>";
	header("Location: ../perfil/add.php");
}

require_once ("Lista.php");
$lista = new Lista($_SESSION['id_usuario']);
$lista->comparaPreco();

include "modal.php";

