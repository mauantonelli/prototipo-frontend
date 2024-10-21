<?php

require_once(__DIR__ . '/../configs/Database.php');

class Produto {
    public static function listar() {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("SELECT * FROM produto");
            $sql->execute();

            return $sql->fetchAll();
        } catch (Exception $e) {
            output(500, ["msg" => $e->getMessage()]);
        }
    }

    public static function insert($nome, $marca, $descricao, $preco, $quantidade) {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("INSERT INTO produto(nome, marca, descricao, preco, quantidade) VALUES (?,?,?,?,?)");
            $sql->execute([$nome, $marca, $descricao, $preco, $quantidade]);
            return $sql->rowCount();
        } catch (Exception $e) {
            output(500, ["msg" => $e->getMessage()]);
        }
    }

    public static function editar($nome, $marca, $descricao, $preco, $quantidade) {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("UPDATE produto SET nome = ?, marca = ?, descricao = ?, preco = ?, quantidade = ? WHERE id_produto = ?");
            $sql->execute([$nome, $marca, $descricao, $preco, $quantidade, $id_produto]);

            return $sql->rowCount();
        } catch (Exception $e) {
            output(500, ["msg" => $e->getMessage()]);
        }
    }
}
