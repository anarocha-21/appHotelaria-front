<?php

require_once __DIR__ . "/../models/reservaModel.php";
require_once __DIR__ . "/validacaoController.php";


class reservaController{
    public static function create($conn, $data) {

        validacaoController::validate_data($data, ['fk_pedidos', 'fk_quartos', 'fk_adicionais', 'chegada', 'saida']);

        $data['chegada'] = validacaoController::fix_dateHour($data['chegada'], 14);
        $data['saida'] = validacaoController::fix_dateHour($data['saida'], 12);


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