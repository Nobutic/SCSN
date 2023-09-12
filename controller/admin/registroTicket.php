<?php
    $nombre      = $_POST['nombre'];

    if(empty($nombre))
    {
        echo '<script type="text/javascript">
                alert("No puede guardar un ticket vacío");
                window.location="../../view/admin/ticket.php";
            </script>';
    }else{

        require_once '../../model/tarea.php';

        $ticket = new Tarea();

        $ticket -> registrarTicket($nombre);

    }

?>