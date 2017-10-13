<?php
include "../inc/header.php";

require_once ("Lista.php");
$lista = new Lista();
$lista->listar();

include "modal.php";
