<?php
include "../inc/header.php";
header ("Content-Type: text/html; charset=utf8");

require_once ("Lista.php");
$lista = new Lista($_SESSION['id_usuario']);
$lista->add();
