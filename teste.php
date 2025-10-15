<?php
require_once __DIR__ ."/controllers/autenticador.php";
require_once __DIR__ ."/controllers/senhaController.php";
require_once __DIR__ . "/helpers/token_jwt.php";

require_once __DIR__ . "/controllers/quartoController.php";
require_once __DIR__ . "/controllers/addController.php";
require_once __DIR__ . "/controllers/clienteController.php";
require_once __DIR__ . "/controllers/pedidoController.php";
require_once __DIR__ . "/controllers/reservaController.php";

//quartoController::getAll($conn);
//addController::getAll($conn);
clienteController::getAll($conn);
//pedidoController::getAll($conn);
//reservaController::getAll($conn);


/*$data = [
    "nome" => "quarto",
    "numero" => 1,
    "qtd_cama_casal" => 1,
    "qtd_cama_solteiro" => 2,
    "preco" => 300,
    "disponivel" => 1
];*/

//quartoController::create($conn, $data);

/*$data = [
   "email" => "bolso_naro22@gmail.com",
   "senha" => "123"
];*/

//autenticador::login($conn, $data);

//$tokenInvalido = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJtZXVTaXRlIiwiaWF0IjoxNzU2OTI0NjU5LCJleHAiOjE3NTY5MjgyNTksInN1YiI6eyJpZCI6MTcsIm5vbWUiOiJtYXRldXMgYm9sc29uYXJvIiwiZW1haWwiOiJib2xzb19uYXJvMjJAZ21haWwuY29tIiwicmVncmFzIjoiYXRlbmRlbnRlIn19.mhWaJ78LEBt02Ck2Kpci4tr07dJqI0ixda47HZKZ5H0";
//$tokenValido = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJtZXVTaXRlIiwiaWF0IjoxNzU2OTI0NjU5LCJleHAiOjE3NTY5MjgyNTksInN1YiI6eyJpZCI6MTcsIm5vbWUiOiJtYXRldXMgYm9sc29uYXJvIiwiZW1haWwiOiJib2xzb19uYXJvMjJAZ21haWwuY29tIiwicmVncmFzIjoiYXRlbmRlbnRlIn19.mhWaJ78LEBt02Ck2Kpci4tr07dJqI0ixda47HZKZ5H0";
//echo validateToken($token);
 
//echo senhaControler::geradorHash($data["password"]);
//$hash = '$2y$10$gS3zXiLQKS2CQF/1WWSDcuCtre.B4XdLxZqIuV50P8765yN7hseei$2y$10$w.TyMHBKdtwpf81ZtdCNUeXtZ1yF6iq8yKtI0RsV1MxiDLKQ.Kne2';
//echo "<br>";
//echo senhaControler::leitorHash($data["password"], $hash);
 
?>