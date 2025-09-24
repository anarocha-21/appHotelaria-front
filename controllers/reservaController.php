<?php

require_once __DIR__ . "/../models/reservaModel.php";

class reservaController{
    public static function create($conn, $data) {

        $result = reservaModel::create($conn, $data);
        
        if ($result) {
            return jsonResponse(['message'=>'Reserva registrada com sucesso"']);
        }
        else {
            return jsonResponse(['message'=>'Erro ao registrar a reserva!']);
        }
    }

    public static function getById($conn, $id) {
        $result = reservaModel::getById($conn, $id);
        return jsonResponse($result);
    }

    public static function getAll($conn) {
        $result = reservaModel::getAll($conn);
        return jsonResponse($result);
    }
}

?>