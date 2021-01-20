<?php

class Produtos
{
	var $cod;
	var $nome;
	var $descricao;
	var $valor;
	var $quantidade;

	function getCod()
	{
		return $this->cod;
	}
	function setCod($cod)
	{
		$this->cod = $cod;
	}

	function getNome()
	{
		return $this->nome;
	}
	function setNome($nome)
	{
		$this->nome = $nome;
	}

	function getDescricao()
	{
		return $this->descricao;
	}
	function setDescricao($descricao)
	{
		$this->descricao = $descricao;
	}

	function getValor()
	{
		return $this->valor;
	}
	function setValor($valor)
	{
		$this->valor = $valor;
	}

	function getQuantidade()
	{
		return $this->quantidade;
	}
	function setQuantidade($quantidade)
	{
		$this->quantidade = $quantidade;
	}
}

class ProdutosDAO
{

	function create($Produtos)
	{
		$result = array();

		try {
			$query = "INSERT INTO produtos VALUES (default, '" . $Produtos->getNome() . "','" . $Produtos->getValor() . "','" . $Produtos->getQuantidade() . "')";

			$con = new Connection();

			if (Connection::getInstance()->exec($query) >= 1) {
				$result["cod"] = connection::getInstance()->lastInsertCod();
				$result["nome"] = $Produtos->getNome();
				$result["descricao"] = $Produtos->getDescricao();
				$result["valor"] = $Produtos->getValor();
				$result["quantidade"] = $Produtos->getQuantidade();
			} else {
				$result["erro"] = "Não foi possivel adicionar a mercadoria!!";
			}
			$con = null;
		} catch (PDOException $e) {
			$result["err"] = $e->getMessage();
		}

		return $result;
	}

	function readAll()
	{
		$result = array();

		try {
			$query = "SELECT * FROM produtos";
			$con = new Connection();
			$resultSet = Connection::getInstance()->query($query);
			while ($linha = $resultSet->fetchObject()) {
				$produtos = new produtos();
				$produtos->setCod($linha->cod);
				$produtos->setNome($linha->nome);
				$produtos->setDescricao($linha->descricao);
				$produtos->setValor($linha->valor);
				$produtos->setQuantidade($linha->quantidade);
				$result[] = $produtos;
			}
			$con = null;
		} catch (PDOException $e) {
			$result["err"] = $e->getMessage();
		}

		return $result;
	}

	function read($cod)
	{
		$result = array();
		$query = "SELECT * FROM produtos where cod=$cod";
		try {
			$con = new Connection();
			$resultSet = Connection::getInstance()->query($query);
			if ($resultSet) {
				while ($linha = $resultSet->fetchObject()) {
					$produtos = new Produtos();
					$produtos->setCod($linha->cod);
					$produtos->setNome($linha->nome);
					$produtos->setDescricao($linha->descricao);
					$produtos->setValor($linha->valor);
					$produtos->setQuantidade($linha->quantidade);

					$result[] = $produtos;
				}
			}
			$con = null;
		} catch (PDOException $e) {
			$result["err"] = $e->getMessage();
		}

		return $result;
	}

	function update($prod)
	{
		$result = array();
		$cod = $prod->getCod();
		$nome = $prod->getNome();
		$descricao = $prod->getDescricao();
		$valor = $prod->getValor();
		$quantidade = $prod->getQuantidade();

		try {
			$query = "UPDATE produtos SET nome = '$nome',descricao = '$descricao', valor = '$valor',quantidade = '$quantidade' WHERE cod = $cod";

			$con = new Connection();

			$status = Connection::getInstance()->prepare($query);
			echo $query;
			if ($status->execute()) {
				$result = $prod;
			} else {
				$result["erro"] = "Não foi possivel atualizar os dados";
			}

			$con = null;
		} catch (PDOException $e) {
			$result["err"] = $e->getMessage();
		}

		return $result;
	}

	function delete($cod)
	{
		$result = array();
		$query = "DELETE FROM produtos WHERE cod = $cod";
		try {

			$con = new Connection();

			if (Connection::getInstance()->exec($query) >= 1) {
				$result["msg"] = "A mercadoria foi excluida.";
			} else {
				$result["Erro"] = "Mercadoria não excluida.";
			}

			$con = null;
		} catch (PDOException $e) {
			$result["err"] = $e->getMessage();
		}

		return $result;
	}
}
