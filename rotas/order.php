<?php


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data = json_decode(file_get_contents('php://input'), true);

    orderController::createOrder($conn, $data);

}
else{
    jsonResponse([
    "status"=>"erro",
    "message"=>"Metodo não permitido"], 405);
}

elseif ($_SERVER['REQUEST_METHOD'] === "POST") {
    $opcao = $segments[2] ?? null;
    $data = json_decode(file_get_contents('php://input'), true);

    if ($opcao == "reservation"){
        orderController::create($conn, $data);
    }else{
        orderController::create($conn, $data);
    }
}

else{
    jsonResponse(['status' => 'erro', 'message' => 'metodo não permitido'])
}

?>