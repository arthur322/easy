<?php

define('SERVIDOR', 'mysql:host=localhost;dbname=db_easy');
define('USUARIO', 'root');
define('SENHA', '');

class Supermercado
{
    private $id;
    private $nome;
    private $cnpj;
    private $cep;
    private $logradouro;
    private $numero;
    private $bairro;
    private $cidade;
    private $estado;
    private $telefone;


    public function __construct($id=null, $nome=null, $cnpj=null, $cep=null, $logradouro=null, $numero=null, $bairro=null, $cidade=null, $estado=null,  $telefone=null){

        $this->id = $id;
        $this->nome = $nome;
        $this->cnpj = $cnpj;
        $this->cep = $cep;
        $this->logradouro = $logradouro;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->telefone = $telefone;

    }

    public function view(){

        $con = new PDO(SERVIDOR, USUARIO, SENHA);
        $sql = $con->prepare("SELECT * FROM supermercados WHERE id=?");
        $sql->execute(array($this->id)) ;
        $r=$sql->fetchObject();

        echo "<table class='table table-bordered'>";
        echo "<tr><td>NOME</td><td>".$r->nome."</td></tr>";
        echo "<tr><td>CNPJ</td><td>".$r->cnpj."</td></tr>";
        echo "<tr><td>CEP</td><td>".$r->cep."</td></tr>";
        echo "<tr><td>LOGRADOURO</td><td>".$r->logradouro."</td></tr>";
        echo "<tr><td>NUMERO</td><td>".$r->numero."</td></tr>";
        echo "<tr><td>BAIRRO</td><td>".$r->bairro."</td></tr>";
        echo "<tr><td>CIDADE</td><td>".$r->cidade."</td></tr>";
        echo "<tr><td>ESTADO</td><td>".$r->estado."</td></tr>";
        echo "<tr><td>TELEFONE</td><td>".$r->telefone."</td></tr>";
        echo "</table>";

        echo "<a class='btn btn-primary' href='list.php'>Voltar</a>";
    }

    public function listar(){

        $con = new PDO(SERVIDOR, USUARIO, SENHA);

        $sql = $con->prepare("SELECT * FROM supermercados");
        $sql->execute();
        $produtos=$sql->fetchAll(PDO::FETCH_CLASS);

        echo "<h2>Supermercados
        <div class='pull-right'> <a class='btn btn-success' href='add.php'><i class='fa fa-plus' aria-hidden='true'></i> Novo</a></div>
        </h2>";

        echo "<table class='table table-bordered'>";
        echo "<tr><th>NOME</th>";
        echo "<th>FOTO</th>";
        echo "<th>CNPJ</th>";
        echo "<th>CEP</th>";
        echo "<th>LOGRADOURO</th>";
        echo "<th>BAIRRO</th>";
        echo "<th>NUMERO</th>";
        echo "<th>CIDADE</th>";
        echo "<th>ESTADO</th>";
        echo "<th>TELEFONE</th>";
        echo "<th>ACOES</th></tr>";

        foreach($produtos AS $p){
            echo "<tr><td>".$p->nome."</td>";
            echo "<td><img height='50px' src='images/".$p->foto."'></td>";
            echo "<td>".$p->cnpj."</td>";
            echo "<td>".$p->cep."</td>";
            echo "<td>".$p->logradouro."</td>";
            echo "<td>".$p->bairro."</td>";
            echo "<td>".$p->numero."</td>";
            echo "<td>".$p->cidade."</td>";
            echo "<td>".$p->estado."</td>";
            echo "<td>".$p->telefone."</td>";
            echo "<td>
            <a class='btn btn-warning' href='view.php?id=$p->id'><i class='fa fa-search' aria-hidden='true'></i> Ver</a>
            <a class='btn btn-primary' href='update.php?id=$p->id'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Editar</a>
            <button type='button' class='btn btn-danger btn-excluir' data-toggle='modal' data-target='#delete-modal' data-id='$p->id' data-nome='$p->nome'><i class='fa fa-trash-o' aria-hidden='true'></i> Excluir</button>
            </td></tr>";

        }
        echo "</table>";

    }

    public function delete(){

        $con = new PDO(SERVIDOR, USUARIO, SENHA);

        $sql = $con->prepare("DELETE FROM supermercados WHERE id=?");
        $sql->execute(array($this->id)) ;

    }

    public function update(){

        $con = new PDO(SERVIDOR, USUARIO, SENHA);

        if ( isset($_POST['supermercados']) ){

            // o usuario enviou uma fota
            if ( isset($_FILES['foto']) && !empty($_FILES["foto"]["name"]) ){
                $target_dir = "images/";
                $target_file = $target_dir . basename($_FILES["foto"]["name"]);

                // envia a foto
                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);

                // para ser usado no banco de dados
                $this->foto=$_FILES["foto"]["name"];

                // alterando o campo no banco de dados
                $sql = $con->prepare("UPDATE supermercados SET foto=? WHERE id=?");
                $sql->execute(array($this->foto,  $this->id)) ;

            }

            $this->nome=$_POST['supermercados']['nome'];
            $this->cnpj=$_POST['supermercados']['cnpj'];
            $this->cep=$_POST['supermercados']['cep'];
            $this->logradouro=$_POST['supermercados']['logradouro'];
            $this->bairro=$_POST['supermercados']['bairro'];
            $this->numero=$_POST['supermercados']['numero'];
            $this->cidade=$_POST['supermercados']['cidade'];
            $this->estado=$_POST['supermercados']['estado'];
            $this->telefone=$_POST['supermercados']['telefone'];

            $sql = $con->prepare("UPDATE supermercados SET nome=?, cnpj=?, cep=?, logradouro=?, bairro=?, numero=?, cidade=?, estado=?,  telefone=? WHERE id=?");
            $sql->execute(array($this->nome, $this->cnpj, $this->cep, $this->logradouro, $this->bairro, $this->numero, $this->cidade, $this->estado, $this->telefone, $this->id)) ;
            header("Location: list.php");
        }

