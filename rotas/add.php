<?php

require_once __DIR__ . "/../controllers/addController.php";

if ( $_SERVER['REQUEST_METHOD'] === "GET") {
    validateToken('atendente');

    $id = $segments[2] ?? null;

    
    if (isset($id) === null) {
        addController::getAll($conn);
    }
    else  {
        addController::getById($conn, $id);
    }
    
}

elseif ($_SERVER['REQUEST_METHOD'] === "POST") {
    validateTokenAPI('atendente');
    
    $data = json_decode(file_get_contents('php://input'), true);
    addController::create($conn, $data);
}

elseif ($_SERVER['REQUEST_METHOD'] === "DELETE") {
    $id = $segments[2] ?? null;
    
    if (isset($id)) {
        addController::delete($conn, $id);
    }
    else {
        jsonResponse([
        "message" => 'Você não conseguiu excluir'
        ], 400);
    }
}

elseif ($_SERVER['REQUEST_METHOD'] === "PUT") {
    validateTokenAPI('atendente');
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data["id"];

    addController::update($conn, $id, $data);
    
}

else {
    jsonResponse([
        "status" => 'erro',
        "message" => 'Método não permitido'
    ], 405);
}

?>