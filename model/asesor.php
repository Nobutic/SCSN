<?php

  # Incluimos la clase conexion para poder heredar los metodos de ella.
  require_once('conexion.php');


  class Asesor extends Conexion
  {

    
    public function registroAsesor($nombre, $calendario, $identificacion, $email, $telefono, $cargo, $clave)
    {
      parent::conectar();

      $email   = parent::filtrar($email);


      // validar que el correo no exito
      $verificarCorreo    = parent::verificarRegistros('select id from asesores where email="'.$email.'" ');
      $verificarId        = parent::verificarRegistros('select id from asesores where id = "'.$identificacion.'" ');
      $verificarIdUsuario = parent::verificarRegistros('select id from usuarios where id = "'.$identificacion.'" ');


      if($verificarCorreo > 0){
        echo 'error_3';
      }else if($verificarId > 0){
        echo 'error_2';
      }else if($verificarIdUsuario > 0){
        echo 'error_2';
      }else{

        parent::query('insert into asesores(id, nombre, email, telefono, calendario, cargo) values("'.$identificacion.'", "'.$nombre.'", "'.$email.'", "'.$telefono.'", "'.$calendario.'", "'.$cargo.'")');
        parent::query('insert into usuarios(id, nombre, email, clave, cargo) values("'.$identificacion.'", "'.$nombre.'", "'.$email.'", "'.$clave.'", 3)');
        echo 'guardar';
      }

      parent::cerrar();
    }

    public function numAsesores()
    {
      parent::conectar();
      $numAsesores = parent::verificarRegistros('SELECT * FROM asesores');
      return $numAsesores;
    }

    public function listarAsesores()
    {
      parent::conectar();

      $consulta = "SELECT @n := @n + 1 n, nombre, id, calendario, email, telefono, cargo FROM asesores, (SELECT @n := 0) m  ORDER BY nombre";

      $listaAsesores = parent::query($consulta);

      return $listaAsesores;

      parent::cerrar();
    }

    public function listarTareas($id)
    {
      parent::conectar();

      $consulta = 'SELECT t.id,t.id_servicio, c.nombre, ti.nombre as titulo, t.descripcion, date_format(fecha, "%d-%m-%Y") AS fecha, t.estado, solucion
                    FROM tareas t
                    INNER JOIN servicios s, asesores a, clientes c, tickets ti
                    WHERE t.id_servicio = s.id_servicio
                    AND s.id_cliente = c.id
                    AND a.id = s.id_asesor
                    AND ti.id = id_ticket
                    AND t.estado != "N/A"
                    AND t.id_asesor = "'.$id.'" ';

      $listaTareas = parent::query($consulta);

      return $listaTareas;

      parent::cerrar();
    }


    public function actualizarAsesor($nombre, $identificacion, $email, $telefono, $cargo)
    {
      parent::conectar();

      parent::query('UPDATE asesores SET nombre="'.$nombre.'", email="'.$email.'", telefono="'.$telefono.'", cargo="'.$cargo.'" WHERE id ="'.$identificacion.'" ');

      parent::cerrar();
    }


    public function eliminarAsesor($id)
    {
      parent::conectar();

      parent::query('DELETE FROM asesores WHERE id ="'.$id.'" ');

      parent::cerrar();
    }

    public function calendario_asesor($idAsesor)
    {
      parent::conectar();
      $asesor_calendar = parent::consultaArreglo('SELECT calendario FROM asesores WHERE id = '.$idAsesor);
      return $asesor_calendar;
      parent::cerrar();
    }
  }



?>
