<?php

require_once(__DIR__ . '/../configs/utils.php');
require_once(__DIR__ . '/../model/Produto.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Content-Type: application/json; charset=UTF-8");

$data = handleJSONInput();

// Listar produtos
if (method('GET')) {
    try {
        $produtos = Produto::listar();
        output(200, $produtos);
    } catch (Exception $e) {
        output(500, ["msg" => $e->getMessage()]);
    }
}

// Cadastrar produto
if (method('POST')) {
    try {
        if (!valid($data, ['nome', 'marca', 'descricao', 'preco', 'quantidade'])) {
            throw new Exception("Dados incompletos", 400);
        }
        Produto::insert($data['nome'], $data['marca'], $data['descricao'], $data['preco'], $data['quantidade']);
        output(200, ["msg" => "Produto cadastrado com sucesso!"]);
    } catch (Exception $e) {
        output($e->getCode(), ["msg" => $e->getMessage()]);
    }
}

// Editar produto
if (method('PUT')) {
    try {
        if (!valid($data, ['id', 'nome', 'marca', 'descricao', 'preco', 'quantidade'])) {
            throw new Exception("Dados incompletos", 400);
        }
        Produto::editar($data['id'], $data['nome'], $data['marca'], $data['descricao'], $data['preco'], $data['quantidade']);
        output(200, ["msg" => "Produto editado com sucesso!"]);
    } catch (Exception $e) {
        output($e->getCode(), ["msg" => $e->getMessage()]);
    }
}
