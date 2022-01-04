<?php
include_once 'model/conexion.php';
include 'controller/funtions.php';

//conexion ftp
$ftp_host = 'sifsistemas.com'; 
$ftp_user = 'upncsiol'; 
$ftp_pass = '3usN363qQNEi'; 

$ftp_connection = ftp_connect($ftp_host) or die ("Couldn't connect to $ftp_host"); 
ftp_login($ftp_connection,$ftp_user,$ftp_pass) or die("Couldn't login to ftp server");
ftp_pasv($ftp_connection,true);

// para los xml
$find_extension = "xml";
$find_first_name = "R";

$local_dir = "C:/xampp/htdocs/comprobante/archivos";
$remote_server_dir = "/sifsistemas.com/piolito/dataprueba"; // problema de la ruta
$files = clean_scandir($local_dir);
for ($i=0; $i <count($files) ; $i++) { 

    $file_extension = pathinfo($files[$i],PATHINFO_EXTENSION);
    $fize_file = filesize("$local_dir/$files[$i]");
    $filename = pathinfo($files[$i],PATHINFO_FILENAME);
    $first = substr($filename,0,1);

    // lista de archivos en el servidor ftp
    $files_on_server = clean_ftp_nlist($ftp_connection,$remote_server_dir);
    // para subir los archivos a ftp
    // if($fize_file>0){
    //     // echo "$files[$i] <br>";
    //     if (!in_array("$remote_server_dir/$files[$i]",$files_on_server)) {
    //         if (ftp_put($ftp_connection,"$remote_server_dir/$files[$i]",
    //         "$local_dir/$files[$i]",FTP_BINARY)) {
    //             $update_ruta = mysqli_query($con,"UPDATE electronica_facturacion_web 
    //             SET ruta = '$filename' WHERE 
    //             CONCAT(ruc,'-',tipodoc,'-',serie,'-',numero) = '$filename'");
    //             echo "Successfully uploaded $files[$i] <br/>";  
    //         } else {
    //             echo "Problem has upload <br/>";
    //         } 
    //     } else {
    //         echo "$remote_server_dir/$files[$i] Si existe! <br/>";
    //     }
    // }
    // if ($first == $find_first_name and $file_extension == $find_extension) {
    //     $xml = simplexml_load_file("$local_dir/$files[$i]");
    //     $description = $xml->xpath("//ar:ApplicationResponse//cac:DocumentResponse//cac:Response//cbc:Description");
    //     foreach ($description as $value) continue;
    //     //observaciones
    //     $referencesID = $xml->xpath('
    //     //ar:ApplicationResponse//cac:DocumentResponse//cac:Response//cbc:ReferenceID');
    //     foreach ($referencesID as $key) continue;
    //     // texto de validacion;     
    //     $text_validation = "La Factura numero $key, ha sido aceptada";
    //     if ($value == $text_validation) {
    //         $final = substr($filename,2);
    //         // sql para el cambio 
    //         $update_answer = mysqli_query($con,"UPDATE electronica_facturacion_web SET respuesta_cdr = 1 
    //         WHERE CONCAT(ruc,'-',tipodoc,'-',serie,'-',numero) = '$final'");
    //     }
    // } else {
    //     // echo "$files[$i] No coinciden con lo requerido <br>";
    // }
        if ($first != $find_first_name and $file_extension == $find_extension and $fize_file > 0) {
           
        $xml2 = simplexml_load_file("$local_dir/$files[$i]",null,LIBXML_NOCDATA);
        //fecha de emision
        $issueDate = $xml2->xpath('cbc:IssueDate');
        foreach ($issueDate as $date) continue;
        // echo $date;
         // razon social
        $bussName = $xml2->xpath(
            "cac:AccountingCustomerParty//cac:Party//cac:PartyLegalEntity//cbc:RegistrationName");
        foreach ($bussName as $buss) continue;
            // print_r($bussName);

       // total 
        $amount = $xml2->xpath("cac:LegalMonetaryTotal//cbc:PayableAmount");
        foreach ($amount as $amo) continue;
    //     // capturar el nombre    
        $final2 = substr($filename,0);
       //sentencia para guardar los datos
        $add_data = mysqli_query($con,"UPDATE electronica_facturacion_web 
        SET razon_social ='$buss',fecha_emision='$date',total ='$amo' 
        WHERE CONCAT(ruc,'-',tipodoc,'-',serie,'-',numero) = '$final2'");
         echo "se guardo correctamente";
    } else {
        // echo "No se encontro";
    }   
}
?>