<?php

require_once ("Lista.php");
header ("Content-Type: text/html; charset=utf8");
$produto = new Lista($_SESSION['id_usuario'], $_GET['id']);
$produto->delete();

header("Location: list.php");



