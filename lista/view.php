<?php
include "../inc/header.php";

require_once ("Lista.php");
$lista = new Lista($_SESSION['id_usuario'], $_GET['id']);
$lista->view();
