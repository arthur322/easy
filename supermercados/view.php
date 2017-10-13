<?php
include "../inc/header.php";

require_once ("Supermercado.php");
$supermercado = new Supermercado($_GET['id']);
$supermercado->view();
