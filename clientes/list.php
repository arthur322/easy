<?php
header("Content-type: text/html; charset=utf8");

include("../inc/header.php");

require_once ("Cliente.php");

$cliente = new Cliente();

$cliente->listar();

include "modal.php";