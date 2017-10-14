<?php

include "../inc/header.php";

require_once ("Perfil.php");

if(!isset($_SESSION['id_usuario'])){
	$_SESSION['erro'] = "<script>alert('Você tem que cadastrar um perfil primeiro!');</script>";
	header("Location: ../perfil/add.php");
}

$perfil = new Perfil(null, $_SESSION['id_usuario']);
$perfil->update();

