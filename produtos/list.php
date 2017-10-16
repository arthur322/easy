<?php
include "../inc/header.php";
header ("Content-Type: text/html; charset=utf8");

require_once ("Produto.php");
$produto = new Produto();
$produto->listar();

include "modal.php";
