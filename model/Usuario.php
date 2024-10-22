<?php

require_once(__DIR__ . '/../configs/Database.php');

class Usuario {
    public static function listar() {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("SELECT * FROM usuario");
            $sql->execute();

            return $sql->fetchAll();
        } catch (Exception $e) {
            output(500, ["msg" => $e->getMessage()]);
        }
    }

    public static function insert($nome, $email, $senha) {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)");
            $sql->execute([$nome, $email, $senha]);

            return $sql->rowCount();
        } catch (Exception $e) {
            output(500, ["msg" => $e->getMessage()]);
        }
    }

    public static function editar($id, $nome, $email, $senha) {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("UPDATE usuario SET nome = ?, email = ?, senha = ? WHERE id = ?");
            $sql->execute([$nome, $email, $senha, $id]);

            return $sql->rowCount();
        } catch (Exception $e) {
            output(500, ["msg" => $e->getMessage()]);
        }
    }
}
