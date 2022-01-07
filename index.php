<!-- <?php 
    include_once 'model/conexion.php';
    ?> -->
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php include_once 'layout/layout.php'?> 
        <title>Facturas Comprobante ED</title>
    </head>
    <body>
        <div class="container" align="center">
           
                <form action="" method="POST">
                <div class="col-md-3" style="margin-top:30px">
                    <h6 for="ruc">RUC EMISOR</h6>
                    <input type="text" class="form-control form-control-sm" name="ruc" id="ruc" placeholder="RUC EMISOR" maxlength="11" required>
                </div>
                <div class="col-md-3">
                    <h6 for="tipodoc">Tipo de Comprobante</h6>
                    <select name="tipodoc" id="tipodoc" class="form-select form-select-sm" required>
                        <option value=""></option>
                        <?php 
                            $ruc = $_POST['ruc'];
                            $tipodoc = $_POST['tipodoc'];
                            $serie = $_POST['serie'];
                            $numero = $_POST['numero'];
                            $fecha_emision = $_POST['fecha_emision'];
                            $sql = mysqli_query($con,"SELECT * FROM tipo_comprobante");
                            while ($row = mysqli_fetch_assoc($sql)){
                        ?>
                            <option value="<?php echo $row['id']?>"><?php echo $row['nombre_com'] ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="row col-md-3">
                    <div class="col-sm">
                            <h6 for="serie">Serie</h6>
                            <input type="text" class="form-control form-control-sm" name="serie" id="serie" placeholder="Serie" required>
                    </div>
                    
                    <div class="col-sm">
                        <h6 for="numero">Número</h6>
                        <input type="text" class="form-control form-control-sm" name="numero" id="numero" placeholder="Número" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <h6 for="fecha_emision">Fecha</h6>
                    <input type="date" class="form-control form-control-sm" name="fecha_emision" id="fecha_emision" max="<?php $hoy = date("Y-m-d"); echo $hoy?>" required>
                </div>
                <div class="d-grid gap-2 col-3 mx-auto" style="margin-top:10px">
                <!-- <input type="submit" class="btn btn-primary" name="filter" id="filter" > -->
                <button type="submit" class="btn btn-primary" name="filter" id="filter"><i class="fas fa-search"></i> Buscar </button>
                </div>
                </form>
    
            <!-- Inicio Envio de la busqueda  -->
            <div class="mb-3">
                <?php 
                    if (isset($_POST['filter'])) { 
                        $consulta = mysqli_query($con,"SELECT e.ruc,e.ruccliente,t.nombre_com,
                        e.serie,e.numero,e.ruta,e.fecha_emision FROM electronica_facturacion_web e 
                        INNER JOIN tipo_comprobante t ON e.tipodoc = t.id 
                        WHERE e.ruc LIKE '%$ruc%' and e.tipodoc LIKE '%$tipodoc%' 
                        and e.serie LIKE '%$serie%' and 
                        e.numero LIKE '%$numero%' and e.fecha_emision LIKE '%$fecha_emision%'");
                        if (mysqli_num_rows($consulta) == 0) {
                            echo '<div class="alert alert-danger col-md-3" style="margin-top:10px" role="alert">
                            No hay resultado ! </div>';
                        }else{
                        while ($row = mysqli_fetch_assoc($consulta)) {
                    ?>   
                    <div class="card col-md-3" style="margin-top:10px">
                            <div class="card-body">
                                <td>
                                    <h6 for="">Ruc:<?php echo $row['ruc'] ?></h6>
                                </td>
                                <td>
                                    <h6 for="">Ruc. Cliente: <?php echo $row['ruccliente'] ?> </h6>
                                </td>
                                <td>
                                    <h6 for="">Tipo Comprobante: <?php echo $row['nombre_com'] ?> </h6>
                                </td>
                                <td>
                                    <h6 for="">Serie: <?php echo $row['serie'] ?> </h6>
                                </td>
                                <td>
                                    <h6 for="">Numero: <?php echo $row['numero'] ?> </h6>
                                </td>
                                <td>
                                    <h6 for="">Fecha: <?php echo $row['fecha_emision'] ?> </h6>
                                </td>
                                <td>
                                    <?php 
                                        // $search = $row['ruta'];
                                        // $file_pointer = 'archivos/'.$row["ruc"].'-'.$row["tipodoc"].'-'.$row["serie"].'-'.$row["numero"].'.pdf';
                                    $search = $row['ruta'];
                                    
                                    $file_pointer = "archivos/$search.pdf";
                                    if (file_exists($file_pointer)) {
                                    ?>
                                        <a class="btn btn-danger btn-sm" href="<?php echo $file_pointer?>" download="<?php echo $file_pointer ?>"><i class="fas fa-file-pdf"></i> PDF </a>
                                    <?php 
                                        $sql = "SELECT * FROM electronica_facturacion_web WHERE ruc='$ruc' 
                                        and tipodoc='$tipodoc' and serie='$serie' and numero='$numero' 
                                        and fecha_emision='$fecha_emision'";
                                        $result = mysqli_query($con, $sql);
                                        if(mysqli_num_rows($result) > 0){
                                            $sql2 = "UPDATE electronica_facturacion_web SET est_pdf= 1, est_xml = 1
                                                WHERE ruc='$ruc' and tipodoc='$tipodoc' and serie='$serie' 
                                                and numero='$numero' and fecha_emision='$fecha_emision' ";
                                                mysqli_query($con, $sql2);
                                        }else{
                                            echo "No se encontro";
                                        }
                                } else { ?>
                                        <button class="btn btn-secondary btn-sm" disabled><i class="fas fa-file-pdf"></i> Sin PDF </button>
                                    <?php } ?>

                                    <?php 
                                        $file_pointer_xml = "archivos/$search.xml";
                                        if (file_exists($file_pointer_xml)) {
                                        
                                    ?>
                                    <a class="btn btn-success btn-sm" href="<?php echo $file_pointer_xml?>" download="<?php echo $file_pointer_xml ?>">
                                    <i class="fas fa-file"></i> XML </a>
                                    <?php 

                                
                                } else { ?>
                                        <button class="btn btn-secondary btn-sm" disabled><i class="fas fa-file"></i> Sin XML </button>
                                    <?php } ?>
                                </td>
                            
                            </div>
                    </div>
                    <?php   }
                        }
                    } ?>
            </div>
            <!-- Fin de la busqueda -->
        </div>
    </body>
    </html>