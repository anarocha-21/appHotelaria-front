<?php
 
class senhaControler{
    public static function geradorHash($senha){
        return password_hash('$senha', PASSWORD_BCRYPT);
    }
    public static function leitorHash($senha, $hash){
        return password_verify('$senha', '$hash');
    }
}
 
?>