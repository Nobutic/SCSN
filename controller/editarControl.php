<?php

    $idCliente     = $_POST['id'];
    $idAsesor      = $_POST['idAsesor'];
    $idServicio    = $_POST['consecutivo'];
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
        echo 'error_1';

    }elseif(empty($tipoServicio) || empty($modulo) || empty($descripcion) || empty($tareas_asesor) || empty($tarea_cliente) || empty($horaInicio) || empty($horaFinal) || empty($tiempo) || empty($pRecibe) || empty($cargo) || empty($email)){
        echo 'error_2';
    }else{
        require_once '../model/servicio.php';
        $servicio = new Servicio();
        $servicio ->editarControl($idCliente, $idAsesor, $idServicio, $tipoServicio, $modulo, $descripcion, $id_ticket, $tareas_asesor, $tarea_cliente, $fecha, $horaInicio, $horaFinal, $tiempo, $pRecibe, $cargo, $email);
        
        echo 'editar';
      }

    
?>
