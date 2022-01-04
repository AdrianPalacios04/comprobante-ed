
<?php 
    // $files = scandir('../carpetanueva/');
    // $source = "../carpetanueva/";
    // $destination = "../archivos/";
    $files = scandir('../archivos/'); // encuentra la carpeta o directorio
    $source = "../archivos/";
    $destination = "../carpetanueva/";
    if (is_dir('../archivos/')) { // indica si el nombre es un directorio 
        if (count($files)>2) {
            foreach ($files as $file) {
                if (in_array($file,array(".",".."))) continue ;
                    if (copy($source.$file,$destination.$file)) {
                        $delete[] = $source.$file;
                    }
            }
            foreach ($delete as $file) {
                unlink($file);
            }
            echo 'se envio correctamente los archivos';
        }
    }
?>