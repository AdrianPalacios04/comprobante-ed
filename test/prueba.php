<?php
// include '../controller/funciones.php';
include '../model/conexion.php';
// connection
$ftp_hostname = 'industriasdq.com'; // change this
$conn_id = ftp_connect($ftp_hostname,21,30);
$ftp_username = 'industri'; // change this
$ftp_password = 'upqXIoWGkyFH'; // change this

$login_result = ftp_login($conn_id, $ftp_username, $ftp_password);

ftp_pasv($conn_id, true);

$local_dir = "C:/xampp/htdocs/comprobante/archivos";
$files = 'file.txt';

// $remote_server_dir = "facturas.industriasdq.com/carpetaprueba";
$remote_server_dir = "/facturas.industriasdq.com/carpetaprueba";



$check_exists =  $remote_server_dir."/".$files;
echo $check_exists;

    $files_on_server = ftp_nlist($conn_id,$remote_server_dir);
    print_r($files_on_server);

    $file_size = ftp_size($conn_id,$check_exists);
    // print_r($file_size);
    if ($file_size != -1) {
        echo "tamaño $files de bytes $file_size <br/>";
    } else {
        echo "no se obtuvo el tamaño";
    }
    
    //  print_r($files_on_server);
    if (in_array($check_exists,$remote_server_dir)) {
        echo "Si existe!";
    } else {
        echo "No existe!";
    }
    
//     if (!in_array("$files[$i]",$files_on_server)){
//         if (ftp_put($conn_id,"$remote_server_dir/$files[$i]",
//         "$local_dir/$files[$i]",FTP_BINARY)) {
//             echo "Se envió correctamente $files[$i] <br/>"; 
//         }else{
//             echo "Problemas al enviar los archivos $files[$i] <br/>";
//         }
//     }else{
//         echo "$remote_server_dir/$files[$i] Si existe <br/>";
//     }
// }

ftp_close($conn_id);
?>