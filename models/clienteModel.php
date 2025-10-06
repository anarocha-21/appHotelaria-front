<?php

class clienteModel {

    public static function getAll($conn) {
        $sql = "SELECT * FROM clientes";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getById($conn, $id) {
        $sql = "SELECT * FROM clientes WHERE id= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function create($conn, $data) {
        $sql = "INSERT INTO clientes (nome, telefone, cpf, email, senha, regras_id) 
        VALUES (?, ?, ?, ?, ?,?);";
        
        $stat = $conn->prepare($sql);
        $stat->bind_param("isssi", 
            $data["nome"],
            $data["telefone"],
            $data["cpf"],
            $data["email"],
            $data["senha"],
            $data["regras_id"]
        );
        return $stat->execute();
    }

    public static function update($conn, $id, $data) {
        $sql = "UPDATE clientes SET nome = ?, telefone = ?, cpf = ?, email = ?, senha = ?, regras_id = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssii",
            $data["nome"],
            $data["telefone"],
            $data["cpf"],
            $data["email"],
            $data["senha"],
            $data["regras_id"],
            $id
        );
        return $stmt->execute();
    }

    public static function delete($conn, $id) {
        $sql = "DELETE FROM clientes WHERE id= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public static function clientValidation($conn, $email, $senha) {
        $sql = "SELECT clientes.id, clientes.nome, clientes.email, clientes.senha 
        FROM clientes 
        JOIN regras ON fk_regras = clientes.cargo_id
        WHERE clientes.email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
 
        if($client = $result->fetch_assoc()) {
        
            if(PasswordController::validateHash($password, $client['senha'])) {
                unset($client['senha']);
                return $client;  
            }

        return false;
        
        }
    }
}

?>