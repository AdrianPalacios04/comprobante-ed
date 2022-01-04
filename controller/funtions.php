<?php 
//funcion para el array de las carpeta local
function clean_scandir($dir){
    return array_values(array_diff(scandir($dir),array('..','.')));
}
// funcion para el ftp_nlist
function clean_ftp_nlist($conn_id,$remote_server_dir)
{
    $files_on_server = ftp_nlist($conn_id,$remote_server_dir);
    return array_values(array_diff($files_on_server,array('.','..')));
}

?>