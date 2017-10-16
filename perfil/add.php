<?php
include "../inc/header.php";
header ("Content-Type: text/html; charset=utf8");

require_once ("Perfil.php");
$perfil = new Perfil();
$perfil->add();

