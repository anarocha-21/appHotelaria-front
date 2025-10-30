<?php
require_once __DIR__ . "/../models/quartoModel.php";
require_once __DIR__ . "/../models/fotoModel.php";
require_once "validacaoController.php";
require_once "uploadController.php";



class quartoController
{

    public static function create($conn, $data)
    {
        $result = quartoModel::create($conn, $data);

        if ($result) {
            return jsonResponse(['message' => "Quarto criado com sucesso"]);
        } else {
            return jsonResponse(['message' => " "]);
        }
    }

    public static function getAll($conn)
    {
        $result = quartoModel::getAll($conn);
        return jsonResponse($result);
    }

    public static function getById($conn, $id)
    {
        $result = quartoModel::getById($conn, $id);
        return jsonResponse($result);
    }

    public static function delete($conn, $id)
    {
        $result = quartoModel::delete($conn, $id);
        if ($result) {
            return jsonResponse(['mesage' => "Quarto excluido com sucesso"]);
        } else {
            return jsonResponse(['mesage' => "Nao criado"], 400);
        }
    }

    public static function update($conn, $id, $data){
        $result = quartoModel::update($conn, $id, $data);
        if ($result) {
            if ($data['fotos']) {
                $imagem = uploadController::upload($data['fotos']);

                return jsonResponse(['message' => 'quarto atualizado']);
            } else {
                return jsonResponse(['message' => 'escafedeu-se'], 400);
            }
        }
    }

    public static function searchDisp($conn, $data)
    {
        validacaoController::validate_data($data, ["chegada", "saida", "qtd"]);

        $data['chegada'] = validacaoController::fix_dateHour($data["chegada"], 14);
        $data["saida"] = validacaoController::fix_dateHour($data["saida"], 12);

        $result = quartoModel::buscarDisponivel($conn, $data);
        if ($result !== false && !empty($result)) {
            // foreach ($result as &$quarto) {
            //     $quarto['fotos'] = fotoModel::getByQuartoId($conn, $quarto['id']);
            // }
            return jsonResponse(['Quartos'=> $result]);

        } else {
            return jsonResponse(['message' => "Erro ao buscar quartos disponiveis"], 404);
        }
    }
}

?>