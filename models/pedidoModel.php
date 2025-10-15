<?php

class pedidoModel {

    public static function getAll($conn) {
        $sql = "SELECT * FROM pedidos";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getById($conn, $id) {
        $sql = "SELECT * FROM pedidos WHERE id= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function create($conn, $data) {
        $sql = "INSERT INTO pedidos (fk_usuarios, fk_clientes, pagamento) VALUES (?, ?, ?);";
        
        $stat = $conn->prepare($sql);
        $stat->bind_param("iis", 
            $data["fk_usuarios"],
            $data["fk_clientes"],
            $data["pagamento"]
        );
        return $stat->execute();
    }

    public static function update($conn, $id, $data) {
        $sql = "UPDATE pedidos SET fk_usuarios = ?, fk_clientes = ?, data = ?, pagamento = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iissi",
            $data["fk_usuarios"],
            $data["fk_clientes"],
            $data["data"],
            $data["pagamento"],
            $id
        );
        return $stmt->execute();
    }

    public static function delete($conn, $id) {
        $sql = "DELETE FROM pedidos WHERE id= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

}

?>