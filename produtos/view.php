<?php
include "../inc/header.php";
session_start();
require_once ("Produto.php");
$produto = new Produto($_SESSION['id']);
$produto->view();
