<?php
header ("Content-Type: text/html; charset=utf8");
include "../inc/header.php";
$con = new mysqli('localhost', 'root', '', 'db_easy');

if($_GET['tabela'] == 'precos'){
    $campo = "p.codigo as codigo_produto,p.nome as nome_produto,sp.id as codigo_supermercado,sp.nome as nome_supermercado,pr.preco";
    $_GET['tabela'] = "precos pr left join produtos p on p.codigo = pr.id_produto left join supermercados sp on sp.id = pr.id_supermercado";
}
else
    $campo = "*";

if(!empty($_GET['busca'])){
    if(!empty($_GET['orderby']))
        $sql = "SELECT ".$campo." FROM ".$_GET['tabela']." WHERE lower(".$_GET['where'].") LIKE lower('%".$_GET['busca']."%') ORDER BY ".$_GET['orderby'].";";
    else
        $sql = "SELECT ".$campo." FROM ".$_GET['tabela']." WHERE lower(".$_GET['where'].") LIKE lower('%".$_GET['busca']."%');";
}else if(!empty($_GET['orderby']))
        $sql = "SELECT ".$campo." FROM ".$_GET['tabela']." ORDER BY ".$_GET['orderby'].";";
    else
        $sql = "SELECT ".$campo." FROM ".$_GET['tabela'].";";
var_dump($sql);

echo "<a class='btn btn-primary' href='relatorios.php'>Voltar</a><br>";

if($res = $con->query($sql)){
    if ($res->num_rows > 0) {
        $resultado = $res->fetch_all(MYSQLI_ASSOC);

        if($_GET['tabela'] == 'usuario'){
            echo "<table class='table table-bordered'>";
            echo "<tr><th>ID</th>";
            echo "<th>NOME</th>";
            echo "<th>CPF</th>";
            echo "<th>DATA NASCIMENTO</th>";
            echo "<th>TELEFONE</th>";
            echo "<th>CEP</th>";
            echo "<th>LOGRADOURO</th>";
            echo "<th>BAIRRO</th>";
            echo "<th>NUMERO</th>";
            echo "<th>CIDADE</th>";
            echo "<th>ESTADO</th></tr>";
            foreach($resultado as $r){
                echo "<tr><td>".$r['codigo']."</td>";
                echo "<td>".$r['nome']."</td>";
                echo "<td>".$r['cpf']."</td>";
                echo "<td>".$r['datanascimento']."</td>";
                echo "<td>".$r['telefone']."</td>";
                echo "<td>".$r['cep']."</td>";
                echo "<td>".$r['logradouro']."</td>";
                echo "<td>".$r['bairro']."</td>";
                echo "<td>".$r['numero']."</td>";
                echo "<td>".$r['cidade']."</td>";
                echo "<td>".$r['estado']."</td></tr>";
            }
        }

        if($_GET['tabela'] == 'produtos'){
            echo "<table class='table table-bordered'>";
            echo "<tr><th>NOME</th>";
            echo "<th>ID</th>";
            echo "<th>FOTO</th>";
            echo "<th>CATEGORIA</th>";
            echo "<th>PRECO</th>";
            echo "<th>DATA VALIDADE</th></tr>";
            foreach($resultado as $r){
                echo "<tr><td>".$r['codigo']."</td>";
                echo "<td>".$r['nome']."</td>";
                echo "<td><img height='50px' src='../produtos/images/".$r['foto']."'></td>";
                echo "<td>".$r['categoria']."</td>";
                echo "<td>R$ ".$r['preco']."</td>";
                echo "<td>".$r['datavalidade']."</td></tr>";
            }
        }

        if($_GET['tabela'] == 'supermercados'){
            echo "<table class='table table-bordered'>";
            echo "<tr><th>ID</th>";
            echo "<th>NOME</th>";
            echo "<th>FOTO</th>";
            echo "<th>CNPJ</th>";
            echo "<th>CEP</th>";
            echo "<th>LOGRADOURO</th>";
            echo "<th>BAIRRO</th>";
            echo "<th>NUMERO</th>";
            echo "<th>CIDADE</th>";
            echo "<th>ESTADO</th>";
            echo "<th>TELEFONE</th></tr>";
            foreach($resultado as $r){
               echo "<tr><td>".$r['id']."</td>";
               echo "<td>".$r['nome']."</td>";
                echo "<td><img height='50px' src='../supermercados/images/".$r['foto']."'></td>";
                echo "<td>".$r['cnpj']."</td>";
                echo "<td>".$r['cep']."</td>";
                echo "<td>".$r['logradouro']."</td>";
                echo "<td>".$r['bairro']."</td>";
                echo "<td>".$r['numero']."</td>";
                echo "<td>".$r['cidade']."</td>";
                echo "<td>".$r['estado']."</td>";
                echo "<td>".$r['telefone']."</td></tr>";
            }
        }

        if($_GET['tabela'] == 'supermercados'){
            echo "<table class='table table-bordered'>";
            echo "<tr><th>ID</th>";
            echo "<th>NOME</th>";
            echo "<th>FOTO</th>";
            echo "<th>CNPJ</th>";
            echo "<th>CEP</th>";
            echo "<th>LOGRADOURO</th>";
            echo "<th>BAIRRO</th>";
            echo "<th>NUMERO</th>";
            echo "<th>CIDADE</th>";
            echo "<th>ESTADO</th>";
            echo "<th>TELEFONE</th></tr>";
            foreach($resultado as $r){
               echo "<tr><td>".$r['id']."</td>";
               echo "<td>".$r['nome']."</td>";
                echo "<td><img height='50px' src='../supermercados/images/".$r['foto']."'></td>";
                echo "<td>".$r['cnpj']."</td>";
                echo "<td>".$r['cep']."</td>";
                echo "<td>".$r['logradouro']."</td>";
                echo "<td>".$r['bairro']."</td>";
                echo "<td>".$r['numero']."</td>";
                echo "<td>".$r['cidade']."</td>";
                echo "<td>".$r['estado']."</td>";
                echo "<td>".$r['telefone']."</td></tr>";
            }
        }


        if(strpos($_GET['tabela'], 'precos') !== false){
            echo "<table class='table table-bordered'>";
            echo "<tr><th>ID PRODUTO</th>";
            echo "<th>NOME DO PRODUTO</th>";
            echo "<th>CÓD. SUPERM.</th>";
            echo "<th>SUPERMERCADO</th>";
            echo "<th>PRECO</th></tr>";
            foreach($resultado as $r){
                echo "<tr><td>".$r['codigo_produto']."</td>";
                echo "<td>".$r['nome_produto']."</td>";
                echo "<td>".$r['codigo_supermercado']."</td>";
                echo "<td>".$r['nome_supermercado']."</td>";
                echo "<td>".$r['preco']."</td></tr>";
            }
        }

    }
    else
    {
        echo "Nenhum produto cadastrado.";
    }
}else{
    echo "Nenhum produto cadastrado.";
}



?>
