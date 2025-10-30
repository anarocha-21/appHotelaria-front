<?php

require_once __DIR__ . "/../controllers/pedidoController.php";
require_once __DIR__ ."/../controllers/orderController.php";

if ( $_SERVER['REQUEST_METHOD'] === "GET") {
    $id = $segments[2] ?? null;

    if (isset($id) === null) {
        pedidoController::getAll($conn);
    }
    else  {
        pedidoController::getById($conn, $id);
    }
    
}

elseif ($_SERVER['REQUEST_METHOD'] === "POST") {
    $user = validateToken('cliente');
    
    $opcao = $segments[2] ?? null;
    $data = json_decode(file_get_contents('php://input'), true);
    $data['clientes_id'] = $user['id'];

    if ($opcao == "reservation"){
        orderController::createOrder($conn, $data);
    }else{
        pedidoController::create($conn, $data);
    }
}

elseif ($_SERVER['REQUEST_METHOD'] === "DELETE") {
    $id = $segments[2] ?? null;
    
    if (isset($id)) {
        pedidoController::delete($conn, $id);
    }
    else {
        jsonResponse([
        "message" => 'Você não conseguiu excluir'
        ], 400);
    }
}

elseif ($_SERVER['REQUEST_METHOD'] === "PUT") {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data["id"];

    pedidoController::update($conn, $id, $data);
}

else {
    jsonResponse([
        "status" => 'erro',
        "message" => 'Método não permitido'
    ], 405);
}

?>