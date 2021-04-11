<!-- Crear, modificar y eliminar usuarios -->
<!-- Header -->
<?php
require("BaseDatos.php");
require("./includes/header.php");
?>


<?php
if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    list($name, $email, $birthDate, $address, $postalCode, $password, $city, $state) = editarUsuarioGet($conn, $userId);
?>
    <div class="container">
        <div class="row">
            <div class="d-grid gap-2 col-6 mx-auto mt-2 pt-2 mb-2 mt-2 text-center">
                <h1 class="display-1 mt-4 mb-4">Editar Usuario</h1>
                <form action="FormUsuario.php?idUser=<?php echo $userId; ?>" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" id="name" value="<?php echo $name ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" value="<?php echo $email ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" value="<?php echo $password ?>">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Direccion</label>
                        <input type="text" class="form-control" id="address" value="<?php echo $address ?>">
                    </div>
                    <div class="mb-3">
                        <label for="postalCode" class="form-label">Codigo Postal</label>
                        <input type="text" class="form-control" id="postalCode" value="<?php echo $postalCode ?>">
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">Ciudad</label>
                        <input type="text" class="form-control" id="city" value="<?php echo $city ?>">
                    </div>
                    <div class="mb-3">
                        <label for="state" class="form-label">Pais</label>
                        <input type="text" class="form-control" id="state" value="<?php echo $state ?>">
                    </div>
                    <div class="mb-3">
                        <label for="birthDate" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="birthDate" value="<?php echo $birthDate ?>">
                    </div>
                    <input type="hidden" class="form-control" id="UserId" value="<?php echo $userId ?>">
                    <button type="submit" class="btn btn-outline-primary"">Guardar</button>
            </form>
        </div>
    </div>
</div>
<?php
} elseif (isset($_GET['idUser'])) {
    $usuario = $_GET['idUser'];
    editarUsuarioPost($conn, $usuario);
    /* Lo dejamos aqui, siguiente paso modificar el registro en la BBDD */
}
?>


<!-- Footer -->
<?php
require("./includes/footer.php");
?>