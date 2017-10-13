<?php
header("Content-Type: text/html; charset=utf8");
include "../inc/header.php";

require_once ("Perfil.php");

if(!isset($_SESSION)) session_start();

$perfil = new Perfil(null, $_SESSION['id_usuario']);

$perfil->view();


