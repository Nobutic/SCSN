<?php

    require_once 'conexion.php';

    class TipoServicio extends Conexion{

        public function registroTipoServicio($nombre){
            parent::conectar();
            $verificar_existencia = parent::verificarRegistros('SELECT * FROM tipo_servicio WHERE nombre = "'.$nombre.'" ');
            if($verificar_existencia > 0){
                echo 'existe';
            }else{
                $registro = 'INSERT INTO tipo_servicio(nombre) VALUES ("'.$nombre.'") ';
                parent::query($registro);
            }
            parent::cerrar();
        }


        public function numTipoServicios(){
            parent::conectar();
            $numTipoServicio = parent::verificarRegistros('SELECT * FROM tipo_servicio');
            return $numTipoServicio;
            parent::cerrar();
        }

        public function listarTipoS(){
            parent::conectar();
            $listaTipoServicio = parent::query('SELECT * FROM tipo_servicio');
            return $listaTipoServicio;
            parent::cerrar();
        }
    }

?>