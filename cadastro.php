
<?php
header ("Content-Type: text/html; charset=utf8");
session_start();
if(isset($_SESSION['id']))
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
	<form action="control/cadastrar.php" method="post">
			<h2>Cadastre-se!</h2>
			<input type="email" name="email" placeholder="Email"><br><br><br>
			<input type="password" name="senha" placeholder="Senha"><br><br><br>
			<input type="password" name="repete_senha" placeholder="Confirme sua senha"><br><br>
			<input type="submit" value="Cadastrar">
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