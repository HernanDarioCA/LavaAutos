<?php
header('Content-Type: application/json');

$server = "localhost"; //nombre del servidor
$user = "root";        //nombre del usuario
$pass = "";         //contraseña
$bd = "carwash"; //nombre de la base de datos
//Creamos la conexión
$conexion = mysqli_connect($server, $user, $pass,$bd) 
or die("Ha sucedido un error inesperado en la conexion de la base de datos");

switch ($_GET['accion']) {
    case 'listar':
        $datos = mysqli_query($conexion, "select id, descripcio, precio from producto");
        $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
        echo json_encode($resultado);
        break;

    case 'agregar':
        $respuesta = mysqli_query($conexion, "insert into producto(descripcion,precio) values ('$_POST[descripcion]',$_POST[precio])");
        echo json_encode($respuesta);
        break;

    case 'borrar':
        $respuesta = mysqli_query($conexion, "delete from producto where id=$_GET[id]");
        echo json_encode($respuesta);
        break;

    case 'consultar':
        $datos = mysqli_query($conexion, "select mv. * from (select @f1:=$_GET[id] p) param, estadoservicio2 mv");
        $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
        echo json_encode($resultado);
        break;

    case 'ingresar':
        $datos = mysqli_query($conexion, "select `tb_trabajadores`.`Nom_trab`, `tb_trabajadores`.`idRol`\n"
        . "        from `tb_trabajadores`\n"    
        . "        where (User_trab=\"PPPedraza\" and Pass_trab=\"1234\")");
        $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
        echo json_encode($resultado);
        break;    

    case 'modificar':
        $respuesta = mysqli_query($conexion, "update producto set
                                                  descripcion='$_POST[descripcion]',
                                                  precio=$_POST[precio]
                                               where id=$_GET[id]");
        echo json_encode($respuesta);
        break;
}