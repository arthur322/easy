<?php
define('SERVIDOR', 'mysql:host=localhost;dbname=db_easy');
define('USUARIO', 'root');
define('SENHA', '');

if(!isset($_SESSION)) session_start();

class Lista
{
    private $id;
    private $produtos_codigo;
    private $quantidade;


    public function __construct($id_usuario = null, $id=null, $produtos_codigo=null, $quantidade=null){

        $this->id_usuario = $id_usuario;
        $this->id = $id;
        $this->produtos_codigo = $produtos_codigo;
        $this->quantidade = $quantidade;

    }

    public function listar(){

        $con = new PDO(SERVIDOR, USUARIO, SENHA);

        $sql = $con->prepare("SELECT * FROM lista l INNER JOIN produtos p ON p.codigo = l.produtos_codigo WHERE l.id_usuario=?");
        $sql->execute(array($this->id_usuario));
        $produtos=$sql->fetchAll(PDO::FETCH_CLASS);

        echo "<h2>Lista de compras
        <div class='pull-right'> <a class='btn' href='comparapreco.php'><i class='fa fa-plus' aria-hidden='true'></i> Comparar preços</a></div>
        <div class='pull-right'> <a class='btn btn-success' href='add.php'><i class='fa fa-plus' aria-hidden='true'></i> Novo</a></div>
        </h2>";

        echo "<table class='table table-bordered'>";
        echo "<tr><th>NOME DO PRODUTO</th>";
        echo "<th>QUANTIDADE</th>";
        echo "<th>ACOES</th></tr>";

        foreach($produtos AS $p){
            echo "<tr><td>".$p->nome."</td>";
            echo "<td>".$p->quantidade."</td>";
            echo "<td>
            <a class='btn btn-warning' href='view.php?id=$p->id'><i class='fa fa-search' aria-hidden='true'></i> Ver</a>
            <a class='btn btn-primary' href='update.php?id=$p->id'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Editar</a>
            </td></tr>";

        }
        echo "</table>";

    }

    public function view(){

        $con = new PDO(SERVIDOR, USUARIO, SENHA);

        $sql = $con->prepare("SELECT * FROM lista l INNER JOIN produtos p ON p.codigo = l.produtos_codigo WHERE l.id=?");
        $sql->execute(array($this->id));
        $r=$sql->fetchObject();
        
        echo "<h2>Produto da compras</h2>";
        echo "<table class='table table-bordered'>";
        echo "<tr><td>Nome do produto</td><td>".$r->nome."</td></tr>";
        echo "<tr><td>quantidade</td><td>".$r->quantidade."</td></tr>";
        echo "</table>";

        echo "<a class='btn btn-primary' href='list.php'>Voltar</a>";

    }

    public function update(){

        $con = new PDO(SERVIDOR, USUARIO, SENHA);

        if ( isset($_POST['lista']) ){

            $this->produtos_codigo=$_POST['lista']['produtos_codigo'];
            $this->quantidade=$_POST['lista']['quantidade'];

            $sql = $con->prepare("UPDATE lista SET produtos_codigo=?, quantidade=? WHERE id=?");
            $sql->execute(array($this->produtos_codigo, $this->quantidade, $this->id)) ;
            
            header("Location: list.php");

        }

        $sql = $con->prepare("SELECT * FROM lista WHERE id=?");
        $sql->execute(array($this->id)) ;
        $r=$sql->fetchObject();

        $this->produtos_codigo = $r->produtos_codigo;
        $this->quantidade = $r->quantidade;


        $sql = $con->prepare("SELECT * FROM produtos");
        $sql->execute();
        $produtos=$sql->fetchAll(PDO::FETCH_CLASS);

        echo "<h2>Alterar produto</h2>";
        echo "<form method='post' action='' enctype='multipart/form-data'> ";
        echo "<table class='table table-bordered'>";
        echo "<tr><td>ID</td><td><input type='text' name='lista[id]' value='$this->id' disabled></td></tr>";
        echo "<tr><td>CODIGO DO PRODUTO</td><td>";
        echo "<select class='form-control' name='lista[produtos_codigo]' disabled>";
        foreach($produtos as $produto){
            if($produto->codigo == $this->produtos_codigo)
            echo "<option value=".$produto->codigo." selected>".$produto->nome."</option>";
            else
            echo "<option value=".$produto->codigo.">".$produto->nome."</option>";
        }
        echo"</select></td></tr>";
        echo "<tr><td>QUANTIDADE</td><td><input type='text' name='lista[quantidade]' value='$this->quantidade'></td></tr>";
        echo "</table>";
        echo "<input class='btn btn-primary' type='submit' value='Salvar'>";
        echo " <a class='btn btn-default' href='list.php'>Cancelar</a>";
        echo "</form>";

    }

