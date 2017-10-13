<?php
define('SERVIDOR', 'mysql:host=localhost;dbname=db_easy');
define('USUARIO', 'root');
define('SENHA', '');

if(!isset($_SESSION)) session_start();

class Produto
{
    private $codigo;
    private $nome;
    private $categoria;
    private $preco;
    private $datavalidade;
    private $foto;

    public function __construct($codigo=null, $nome=null, $categoria=null, $preco=null, $datavalidade=null, $foto=null){

        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->categoria = $categoria;
        $this->preco = $preco;
        $this->datavalidade = $datavalidade;
        $this->foto = $foto;

    }

    public function listar(){

        $con = new PDO(SERVIDOR, USUARIO, SENHA);

        $sql = $con->prepare("SELECT * FROM produtos");
        $sql->execute();
        $produtos=$sql->fetchAll(PDO::FETCH_CLASS);

        echo "<h2>Produtos
        <div class='pull-right'> <a class='btn btn-success' href='add.php'><i class='fa fa-plus' aria-hidden='true'></i> Novo</a></div>
        </h2>";

        echo "<table class='table table-bordered'>";
        echo "<tr><th>NOME</th>";
        echo "<th>FOTO</th>";
        echo "<th>CATEGORIA</th>";
        echo "<th>PRECO</th>";
        echo "<th>DATA VALIDADE</th>";
        echo "<th>ACOES</th></tr>";

        foreach($produtos AS $p){
            echo "<tr><td>".$p->nome."</td>";
            echo "<td><img height='50px' src='images/".$p->foto."'></td>";
            echo "<td>".$p->categoria."</td>";
            echo "<td>".$p->preco."</td>";
            echo "<td>".$p->datavalidade."</td>";
            echo "<td>
            <a class='btn btn-warning' href='view.php?codigo=$p->codigo'><i class='fa fa-search' aria-hidden='true'></i> Ver</a>
            <a class='btn btn-primary' href='update.php?codigo=$p->codigo'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Editar</a>
            <button type='button' class='btn btn-danger btn-excluir' data-toggle='modal' data-target='#delete-modal' data-codigo='$p->codigo' data-nome='$p->categoria'><i class='fa fa-trash-o' aria-hidden='true'></i> Excluir</button>
            </td></tr>";

        }
        echo "</table>";

    }

    public function view(){

        $con = new PDO(SERVIDOR, USUARIO, SENHA);

        $sql = $con->prepare("SELECT * FROM produtos WHERE codigo=?");
        $sql->execute(array($this->codigo)) ;
        $r=$sql->fetchObject();

        echo "<h2>Detalhes do produto</h2>";
        echo "<table class='table table-bordered'>";
        echo "<tr><td>CODIGO</td><td>".$r->codigo."</td></tr>";
        echo "<tr><td>NOME</td><td>".$r->nome."</td></tr>";
        echo "<tr><td>CATEGORIA</td><td>".$r->categoria."</td></tr>";
        echo "<tr><td>PRECO</td><td>".$r->preco."</td></tr>";
        echo "<tr><td>DATA VALIDADE</td><td>".$r->datavalidade."</td></tr>";
        echo "</table>";

        echo "<a class='btn btn-primary' href='list.php'>Voltar</a>";

    }

    public function delete(){

        $con = new PDO(SERVIDOR, USUARIO, SENHA);

        $sql = $con->prepare("DELETE FROM produtos WHERE codigo=?");
        $sql->execute(array($this->codigo)) ;
    }

    public function update(){

        $con = new PDO(SERVIDOR, USUARIO, SENHA);

        if ( isset($_POST['produtos']) ){

            // o usuario enviou uma fota
            if ( isset($_FILES['foto']) && !empty($_FILES["foto"]["name"]) ){
                $target_dir = "images/";
                $target_file = $target_dir . basename($_FILES["foto"]["name"]);
                
                // envia a foto
                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);

                // para ser usado no banco de dados
                $this->foto=$_FILES["foto"]["name"];

                // alterando o campo no banco de dados
                $sql = $con->prepare("UPDATE produtos SET foto=? WHERE codigo=?");
                $sql->execute(array($this->foto,  $this->codigo)) ;

            }

            $this->nome=$_POST['produtos']['nome'];
            $this->categoria=$_POST['produtos']['categoria'];
            $this->preco=$_POST['produtos']['preco'];
            $this->datavalidade=$_POST['produtos']['datavalidade'];

            $sql = $con->prepare("UPDATE produtos SET nome=?, categoria=?, preco=?, datavalidade=? WHERE codigo=?");
            $sql->execute(array($this->nome, $this->categoria, $this->preco, $this->datavalidade,  $this->codigo)) ;

            header("Location: list.php");

        }

