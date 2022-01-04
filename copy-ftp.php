<?php

include_once "model/conexion.php";
include "controller/funtions.php";
//conexion ftp
$ftp_host = 'sifsistemas.com'; 
$ftp_user = 'upncsiol'; 
$ftp_pass = '3usN363qQNEi'; 

$ftp_connection = ftp_connect($ftp_host) or die ("Couldn't connect to $ftp_host"); 
ftp_login($ftp_connection,$ftp_user,$ftp_pass) or die("Couldn't login to ftp server");
ftp_pasv($ftp_connection,true);

$local_dir = "C:/xampp/htdocs/comprobante/archivos/";
$remote_server_dir = "/sifsistemas.com/piolito/dataprueba"; // problema de la ruta
$files = clean_scandir($local_dir);
// contador para la lista de carpetas
    for ($i=0; $i <count($files) ; $i++) {   
        $fize_file = filesize("$local_dir/$files[$i]");
        $filename = pathinfo($files[$i],PATHINFO_FILENAME);
        $files_on_server = clean_ftp_nlist($ftp_connection,$remote_server_dir);
        if ($fize_file > 0) {
            if (!in_array("$remote_server_dir/$files[$i]",$files_on_server)) {
                if (ftp_put($ftp_connection,"$remote_server_dir/$files[$i]",
                "$local_dir/$files[$i]",FTP_BINARY)) {
                    $update_ruta = mysqli_query($con,"UPDATE electronica_facturacion_web 
                    SET ruta = '$filename' WHERE 
                    CONCAT(ruc,'-',tipodoc,'-',serie,'-',numero) = '$filename'");
                    echo "Successfully uploaded $files[$i] <br/>";  
                } else {
                    echo "Problem has upload <br/>";
                } 
            } else {
                echo "$remote_server_dir/$files[$i] Si existe! <br/>";
            }
        } else {
            echo "$files[$i] es archivo no se puede subir por falta de contenido";
        }      
    }
ftp_close($ftp_connection);
?>

