<!-- Lista de usuarios -->
<!-- Header -->
<?php
require("BaseDatos.php");
require("./includes/header.php");
?>

<div class="container p-2">
    <div class="row justify-content-center">
        <div class="col-4 mt-4 mb-4">
            <a href="FormUsuario.php" class='btn btn-success'>Crear Usuario</a>
        </div>

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
                    listarPorNombre($conn);
                } elseif (isset($_GET['email'])) {
                    listarPorEmail($conn);
                } elseif (isset($_GET['lastAccess'])) {
                    listarPorAcceso($conn);
                } elseif (isset($_GET['id'])) {
                    listarPorID($conn);
                } elseif (isset($_GET['enabled'])) {
                    listarPorEnabled($conn);
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