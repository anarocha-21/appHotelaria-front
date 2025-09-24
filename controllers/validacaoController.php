<?php


class validRotas {

    public static function autCliente($data) {
        $fieldsImportant = [
            'nome', 'cpf', 'telefone', 'email', 'senha', 'regras_id'
        ];
        
        return self::validarCampos($data, $fieldsImportant, 'cliente');
    }

    public static function autQuarto($data) {
        $fieldsImportant = [
            'nome', 'numero', 'preco', 'qtd_cama_solteiro', 'qtd_cama_casal', 'disponivel'
        ];
        
        return self::validarCampos($data, $fieldsImportant, 'quarto');
    }

    public static function autReserva($data) {
        $fieldsImportant = [
            'fk_pedidos', 'fk_quartos', 'fk_adicionais', 'chegada', 'saida'
        ];
        
        return self::validarCampos($data, $fieldsImportant, 'reserva');
    }

    public static function autPedido($data) {
        $fieldsImportant = [
            'fk_usuarios', 'fk_clientes', 'data', 'pagamento'
        ];
        
        return self::validarCampos($data, $fieldsImportant, 'pedido');
    }

    public static function autAdd($data) {
        $fieldsImportant = [
            'nome', 'preco'
        ];
        
        return self::validarCampos($data, $fieldsImportant, 'adicional');
    }



    private static function validarCampos($data, $fieldsImportant, $entidade) {
        $camposFaltantes = [];
        
        foreach ($fieldsImportant as $fields) {
            if (!isset($data[$fields]) || empty(trim($data[$fields]))) {
                $camposFaltantes[] = $fields;
            }
        }
        
        if (!empty($camposFaltantes)) {
            return [
                'sucesso' => false,
                'mensagem' => "Erro! Os campos obrigatórios estão vazios em: $entidade",
                'campos_faltantes' => $camposFaltantes,
                'entidade' => $entidade
            ];
        }

        // Validações específicas por campo
        $errosValidate = self::validateTypesDatas($data, $entidade);
        if (!empty($errosValidate)) {
            return [
                'sucesso' => false,
                'mensagem' => "Erros de validação em: $entidade",
                'erros_validacao' => $errosValidate,
                'entidade' => $entidade
            ];
        }
        
        return ['sucesso' => true];
    }

    private static function validateTypesDatas($data, $entidade) {
        $erros = [];
        
        switch ($entidade) {
            case 'cliente':
                if (isset($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $erros[] = 'Email inválido';
                }
                if (isset($data['cpf']) && !self::validarCPF($data['cpf'])) {
                    $erros[] = 'CPF inválido';
                }
                break;
                
            case 'usuario':
                if (isset($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $erros[] = 'Email inválido';
                }
                if (isset($data['senha']) && strlen($data['senha']) < 6) {
                    $erros[] = 'Senha deve ter pelo menos 6 caracteres';
                }
                break;
                
            case 'reserva':
                if (isset($data['chegada']) && isset($data['saida'])) {
                    if (strtotime($data['chegada']) >= strtotime($data['saida'])) {
                        $erros[] = 'Data de entrada deve ser anterior à data de saída';
                    }
                }
                break;
        }
        
        return $erros;
    }
}


?>