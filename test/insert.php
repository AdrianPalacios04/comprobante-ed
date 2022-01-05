<?php
include_once "../model/conexion.php";

 function clean_scandir($dir){
    return array_values(array_diff(scandir($dir),array('..','.')));
}
$local_dir = "C:/xampp/htdocs/comprobante/archivos/xml";
$files = clean_scandir($local_dir);

    for ($i=0; $i <count($files) ; $i++) { 
        $filename = pathinfo($files[$i],PATHINFO_FILENAME);
         echo "$filename <br>";
        $ruc = substr($filename,0,11);
        // echo "$ruc<br>";
        $tipodoc = substr($filename,13,1);
        // echo "$tipodoc<br>";
        $serie = substr($filename,15,4);
        // echo "$serie<br>";
        $num = substr($filename,20);

        $sql = mysqli_query($con,
        "INSERT INTO electronica_facturacion_web(ruc,tipodoc,serie,numero) 
        VALUES('$ruc','$tipodoc','$serie','$num')
        ");
    }
?>