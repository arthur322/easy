<?php

require_once ("Produto.php");
$produto = new Produto($_GET['codigo']);
$produto->delete();

header("Location: list.php");



