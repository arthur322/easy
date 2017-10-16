<?php 

include "../inc/header.php";
header ("Content-Type: text/html; charset=utf8");

?>
<div class="row">
	<div class="col-md-3 center">
		<form action="visualizar.php" method="get">
			<h1>Perfis</h1>
			<input type="hidden" name="tabela" value="usuario">
			<input type="text" name="busca" placeholder="Pesquisa...">
			<br><br>
			Pesquisar no campo:<br><br>
			<select name="where">
				<option value="">---</option>
				<option value="codigo">Codigo</option>
				<option value="nome">Nome</option>
				<option value="datanascimento">Data de nascimento</option>
				<option value="logradouro">Endereço</option>
				<option value="bairro">Bairro</option>
				<option value="cidade">Cidade</option>
				<option value="cep">CEP</option>
			</select>
			<br><br>
			Ordenar por:<br><br>
			<select name="orderby">
				<option value="">---</option>
				<option value="codigo">Codigo</option>
				<option value="nome">Nome</option>
				<option value="datanascimento">Data de nascimento</option>
				<option value="logradouro">Endereço</option>
				<option value="bairro">Bairro</option>
				<option value="cidade">Cidade</option>
				<option value="cep">CEP</option>
			</select>
			<br><br>
			<input type="submit" name="perfil" value="Visualizar relatório">
		</form>
	</div>

	<div class="col-md-3 center">
		<form action="visualizar.php" method="get">
			<h1>Produtos</h1>
			<input type="hidden" name="tabela" value="produtos">
			<input type="text" name="busca" placeholder="Pesquisa...">
			<br><br>
			Pesquisar no campo:<br><br>
			<select name="where">
				<option value="">---</option>
				<option value="codigo">Codigo</option>
				<option value="nome">Nome</option>
				<option value="categoria">Categoria</option>
				<option value="datavalidade">Data de validade</option>
			</select>
			<br><br>
			Ordenar por:<br><br>
			<select name="orderby">
				<option value="">---</option>
				<option value="codigo">Codigo</option>
				<option value="nome">Nome</option>
				<option value="categoria">Categoria</option>
				<option value="datavalidade">Data de validade</option>
			</select>
			<br><br>
			<input type="submit" name="produtos" value="Visualizar relatório">
		</form>
	</div>

	<div class="col-md-3 center">
		<form action="visualizar.php" method="get">
			<h1>Supermercado</h1>
			<input type="hidden" name="tabela" value="supermercados">
			<input type="text" name="busca" placeholder="Pesquisa...">
			<br><br>
			Pesquisar no campo:<br><br>
			<select name="where">
				<option value="">---</option>
				<option value="id">Codigo</option>
				<option value="nome">Nome</option>
				<option value="cnpj">CNPJ</option>
				<option value="logradouro">Endereço</option>
				<option value="bairro">Bairro</option>
				<option value="cep">CEP</option>
				<option value="cidade">Cidade</option>
				<option value="telefone">Telefone</option>
			</select>
			<br><br>
			Ordenar por:<br><br>
			<select name="orderby">
				<option value="">---</option>
				<option value="codigo">Codigo</option>
				<option value="nome">Nome</option>
				<option value="cnpj">CNPJ</option>
				<option value="logradouro">Endereço</option>
				<option value="bairro">Bairro</option>
				<option value="cep">CEP</option>
				<option value="cidade">Cidade</option>
				<option value="telefone">Telefone</option>
			</select>
			<br><br>
			<input type="submit" name="supermercados" value="Visualizar relatório">
		</form>
	</div>
	<div class="col-md-3 center">
		<form action="visualizar.php" method="get">
			<h1>Preços</h1>
			<input type="hidden" name="tabela" value="precos">
			<input type="text" name="busca" placeholder="Pesquisa...">
			<br><br>
			Pesquisar no campo:<br><br>
			<select name="where">
				<option value="">---</option>
				<option value="p.codigo">Codigo do produto</option>
				<option value="p.nome">Nome do produto</option>
				<option value="sp.id">Codigo do Supermercado</option>
				<option value="sp.nome">Nome do Supermercado</option>
				<option value="preco">Preço do produto do Supermercado</option>
			</select>
			<br><br>
			Ordenar por:<br><br>
			<select name="orderby">
				<option value="">---</option>
				<option value="p.codigo">Codigo do produto</option>
				<option value="p.nome">Nome do produto</option>
				<option value="sp.id">Codigo do Supermercado</option>
				<option value="sp.nome">Nome do Supermercado</option>
				<option value="preco">Preço do produto do Supermercado</option>
			</select>
			<br><br>
			<input type="submit" name="precos" value="Visualizar relatório">
		</form>
	</div>
</div>
