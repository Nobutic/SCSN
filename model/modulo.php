<?php


require_once('conexion.php');

class Modulo extends Conexion
{
    public function registroModulo($nombre)
    {
        parent::conectar();

        $verificar_registro = parent::verificarRegistros('SELECT * FROM modulos WHERE nombre = "'.$nombre.'" ');

        if($verificar_registro > 0)
        {
            echo 'existe';
        }else{
            parent::query('insert into modulos(nombre) values("'.$nombre.'")');
            echo 'registro';
        }

        parent::cerrar();
    }

    public function listarModulo()
    {
        parent::conectar();

        $consulta = "SELECT * FROM modulos";

        $listaModulo = parent::query($consulta);

        return $listaModulo;

        parent::cerrar();
    }

}

?>