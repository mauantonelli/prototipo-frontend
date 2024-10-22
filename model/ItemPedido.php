<?php

require_once(__DIR__ . '/../configs/Database.php');

class ItemPedido {
    public static function listar() {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("SELECT * FROM itempedido");
            $sql->execute();
            return $sql->fetchAll();
        } catch (Exception $e) {
            output(500, ["msg" => $e->getMessage()]);
        }
    }

    public static function insert($quantidade, $id_pedido, $id_produto) {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("INSERT INTO itempedido (quantidade, id_pedido, id_produto) VALUES (?, ?, ?)");
            $sql->execute([$quantidade, $id_pedido, $id_produto]);
            return $sql->rowCount();
        } catch (Exception $e) {
            output(500, ["msg" => $e->getMessage()]);
        }
    }

    public static function editar($id_item_pedido, $quantidade, $id_pedido, $id_produto) {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("UPDATE itempedido SET quantidade = ?, id_pedido = ?, id_produto = ? WHERE id_item_pedido = ?");
            $sql->execute([$quantidade, $id_pedido, $id_produto, $id_item_pedido]);
            return $sql->rowCount();
        } catch (Exception $e) {
            output(500, ["msg" => $e->getMessage()]);
        }
    }

}
