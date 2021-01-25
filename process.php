<?php

session_start();

// Conexión a la base de datos configurada con XAMPP mediante PHPMyadmin
$mysqli = new mysqli('localhost', 'root', '', 'rqp-crud') or die(mysqli_error($mysqli));

$id = 0;
$nombre = null;
$tipo = null;
$cantidad = null;
$precio = null;

$update = false;

// Request POST mediante el formulario con el botón guardar en index.php
if(isset($_POST['guardar'])){

    // Extracción de datos del formulario llamandolos directamente desde sus nombres en los tags HTML
    $nombre = $_POST['producto'];
    $tipo = $_POST['tipo'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['costo'];

    // Hacemos el query para registrar los datos extraídos a la base de datos 'rqp-crud'
    $mysqli->query("INSERT INTO productos (nombre, tipo, cantidad, precio) VALUES ('$nombre', '$tipo', '$cantidad', '$precio')")
    or die($mysqli->error);

    $_SESSION['message'] = '¡Producto registrado correctamente!';
    $_SESSION['msg_type'] = 'success';

    header("Location: index.php");
}

// Request GET mediante el botón 'delete' en index.php
if(isset($_GET['delete'])){

    // Obtención de los datos referentes al item correspondiente al id seleccionado
    $id = $_GET['delete'];

    // Hacemos el query para eliminar los datos del elemento obtenido en 'rqp-crud'
    $mysqli->query("DELETE FROM productos WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = '¡Producto eliminado correctamente!';
    $_SESSION['msg_type'] = 'warning';

    header("Location: index.php");
}

// Request GET mediante el botón 'edit' en index.php
if(isset($_GET['edit'])){

    // Obtención de los datos referentes al item correspondiente al id seleccionado
    $id = $_GET['edit'];

    $update = true;

    // Hacemos el query para buscar los datos del elemento obtenido en 'rqp-crud'
    $query_result = $mysqli->query("SELECT * FROM productos WHERE id=$id") or die($mysqli->error);

    if($query_result == 1){

        $fila = $query_result->fetch_array();

        $nombre = $fila['nombre'];
        $tipo = $fila['tipo'];
        $cantidad = $fila['cantidad'];
        $precio = $fila['precio'];
    }
}

// Request POST mediante el formulario con el botón actualizar en index.php
if(isset($_POST['actualizar'])){

    // Extracción de datos del formulario llamandolos directamente desde sus nombres en los tags HTML
    $id = $_POST['id'];
    $nombre = $_POST['producto'];
    $tipo = $_POST['tipo'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['costo'];

    // Hacemos el query para registrar los datos extraídos a la base de datos 'rqp-crud'
    $mysqli->query("UPDATE productos SET nombre='$nombre', tipo='$tipo', cantidad='$cantidad', precio='$precio' WHERE id='$id'")
    or die($mysqli->error);

    $_SESSION['message'] = '¡Producto actualizado correctamente!';
    $_SESSION['msg_type'] = 'success';

    header("Location: index.php");
}