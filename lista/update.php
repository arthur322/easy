<?php
include "../inc/header.php";

require_once ("Lista.php");
$lista = new Lista($_GET['id']);
$lista->update();
