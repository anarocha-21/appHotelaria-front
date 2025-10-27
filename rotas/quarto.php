<?php
require_once __DIR__. "/../controllers/quartoController.php";

$method = $_SERVER['REQUEST_METHOD'];
$resource = $segments[3] ?? null;
$param = $segments[2] ?? null;

switch ($method) {
    case "GET":
        if ($param === 'disponiveis') {
            $chegada = isset($_GET['chegada']) ? $_GET['chegada'] : null;
            $saida = isset($_GET['saida']) ? $_GET['saida'] : null;
            $capacidade = isset($_GET['capacidade']) ? $_GET['capacidade'] : null;

            if ($inicio && $fim && $capacidade) {
                $data = ['chegada' => $inicio, 'saida' => $fim, 'capacidade' => $capacidade];
                $resultados = quartoController::searchDisp($conn, $data);
                jsonResponse(["message" => "quartos disponiveis",
                "data" => $resultados]);
            } else {
                jsonResponse(["message" => "Parâmetros 'chegada' e 'saida' são obrigatórios."], 400);
            }
        } 
        elseif ($param) {
            quartoController::getById($conn, $param);
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