    public function add(){

        $con = new PDO(SERVIDOR, USUARIO, SENHA);

        if ( isset($_POST['lista']) ){

            $this->produtos_codigo=$_POST['lista']['produtos_codigo'];
            $this->quantidade=$_POST['lista']['quantidade'];

            $sql = $con->prepare("INSERT INTO lista (id_usuario, produtos_codigo, quantidade) VALUES (?,?,?)");
            $sql->execute(array($this->id_usuario, $this->produtos_codigo, $this->quantidade)) ;
            
            header("Location: list.php");

        }

        $sql = $con->prepare("SELECT * FROM produtos");
        $sql->execute();
        $produtos=$sql->fetchAll(PDO::FETCH_CLASS);

        echo "<h2>Novo produto</h2>";
        echo "<form method='post' action=''> ";
        echo "<table class='table table-bordered'>";
        echo "<tr><td>CODIGO DO PRODUTO</td><td>";
        echo "<select class='form-control' name='lista[produtos_codigo]'>";
        foreach($produtos as $produto){
            echo "<option value=".$produto->codigo.">".$produto->nome."</option>";
        }
        echo"</select></td></tr>";
        echo "<tr><td>QUANTIDADE</td><td><input type='text' name='lista[quantidade]' ></td></tr>";
        echo "</table>";
        echo "<input class='btn btn-primary' type='submit' value='Enviar'>";
        echo "</form>";

    }



    public function comparaPreco(){

        $con = new PDO(SERVIDOR, USUARIO, SENHA);

        $sql = $con->prepare("select produtos_codigo, quantidade from lista where id_usuario = ?");
        $sql->execute(array($this->id_usuario)) ;
        $produtos=$sql->fetchAll(PDO::FETCH_ASSOC);

        foreach($produtos as $pr){
            $sql = $con->prepare("CALL recupera_menor_preco(?)");
            $sql->execute(array($pr['produtos_codigo'])) ;
            $result=$sql->fetch(PDO::FETCH_ASSOC);
            $total[] = array('produto_nome' => $result['produto_nome'],
                            'id_supermercado' => $result['id_supermercado'],
                            'supermercado_nome' => $result['supermercado_nome'],
                            'preco' => $result['preco'],
                            'quantidade' => $pr['quantidade'], 
                            'total' => ((int)$pr['quantidade'] * (int)$result['preco']));
        }

        echo "<h2>Comparação</h2>";

        echo "<table class='table table-bordered'>";
        echo "<tr><th>NOME DO PRODUTO</th>";
        echo "<th>SUPERMERCADO</th>";
        echo "<th>PRECO</th>";
        echo "<th>QUANTIDADE</th>";
        echo "<th>TOTAL</th></tr>";

        foreach($total AS $t){
            echo "<tr><td>".$t['produto_nome']."</td>";
            echo "<td><a href='../supermercados/view.php?id=".$t['id_supermercado']."'>".$t['supermercado_nome']."</a></td>";
            echo "<td>".$t['preco']."</td>";
            echo "<td>".$t['quantidade']."</td>";
            echo "<td>".$t['total']."</td></tr>";

        }
        echo "</table>";

    }

}