        $sql = $con->prepare("SELECT * FROM produtos WHERE codigo=?");
        $sql->execute(array($this->codigo)) ;
        $r=$sql->fetchObject();

        $this->nome = $r->nome;
        $this->categoria = $r->categoria;
        $this->preco = $r->preco;
        $this->datavalidade = $r->datavalidade;

        echo "<h2>Alterar produto</h2>";
        echo "<form method='post' action='' enctype='multipart/form-data'> ";
        echo "<table class='table table-bordered'>";
        echo "<tr><td>CODIGO</td><td><input type='text' name='produtos[codigo]' value='$this->codigo' disabled></td></tr>";
        echo "<tr><td>NOME</td><td><input type='text' name='produtos[nome]' value='$this->nome'></td></tr>";
        echo "<tr><td>CATEGORIA</td><td><input type='text' name='produtos[categoria]' value='$this->categoria'></td></tr>";
        echo "<tr><td>PRECO</td><td><input type='text' name='produtos[preco]' value='$this->preco'></td></tr>";
        echo "<tr><td>DATA VALIDADE</td><td><input type='text' name='produtos[datavalidade]' value='$this->datavalidade'></td></tr>";
        echo "<tr><td>FOTO</td><td>
        <input type='file' name='foto'>
        </td></tr>";
        echo "</table>";
        echo "<input class='btn btn-primary' type='submit' value='Salvar'>";
        echo " <a class='btn btn-default' href='list.php'>Cancelar</a>";
        echo "</form>";

    }

    public function add(){

        $con = new PDO(SERVIDOR, USUARIO, SENHA);

        if ( isset($_POST['produtos']) ){

            // o usuario enviou uma fota
            if ( isset($_FILES['foto']) && !empty($_FILES["foto"]["name"]) ){
                $target_dir = "images/";
                $target_file = $target_dir . basename($_FILES["foto"]["name"]);

                // envia a foto
                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);

                // para ser usado no banco de dados
                $this->foto=$_FILES["foto"]["name"];

                // alterando o campo no banco de dados
                $sql = $con->prepare("UPDATE produtos SET foto=? WHERE codigo=?");
                $sql->execute(array($this->foto,  $this->id)) ;

            }

            $this->nome=$_POST['produtos']['nome'];
            $this->categoria=$_POST['produtos']['categoria'];
            $this->preco=$_POST['produtos']['preco'];
            $this->datavalidade=$_POST['produtos']['datavalidade'];

            $sql = $con->prepare("INSERT INTO produtos (nome, categoria, preco, datavalidade) VALUES (?,?,?,?)");
            $sql->execute(array($this->nome, $this->categoria, $this->preco, $this->datavalidade)) ;

            header("Location: list.php");

        }

        echo "<h2>Novo produto</h2>";
        echo "<form method='post' action=''> ";
        echo "<table class='table table-bordered'>";
        echo "<tr><td>NOME</td><td><input type='text' name='produtos[nome]' ></td></tr>";
        echo "<tr><td>CATEGORIA</td><td><input type='text' name='produtos[categoria]' ></td></tr>";
        echo "<tr><td>PRECO</td><td><input type='text' name='produtos[preco]' ></td></tr>";
        echo "<tr><td>DATA VALIDADE</td><td><input type='text' name='produtos[datavalidade]' ></td></tr>";
        echo "<tr><td>FOTO</td><td>
        <input type='file' name='foto'>
        </td></tr>";
        echo "</table>";
        echo "<input class='btn btn-primary' type='submit' value='Enviar'>";
        echo "</form>";

    }

}




