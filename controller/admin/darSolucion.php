<?php

    $id_tarea       = $_POST['id'];
    $texto_solucion = $_POST['solucion'];

    if(empty($texto_solucion)){
        echo "<script type='text/javascript'>
            alert('Campos obligatorios, llene los campos vacíos');
            window.location='../../view/admin/tareas.php';
          </script>"; 
    }else{
        
        
        require_once('../../model/tarea.php');
        $solucion = new Tarea();

        $solucion->solucionTarea($id_tarea, $texto_solucion);

        echo "<script type='text/javascript'>
            alert('Registro exitoso!!');
            window.location='../../view/admin/tareas.php';
          </script>"; 
    }
?>
