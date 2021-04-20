    <!-- Header -->
    <?php
    require("BaseDatos.php");
    require("./includes/header.php");
    ?>

    <!-- Body -->
    <?php
    /* Comprobamos si la Autenticación esta activada */
    $authAct = comprobarAuth($conn);

    if ($authAct == 1) { //Si esta activada ->
        if (isset($_SESSION['user'])) { ?>

            <div class="container">
                <div class="row">
                    <div class="d-grid gap-2 col-4 mx-auto mt-5 pt-5 mb-5 mt-5 text-center">

                        <h1>Bienvenido <?= $_SESSION['user'] ?></h1><!-- Cogemos el usuario de la SESSION -->

                        <h1 class="display-1 mt-4 mb-4">WestStore</h1>
                        <a href="BaseDatos.php?auth=0" class="btn btn-outline-danger">
                            Desactivar Autenticación
                        </a>
                        <a href="ListaArticulo.php" class="btn btn-primary">
                            Listar Articulos
                        </a>
                        <a href="ListaUsuario.php" class="btn btn-primary">
                            Listar Usuarios
                        </a>
                    </div>
                </div>
            </div>

        <?php } else { // Si no lo esta ->
            header("Location: Validacion.php");
        }
    } elseif ($authAct == 0) { ?>
        <div class="container">
            <div class="row">
                <div class="d-grid gap-2 col-4 mx-auto mt-5 pt-5 mb-5 mt-5 text-center">

                    <h1 class="display-3 mt-4 mb-4 text-danger">Autenticacion Desactivada</h1><!-- Avisamos de que la autenticación esta desactivada -->

                    <h1 class="display-1 mt-4 mb-4">WestStore</h1>
                    <a href="BaseDatos.php?auth=1" class="btn btn-outline-success">
                        Activar Autenticación
                    </a>
                    <a href="ListaArticulo.php" class="btn btn-primary">
                        Listar Articulos
                    </a>
                    <a href="ListaUsuario.php" class="btn btn-primary">
                        Listar Usuarios
                    </a>
                </div>
            </div>
        </div>

    <?php
    }
    ?>

    <!-- Footer -->
    <?php
    require("./includes/footer.php");
    ?>