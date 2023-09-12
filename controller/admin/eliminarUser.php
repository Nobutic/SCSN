<?php

    $id = $_GET['id'];

    if($id){
        require_once '../../model/usuario.php';

        $usuario = new Usuario();
        
        $usuario -> eliminarUsuario($id);

        echo "<script type='text/javascript'>
                window.location = '../../view/admin/listUser.php';
              </script>";
    }else{
        echo "<script type='text/javascript'>
                swal('Error', 'Error al intentar eliminar el usuario', 'error');
                window.location = 'listUser.php';
              </script>";
    }
?>