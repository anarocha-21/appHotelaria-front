<?php
require_once __DIR__ . "/../controllers/autenticador.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $opcao = $segments[2] ?? null;
    $data = json_decode(file_get_contents('php://input'), true);

    if ($opcao == "cliente"){// login do cliente
        autenticador::loginClient($conn, $data);
    
    } else if($opcao == "employee") { //login do funcionario
        autenticador::login($conn, $data);
   
    }else{
        jsonResponse([
        "status"=>"erro",
        "message"=>"rota nao existe"], 405);
    }
}

elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    validateTokenAPI();
    jsonResponse(["message"=>"deu certo"]);
}else{
    jsonResponse([
    "status"=>"erro",
    "message"=>"método não permitido"], 405);
}

?>