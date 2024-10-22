<?php

require_once(__DIR__ . '/../configs/utils.php');
require_once(__DIR__ . '/../model/Categoria.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Content-Type: application/json; charset=UTF-8");

$data = handleJSONInput();

if (method('GET')) {
    $categorias = Categoria::listar();
    output(200, $categorias);
}

if (method('POST')) {
    if (!valid($data, ['nome', 'descricao'])) {
        output(400, ["msg" => "Dados incompletos"]);
    }
    Categoria::insert($data['nome'], $data['descricao']);
    output(200, ["msg" => "Categoria cadastrada com sucesso!"]);
}

if (method('PUT')) {
    if (!valid($data, ['id_categoria', 'nome', 'descricao'])) {
        output(400, ["msg" => "Dados incompletos"]);
    }
    Categoria::editar($data['id_categoria'], $data['nome'], $data['descricao']);
    output(200, ["msg" => "Categoria editada com sucesso!"]);
}
