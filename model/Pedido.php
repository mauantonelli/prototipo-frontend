<?php

require_once(__DIR__ . '/../configs/Database.php');

class Pedido {
    public static function listar() {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("SELECT * FROM pedido");
            $sql->execute();
            return $sql->fetchAll();
        } catch (Exception $e) {
            output(500, ["msg" => $e->getMessage()]);
        }
    }

    public static function insert($data, $valor, $id_cliente) {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("INSERT INTO pedido (data, valor, id_cliente) VALUES (?, ?, ?)");
            $sql->execute([$data, $valor, $id_cliente]);
            return $sql->rowCount();
        } catch (Exception $e) {
            output(500, ["msg" => $e->getMessage()]);
        }
    }

    public static function editar($id_pedido, $data, $valor, $id_cliente) {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("UPDATE pedido SET data = ?, valor = ?, id_cliente = ? WHERE id_pedido = ?");
            $sql->execute([$data, $valor, $id_cliente, $id_pedido]);
            return $sql->rowCount();
        } catch (Exception $e) {
            output(500, ["msg" => $e->getMessage()]);
        }
    }
}
