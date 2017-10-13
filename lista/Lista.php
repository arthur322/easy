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


    public function __construct($id=null, $produtos_codigo=null, $quantidade=null){

        $this->id = $id;
        $this->produtos_codigo = $produtos_codigo;
        $this->quantidade = $quantidade;

    }

    public function listar(){

        $con = new PDO(SERVIDOR, USUARIO, SENHA);

        $sql = $con->prepare("SELECT * FROM lista");
        $sql->execute();
        $produtos=$sql->fetchAll(PDO::FETCH_CLASS);

        echo "<h2>Produtos
        <div class='pull-right'> <a class='btn btn-success' href='add.php'><i class='fa fa-plus' aria-hidden='true'></i> Novo</a></div>
        </h2>";

        echo "<table class='table table-bordered'>";
        echo "<tr><th>CODIGO DO PRODUTO</th>";
        echo "<th>QUANTIDADE</th>";
        echo "<th>ACOES</th></tr>";

        foreach($produtos AS $p){
            echo "<tr><td>".$p->produtos_codigo."</td>";
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

        $sql = $con->prepare("SELECT * FROM lista WHERE id=?");
        $sql->execute(array($this->id));
        $r=$sql->fetchObject();

        echo "<h2>Detalhes do produto</h2>";
        echo "<table class='table table-bordered'>";
        echo "<tr><td>id</td><td>".$r->id."</td></tr>";
        echo "<tr><td>produtos_codigo</td><td>".$r->produtos_codigo."</td></tr>";
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

        echo "<h2>Alterar produto</h2>";
        echo "<form method='post' action='' enctype='multipart/form-data'> ";
        echo "<table class='table table-bordered'>";
        echo "<tr><td>ID</td><td><input type='text' name='produtos[id]' value='$this->id' disabled></td></tr>";
        echo "<tr><td>CODIGO DO PRODUTO</td><td><input type='text' name='produtos[produtos_codigo]' value='$this->produtos_codigo'></td></tr>";
        echo "<tr><td>QUANTIDADE</td><td><input type='text' name='produtos[quantidade]' value='$this->quantidade'></td></tr>";
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

            $sql = $con->prepare("INSERT INTO lista (produtos_codigo, quantidade) VALUES (?,?)");
            $sql->execute(array($this->produtos_codigo, $this->quantidade)) ;

            header("Location: list.php");

        }

        echo "<h2>Novo produto</h2>";
        echo "<form method='post' action=''> ";
        echo "<table class='table table-bordered'>";
        echo "<tr><td>CODIGO DO PRODUTO</td><td><input type='text' name='lista[produtos_codigo]' ></td></tr>";
        echo "<tr><td>QUANTIDADE</td><td><input type='text' name='lista[quantidade]' ></td></tr>";
        echo "</table>";
        echo "<input class='btn btn-primary' type='submit' value='Enviar'>";
        echo "</form>";

    }

}




