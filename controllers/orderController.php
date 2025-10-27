<?php

require_once "validacaoController.php";

class orderController{
    public static function createOrder($conn, $data){
        validacaoController::validate_data($data, ["fk_clientes", "pagamento", "quartos"]);

        foreach($data['quartos'] as $index => $quartos){
            validacaoController::validate_data($quartos, ["id", "chegada", "saida"]);
        }
    }
}

?>