        $sql = $con->prepare("SELECT * FROM supermercados WHERE id=?");
        $sql->execute(array($this->id)) ;
        $r=$sql->fetchObject();

        $this->nome = $r->nome;
        $this->cnpj = $r->cnpj;
        $this->cep = $r->cep;
        $this->logradouro = $r->logradouro;
        $this->bairro = $r->bairro;
        $this->numero = $r->numero;
        $this->cidade = $r->cidade;
        $this->estado = $r->estado;
        $this->telefone = $r->telefone;

        echo "<h2>Alterar supermercado</h2>";
        echo "<form method='post' action='' enctype='multipart/form-data'> ";
        echo "<table class='table table-bordered'>";
        echo "<tr><td>id</td><td><input type='text' name='supermercados[id]' value='$this->id' disabled></td></tr>";
        echo "<tr><td>NOME</td><td><input type='text' name='supermercados[nome]' value='$this->nome'></td></tr>";
        echo "<tr><td>CNPJ</td><td><input type='text' name='supermercados[cnpj]' value='$this->cnpj'></td></tr>";
        echo "<tr><td>CEP</td><td><input type='text' name='supermercados[cep]' value='$this->cep'></td></tr>";
        echo "<tr><td>LOGRADOURO</td><td><input type='text' name='supermercados[logradouro]' value='$this->logradouro'></td></tr>";
        echo "<tr><td>BAIRRO</td><td><input type='text' name='supermercados[bairro]' value='$this->bairro'></td></tr>";
        echo "<tr><td>NUMERO</td><td><input type='number' name='supermercados[numero]' value='$this->numero'></td></tr>";
        echo "<tr><td>CIDADE</td><td><input type='text' name='supermercados[cidade]' value='$this->cidade'></td></tr>";
        echo "<tr><td>ESTADO</td><td><input type='text' name='supermercados[estado]' maxlength='2' value='$this->estado'></td></tr>";
        echo "<tr><td>TELEFONE</td><td><input type='text' name='supermercados[telefone]' value='$this->telefone'></td></tr>";
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

        if ( isset($_POST['supermercados']) ){

            // o usuario enviou uma fota
            if ( isset($_FILES['foto']) && !empty($_FILES["foto"]["name"]) ){
                $target_dir = "images/";
                $target_file = $target_dir . basename($_FILES["foto"]["name"]);

                // envia a foto
                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);

                // para ser usado no banco de dados
                $this->foto=$_FILES["foto"]["name"];

                // alterando o campo no banco de dados
                $sql = $con->prepare("UPDATE supermercados SET foto=? WHERE id=?");
                $sql->execute(array($this->foto,  $this->id)) ;

            }

            $this->nome=$_POST['supermercados']['nome'];
            $this->cnpj=$_POST['supermercados']['cnpj'];
            $this->cep=$_POST['supermercados']['cep'];
            $this->logradouro=$_POST['supermercados']['logradouro'];
            $this->bairro=$_POST['supermercados']['bairro'];
            $this->numero=$_POST['supermercados']['numero'];
            $this->cidade=$_POST['supermercados']['cidade'];
            $this->estado=$_POST['supermercados']['estado'];
            $this->telefone=$_POST['supermercados']['telefone'];


            $sql = $con->prepare("INSERT INTO supermercados (nome, cnpj, cep, logradouro, bairro, numero, cidade, estado, telefone) VALUES (?,?,?,?,?,?,?,?,?)");
            $teste = $sql->execute(array($this->nome, $this->cnpj, $this->cep, $this->logradouro, $this->bairro, $this->numero, $this->cidade, $this->estado, $this->telefone)) ;
            
            header("Location: list.php");

        }

        echo "<h2>Novo supermercado</h2>";
        echo "<form method='post' action=''> ";
        echo "<table class='table table-bordered'>";
        echo "<tr><td>id</td><td><input type='text' name='supermercados[id]' value='$this->id' disabled></td></tr>";
        echo "<tr><td>NOME</td><td><input type='text' name='supermercados[nome]' ></td></tr>";
        echo "<tr><td>CNPJ</td><td><input type='text' name='supermercados[cnpj]' ></td></tr>";
        echo "<tr><td>CEP</td><td><input type='text' name='supermercados[cep]' ></td></tr>";
        echo "<tr><td>LOGRADOURO</td><td><input type='text' name='supermercados[logradouro]' ></td></tr>";
        echo "<tr><td>BAIRRO</td><td><input type='text' name='supermercados[bairro]' ></td></tr>";
        echo "<tr><td>NUMERO</td><td><input type='number' name='supermercados[numero]' ></td></tr>";
        echo "<tr><td>CIDADE</td><td><input type='text' name='supermercados[cidade]' ></td></tr>";
        echo "<tr><td>ESTADO</td><td><input type='text' name='supermercados[estado]' maxlength='2'></td></tr>";
        echo "<tr><td>TELEFONE</td><td><input type='text' name='supermercados[telefone]' ></td></tr>";
        echo "<tr><td>FOTO</td><td>
        <input type='file' name='foto'>
        </td></tr>";
        echo "</table>";
        echo "<input class='btn btn-primary' type='submit' value='Enviar'>";
        echo "</form>";

    }

}




