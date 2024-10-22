<?php

require_once(__DIR__ . '/../configs/utils.php');
require_once(__DIR__ . '/../model/Produtocategoria.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Content-Type: application/json; charset=UTF-8");

$data = handleJSONInput();

if (method('GET')) {
    $produtosCategorias = Produtocategoria::listar();
    output(200, $produtosCategorias);
}

if (method('POST')) {
    if (!valid($data, ['id_produto', 'id_categoria'])) {
        output(400, ["msg" => "Dados incompletos"]);
    }
    Produtocategoria::insert($data['id_produto'], $data['id_categoria']);
    output(200, ["msg" => "Relação produto-categoria cadastrada com sucesso!"]);
}

if (method('PUT')) {
    if (!valid($data, ['id_produto_categoria', 'id_produto', 'id_categoria'])) {
        output(400, ["msg" => "Dados incompletos"]);
    }
    Produtocategoria::editar($data['id_produto_categoria'], $data['id_produto'], $data['id_categoria']);
    output(200, ["msg" => "Relação produto-categoria editada com sucesso!"]);
}

if (method('DELETE')) {
    if (!valid($data, ['id_produto_categoria'])) {
        output(400, ["msg" => "ID da relação é obrigatório"]);
    }
    Produtocategoria::deletar($data['id_produto_categoria']);
    output(200, ["msg" => "Relação produto-categoria deletada com sucesso!"]);
}
