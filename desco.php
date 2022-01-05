<?php
function clean_scandir($dir){
    return array_values(array_diff(scandir($dir),array('..','.')));
}
$local_dir = "C:/xampp/htdocs/comprobante/archivos";
$files = clean_scandir($local_dir);

$find_extension_zip = "zip"; 

for ($i=0; $i <count($files) ; $i++) { 
    $file_extension = pathinfo($files[$i],PATHINFO_EXTENSION);
    if ($file_extension == $find_extension_zip) {
        // echo "$files[$i]";
        $zip = new ZipArchive;
        
        // $zip->extractTo("$local_dir");
        // $zip->close();
        if ($zip->open("$local_dir/$files[$i]") === TRUE) {
            $zip->extractTo('C:/xampp/htdocs/comprobante/archivos');
            $zip->close();
            echo 'ok';
        } else {
            echo 'failed';
        }
    } else {
        // echo "No se encontro";
    }   
}
?>