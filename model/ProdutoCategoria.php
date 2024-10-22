<?php

require_once(__DIR__ . '/../configs/Database.php');

class Produtocategoria {
    public static function listar() {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("SELECT * FROM produtocategoria");
            $sql->execute();
            return $sql->fetchAll();
        } catch (Exception $e) {
            output(500, ["msg" => $e->getMessage()]);
        }
    }

    public static function insert($id_produto, $id_categoria) {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("INSERT INTO produtocategoria (id_produto, id_categoria) VALUES (?, ?)");
            $sql->execute([$id_produto, $id_categoria]);
            return $sql->rowCount();
        } catch (Exception $e) {
            output(500, ["msg" => $e->getMessage()]);
        }
    }

    public static function editar($id_produto_categoria, $id_produto, $id_categoria) {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("UPDATE produtocategoria SET id_produto = ?, id_categoria = ? WHERE id_produto_categoria = ?");
            $sql->execute([$id_produto, $id_categoria, $id_produto_categoria]);
            return $sql->rowCount();
        } catch (Exception $e) {
            output(500, ["msg" => $e->getMessage()]);
        }
    }
}
