<?php

if (isset($_POST["proyecto"]))
{
    $carpeta = htmlspecialchars($_POST["proyecto"]);
    
    //$ruta = htmlspecialchars($_POST["ruta"]);
    $ruta = $_SERVER['DOCUMENT_ROOT']."/";
    $directorio = $ruta.$carpeta;
    
    $respuesta = new stdClass();

    if(!is_dir($directorio))
    {        

        $crear = mkdir($directorio, 0777, true);      
        
        if($crear)
        {
            $respuesta->mensaje = "El directorio $carpeta se creó correctamente.";
            echo json_encode($respuesta);
        }
        else 
        {
            $respuesta->mensaje = "Ocurrio un problema al crear el directorio $carpeta.";
            echo json_encode($respuesta);
        }       
        
    }    
    else
    {
        $respuesta->mensaje = "El directorio $carpeta que intentas crear ya existe";
        echo json_encode($respuesta);
    }    
    
}  
    
    
?>