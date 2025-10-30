<?php
require_once "config/database.php";
require_once "helpers/response.php";
require_once "helpers/token_jwt.php";
 
 
if ($erroDB) {
    echo "Erro no Site";
    exit;
}
$uri = strtolower(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$method = $_SERVER['REQUEST_METHOD'];
 
$baseFolder = strtolower(basename(dirname(__FILE__)));
$uri = str_replace("/$baseFolder", "", $uri);
$segments = explode("/", trim($uri, "/"));
 
$route = $segments[0] ?? null;
$subRoute = $segments[1] ?? null;
 
if ($route != "api"){
    // require __DIR__ . "/public/index.html";
    require "teste.php";
    exit;
 
}
   
    elseif($route === "api"){
    if(in_array($subRoute, ["login", "quarto", "add", "cliente", "pedido", "reserva", "foto", ""])){
        require "rotas/${subRoute}.php";
    }else{
    return jsonResponse(['message'=>'rota da API não encontrada.', 404]);  
    }
    exit;
}
else{
    echo "404 pagina nao encontrada";
    exit;
}

?>