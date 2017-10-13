<?php

define('SERVIDOR', 'mysql:host=localhost;dbname=db_easy');
define('USUARIO', 'root');
define('SENHA', '');

if(!isset($_SESSION)) session_start();

class Perfil
{
    private $codigo;
    private $nome;
    private $cpf;
    private $datanascimento;
    private $telefone;
    private $cep;
    private $logradouro;
    private $bairro;
    private $numero;
    private $cidade;
    private $estado;
    private $id_usuario;


    public function __construct($codigo=null, $id_usuario = null, $nome=null, $cpf=null, $datanascimento=null, $telefone=null, $cep=null, $logradouro=null, $bairro=null, $numero=null, $cidade=null, $estado=null){

        $this->codigo = $codigo;
        $this->id_usuario = $id_usuario;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->datanascimento = $datanascimento;
        $this->telefone = $telefone;
        $this->cep = $cep;
        $this->logradouro = $logradouro;
        $this->bairro = $bairro;
        $this->numero = $numero;
        $this->cidade = $cidade;
        $this->estado = $estado;

    }

    public function view(){

        $con = new PDO(SERVIDOR, USUARIO, SENHA);
        $sql = $con->prepare("SELECT * FROM usuario WHERE codigo=?");
        $sql->execute(array($this->id_usuario)) ;
        
        if($r=$sql->fetchObject()){
            echo "<table class='table table-bordered'>";
            echo "<tr><td>NOME</td><td>".$r->nome."</td></tr>";
            echo "<tr><td>CPF</td><td>".$r->cpf."</td></tr>";
            echo "<tr><td>DATA NASCIMENTO</td><td>".$r->datanascimento."</td></tr>";
            echo "<tr><td>TELEFONE</td><td>".$r->telefone."</td></tr>";
            echo "<tr><td>CEP</td><td>".$r->cep."</td></tr>";
            echo "<tr><td>LOGRADOURO</td><td>".$r->logradouro."</td></tr>";
            echo "<tr><td>BAIRRO</td><td>".$r->bairro."</td></tr>";
            echo "<tr><td>NUMERO</td><td>".$r->numero."</td></tr>";
            echo "<tr><td>CIDADE</td><td>".$r->cidade."</td></tr>";
            echo "<tr><td>ESTADO</td><td>".$r->estado."</td></tr>";
            echo "</table>";
            
        }else{
            echo "<h2>Nenhum cliente encontrado!</h2>";
        }
        echo "<a class='btn btn-primary' href='update.php'>Editar</a>";
    }


    public function update(){

        $con = new PDO(SERVIDOR, USUARIO, SENHA);

        if ( isset($_POST['usuario']) ){


            $this->nome=$_POST['usuario']['nome'];
            $this->cpf=$_POST['usuario']['cpf'];
            $this->datanascimento=$_POST['usuario']['datanascimento'];
            $this->telefone=$_POST['usuario']['telefone'];
            $this->cep=$_POST['usuario']['cep'];
            $this->logradouro=$_POST['usuario']['logradouro'];
            $this->bairro=$_POST['usuario']['bairro'];
            $this->numero=$_POST['usuario']['numero'];
            $this->cidade=$_POST['usuario']['cidade'];
            $this->estado=$_POST['usuario']['estado'];

            $sql = $con->prepare("UPDATE usuario SET nome=?, cpf=?, datanascimento=?, telefone=?, cep=?, logradouro=?, bairro=?, numero=?, cidade=?, estado=? WHERE codigo=?");
            $sql->execute(array($this->nome, $this->cpf, $this->datanascimento, $this->telefone, $this->cep, $this->logradouro, $this->bairro, $this->numero, $this->cidade, $this->estado, $this->id_usuario)) ;

            header("Location: view.php");

        }

        $sql = $con->prepare("SELECT * FROM usuario WHERE codigo=?");
        $sql->execute(array($this->id_usuario)) ;
        $r=$sql->fetchObject();

        $this->codigo = $r->codigo;
        $this->nome = $r->nome;
        $this->cpf = $r->cpf;
        $this->datanascimento = $r->datanascimento;
        $this->telefone = $r->telefone;
        $this->cep = $r->cep;
        $this->logradouro = $r->logradouro;
        $this->bairro = $r->bairro;
        $this->numero = $r->numero;
        $this->cidade = $r->cidade;
        $this->estado = $r->estado;

        echo "<h2>Alterar perfil</h2>";
        echo "<form method='post' action='' enctype='multipart/form-data'> ";
        echo "<table class='table table-bordered'>";
        echo "<tr><td>CODIGO</td><td><input type='text' name='usuario[codigo]' value='$this->codigo' disabled></td></tr>";
        echo "<tr><td>NOME</td><td><input type='text' name='usuario[nome]' value='$this->nome'></td></tr>";
        echo "<tr><td>CPF</td><td><input type='text' name='usuario[cpf]' value='$this->cpf'></td></tr>";
        echo "<tr><td>DATA NASCIMENTO</td><td><input type='date' name='usuario[datanascimento]' value='$this->datanascimento'></td></tr>";
        echo "<tr><td>TELEFONE</td><td><input type='text' name='usuario[telefone]' value='$this->telefone'></td></tr>";
        echo "<tr><td>CEP</td><td><input type='text' name='usuario[cep]' value='$this->cep'></td></tr>";
        echo "<tr><td>LOGRADOURO</td><td><input type='text' name='usuario[logradouro]' value='$this->logradouro'></td></tr>";
        echo "<tr><td>BAIRRO</td><td><input type='text' name='usuario[bairro]' value='$this->bairro'></td></tr>";
        echo "<tr><td>NUMERO</td><td><input type='text' name='usuario[numero]' value='$this->numero'></td></tr>";
        echo "<tr><td>CIDADE</td><td><input type='text' name='usuario[cidade]' value='$this->cidade'></td></tr>";
        echo "<tr><td>ESTADO</td><td><input type='text' name='usuario[estado]' value='$this->estado'></td></tr>";
        echo "</table>";
        echo "<input class='btn btn-primary' type='submit' value='Salvar'>";
        echo " <a class='btn btn-default' href='list.php'>Cancelar</a>";
        echo "</form>";

    }

