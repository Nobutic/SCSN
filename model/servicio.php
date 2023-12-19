<?php

    require_once('conexion.php');

    class Servicio extends Conexion
    {

        public function registrarControl($idCliente, $idAsesor, $idServicio, $tipoServicio, $modulo, $descripcion, $ticket, $tareaA, $tareaC, $fecha, $horaInicio, $horaFinal, $tiempo, $recibe, $cargo, $email)
        {
            parent::conectar();
            
                
            if($ticket > 1){
                $control_ticket = 'SI';
                $estado = "PENDIENTE";
            }else {
                $control_ticket = 'NO';
                $estado = "N/A"; 
            }
            if(parent::verificarRegistros('select id_servicio from servicios where descripcion="'.$descripcion.'"')>0){
                echo '<script type="text/javascript">
                    window.location = "../index.php";
                </script>';
            }else{
            // insercion en servicios
            parent::query('INSERT INTO servicios(id_cliente, id_asesor, id_servicio, tipo_servicio, ticket, modulo, descripcion, fecha, hora_inicio, hora_fin, tiempo, persona_recibe, cargo,email, estado_control)
                           VALUES("'.$idCliente.'", "'.$idAsesor.'", "'.$idServicio.'", "'.$tipoServicio.'", "'.$control_ticket.'", "'.$modulo.'", "'.$descripcion.'", "'.$fecha.'", "'.$horaInicio.'", "'.$horaFinal.'", "'.$tiempo.'", "'.$recibe.'", "'.$cargo.'", "'.$email.'", "PENDIENTE") ');
            // Insercion en tareas
            parent::query('INSERT INTO tareas(id, id_ticket, id_servicio, id_asesor, descripcion, tarea_cliente, estado) 
                            VALUES("'.$idServicio.'", "'.$ticket.'", "'.$idServicio.'", "'.$idAsesor.'", "'.$tareaA.'", "'.$tareaC.'", "'.$estado.'")' );
            parent::cerrar();

            
            echo '<script type="text/javascript">
                    alert("Registro exitoso");
                    window.location = "../index.php";
                </script>';
            }
            
        }
        
        public function consecutivo($fecha)
        {
            parent::conectar();
            $ultimo_registro = parent::consultaArreglo('select max(id_servicio) + 1 id_servicio from servicios');
            $digitos = $ultimo_registro[0];
            if($digitos==null){
                $digitos='001';
            }else{
                $digitos = substr($digitos, -3);
            }
            $idServicio = $fecha.$digitos;
            
            return $idServicio;

            parent::cerrar();

        }

        public function editarControl($idCliente, $idAsesor, $idServicio, $tipoServicio, $modulo, $descripcion, $ticket, $tareaA, $tareaC, $fecha, $horaInicio, $horaFinal, $tiempo, $recibe, $cargo, $email)
        {
            parent::conectar();
            
                
            if($ticket > 1){
                $control_ticket = 'SI';
                $servicio = parent::query('UPDATE servicios SET id_cliente="'.$idCliente.'", id_asesor="'.$idAsesor.'", tipo_servicio="'.$tipoServicio.'", ticket="'.$control_ticket.'", modulo= "'.$modulo.'", descripcion="'.$descripcion.'", fecha="'.$fecha.'", hora_inicio="'.$horaInicio.'", hora_fin="'.$horaFinal.'", tiempo="'.$tiempo.'", persona_recibe="'.$recibe.'", cargo="'.$cargo.'", email="'.$email.'" WHERE id_servicio="'.$idServicio.'" ');
            
                $tarea = parent::query('UPDATE tareas SET id_ticket="'.$ticket.'", id_asesor="'.$idAsesor.'", descripcion="'.$tareaA.'", tarea_cliente="'.$tareaC.'", estado="PENDIENTE" WHERE id='.$idServicio );
                
            }else {
                $control_ticket = 'NO';
                $servicio = 'UPDATE servicios SET id_cliente="'.$idCliente.'", id_asesor="'.$idAsesor.'", tipo_servicio="'.$tipoServicio.'", ticket="'.$control_ticket.'", modulo= "'.$modulo.'", descripcion="'.$descripcion.'", fecha="'.$fecha.'", hora_inicio="'.$horaInicio.'", hora_fin="'.$horaFinal.'", tiempo="'.$tiempo.'", persona_recibe="'.$recibe.'", cargo="'.$cargo.'", email="'.$email.'" WHERE id_servicio="'.$idServicio.'" ';
                parent::query($servicio);
                parent::query('UPDATE tareas SET id_ticket="'.$ticket.'", id_asesor="'.$idAsesor.'", descripcion="'.$tareaA.'", tarea_cliente="'.$tareaC.'", estado="N/A" WHERE id='.$idServicio );
            }

            
            parent::cerrar();
        }

        public function aprobarControl($idCliente, $idControl, $tiempo)
        {
            parent::conectar();

            // consulta el tiempo del clientes antes de realizar el descuento
            $res = parent::query('select tiempo from clientes where id= "'.$idCliente.'" ');
            $tiempoActual = 0;
            if($reg = $res->fetch_array()){
                $tiempoActual = $reg[0];
            }
            // nuevo tiempo: le restamos el tiempo_asesoria al tiempo actual del cliente
            $tiempoActual -= $tiempo;

        
            $query = 'update clientes set tiempo = "'.$tiempoActual.'" where id = "'.$idCliente.'" ';
            parent::query($query);
            parent::query('UPDATE servicios SET estado_control="APROBADO" WHERE id_servicio="'.$idControl.'"');
            echo "<script type='text/javascript'>
                    alert('Aprobación Exitosa!!');
                    window.location='../view/admin/listaControles.php';
                    </script>";
            parent::cerrar();

        }

        public function listaControl()
        {
            parent::conectar();
            $listaC = parent::query('SELECT s.id_servicio, id_cliente, s.id_asesor, direccion, c.telefono, ciudad, fecha, c.nombre AS cliente, m.nombre AS modulo, m.id AS idModulo, ts.nombre AS servicio, ts.id AS idServicio, s.descripcion as actividades, hora_inicio, hora_fin, TIMESTAMPDIFF(minute, hora_inicio, hora_fin) as tiempo_conexion, s.tiempo, a.nombre AS asesor, persona_recibe, s.cargo, s.email, ticket, estado_control,ti.nombre AS tarea, t.id AS id_tarea, t.descripcion AS descTarea, tarea_cliente, id_ticket
                                    FROM servicios s
                                    INNER JOIN modulos m, tipo_servicio ts, asesores a, clientes c, tareas t, tickets ti
                                    WHERE m.id = modulo
                                    AND ts.id = tipo_servicio
                                    AND a.id = s.id_asesor
                                    AND c.id = id_cliente
                                    AND t.id = s.id_servicio
                                    AND ti.id = id_ticket
                                    AND estado_control != "APROBADO"
                                    ORDER BY fecha ASC ');
            return $listaC;
            parent::cerrar();
        }
        public function historialControl()
        {
            parent::conectar();
            $listaCH = parent::query('SELECT s.id_servicio, s.id_cliente, c.direccion, c.telefono, c.ciudad, c.email, DATE_FORMAT(s.fecha, "%d-%m-%Y") AS fecha, c.nombre AS cliente, m.nombre AS modulo, ts.nombre AS servicio, s.descripcion as actividades, s.hora_inicio, s.hora_fin, TIMESTAMPDIFF(MINUTE, s.hora_inicio, s.hora_fin) AS tiempo_conexion, s.tiempo, a.nombre AS asesor, s.persona_recibe, s.ticket, s.cargo, s.estado_control, ti.nombre AS tarea, t.descripcion AS descTarea, t.tarea_cliente
                                    FROM servicios s
                                    INNER JOIN modulos m ON m.id = s.modulo
                                    INNER JOIN tipo_servicio ts ON ts.id = s.tipo_servicio
                                    INNER JOIN asesores a ON a.id = s.id_asesor
                                    INNER JOIN clientes c ON c.id = s.id_cliente
                                    INNER JOIN tareas t ON t.id = s.id_servicio
                                    INNER JOIN tickets ti ON ti.id = t.id_ticket
                                    WHERE s.estado_control = "APROBADO"
                                    ORDER BY s.fecha DESC; ');
            return $listaCH;
            parent::cerrar();
        }

        public function controlAsesor($idAsesor)
        {
            parent::conectar();
            $listaC = parent::query('SELECT s.id_servicio, id_cliente, direccion, c.telefono, ciudad, fecha, c.nombre AS cliente, m.nombre AS modulo, m.id AS idModulo, ts.nombre AS servicio, ts.id AS idServicio, s.descripcion as actividades, hora_inicio, hora_fin, TIMESTAMPDIFF(minute, hora_inicio, hora_fin) as tiempo_conexion, s.tiempo, a.nombre AS asesor, persona_recibe, s.cargo, s.email, ticket, estado_control, t.id AS tarea, t.descripcion AS descTarea, tarea_cliente, id_ticket
                                    FROM servicios s
                                    INNER JOIN modulos m, tipo_servicio ts, asesores a, clientes c, tareas t
                                    WHERE m.id = modulo
                                    AND ts.id = tipo_servicio
                                    AND a.id = s.id_asesor
                                    AND s.id_asesor = '.$idAsesor.'
                                    AND c.id = id_cliente
                                    AND t.id = s.id_servicio
                                    ORDER BY estado_control DESC ');
            return $listaC;
            parent::cerrar();
        }
        
        public function numServicios()
        {
            parent::conectar();
            $numServicios = parent::verificarRegistros('SELECT * FROM servicios where estado_control = "PENDIENTE"');
            return $numServicios;
            parent::cerrar();
        }
        
        public function numControl()
        {
            parent::conectar();
            $numControles = parent::verificarRegistros('SELECT * FROM servicios where estado_control != "PENDIENTE"');
            return $numControles;
            parent::cerrar();
        }

        public function registroTipoServicio($nombre, $descripcion)
        {
            parent::conectar();
            parent::query('INSERT INTO tipo_servicio(nombre, descripcion) VALUES("'.$nombre.'", "'.$descripcion.'")');
            echo 'guardar';
            parent::cerrar();
        }

        public function listarTipoServicio()
        {
            parent::conectar();
            $consulta = "SELECT * FROM tipo_servicio";
            $listaTipoServicio = parent::query($consulta);
            return $listaTipoServicio;
            parent::cerrar();
        }

        public function mostrarServicio($fechaInicio, $fechaFin, $cliente)
        {
            parent::conectar();
            $fechaInicio = date('Y-m-d', strtotime($fechaInicio));
            $fechaFin = date('Y-m-d', strtotime($fechaFin));
            $consulta = 'SELECT s.id_servicio, id_cliente, direccion, c.telefono, ciudad, date_format(fecha, "%d-%m-%Y") AS fecha, c.nombre AS cliente, m.nombre AS modulo, ts.nombre AS servicio, s.descripcion as actividades, hora_inicio, hora_fin, TIMESTAMPDIFF(minute, hora_inicio, hora_fin) as tiempo_conexion, s.tiempo, a.nombre AS asesor, persona_recibe,s.cargo, ticket, t.descripcion, ti.nombre AS tarea, tarea_cliente
                          FROM servicios s
                          INNER JOIN modulos m, tipo_servicio ts, asesores a, clientes c, tareas t, tickets ti
                          WHERE m.id = modulo
                          AND ts.id = tipo_servicio
                          AND a.id = s.id_asesor
                          AND c.id = id_cliente
                          AND t.id = s.id_servicio
                          AND t.id_ticket = ti.id
                          AND fecha BETWEEN "'.$fechaInicio.'" AND  "'.$fechaFin.'"
                          AND id_cliente = "'.$cliente.'"
                          AND s.estado_control = "APROBADO"
                          ORDER BY fecha ASC ';
            $listaServicios = parent::query($consulta);
            return $listaServicios;
            parent::cerrar();
        }

        public function todosServicio($fechaInicio, $fechaFin)
        {
            parent::conectar();
            $consulta = 'SELECT s.id_servicio, id_cliente, direccion, c.telefono, ciudad, date_format(fecha, "%d-%m-%Y") AS fecha, c.nombre AS cliente, m.nombre AS modulo, ts.nombre AS servicio, s.descripcion as actividades, hora_inicio, hora_fin, TIMESTAMPDIFF(minute, hora_inicio, hora_fin) as tiempo_conexion, s.tiempo, a.nombre AS asesor, persona_recibe,s.cargo, ticket, t.descripcion, ti.nombre AS tarea, tarea_cliente
                          FROM servicios s
                          INNER JOIN modulos m, tipo_servicio ts, asesores a, clientes c, tareas t, tickets ti
                          WHERE m.id = modulo
                          AND ts.id = tipo_servicio
                          AND a.id = s.id_asesor
                          AND c.id = id_cliente
                          AND t.id = s.id_servicio
                          AND t.id_ticket = ti.id
                          AND fecha BETWEEN "'.$fechaInicio.'" AND "'.$fechaFin.'"
                          AND s.estado_control = "APROBADO"
                          ORDER BY fecha ASC ';
            $listaServicios = parent::query($consulta);
            return $listaServicios;

            parent::cerrar();
        }

        public function servicioId($id)
        {
            parent::conectar();
            $consulta = 'SELECT s.id_servicio, id_cliente, direccion, c.telefono, ciudad, s.email, date_format(fecha, "%d-%m-%Y") AS fecha, c.nombre AS cliente, m.nombre AS modulo, ts.nombre AS servicio, s.descripcion as actividades, hora_inicio, hora_fin, TIMESTAMPDIFF(minute, hora_inicio, hora_fin) as tiempo_conexion, s.tiempo, a.nombre AS asesor, persona_recibe, ticket, s.cargo,estado_control, ti.nombre AS tarea, t.descripcion AS descTarea, tarea_cliente, id_ticket
                          FROM servicios s
                          INNER JOIN modulos m, tipo_servicio ts, asesores a, clientes c, tareas t, tickets ti
                          WHERE m.id = modulo
                          AND ts.id = tipo_servicio
                          AND a.id = s.id_asesor
                          AND c.id = id_cliente
                          AND t.id = s.id_servicio
                          AND ti.id = id_ticket
                          AND s.id_servicio = "'.$id.'" ';
            $servicio = parent::query($consulta);
            return $servicio;

            parent::cerrar();
        }

        public function ultimosRegistros($idCliente)
        {
            parent::conectar();
            $ultimo = parent::query('SELECT s.id_servicio, id_cliente, direccion, c.telefono, ciudad, date_format(fecha, "%d-%m-%Y") AS fecha, c.nombre AS cliente, m.nombre AS modulo, ts.nombre AS servicio, s.descripcion as actividades, hora_inicio, hora_fin, TIMESTAMPDIFF(minute, hora_inicio, hora_fin) as tiempo_conexion, s.tiempo, a.nombre AS asesor, persona_recibe,s.cargo, ticket, t.descripcion, ti.nombre AS tarea, tarea_cliente
                                    FROM servicios s
                                    INNER JOIN modulos m, tipo_servicio ts, asesores a, clientes c, tareas t, tickets ti
                                    WHERE m.id = modulo
                                    AND ts.id = tipo_servicio
                                    AND a.id = s.id_asesor
                                    AND c.id = id_cliente
                                    AND t.id = s.id_servicio
                                    AND t.id_ticket = ti.id
                                    AND id_cliente = "'.$idCliente.'"
                                    AND s.estado_control = "APROBADO"
                                    ORDER BY fecha DESC
                                    LIMIT 5');
            return $ultimo;
            parent::cerrar();
        }

        public function eliminarControl($idControl){
            parent::conectar();

            parent::query('DELETE FROM tareas where id='.$idControl);
            parent::query('DELETE FROM servicios WHERE id_servicio='.$idControl);
            parent::cerrar();
        }

        public function totalServicios()
        {
            parent::conectar();

            $consultaServicios = parent::consultaArreglo("SELECT DATE_FORMAT(fecha, '%Y-%m') AS mes, COUNT(*) AS total FROM servicios WHERE fecha >= DATE_SUB(CURDATE(), INTERVAL 5 MONTH) GROUP BY mes");
            return $consultaServicios;

            parent::cerrar();
        }

                                        
    }

?>