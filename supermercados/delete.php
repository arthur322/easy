<?php

require_once ("Supermercado.php");
$supermercado = new Supermercado($_GET['id']);
$supermercado->delete();

header("Location: list.php");



