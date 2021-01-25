<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>My PHP CRUD</title>
    <link rel="icon" type="image/svg+xml" href="assets/resources/watermelon.svg">

    <!-- Contenido externo de bootstrap -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
          crossorigin="anonymous"
    >

    <!-- Fuente global de texto desde Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@600&display=swap" rel="stylesheet">

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="assets/styles.css">
</head>

<body>

    <?php require_once 'process.php'; ?>

    <!-- Navbar del sitio -->
    <nav class="navbar navbar-light bg-danger nav-frutas fixed-top">
        <a class="navbar-brand" href="index.php">
            <img src="assets/resources/watermelon.svg" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
            C.R.U.D. Inventario de frutería
        </a>
    </nav>

    <h1 class="text-center title-maps title-map-resp">Mi prueba de C.R.U.D en PHP</h1>

    <?php if(isset($_SESSION['message'])): ?>
        <div class="container text-center alert alert-<?=$_SESSION['msg_type']?>" style="margin-top: 15px">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif; ?>

    <section class="background-main position-relative overflow-hidden p-3 p-md-5 m-md-3">
        <form action="process.php" method="POST">

            <div class="container-fluid dir_tarjeta">
                <div class="row justify-content-md-center">

                    <!-- Tarjeta 1-->
                    <div class="col-md-auto posicion_tarjeta">
                        <div class="card contenido_tarjeta_1">
                            <div class="card-body">

                                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                                    <h5 class="card-title"><strong>Registro de productos</strong></h5>

                                    <p class="card-text text-card-resp">
                                        Bienvenido, porfavor diligencie los siguientes campos para el inventario de
                                        venta de frutas y verduras.
                                    </p>

                                    <label for="producto">Producto</label>
                                    <input type="text" id="producto" name="producto" class="form-control"
                                           placeholder="Nombre del producto" value="<?php echo $nombre; ?>">
                                    <br>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipo" id="fruta" value="Fruta">
                                        <label class="form-check-label" for="fruta">
                                            Fruta
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipo" id="verdura" value="Verdura">
                                        <label class="form-check-label" for="verdura">
                                            Verdura
                                        </label>
                                    </div>
                                    <br>
                                    <br>

                                    <label for="cantidad">Cantidad de existencias</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">#</span>
                                        </div>
                                        <input type="number" id="cantidad" name="cantidad"
                                               class="form-control" value="<?php echo $cantidad; ?>">
                                    </div>

                                    <label for="costo">Precio C/U</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" id="costo" name="costo"
                                               class="form-control" value="<?php echo $precio; ?>">
                                    </div>

                                    <?php if($update == true): ?>
                                        <input type="submit" value="Actualizar" class="btn btn-danger btn-ruta"
                                               id="submit" name="actualizar">
                                    <?php else: ?>
                                        <input type="submit" value="Registrar" class="btn btn-danger btn-ruta"
                                               id="submit" name="guardar">
                                    <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta 2-->
                    <div class="col-md-auto posicion_tarjeta">

                        <?php
                            // Conexión a la base de datos configurada con XAMPP mediante PHPMyadmin
                            $mysqli = new mysqli('localhost', 'root', '', 'rqp-crud') or die(mysqli_error($mysqli));

                            $query_result = $mysqli->query("SELECT * FROM `rqp-crud`.productos") or die($mysqli->error);

                            // pre_r($query_result);

                        ?>

                        <div class="card contenido_tarjeta_2" id="map">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nombre del producto</th>
                                        <th scope="col">Tipo de producto</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Precio C/U</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($producto = $query_result->fetch_assoc()): ?>
                                        <tr>
                                            <th scope="row"><?php echo $producto['id'] ?></th>
                                            <td><?php echo $producto['nombre'] ?></td>
                                            <td><?php echo $producto['tipo'] ?></td>
                                            <td><?php echo $producto['cantidad'] ?></td>
                                            <td>$ <?php echo $producto['precio'] ?></td>

                                            <td>
                                                <a href="index.php?edit=<?php echo $producto['id']; ?>" class="btn btn-info">
                                                    Editar
                                                </a>
                                                <a href="index.php?delete=<?php echo $producto['id']; ?>" class="btn btn-danger">
                                                    Eliminar
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <!-- Recursos js de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"
    >
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
            crossorigin="anonymous"
    >
    </script>
</body>
</html>
