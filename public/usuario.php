<?php

require_once(__DIR__ . '/../configs/utils.php');
require_once(__DIR__ . '/../model/Usuario.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Content-Type: application/json; charset=UTF-8");

$data = handleJSONInput();

if (method('GET')) {
    try {
        $usuarios = Usuario::listar();
        output(200, $usuarios);
    } catch (Exception $e) {
        output(500, ["msg" => $e->getMessage()]);
    }
}

if (method('POST')) {
    try {
        if (!valid($data, ['nome', 'email', 'senha'])) {
            throw new Exception("Dados incompletos", 400);
        }
        Usuario::insert($data['nome'], $data['email'], $data['senha']);
        output(200, ["msg" => "Usuário cadastrado com sucesso!"]);
    } catch (Exception $e) {
        output($e->getCode(), ["msg" => $e->getMessage()]);
    }
}

if (method('PUT')) {
    try {
        if (!valid($data, ['id', 'nome', 'email', 'senha'])) {
            throw new Exception("Dados incompletos", 400);
        }
        Usuario::editar($data['id'], $data['nome'], $data['email'], $data['senha']);
        output(200, ["msg" => "Usuário editado com sucesso!"]);
    } catch (Exception $e) {
        output($e->getCode(), ["msg" => $e->getMessage()]);
    }
}
