<?php
include "../inc/header.php";

require_once ("Supermercado.php");
$supermercado = new Supermercado();
$supermercado->listar();

include "modal.php";
