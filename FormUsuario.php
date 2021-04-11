<!-- Crear, modificar y eliminar usuarios -->
<!-- Header -->
<?php
require("BaseDatos.php");
require("./includes/header.php");
?>


<?php

/* eliminar Usuario */
if (isset($_GET['deleteId'])) {
    $userId = $_GET['deleteId'];
    $query = "DELETE FROM user
    WHERE UserID = $userId";
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = 'Usuario Eliminado.';
        $_SESSION['message_type'] = 'info';
        header("Location: ListaUsuario.php");
        die();
    } else {
        $_SESSION['message'] = 'Error Usuario No Eliminado.';
        $_SESSION['message_type'] = 'danger';
        header("Location: ListaUsuario.php");
        die();
    }
};


if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    list($name, $email, $birthDate, $address, $postalCode, $password, $city, $state) = editarUsuarioGet($conn, $userId);
?>
    <div class="container">
        <div class="row">
            <div class="d-grid gap-2 col-6 mx-auto mt-2 pt-2 mb-2 mt-2 text-center">
                <h1 class="display-1 mt-4 mb-4">Editar Usuario</h1>
                <form action="FormUsuario.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $password ?>">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Direccion</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $address ?>">
                    </div>
                    <div class="mb-3">
                        <label for="postalCode" class="form-label">Codigo Postal</label>
                        <input type="text" class="form-control" id="postalCode" name="postalCode" value="<?php echo $postalCode ?>">
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">Ciudad</label>
                        <input type="text" class="form-control" id="city" name="city" value="<?php echo $city ?>">
                    </div>
                    <div class="mb-3">
                        <label for="state" class="form-label">Pais</label>
                        <input type="text" class="form-control" id="state" name="state" value="<?php echo $state ?>">
                    </div>
                    <div class="mb-3">
                        <label for="birthDate" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="birthDate" name="birthDate" value="<?php echo $birthDate ?>">
                    </div>
                    <input type="hidden" class="form-control" id="UserId" name="UserId" value="<?php echo $userId ?>">
                    <button type="submit" class="btn btn-outline-primary"">Guardar</button>
            </form>
        </div>
    </div>
</div>
<?php
} elseif (isset($_POST['UserId'])) {
    $usuario = $_POST['UserId'];
    editarUsuarioPost($conn, $usuario);
} elseif (isset($_POST['newUser'])) {
    crearUsuario($conn);
} else {
?>
<div class=" container">
                        <div class="row">
                            <div class="d-grid gap-2 col-6 mx-auto mt-2 pt-2 mb-2 mt-2 text-center">
                                <h1 class="display-1 mt-4 mb-4">Editar Usuario</h1>
                                <form action="FormUsuario.php" method="POST">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nombre Completo</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Direccion</label>
                                        <input type="text" class="form-control" id="address" name="address">
                                    </div>
                                    <div class="mb-3">
                                        <label for="postalCode" class="form-label">Codigo Postal</label>
                                        <input type="text" class="form-control" id="postalCode" name="postalCode">
                                    </div>
                                    <div class="mb-3">
                                        <label for="city" class="form-label">Ciudad</label>
                                        <input type="text" class="form-control" id="city" name="city">
                                    </div>
                                    <div class="mb-3">
                                        <label for="state" class="form-label">Pais</label>
                                        <input type="text" class="form-control" id="state" name="state">
                                    </div>
                                    <div class="mb-3">
                                        <label for="birthDate" class="form-label">Fecha de Nacimiento</label>
                                        <input type="date" class="form-control" id="birthDate" name="birthDate">
                                    </div>
                                    <input type="hidden" class="form-control" id="newUser" name="newUser" value="1">
                                    <button type="submit" class="btn btn-outline-primary"">Guardar</button>
            </form>
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