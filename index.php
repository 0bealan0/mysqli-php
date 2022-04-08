<?php
//conectar con las clases
require "conexion.php";
function carga ($clase){
    require "$clase.php";
}
spl_autoload_register('carga');
//cargar base de datos
$bd=new BaseDatos();
//mostrar todo lo que hay en la base de datos y añadir los botones de editar y borrar
$sentencia="select * from usuarios";
$usuarios=$bd->consulta($sentencia);
$msj="";
//controlador de eventos
$click=$_POST['submit']??null;
    switch ($click){

        case 'inserta':
            $nombre=$_POST['user'];
            $pass=$_POST['pass'];
            $sentencia="insert into usuarios(nombre, password) values ('$nombre','$pass')";
            $msj= $bd->insertar($sentencia);
            break;

        case 'editar':
            $id=$_POST['id'];
            header("Location:edicion.php?id=$id");
            exit;
        case 'borrar':
            $nombre=$_POST['user'];
            $pass=$_POST['pass'];
            $id=$_POST['id'];
            $sentencia = "delete from usuarios where id=$id";
            $msj=$bd->borrar_usuario($sentencia);
            break;
    }

$tabla="usuarios";
$campos=$bd->obtener($tabla);
$listado= interfaz::listado_tabla($usuarios, $campos);

//$bd->cerrar();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body{
            margin: 15rem;
        }
        h1{
            color:indianred;
        }
    </style>
</head>
<body>

<?=$listado?>
<h1><?=$msj?></h1>
<form action="index.php" method="post">
    <fieldset>
        <legend>Acceso de usuarios</legend>
        <div class="form-block ">
            <label class="form-control" for="user">Usuario</label>
            <input type="text" id="user" class="form-control" name="user">
        </div>
        <div class="form-block">
            <label class="form-control" for="pass">Password</label>
            <input type="text" id="pass" name="pass" class="form-control">
        </div>
        <input class="btn btn-success" type="submit" value="inserta" name="submit"><br>
    </fieldset>

</form>

</body>

</html>
