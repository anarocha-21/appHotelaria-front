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

     public static function update($conn, $id, $data) {
        $sql = "UPDATE quartos SET nome = ?, numero = ?, qtd_cama_casal = ?, qtd_cama_solteiro = ?, preco = ?, disponivel = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiidii",
            $data["nome"],
            $data["numero"],
            $data["qtd_cama_casal"],
            $data["qtd_cama_solteiro"],
            $data["preco"],
            $data["disponivel"],
            $id
        );
        return $stmt->execute();
    }

    public static function buscarDisponivel($conn, $data) {
        $sql = "SELECT *
        FROM quartos q
        WHERE q.disponivel = 1
        AND (q.qtd_cama_casal * 2 + q.qtd_cama_solteiro) >= ?
        AND q.id NOT IN (
            SELECT r.quarto_id
            FROM reservas r
            WHERE (r.fim >= ? AND r.inicio <= ?));";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss",
            $data['capacidade'],
            $data['chegada'],
            $data['saida']
        );

        $stmt->execute();
        $result = $stmt->get_result();
        $rooms = [];
            
        while ($row = $result->fetch_assoc()) {
            $rooms[] = $row;
        }
        
        return $rooms;
    }

}


?>