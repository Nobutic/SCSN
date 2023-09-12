<?php

  # Incluimos la clase conexion para poder heredar los metodos de ella.
  require_once('conexion.php');


  class Usuario extends Conexion
  {

    public function login($user, $clave)
    {
      

      # Nos conectamos a la base de datos
      parent::conectar();

      // El metodo salvar sirve para escapar cualquier comillas doble o simple y otros caracteres que pueden vulnerar nuestra consulta SQL
      $user  = parent::salvar($user);
      $clave = parent::salvar($clave);

      // Si necesitas filtrar las mayusculas y los acentos habilita las lineas 36 y 37 recuerda que en la base de datos debe estar filtrado tambien para una validacion correcta
      /*$user  = parent::filtrar($user);
      $clave = parent::filtrar($clave);*/


      // traemos el id y el nombre de la tabla usuarios donde el usuario sea igual al usuario ingresado y ademas la clave sea igual a la ingresada para ese usuario.
      $consulta = 'select id, nombre, cargo from usuarios where email="'.$user.'" and clave="'.$clave.'" ';
      /*
        Verificamos si el usuario existe, la funcion verificarRegistros
        retorna el número de filas afectadas, en otras palabras si el
        usuario existe retornara 1 de lo contrario retornara 0
      */

      $verificar_usuario = parent::verificarRegistros($consulta);

      // si la consulta es mayor a 0 el usuario existe
      if($verificar_usuario > 0){

        $user = parent::consultaArreglo($consulta);

        session_start();

        $_SESSION['id']     = $user['id'];
        $_SESSION['nombre'] = $user['nombre'];
        $_SESSION['cargo']  = $user['cargo'];
        $_SESSION['tiempo'] = time();


        // Verificamos que cargo tiene l usuario y asi mismo dar la respuesta a ajax para que redireccione
        if($_SESSION['cargo'] == 1){
          echo 'view/admin/index.php';
        }else if($_SESSION['cargo'] == 2){
          echo 'view/user/index.php';
        }else if($_SESSION['cargo'] == 3){
          echo 'view/asesor/index.php';
        }


        // u.u finalizamos aqui :v

      }else{
        // El usuario y la clave son incorrectos
        echo 'error_3';
      }


      # Cerramos la conexion
      parent::cerrar();
    }

    
    public function cambiarClave($id, $claveActual, $claveNueva)
    {
      parent::conectar();

      $claveActual = parent::salvar($claveActual);
      $claveNueva = parent::salvar($claveNueva);

      $verificar_claveActual = parent::verificarRegistros('select * from usuarios where id="'.$id.'" and clave="'.$claveActual.'"');

      if($verificar_claveActual>0)
      {
        parent::query('update usuarios set clave="'.$claveNueva.'" where id='.$id);
      }else{
        echo 'error_2';
      }
      parent::cerrar();
    }


    public function registroUsuario($id, $name, $email, $clave, $cargo)
    {
      parent::conectar();

      $email = parent::filtrar($email);
      $clave = parent::filtrar($clave);


      // validar que el correo no exito
      $verificarCorreo = parent::verificarRegistros('select id from usuarios where email="'.$email.'" ');
      $verificarId     = parent::verificarRegistros('SELECT * FROM usuarios WHERE id = "'.$id.'" ');

      if($verificarCorreo > 0){
        echo 'error_3';
      }else if($verificarId > 0){
        echo 'error_5';
      }else{

        parent::query('INSERT INTO usuarios(id, nombre, email, clave, cargo) 
                      values("'.$id.'","'.$name.'", "'.$email.'", "'.$clave.'", "'.$cargo.'")');
        
        echo 'guardar';
      }

      parent::cerrar();
    }

    public function listarUsuario()
    {
      parent::conectar();

      $consulta = 'SELECT @n := @n + 1 n, u.id AS id_usuario, u.nombre AS nombre, email, clave, cargo, r.nombre AS Rol_Usuario 
                  FROM usuarios u, (SELECT @n := 0) m INNER JOIN rol r WHERE r.id = u.cargo AND u.id != 1003504814;';

      $listaUsuarios = parent::query($consulta);

      return $listaUsuarios;

      parent::cerrar();
    }

    public function actualizarUsuario($id, $name, $email, $clave, $cargo, $nuevoid)
    {
      parent::conectar();

      $email = parent::filtrar($email);


      parent::query('UPDATE usuarios SET id="'.$nuevoid.'", nombre="'.$name.'", email="'.$email.'", clave="'.$clave.'", cargo="'.$cargo.'" WHERE id ="'.$id.'" ');
      
      
      echo 'actualizar';
      
      parent::cerrar();
    }

    public function eliminarUsuario($id)
    {
      parent::conectar();

      parent::query('DELETE FROM usuarios WHERE id ="'.$id.'" ');

      echo "<script type='text/javascript'>
                swal('Mensaje', 'Usuario eliminado', 'success');
                window.location = 'listUser.php';
              </script>";

      parent::cerrar();
    }

    public function numUsuarios()
    {
      parent::conectar();
      $numUsuario = parent::verificarRegistros('SELECT * FROM usuarios');
      return $numUsuario;
      parent::cerrar();
    }
  }
  
?>