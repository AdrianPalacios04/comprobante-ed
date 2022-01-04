<?php
include '../controller/funciones.php';
include '../model/conexion.php';
// connection
$ftp_hostname = 'industriasdq.com'; // change this
$conn_id = ftp_connect($ftp_hostname);
$ftp_username = 'industri'; // change this
$ftp_password = 'upqXIoWGkyFH'; // change this

$login_result = ftp_login($conn_id, $ftp_username, $ftp_password);

ftp_pasv($conn_id, true);

$local_dir = "C:/xampp/htdocs/comprobante/archivos";
// $remote_server_dir = "/home1/industri/facturas.industriasdq.com/carpetaprueba";
$remote_server_dir = "facturas.industriasdq.com/carpetaprueba";

$sql = mysqli_query($con,'SELECT * FROM configuracion');

//echo mysql_result($sql,0);

// // busca por las rutas que estan en el sistema;
foreach ($sql as $rows) {
    // echo "$rows[ruta_nombre]<br>";
     $files = clean_scandir($rows['ruta_nombre']);
     for ($i=0; $i <count($files); $i++) { 
        // $files_on_server = ftp_nlist($conn_id,$remote_server_dir);
        $files_on_server = clean_ftp_nlist($conn_id,$remote_server_dir);
        // print_r($files_on_server);
        if (!in_array("$files[$i]",$files_on_server))
            {
            // echo "$remote_server_dir/$files[$i] Si existe! <br>";
            // if(ftp_put($conn_id,"$remote_server_dir/$files[$i","$local_dir/$files[$i]",FTP_BINARY)){
            if (ftp_put($conn_id,"$remote_server_dir/$files[$i]","$rows[ruta_nombre]/$files[$i]",FTP_ASCII)) {
                echo "Se envio correctamente $files[$i] <br/>"; 
            }else {
                echo 'Problemas al enviar los archivos';
            }
        }else{
            // if (file_exists("$local_dir/$files[$i])")) {
            //     echo "$local_dir/$files[$i] existe! <br/>";
            // }else{
            //  echo "$local_dir/$files[$i] NO existe! <br/>";
            // }
            echo "$remote_server_dir/$files[$i] Si existe! <br/>";
        }
    }
}  
ftp_close($conn_id);
    // in_array(unlink($files));
?>