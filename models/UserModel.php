<?php

class UserModel{
    public static function validateUser($conn, $email, $password){
        $sql = "SELECT usuarios.id, usuarios.nome, usuarios.senha, usuarios.email, regras.nome AS regras FROM usuarios JOIN regras ON regras.id = usuarios.fk_regras WHERE usuarios.email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if($user = $resultado->fetch_assoc()){
            if($user['senha'] === $password){
                unset($user ['senha']);  
                return $user;
            }
        }
        return false;
    }
}

?>