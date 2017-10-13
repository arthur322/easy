<?php
include "../inc/header.php";

require_once ("Produto.php");
$produto = new Produto();
$produto->add();
