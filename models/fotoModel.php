<?php

class fotoModel {

public static function getAll($conn) {
        $sql = "SELECT * FROM fotos";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getById($conn, $id) {
        $sql = "SELECT * FROM fotos WHERE id= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function getByQuartoId($conn, $id){
    $sql = "SELECT f.nome FROM quartos_fotos qf 
    JOIN fotos f ON qf.foto_id = f.id WHERE qf.quarto_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result =  $stmt->get_result();
    $imagem = [];
    while ($row = $stmt->fetch_assoc()) {
        $imagem[] = $row["nome"];
    }
    return $imagem;
    }   

    public static function create($conn, $name) {
        $sql = "INSERT INTO fotos (nome) VALUES (?);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $name,);
        if($stmt->execute()){
            return $conn->insert_id;
        }
        return false;
    }

     public static function createRelationRoom($conn, $idQuarto, $idFoto) {
        $sql = "INSERT INTO quartos_fotos (qaurto_id, foto_id) VALUES (?, ?);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $idQuarto, $idFoto);
        if($stmt->execute()){
            return $conn->insert_id;
        }
        return false;
    }

    public static function update($conn, $id, $name) {
        $sql = "UPDATE fotos SET nome = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $name["nome"], $id
        );
        return $stmt->execute();
    }

    public static function delete($conn, $id) {
        $sql = "DELETE FROM fotos WHERE id= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

}