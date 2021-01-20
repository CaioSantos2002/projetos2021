<?php

require("../../domain/connection.php");
require("../../domain/Vendas.php");

class VendasProcess
{
	var $Vd;

	function doGet($arr)
	{
		$vd = new VendasDAO();
		if ($arr["cod"] == "0") {
			$sucess = $vd->readAll();
		} else {
			$sucess = $vd->read($arr["cod"]);
		}

		http_response_code(200);
		echo json_encode($sucess);
	}


	function doPost($arr)
	{
		$Vd = new VendasDAO();
		$vendas = new Vendas();
		$vendas->setCod($arr["cod"]);
		$vendas->setPreco($arr["preco"]);
		$vendas->setQuantidade($arr["quantidade"]);
		$sucess = $Vd->create($vendas);
		http_response_code(200);
		echo json_encode($sucess);
	}


	function doPut($arr)
	{
		$Vd = new VendasDAO();
		$vendas = new Vendas();
		$vendas->setCod($arr["cod"]);
		$vendas->setPreco($arr["preco"]);
		$vendas->setQuantidade($arr["quantidade"]);
		$sucess = $Vd->update($vendas);
		http_response_code(200);
		echo json_encode($sucess);
	}


	function doDelete($arr)
	{
		$Vd = new VendasDAO();
		$sucess = $Vd->delete($arr["cod"]);
		http_response_code(200);
		echo json_encode($sucess);
	}
}
