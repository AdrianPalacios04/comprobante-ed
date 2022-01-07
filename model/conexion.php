<?php 
    // $servername = "sifsistemas.com";
    // $username = "upncsiol_factura";
    // $password = 'DLOoAYDQ1Iao';
    // $db = "upncsiol_factura";

    // $servername = "localhost";
    // $username = "root";
    // $password = '';
    // $db = "comprobante";

     $servername = "industriasdq.com";
     $username = "industri_prueba";
     $password = 'LnO0D2Urxdff';
     $db = "industri_comprobante_prueba";
    
    
    // Create connection
    $con = new mysqli($servername, $username, $password,$db);
    
    // Check connection
    if ($con->connect_error) {
      die("Connection failed: " . $con->connect_error);
    }
?>