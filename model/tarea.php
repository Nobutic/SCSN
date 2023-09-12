<?php

    require_once('conexion.php');

    class Tarea extends Conexion{

        public function registrarTicket($nombre)
        {
            parent::conectar();
            $verificar_registro = parent::verificarRegistros('SELECT * FROM tickets WHERE nombre = "'.$nombre.'" ');

            if($verificar_registro > 0)
            {
                echo '<script type="text/javascript">
                        alert("El ticket que intenta crear ya existe");
                        window.location="../../view/admin/ticket.php";
                    </script>';
            }else{
                parent::query('INSERT INTO tickets(nombre) values("'.$nombre.'")');
                echo '<script type="text/javascript">
                        alert("Registro exitoso");
                        window.location="../../view/admin/ticket.php";
                    </script>';
            }

            parent::cerrar();
        }

        public function listarTickets()
        {
            parent::conectar();
            $listaTickets = parent::query('SELECT * FROM tickets');
            return $listaTickets;
            parent::cerrar();
        }

        public function numTareas()
        {
            parent::conectar();
            $numTarea = parent::verificarRegistros('SELECT* FROM tareas WHERE estado="PENDIENTE"');
            return $numTarea;
            parent::cerrar();
        }

        public function numPendientes($asesor)
        {
            parent::conectar();
            $tPendientes = parent::verificarRegistros('SELECT* FROM tareas WHERE id_asesor= "'.$asesor.'" AND estado="PENDIENTE" ');
            return $tPendientes;
            parent::cerrar();
        }

        public function listarTareas()
        {
            parent::conectar();
            $listaTareas = parent::query('SELECT t.id, t.id_servicio, c.nombre, a.nombre AS asesor, ti.nombre AS titulo, t.descripcion, date_format(fecha, "%d-%m-%Y") AS fecha, t.estado, solucion
                                          FROM tareas t
                                          INNER JOIN servicios s, asesores a, clientes c, tickets ti
                                          WHERE t.id_servicio = s.id_servicio
                                          AND s.id_cliente = c.id
                                          AND a.id = s.id_asesor
                                          AND t.estado != "N/A"
                                          AND ti.id = id_ticket');
            return $listaTareas;
            parent::cerrar();
        }

        public function listarTareasAsesor($id)
        {
            parent::conectar();
            $listaTareas = parent::query('SELECT t.id, t.id_servicio, c.nombre, a.nombre AS asesor,ti.nombre AS titulo, t.descripcion, date_format(fecha, "%d-%m-%Y") AS fecha, t.estado, solucion
                                        FROM tareas t
                                        INNER JOIN servicios s, asesores a, clientes c, tickets ti
                                        WHERE t.id_servicio = s.id_servicio
                                        AND s.id_cliente = c.id
                                        AND a.id = s.id_asesor
                                        AND ti.id = id_ticket
                                        AND t.estado != "N/A"
                                        AND t.id_asesor = "'.$id.'" ');
            return $listaTareas;
            parent::cerrar();
        }

        public function cambiarEstado($estado)
        {
            parent::conectar();
            parent::query('UPDATE tareas SET estado = "'.$estado.'"');
            parent::cerrar();
        }

        public function ticketCliente($mes, $anio, $id)
        {
            parent::conectar();
            $lista = parent::query('SELECT t.id_servicio, c.nombre AS cliente, date_format(fecha, "%d-%m-%Y") AS fecha, a.nombre AS asesor, estado, t.descripcion, solucion, ti.nombre AS ticket, m.nombre AS modulo, ts.nombre AS tipo_servicio
                            FROM tareas t
                            INNER JOIN servicios s, asesores a, clientes c, tickets ti, modulos m, tipo_servicio ts
                            WHERE t.id_asesor = a.id
                            AND t.id_servicio = s.id_servicio
                            AND s.id_cliente = c.id
                            AND t.id_ticket = ti.id
                            AND modulo = m.id
                            AND tipo_servicio = ts.id
                            AND MONTH(fecha) = "'.$mes.'"
                            AND YEAR(fecha) = "'.$anio.'"
                            AND id_cliente = "'.$id.'"
                            AND t.estado != "N/A"
                            ORDER BY fecha');
            return $lista;
            parent::cerrar();
        }

        public function solucionTarea($id, $solucion)
        {
            try{
                parent::conectar();
                parent::query('UPDATE tareas SET solucion="'.$solucion.'", estado="RESUELTO" WHERE id="'.$id.'"');
                parent::cerrar();
            }catch(Exception $e){
                echo $e->getMenssage();
            }
        }
    }

?>