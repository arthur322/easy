<?php

require_once ("Lista.php");
$produto = new Lista($_SESSION['id_usuario'], $_GET['id']);
$produto->delete();

header("Location: list.php");