    public function add(){

        $con = new PDO(SERVIDOR, USUARIO, SENHA);

        if ( isset($_POST['usuario']) ){

            $this->nome=$_POST['usuario']['nome'];
            $this->cpf=$_POST['usuario']['cpf'];
            $this->datanascimento=$_POST['usuario']['datanascimento'];
            $this->telefone=$_POST['usuario']['telefone'];
            $this->cep=$_POST['usuario']['cep'];
            $this->logradouro=$_POST['usuario']['logradouro'];
            $this->bairro=$_POST['usuario']['bairro'];
            $this->numero=$_POST['usuario']['numero'];
            $this->cidade=$_POST['usuario']['cidade'];
            $this->estado=$_POST['usuario']['estado'];
            $this->id_cadastro=$_SESSION['id'];


            $sql = $con->prepare("INSERT INTO usuario (nome, cpf, datanascimento, telefone, cep, logradouro, bairro, numero, cidade, estado, id_cadastro) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
            $sql->execute(array($this->nome, $this->cpf, $this->datanascimento, $this->telefone, $this->cep, $this->logradouro, $this->bairro, $this->numero, $this->cidade, $this->estado, $this->id_cadastro)) ;
            $_SESSION['nivel'] = 2;
            header("Location: view.php");

        }

        echo "<h2>Novo perfil</h2>";
        echo "<form method='post' action=''> ";
        echo "<table class='table table-bordered'>";
        echo "<tr><td>CODIGO</td><td><input type='text' name='usuario[codigo]' value='$this->codigo' disabled></td></tr>";
        echo "<tr><td>NOME</td><td><input type='text' name='usuario[nome]' ></td></tr>";
        echo "<tr><td>CPF</td><td><input type='text' name='usuario[cpf]' ></td></tr>";
        echo "<tr><td>DATA NASCIMENTO</td><td><input type='date' name='usuario[datanascimento]' ></td></tr>";
        echo "<tr><td>TELEFONE</td><td><input type='text' name='usuario[telefone]' ></td></tr>";
        echo "<tr><td>CEP</td><td><input type='text' name='usuario[cep]' ></td></tr>";
        echo "<tr><td>LOGRADOURO</td><td><input type='text' name='usuario[logradouro]' ></td></tr>";
        echo "<tr><td>BAIRRO</td><td><input type='text' name='usuario[bairro]' ></td></tr>";
        echo "<tr><td>NUMERO</td><td><input type='text' name='usuario[numero]' ></td></tr>";
        echo "<tr><td>CIDADE</td><td><input type='text' name='usuario[cidade]' ></td></tr>";
        echo "<tr><td>ESTADO</td><td><input type='text' name='usuario[estado]' ></td></tr>";
        echo "</table>";
        echo "<input class='btn btn-primary' type='submit' value='Enviar'>";
        echo "</form>";

    }

}




