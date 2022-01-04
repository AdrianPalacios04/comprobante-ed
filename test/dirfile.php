<?php

$directory = 'C:/xampp/htdocs/comprobante/archivos/';

$allowed_ext = array( "xml","pdf"); 
// Check if the directory exists or not
// if (file_exists($directory) && is_dir($directory)) {
    // Get the files in the directory
    $scan_contents = scandir($directory);
    // Filter out the current (.) and parent (..) directories 
    $files_array = array_diff($scan_contents, array('.', '..'));
    // Get each files of our directory with line break
    foreach ($files_array as $file) {
        //Get the file path
        $file_path = "$directory/$file";
        // Get the file extension
        $file_ext = pathinfo($file_path, PATHINFO_EXTENSION);        
        if (in_array($file_ext, $allowed_ext) ) {
            $files[] = $file_path;
        }
    }
// } 
print_r($files);
?>