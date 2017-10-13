<?php

require_once ("Cliente.php");
$cliente = new Cliente($_GET['codigo']);
$cliente->delete();

header("Location: list.php");