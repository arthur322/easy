<?php if(!isset($_SESSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Easy Preços</title>
    <meta charset="utf-8">
    <?php
    header("Content-Type: text/html; charset=utf8");
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .container{
            min-height: 486px;
            background-color: white;
            width: 1333px;
        }
         body{
             background-color: #303030;
         }
        .aba{
            border-bottom: 1px solid #e3e3e3;
            border-left: 1px solid #e3e3e3;
            border-right: 1px solid #e3e3e3;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            min-height: 330px;
            padding: 10px;
            margin-bottom: 30px;
            background-color: #fff;
        }
        .jumbotron, .rodape{
            background-color: #ff5c33;
        }
        .rodape{
            margin:0;
            margin-top: 30px;
            min-height: 74px;
            padding: 10px;
        }
        .rodape-direita{
            font-size: 10px;
            padding-bottom: 20px;
        }
        .jumbotron{
            padding-bottom: 20px;
            padding-top: 20px;
        }
        .navbar{
            margin-bottom: 0px;
        }
        .active{
            background-color: ghostwhite;
        }
        .navbar ul li a{
            color: #ff5c33;
        }
    </style>
</head>
<body>

<?php
$painel=array('','','','','','');
switch($_SERVER['REQUEST_URI']){
    case '' : $painel[0]='active'; break;
    case '/easy/clientes/list.php' : $painel[1]='active'; break;
    case '/easy/produtos/list.php' : $painel[2]='active'; break;
    case '/easy/supermercados/list.php' : $painel[3]='active'; break;
    case '/easy/lista/list.php' : $painel[4]='active'; break;
    case '/easy/relatórios/index.php' : $painel[5]='active'; break;

}

?>
<nav class="navbar">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <?php if($_SESSION['nivel'] == 3){ ?><li class="<?php echo $painel[1]; ?>"><a href="/easy/clientes/list.php">CLIENTES</a></li><?php } ?>
            <?php if($_SESSION['nivel'] == 3){ ?><li class="<?php echo $painel[2]; ?>"><a href="/easy/produtos/list.php">PRODUTOS</a></li><?php } ?>
            <?php if($_SESSION['nivel'] == 3){ ?><li class="<?php echo $painel[3]; ?>"><a href="/easy/supermercados/list.php">SUPERMERCADOS</a></li><?php } ?>
            <?php if($_SESSION['nivel'] != 3){ ?><li class="<?php echo $painel[4]; ?>"><a href="/easy/lista/list.php">LISTA</a></li><?php } ?>
            <?php if($_SESSION['nivel'] == 3){ ?><li class="<?php echo $painel[5]; ?>"><a href="/easy/relatorios/index.php">RELATÓRIOS</a></li><?php } ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php if($_SESSION['nivel'] != 3){ ?><li><a href="/easy/perfil/view.php"><span class="glyphicon glyphicon-user"></span> PERFIL</a></li><?php } ?>
            <li><a href="/easy/logout.php"><span class="glyphicon glyphicon-log-in"></span> SAIR</a></li>
        </ul>
    </div>
</nav>
<div class="jumbotron text-center">
    <a href="/easy/principal.php"><h1>Easy Preços</h1></a>
</div>

<div class="container">

<?php

if(isset($_SESSION['erro'])){
    echo $_SESSION['erro'];
    $_SESSION['erro'] = "";
}

?>