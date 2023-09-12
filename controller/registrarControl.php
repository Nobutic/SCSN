<?php

    $idCliente     = $_POST['id'];
    $idAsesor      = $_POST['idAsesor'];
    $consecutivo   = $_POST['consecutivo'];
    $tipoServicio  = $_POST['servicio'];
    $modulo        = $_POST['modulo'];
    $descripcion   = $_POST['actividades'];
    $id_ticket     = $_POST['idTicket'];
    $tareas_asesor = $_POST['pAsesor'];
    $tarea_cliente = $_POST['pCliente'];
    $fecha         = $_POST['fecha'];
    $horaInicio    = $_POST['hInicio'];
    $horaFinal     = $_POST['hFinal'];
    $tiempo        = $_POST['tiempoAsesoria'];
    $pRecibe       = $_POST['nombre'];
    $cargo         = $_POST['cargo'];
    $email         = $_POST['email'];
    


    if(empty($idCliente)){
        echo '<script type="text/javascript">
                alert("Debe eligir el cliente");
                javascript:history.back();
            </script>';

    }elseif(empty($idAsesor) || empty($tipoServicio) || empty($modulo) || empty($fecha) || empty($id_ticket) || empty($descripcion) || empty($horaInicio) || empty($horaFinal) || empty($tiempo) || empty($pRecibe) || empty($cargo) || empty($email)){
        echo '<script type="text/javascript">
                alert("Campos vacios, Por favor llene los campos vacios");
                javascript:history.back();
            </script>';
    }else{
        require_once '../model/servicio.php';
        $servicio = new Servicio();
        $idServicio = $servicio->consecutivo($consecutivo);
        $servicio ->registrarControl($idCliente, $idAsesor, $idServicio, $tipoServicio, $modulo, $descripcion, $id_ticket, $tareas_asesor, $tarea_cliente, $fecha, $horaInicio, $horaFinal, $tiempo, $pRecibe, $cargo, $email);
    }

    
?>
