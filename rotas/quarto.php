<?php
require_once __DIR__. "/../controllers/quartoController.php";

$method = $_SERVER['REQUEST_METHOD'];
$resource = $segments[3] ?? null;
$param = $segments[2] ?? null;

switch ($method) {
    case "GET":

        if(isset($param)) {
            if (is_numeric($param)) {
                quartoController::getById($conn, $param);

            } elseif ($param === 'disponiveis') {
    
              $data = [ 
                "chegada" => isset($_GET['chegada']) ? $_GET['chegada'] : null,
                "saida" => isset($_GET['saida']) ? $_GET['saida'] : null,
                "qtd" => isset($_GET['qtd']) ? $_GET['qtd'] : null];
                quartoController::searchDisp($conn, $data);
        
            } else{ 
                jsonResponse(['message'=>"Essa rota não existe"], 400);
            }
        }
        else {
             quartoController::getAll($conn);
        }
        

    break;

    case "DELETE":
        $id = $segments[2] ?? null;

        if ($id) {
            quartoController::delete($conn, $id);
        } else {
            jsonResponse(["message" => "Id necessário!"], 400);
        }
    break;

    case "POST":
        $data = json_decode(file_get_contents('php://input'), true);
        quartoController::create($conn, $data);
    break;

    case "PUT":
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? null;

        if ($id) {
            quartoController::update($conn, $id, $data);
        } 
        else {
            jsonResponse(["message" => "Id necessário no corpo da requisição!"], 400);
        }
    break;

    default:
        jsonResponse([
            "status" => "erro",
            "message" => "Método não permitido"
        ], 405);
    break;
}

?>
