<?php
include_once '../controller/funtions.php';
$filename = "C:/xampp/htdocs/comprobante/archivos/R20514293385-1-F001-0002005.zip";

$za = new ZipArchive();

$za->open("$filename");
for ($i=0; $i<$za->numFiles;$i++) {
    echo "index: $i\n";
    print_r($za->statIndex($i));
}
?>