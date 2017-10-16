<?php
session_start();
header ("Content-Type: text/html; charset=utf8");
if(isset($_SESSION['nivel']))
{
	header('Location: principal.php');
}
 ?>
<html>
<link rel="stylesheet" type="text/css" href="css/estilos.css">
<title>Login</title>
<body>
<div class="todo">

<div class="imagemtopo">
	<a href="index.php"><img src="images/imagem1.png" width="200" height="100" /></a>
</div>

</div>
<div class="imagem">
	<img src="images/fundo.png" width="1371" height="510"/>
</div>

<div class="borda">
	<div class="conteudo">
	<form action="control/logar.php" method="post">
		<h2>Login</h2><br>
		<input type="email" id="email" name="email" placeholder="Email"><br><br><br>
		<input type="password" id="senha" name="senha" placeholder="Senha"><br><br>
		<a href="cadastro.php">Cadastre-se</a><br><br><br>
		<input type="submit" value="Entrar">
	</form>
</div>
</div>

<div class="rodape">
	Copyright © 2017 Easy Preços.
</div>

<?php if(isset($_SESSION['erro'])){
		echo $_SESSION['erro'];
		$_SESSION['erro'] = "";
	  }  ?>

</body>
</html>