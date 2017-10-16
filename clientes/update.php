<?php
header ("Content-Type: text/html; charset=utf8");
include "../inc/header.php";

require_once ("Cliente.php");
$usuario = new Cliente($_GET['codigo']);
$usuario->update();

