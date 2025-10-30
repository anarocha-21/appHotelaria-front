<?php
require_once "senhaController.php";
require_once "validacaoController.php";
require_once __DIR__ . "/../models/UserModel.php";
require_once __DIR__ . "/../models/ClienteModel.php";

require_once __DIR__ . "/../helpers/token_jwt.php";

class autenticador{
    public static function login($conn, $data){
        $data['email'] = trim($data['email']);
        $data['senha'] = trim($data['senha']);

        if(empty($data['email']) || empty($data['senha'])){
            return jsonResponse(["status" =>"erro","message" => "preencha todos os campos"],401);
        }

        $user = UserModel::validateUser($conn, $data['email'], $data['senha']);
        if ($user){
            $token = createToken($user);
            return jsonResponse([ "token" => $token]);
        }else{
            return jsonResponse(["status"=>"erro","message"=>"credenciais inválidas"], 401);
        }
    }
    public static function loginClient($conn, $data) {
        $data['email'] = trim($data['email']);
        $data['senha'] = trim($data['senha']);

        if (empty($data['email']) || empty($data['senha'])) {
            return jsonResponse([
                "status" => "erro",
                "message" => "preencha todos os campos",
            ], 401);
        }

        $user = ClienteModel::clientValidation($conn, $data['email'] , $data['senha']);
        if ($user) {
                
            $token = createToken($user);
            return jsonResponse(["token" => $token ]);
        }

        else {
            jsonResponse([
                "status"=>"erro",
                "message"=>"credenciais inválidas"
            ], 401);
        }
    }
}

?>