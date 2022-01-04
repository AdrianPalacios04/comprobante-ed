<?php
include_once '../controller/funtions.php';
$filename = "C:/xampp/htdocs/comprobante/archivos/R20514293385-1-F001-0002005.zip";

$za = new ZipArchive();

 $open = $za->open("$filename");
$open_entry = $za->zip_entry_open("$open");
print_r($open_entry);

?>