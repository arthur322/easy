<?php
header ("Content-Type: text/html; charset=utf8");
require_once ("Cliente.php");
$cliente = new Cliente($_GET['codigo']);
$cliente->delete();

header("Location: list.php");