<?php

require_once(__DIR__ . '/../configs/Database.php');

class Categoria {
    public static function listar() {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("SELECT * FROM categoria");
            $sql->execute();
            return $sql->fetchAll();
        } catch (Exception $e) {
            output(500, ["msg" => $e->getMessage()]);
        }
    }

    public static function insert($nome, $descricao) {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("INSERT INTO categoria (nome, descricao) VALUES (?, ?)");
            $sql->execute([$nome, $descricao]);
            return $sql->rowCount();
        } catch (Exception $e) {
            output(500, ["msg" => $e->getMessage()]);
        }
    }

    public static function editar($id_categoria, $nome, $descricao) {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("UPDATE categoria SET nome = ?, descricao = ? WHERE id_categoria = ?");
            $sql->execute([$nome, $descricao, $id_categoria]);
            return $sql->rowCount();
        } catch (Exception $e) {
            output(500, ["msg" => $e->getMessage()]);
        }
    }

}
