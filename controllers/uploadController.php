<?php

class uploadController{
    static $maxSize = 1024 * 1024 * 5;
    static $typefiles = [
        "image/png" => 'png',
        "image/jpeg" => 'jpg',
    ];
    static $path = __DIR__ . "/../uploads/";

    public static function normalFotos($foto){
        $files = [];
        if(is_array($foto['name'])){
            foreach($foto['name'] as $index => $nome){
                $files[] = [
                    'name' => $foto['name'][$index],
                    'type' => $foto['type'][$index],
                    'tmp_name'=> $foto['tmp_name'][$index],
                    'erros'=> $foto['error'][$index],
                    'size'=> $foto['size'][$index],
                ];
            }
        }else{
            $files[] = $foto;
        }
        return $files;
    }

    public static function randomNome($extension){
        $nome = bin2hex(random_bytes(16));
        return $nome .'.'. $extension;
    
    }

    public static function upload($foto){
        $files = [];
        $erros = [];
        $saves = [];
        
        if ($foto){
            $files = self::normalFotos($foto);
        }

        foreach($files as $index => $imagem){
            $err = $imagem['error'] ?? UPLOAD_ERR_NO_FILE;
            if ($err === UPLOAD_ERR_NO_FILE) continue;
            if ($err !== UPLOAD_ERR_OK){
                $erros[] = "erro no upload (imagem: {$index})";
                continue;
            }
            if (  ($imagem['size']??0) > self::$maxSize  ){
                $erros[] = 'excedeu o limite (imagem: {$index}) de {self::$maxSize} - MB';
                continue;
            }
            $info = new \finfo(FILEINFO_MIME_TYPE);
            $mime = $info->file($imagem['tmp_name']) ?:($imagem['type'] ?? "application/octet-stream");
            if (!isset(self::$typefiles[$mime])){
                $erros[] = "tipo do arquivo nao é permitido";
                continue;
            }

            $nomeFoto = self::randomNome(self::$typefiles[$mime]);
            $destPath = self::$path . $nomeFoto;

            if(!move_uploaded_file($imagem["tmp_name"], $destPath)){
                $erros[] = "falha ao mover o arquivo";
                continue;
            }
            $saves[] = $nomeFoto;
        
        }
        

        return ["files"=>$files, 
        "erros"=>$erros, 
        "saves"=>$saves];
    }

}

?>