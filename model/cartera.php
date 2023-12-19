<?php

  # Incluimos la clase conexion para poder heredar los metodos de ella.
  require_once('conexion.php');


  class Cartera extends Conexion
  {

    public function listarCartera()
    {
      parent::conectar();
      $lista = parent::query('SELECT c.id_compra, c.id_factura, c.id_cliente, c.fecha, c.fecha_ven, c.valor, abonos.sum_abono, cl.nombre, c.tiempo
                            FROM compras c 
                            JOIN clientes cl ON c.id_cliente = cl.id
                            LEFT JOIN (
                              SELECT id_factura, SUM(abono) as sum_abono
                              FROM movimientos
                             GROUP BY id_factura
                            ) abonos ON c.id_compra = abonos.id_factura');
      return $lista;
      parent::cerrar();
    }

    public function abonar($idFactura, $valor, $fecha)
    {
      parent::conectar();
      parent::query('INSERT INTO movimientos(id_factura, fecha, abono) VALUES("'.$idFactura.'", "'.$fecha.'", '.$valor.');');
      parent::cerrar();
    }

    public function abonos($idFactura)
    {
      parent::conectar();
      $list_abonos = parent::query('SELECT * FROM movimientos WHERE id_factura = "'.$idFactura.'"');
      return $list_abonos;
      parent::cerrar();
    }
    
    public function saldo()
    {
      parent::conectar();
      $lista_saldo = parent::query('SELECT c.id_factura, id_cliente, c.fecha, fecha_ven, valor, SUM(abono) AS sum_abono, cl.nombre, c.tiempo
                                    FROM compras c 
                                    INNER JOIN movimientos m, clientes cl 
                                    WHERE c.id_compra = m.id_factura 
                                    AND c.id_cliente = cl.id
                                    GROUP BY c.id_compra');
      return $lista_saldo;
      parent::cerrar();
    }

    public function editarFactura($idCliente, $idFactura, $fecha, $fechaVen, $fechaFactura, $fechaAbono, $valorFactura, $valorAbono, $tiempo)
    {
      parent::conectar();

      //Actualiza el registro de la compra
      $editarCompra= parent::query('UPDATE compras SET fecha="'.$fechaFactura.'", fecha_ven="'.$fechaVen.'", valor="'.$valorFactura.'" WHERE id_compra="'.$idFactura.'"; ');
      
      if($editarCompra){

      // consulta el tiempo del clientes antes de realizar el descuento
      $res = parent::query('select tiempo from clientes where id= "'.$idCliente.'" ');
      $tiempoActual = 0;
      if($reg = $res->fetch_array()){
          $tiempoActual = $reg[0];
      }
      // nuevo tiempo: le restamos el tiempo_asesoria al tiempo actual del cliente
      $tiempoActual += $tiempo;

  
      $query = 'UPDATE clientes set tiempo = '.$tiempoActual.' WHERE id = "'.$idCliente.'" ';
      parent::query($query);

      //Actualiar tiempo de la compra
      $resC = parent::query('SELECT tiempo FROM compras WHERE id_factura = "'.$idFactura.'";');
      $tiempoFactura = 0;
      if($regC = $resC->fetch_array()){
        $tiempoFactura = $regC[0];
      }
      // nuevo tiempo: le restamos el tiempo_asesoria al tiempo actual en la factura de compra
      $tiempoFactura += $tiempo;
      parent::query('UPDATE compras set tiempo = "'.$tiempoFactura.'" where id_compra = "'.$idFactura.'" ');

      //Actualiza la fecha y el valor del abono en movimiento 
      parent::query('UPDATE movimientos SET fecha="'.$fechaAbono.'", abono="'.$valorAbono.'" WHERE id_factura="'.$idFactura.'" AND fecha="'.$fecha.'";');
      parent::cerrar();
    }else{
      echo '<script type="text/javascript">
                alert("SE HA PRESENTADO UN ERROR, POR FAVOR COMINICARSE CON DESARROLLO");
                window.location="javascript:history.back()";
              </script>';
    }
    }

  }


?>