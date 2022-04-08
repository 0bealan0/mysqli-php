<?php

class BaseDatos
{
    private $conexion;
    private $consulta;
    public function __construct(){
        $this->conexion=new mysqli(HOST, USER, PASS, BD);
        if($this->conexion->connect_errno !=0)
            die ("Error conectando". $this->conexion->connect_errno) ;
    }


    public function insertar(string $insercion):string
    {
        $rtdo = $this->conexion->query($insercion);
        if ($rtdo ===false){
            $msj = "No se ha insertado <br>";
            $msj .= "Sentencia lanzada <span style='color:red'>$insercion</span>";
            $msj .= "El sistema detecta" . $this->conexion->errno;
        }else{
            //Para retornar fila o filas
            $plural = $this->conexion->affected_rows>1?"s":"";
            $msj = "Se ha insertado correctamente" . $this->conexion->affected_rows. "fila$plural";
        }
        return $msj;
    }
    public function cerrar(){
        $this->conexion->close();
    }
    public function __destruct(){
        $this->conexion->close();
    }
    public function consulta ($sentencia_select){
        $resultado = $this->conexion->query($sentencia_select);
        $fila = $resultado->fetch_assoc();
        while($fila){
            $resFinal[]=$fila;
            $fila = $resultado->fetch_assoc();
        }
        return $resFinal;
    }
    public function obtener($tabla){
        $result=$this->conexion->query("select * from $tabla");
        $campos= $result->fetch_fields();
        foreach ($campos as $campo){
            $listado[]=$campo->name;
        }
        return $listado;
    }
    public function borrar_usuario($sentencia){
        $rtdo = $this->conexion->query($sentencia);
        if ($rtdo ===false){
            $msj = "No se ha podido borrar este usuario <br>";
            $msj .= "Sentencia lanzada <span style='color:red'>$sentencia</span>";
            $msj .= "El sistema detecta" . $this->conexion->errno;
        }else{

            $msj = "Se ha borrado correctamente";
        }
        return $msj;
    }
    public function obtener_usuario(&$msj, $sentencia){
        $resultado = $this->conexion->query($sentencia);
        $usuario= $resultado->fetch_assoc();
        $msj="Estoy en obtener_usuario";
        return $usuario;
    }
    public function actualizar_usuario( $sentencia){
        $resultado = $this->conexion->query($sentencia);
        if ($resultado ===false){
            $msj = "No se ha podido modificar el contacto <br>";

        }else{

            $msj = "Se ha modificado correctamente";
        }
        return $msj;
    }
}

//Esta clase hará de intermediario entre php y la base de datos. Nos interesa que aquí este todo el contenido de comprobar la conexion con la base de datos
//creamos la funcion de insertar datos y dos de cerrar la conexion.