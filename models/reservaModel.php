<?php

class ReservaModel {

    public static function getAll($conn) {
        $sql = "SELECT * FROM reservas";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getById($conn, $id) {
        $sql = "SELECT * FROM reservas WHERE id= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function create($conn, $data) {
        $sql = "INSERT INTO reservas (fk_pedidos, fk_quartos, fk_adicionais, chegada, saida) 
        VALUES (?, ?, ?, ?, ?);";
        
        $stat = $conn->prepare($sql);
        $stat->bind_param("iiss", 
            $data['fk_pedidos'],
            $data['fk_quartos'],
            $data['fk_adicionais'],
            $data['chegada'],
            $data['saida']
        );
        return $stat->execute();
    }

}

?>