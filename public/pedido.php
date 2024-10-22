<?php

require_once(__DIR__ . '/../configs/utils.php');
require_once(__DIR__ . '/../model/Pedido.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Content-Type: application/json; charset=UTF-8");

$data = handleJSONInput();

if (method('GET')) {
    $pedidos = Pedido::listar();
    output(200, $pedidos);
}

if (method('POST')) {
    if (!valid($data, ['data', 'valor', 'id_cliente'])) {
        output(400, ["msg" => "Dados incompletos"]);
    }
    Pedido::insert($data['data'], $data['valor'], $data['id_cliente']);
    output(200, ["msg" => "Pedido cadastrado com sucesso!"]);
}

if (method('PUT')) {
    if (!valid($data, ['id_pedido', 'data', 'valor', 'id_cliente'])) {
        output(400, ["msg" => "Dados incompletos"]);
    }
    Pedido::editar($data['id_pedido'], $data['data'], $data['valor'], $data['id_cliente']);
    output(200, ["msg" => "Pedido editado com sucesso!"]);
}
