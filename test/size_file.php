<?php
function getDirContents($dir, &$results = array()){
    $files = scandir($dir);
    foreach($files as $key => $value){
        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
        if(!is_dir($path)) {
            $results[] = ['path'=>$path,'size'=>filesize($path)];
        } else if($value != "." && $value != "..") {
            getDirContents($path, $results);
            $results[] = ['path'=>$path,'size'=>filesize($path)];
        }
    }
    return $results;
}
$fileslist = getDirContents('C:/xampp/htdocs/comprobante/archivos');
echo "<pre>";
print_r($fileslist); 