<?php

include "../inc/header.php";

require_once ("Perfil.php");
$perfil = new Perfil(null, $_SESSION['id_usuario']);
$perfil->update();

