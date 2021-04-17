<!-- Validacion del usuario -->
<?php
require("BaseDatos.php");
require("./includes/header.php");
?>

<div class="container">
    <div class="row">
        <div class="d-grid gap-2 col-4 mx-auto mt-2 pt-2 mb-2 mt-2 text-center">
            <?php if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php session_unset();
            }
            ?>
            <form action="BaseDatos.php" method="POST">
                <div class="mb-3">
                    <label for="InputEmail" class="form-label">Email</label>
                    <input type="text" class="form-control" id="InputEmail" name="email">
                </div>
                <div class="mb-3">
                    <label for="InputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="InputPassword" name="password">
                </div>
                <input type="hidden" class="form-control" id="authUser" name="authUser" value="1">
                <button type="submit" class="btn btn-primary">Iniciar Sesion</button>
            </form>
        </div>
    </div>
</div>


<?php
require("./includes/footer.php");
?>