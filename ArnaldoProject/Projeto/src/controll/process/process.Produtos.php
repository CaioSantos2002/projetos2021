<?php

require("../../domain/connection.php");
require("../../domain/Produtos.php");

class ProdutosProcess
{
	var $Pd;


	function doGet($arr)
	{
		$md = new ProdutosDAO();
		if ($arr["cod"] == "0") {
			$sucess = $md->readAll();
		} else {
			$sucess = $md->read($arr["cod"]);
		}
		http_response_code(200);
		echo json_encode($sucess);
	}



	function doPost($arr)
	{
		$Pd = new ProdutosDAO();
		$Produtos = new Produtos();
		$Produtos->setCod($arr["cod"]);
		$Produtos->setNome($arr["nome"]);
		$Produtos->setValor($arr["valor"]);
		$Produtos->setQuantidade($arr["quantidade"]);
		$sucess = $Pd->create($Produtos);
		http_response_code(200);
		echo json_encode($sucess);
	}


	function doPut($arr)
	{
		$Pd = new ProdutosDAO();
		$Produtos = new Produtos();
		$Produtos->setCod($arr["cod"]);
		$Produtos->setNome($arr["nome"]);
		$Produtos->setValor($arr["valor"]);
		$Produtos->setQuantidade($arr["quantidade"]);
		$sucess = $Pd->update($Produtos);
		http_response_code(200);
		echo json_encode($sucess);
	}


	function doDelete($arr)
	{
		$Pd = new ProdutosDAO();
		$sucess = $Pd->delete($arr["cod"]);
		http_response_code(200);
		echo json_encode($sucess);
	}
}
