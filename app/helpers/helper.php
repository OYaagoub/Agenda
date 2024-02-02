<?php 
/**
 * Genera un hash aleatorio para un nombre de arhivo manteniendo la extensión original
 */
function generarNombreArchivo(string $nombreOriginal):string {
    $nuevoNombre = md5(time()+rand());
    $partes = explode('.',$nombreOriginal);
    $extension = $partes[count($partes)-1];
    return $nuevoNombre.'.'.$extension;
}

function guardarMensaje($mensaje){
    $_SESSION['error']=$mensaje;
}

function imprimirMensaje(){
    if(isset($_SESSION['error'])){
        echo '<div class="error" id="mensajeError">'.$_SESSION['error'].'</div>';
        unset($_SESSION['error']);
    } 
}


function cleanString($content){
   
        $string = preg_replace("/[^A-Za-z1-9\s_-]/", '', $content);
        $contentfinal = filter_var($string , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        return $contentfinal;
    
}


function cleanId($id){
    $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
    return $id;
}