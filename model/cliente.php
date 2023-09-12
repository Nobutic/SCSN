<?php

  # Incluimos la clase conexion para poder heredar los metodos de ella.
  require_once('conexion.php');


  class Cliente extends Conexion
  {
    public function registroCliente($nombre, $nombreUsuario, $identificacion, $email, $direccion, $telefono, $ciudad, $nombreContacto, $cargo, $celular, $emailContacto, $clave)
    {
      parent::conectar();
      $email   = parent::filtrar($email);

      // validar que el correo no exito
      $verificarCorreo = parent::verificarRegistros('select id from clientes where email="'.$email.'" ');
      $verificarId     = parent::verificarRegistros('select id from clientes where id = "'.$identificacion.'" ');

      if($verificarCorreo > 0){
        echo "error_3";
      }else if($verificarId > 0){
        echo "error_2";
      }else{

        parent::query('insert into clientes(id, nombre, email, direccion, telefono, ciudad, nombre_contacto, cargo, celular, email_contacto) values("'.$identificacion.'", "'.$nombre.'", "'.$email.'", "'.$direccion.'", "'.$telefono.'", "'.$ciudad.'", "'.$nombreContacto.'", "'.$cargo.'", "'.$celular.'", "'.$emailContacto.'")');
        parent::query('insert into usuarios(id, nombre, email, clave, cargo) values("'.$identificacion.'", "'.$nombreUsuario.'", "'.$email.'", "'.$clave.'", 2)');
        
        echo 'guardar';
      }

      parent::cerrar();
    }

    public function numClientes()
    {
      parent::conectar();
      $numClientes = parent::verificarRegistros('SELECT * FROM clientes');
      return $numClientes;
    }

    public function consultarClientePorId($nombre)
    {
      parent::conectar();
      $consulta = 'SELECT * FROM clientes WHERE nombre LIKE "%'.$nombre.'%" ';
      $cliente = parent::query($consulta);
      return $cliente;
      parent::cerrar();
    }

    public function verificarCliente($id)
    {
      parent::conectar();
      $consulta = 'SELECT * FROM clientes WHERE id = "'.$id.'" ';
      $cliente = parent::verificarRegistros($consulta);
      return $cliente;
      parent::cerrar();
    }

    public function listarClientes()
    {
      parent::conectar();

      $consulta = "SELECT @n := @n + 1 n, nombre, id,email, direccion, telefono, ciudad, concat(tiempo,' Minutos') AS saldo, nombre_contacto, cargo, celular, email_contacto 
                  FROM clientes, (SELECT @n := 0) m  ORDER BY tiempo DESC";

      $listaClientes = parent::query($consulta);
      return $listaClientes;
      parent::cerrar();
    }

    public function actualizarCliente($id, $nombreUsuario, $nombre, $direccion, $telefono, $ciudad, $nombreContacto, $cargo, $celular, $emailContacto, $data, $clave)
    {
      parent::conectar();
      parent::query('UPDATE clientes SET nombre="'.$nombre.'", email="'.$email.'", direccion="'.$direccion.'", telefono="'.$telefono.'", ciudad="'.$ciudad.'", nombre_contacto="'.$nombreContacto.'", cargo="'.$cargo.'", celular="'.$celular.'", email_contacto="'.$emailContacto.'", actualizacion="'.$data.'" WHERE id ="'.$id.'" ');
      parent::query('UPDATE usuarios SET nombre="'.$nombreUsuario.'", email="'.$email.'", clave="'.$clave.'" WHERE id="'.$id.'" ');
      parent::cerrar();
    }

    public function loadCliente($id)
    {
      parent::conectar();
      $list_cliente = parent::query('SELECT * FROM clientes WHERE id = "'.$id.'"');
      return $list_cliente;
      parent::cerrar();
    }

    public function editar($id, $nombre, $email, $direccion, $telefono, $ciudad, $nombreContacto, $cargo, $celular, $emailContacto, $data)
    {
      parent::conectar();
      parent::query('UPDATE clientes SET nombre="'.$nombre.'", email="'.$email.'", direccion="'.$direccion.'", telefono="'.$telefono.'", ciudad="'.$ciudad.'", nombre_contacto="'.$nombreContacto.'", cargo="'.$cargo.'", celular="'.$celular.'", email_contacto="'.$emailContacto.'", actualizacion="'.$data.'" WHERE id ="'.$id.'" ');
      parent::cerrar();
    }
    
    # se actualiza el tiempo en la tabla clientes, se inserta a la cartera 
    public function actualizarTiempo($id, $time, $factura, $valor, $abono, $actualizacion, $fecha_ven)
    {
      parent::conectar();
      $consulta = 'SELECT tiempo FROM clientes WHERE id = "'.$id.'" ';
      $res = parent::query($consulta);

      $tiempoActual = 0;

      if($reg = $res->fetch_array()){
          $tiempoActual = $reg[0];
      }

      $tiempoActual += $time;

      $id_compra = 0;
      $ultimo_reg = parent::consultaArreglo('select max(id_compra) + 1 id_compra from compras');
      $id_compra = $ultimo_reg[0];
      
      
      $consulta_compra = parent::query('INSERT INTO compras(id_compra,id_factura, id_cliente, fecha, fecha_ven, valor, tiempo) VALUES ('.$id_compra.',"'.$factura.'", "'.$id.'", "'.$actualizacion.'", "'.$fecha_ven.'", "'.$valor.'", "'.$time.'") ');
      if($consulta_compra){
      parent::query('INSERT INTO movimientos(id_factura, fecha, abono) VALUES ("'.$id_compra.'", "'.$actualizacion.'", "'.$abono.'") ');
      parent::query('UPDATE clientes SET tiempo="'.$tiempoActual.'", actualizacion="'.$actualizacion.'" WHERE id ="'.$id.'" ');
      }else{
        echo '<script type="text/javascript">
                alert("SE HA PRESENTADO UN ERROR, POR FAVOR COMINICARSE CON DESARROLLO");
                window.location="javascript:history.back()";
              </script>';
      }
      parent::cerrar();
    }

    public function eliminarCliente($id)
    {
      parent::conectar();
      parent::query('DELETE FROM clientes WHERE id ="'.$id.'" ');
      parent::cerrar();
    }

    public function listarCartera($mes, $anio, $id)
    {
      parent::conectar();
      $lista = parent::query('SELECT id_compra, c.id_factura, c.fecha, fecha_ven, valor, SUM(abono) AS sum_abono 
                              FROM compras c 
                              INNER JOIN movimientos m 
                              WHERE c.id_compra = m.id_factura 
                              AND MONTH(c.fecha) = "'.$mes.'" AND YEAR(c.fecha) = "'.$anio.'" AND id_cliente="'.$id.'"
                              GROUP BY c.id_compra ');
      return $lista;
      parent::cerrar();
    }

    public function abonos($idFactura)
    {
      parent::conectar();
      $list_abonos = parent::query('SELECT * FROM movimientos WHERE id_factura = "'.$idFactura.'"');
      return $list_abonos;
      parent::cerrar();
    }

    public function listarMovimiento($mes, $anio, $id)
    {
      parent::conectar();
      $listaM = parent::query('SELECT * FROM compras WHERE MONTH(fecha) = "'.$mes.'" AND YEAR(fecha) = "'.$anio.'" AND id_cliente="'.$id.'" ');
      return $listaM;
      parent::cerrar();
    }

    public function saldo($id)
    {
      parent::conectar();
      $tiempo = parent::consultaArreglo('SELECT tiempo FROM clientes WHERE id="'.$id.'" ');
      return $tiempo;
      parent::cerrar();
    }

    public function ticket($id)
    {
      parent::conectar();
      $tiempo = parent::verificarRegistros('SELECT * FROM tareas t INNER JOIN servicios s WHERE t.id_servicio = s.id_servicio AND s.id_cliente ="'.$id.'" AND estado ="PENDIENTE" ');
      return $tiempo;
      parent::cerrar();
    }

    public function deuda($id)
    {
      parent::conectar();
      $compras = parent::consultaArreglo('SELECT SUM(valor) FROM compras WHERE id_cliente="'.$id.'" ');
      $abonos = parent::consultaArreglo('SELECT SUM(abono) FROM movimientos m INNER JOIN compras c WHERE c.id_compra=m.id_factura AND c.id_cliente='.$id);
      if(empty($compras[0])){ $compras[0] = 0;}
      if(empty($abonos[0])){ $abonos[0] = 0;}
      
      $deuda = $compras[0]-$abonos[0];
      return $deuda;
      parent::cerrar();
    }

  }
?>
