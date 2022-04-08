<?php
var_dump($_POST);
require "conexion.php";
function carga ($clase){
    require "$clase.php";
}
spl_autoload_register('carga');


//1º acceder a los datos de quien llegó y mostrar
$id=$_GET['id']??$_POST['id'];
var_dump($id);
$bd=new BaseDatos();
$msj="";
$usuario=$bd->obtener_usuario($msj, "select * from usuarios where id=$id");

$opcion=$_POST['submit'];
var_dump($opcion);
switch ($opcion){
    //2º sentencia update
    case 'modificar':
        $nombre=$_POST['user'];
        $pass=$_POST['pass'];
        $id=$_POST['id'];
        var_dump($id);
        $msj=$bd->actualizar_usuario( "update usuarios set nombre='$nombre', password='$pass' where id='$id'");
       header("Location:index.php?msj=$msj&id=$id");
        exit;

//header location
    case 'volver':
        header('Location:index.php');
        exit;

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pagina para editar usuarios</title>
</head>
<body>

    <form action="edicion.php" method="post">

        <fieldset>
            <legend>Datos a modificar</legend>
            <div class="form-block ">
                <label class="form-control" for="user">Usuario</label>
                <input type="text" id="user" class="form-control" name="user" value="<?=$usuario['nombre']?>" >
            </div>
            <div class="form-block">
                <label class="form-control" for="pass">Password</label>
                <input type="text" id="pass" name="pass" class="form-control" value="<?=$usuario['password']?>">
            </div>
            <input class="btn btn-success" type="submit" value="modificar" name="submit"><br>
            <input class="btn btn-success" type="submit" value="volver" name="submit"><br>
            <input type='hidden'  name='id' value='<?=$id?>'>
        </fieldset>
    </form>

</body>
</html>
