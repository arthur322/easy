<?php
include "../inc/header.php";

require_once ("Produto.php");
$produto = new Produto($_GET['codigo']);
$produto->view();
