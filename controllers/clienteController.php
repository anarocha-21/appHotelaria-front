<?php
require_once "senhaController.php";
require_once __DIR__ . "/../models/clienteModel.php";
require_once __DIR__ . "/../controllers/autenticador.php";
require_once __DIR__ . "/../helpers/token_jwt.php";

class clienteController {
    
    public static function create($conn, $data) {
        $login = [
            "email" => $data["email"],
            "senha" => $data["senha"]
        ]

        $data['senha'] = senhaController::generateHash($data['senha']);
        $result = clienteModel::create($conn, $data);
        
            if ($result) {
                autenticador::loginClient($conn, $login);
            }else {
                return jsonResponse(['message'=>'Erro ao registrar o quarto!'], 400);
            }
        }

        public static function getById($conn, $id) {
            $result = clienteModel::getById($conn, $id);
            return jsonResponse($result);
        }

        public static function getAll($conn) {
            $result = clienteModel::getAll($conn);
            return jsonResponse($result);
        }

        public static function delete($conn, $id) {
            $result = clienteModel::delete($conn, $id);
            if($result){
                return jsonResponse(['message'=> 'Cliente excluído']);
            } else{
                return jsonResponse(['message'=> ''], 400);
            }
        }

        public static function update($conn, $id, $data){
            $result = clienteModel::update($conn, $id, $data);
            if($result){
                return jsonResponse(['message'=> 'Cliente atualizado']);
            } else{
                return jsonResponse(['message'=> 'Deu merda'], 400);
            }
        }

        public static function loginClient($conn, $data) {

        $data['email'] = trim($data['email']);
        $data['senha'] = trim($data['senha']);
 
        if (empty($data['email']) || empty($data['senha'])) {
            return jsonResponse([
                "status" => "erro",
                "message" => "Preencha todos os campos!"
            ], 401);
        }
 
        $client = clienteModel::clientValidation($conn, $data['email'], $data['senha']);
        if ($client) {
            $token = createToken($client);
            return jsonResponse([ "token" => $token ]);
        } else {
            return jsonResponse([
                "status" => "erro",
                "message" => "Credenciais inválidas!"
            ], 401);
        }
    }

}



?>