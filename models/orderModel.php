<?php

class orderModel{
    public static function createOrder ($conn, $data){
        $sql = "INSERT INTO pedidos (fk_usuarios, fk_clientes, data, pagamento)
        VALUES (?, ?, ?, ?);";
        $stat = $conn->prepare($sql);
        $stat->bind_param("iis", 
        $data["fk_usuarios"],
        $data["fk_clientes"],
        $data["pagamento"]
        );
        $result = $stat->execute();
        if($result->execute()){
            return $conn->insert_id();
        }
        return false;
    
    }

    public static function getById($conn, $id){
     
      
    }





}