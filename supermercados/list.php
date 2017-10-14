<?php
include "../inc/header.php";

if(!isset($_SESSION)) session_start();

if($_SESSION['nivel'] != 3){
	header("Location: ../lista/list.php");
}

require_once ("Supermercado.php");
$supermercado = new Supermercado();
$supermercado->listar();

include "modal.php";
