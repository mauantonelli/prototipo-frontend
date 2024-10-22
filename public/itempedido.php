<?php

require_once(__DIR__ . '/../configs/utils.php');
require_once(__DIR__ . '/../model/ItemPedido.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Content-Type: application/json; charset=UTF-8");

$data = handleJSONInput();

if (method('GET')) {
    $itens = ItemPedido::listar();
    output(200, $itens);
}

if (method('POST')) {
    if (!valid($data, ['quantidade', 'id_pedido', 'id_produto'])) {
        output(400, ["msg" => "Dados incompletos"]);
    }
    ItemPedido::insert($data['quantidade'], $data['id_pedido'], $data['id_produto']);
    output(200, ["msg" => "Item de pedido cadastrado com sucesso!"]);
}

if (method('PUT')) {
    if (!valid($data, ['id_item_pedido', 'quantidade', 'id_pedido', 'id_produto'])) {
        output(400, ["msg" => "Dados incompletos"]);
    }
    ItemPedido::editar($data['id_item_pedido'], $data['quantidade'], $data['id_pedido'], $data['id_produto']);
    output(200, ["msg" => "Item de pedido editado com sucesso!"]);
}

