<?php

class quartoModel{
    public static function create ($conn, $data){
        $sql = "INSERT INTO quartos (nome, numero, qtd_cama_casal, qtd_cama_solteiro, preco, disponivel) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siiidi", 
            $data["nome"],
            $data["numero"],
            $data["qtd_cama_casal"],
            $data["qtd_cama_solteiro"],
            $data["preco"],
            $data["disponivel"]
        );
        return $stmt->execute();
    }

    public static function getAll($conn){
        $Mysql = "SELECT * FROM quartos";
        $result = $conn->query($Mysql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }  

    public static function getById($conn, $id){
        $sql = "SELECT * FROM quartos WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function delete($conn, $id) {
        $sql = "DELETE FROM quartos WHERE id= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}


?>