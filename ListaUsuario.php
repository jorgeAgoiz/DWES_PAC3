<!-- Lista de usuarios -->
<!-- Header -->
<?php
require("BaseDatos.php");
require("./includes/header.php");
?>

<div class="container p-2">
    <div class="row justify-content-center">
        <div class="d-grid gap-2 col-4">
            <a href="index.php" class='btn btn-info'>Volver</a>
            <a href="FormUsuario.php" class='btn btn-success'>Crear Usuario</a>
        </div>
        <?php if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php session_unset();
        }
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"><a href="ListaUsuario.php?id=<?php echo true; ?>">ID</a></th>
                    <th scope="col"><a href="ListaUsuario.php?name=<?php echo true; ?>">Nombre</a></th>
                    <th scope="col"><a href="ListaUsuario.php?email=<?php echo true; ?>">Email</a></th>
                    <th scope="col"><a href="ListaUsuario.php?lastAccess=<?php echo true; ?>">Último acceso</a></th>
                    <th scope="col"><a href="ListaUsuario.php?enabled=<?php echo true; ?>">Enabled</a></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_GET['name'])) {
                    listarPorOrden($conn, "ORDER BY FullName ASC");
                } elseif (isset($_GET['email'])) {
                    listarPorOrden($conn, "ORDER BY Email ASC");
                } elseif (isset($_GET['lastAccess'])) {
                    listarPorOrden($conn, "ORDER BY LastAccess DESC");
                } elseif (isset($_GET['id'])) {
                    listarPorOrden($conn, "ORDER BY UserID ASC");
                } elseif (isset($_GET['enabled'])) {
                    listarPorOrden($conn, "ORDER BY Enabled ASC");
                } else {
                    listarUsuarios($conn);
                }



                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Footer -->
<?php
require("./includes/footer.php");
?>