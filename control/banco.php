<?php

$ultimo_id = 0;

function open_database()
{
    try
    {
        $conn = new mysqli("localhost", "root", "", "db_easy");
        return $conn;
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
        return null;
    }
}

function executar($sql){
	try
	{
		$conn = open_database();
		$conn->query($sql);
		global $ultimo_id;
		$ultimo_id = $conn->insert_id;
		return true;
	}
	catch (Exception $e)
	{
		echo "Erro ao cadastrar... Erro: $e";
		return false;
	}
}


function select($sql){
	try
	{
		$conn = open_database();
		$resultado = $conn->query($sql);
		return $resultado; 
	}
	catch (Exception $e)
	{
		echo "Erro ao cadastrar... Erro: $e";
	}
}
