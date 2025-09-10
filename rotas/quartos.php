<?php
require_once __DIR__. "/../controllers/quartoController.php";

if ($_SERVER['REQUEST_METHOD'] === "GET"){
    $id = $segment[2] ?? null;
    if (isset($id) == null){
        quartoController::getAll($conn);
    }else{
        quartoController::getById($conn, $id);
    }
    
}
elseif ($_SERVER['REQUEST_METHOD'] === "DELETE"){
    $id = $segment[2] ?? null;
    if (isset($id) == null){
        quartoController::delete($conn, $id);
    }else{
        jsonResponse(['message'=>'É necessario adicionar um id'],400);
    }
    
}


else{
    jsonResponse([
        'status'=>'erro',
        'message'=>'Método nao permitido'
    ], 405);
}

?>