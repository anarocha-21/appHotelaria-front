<?php

require_once __DIR__ . "/../controllers/uploadController.php";

//rota de teste
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data = $_FILES['fotos'] ?? null;
    uploadController::upload($data);
} 
else {
    jsonResponse(['status'=> 'erro', 'message' =>'metodo nao permitido'], 405);
}

?>