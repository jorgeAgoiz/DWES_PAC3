<!-- Crear, modificar y eliminar articulos -->
<!-- Header -->
<?php
require("BaseDatos.php");
require("./includes/header.php");


if (isset($_GET['editId'])) {
    $prodId = $_GET['editId'];
    list($name, $cost, $price, $catName, $idProd) = editarArticuloGet($conn, $prodId);
?>

    <div class="container">
        <div class="row">
            <div class="d-grid gap-2 col-6 mx-auto mt-2 pt-2 mb-2 mt-2 text-center">
                <h1 class="display-1 mt-4 mb-4">Editar Articulo</h1>
                <form action="FormUsuario.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre Producto</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>">
                    </div>
                    <div class="mb-3">
                        <label for="cost" class="form-label">Costo</label>
                        <input type="text" class="form-control" id="cost" name="email" value="<?php echo $cost ?>">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Precio</label>
                        <input type="text" class="form-control" id="price" name="password" value="<?php echo $price ?>">
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Categoria</label>
                        <input type="text" class="form-control" id="category" name="address" value="<?php echo $catName ?>">
                    </div>
                    <input type="hidden" class="form-control" id="ProductId" name="ProductId" value="<?php echo $idProd ?>">
                    <button type="submit" class="btn btn-outline-primary"">Guardar</button>
            </form>
        </div>
    </div>
</div>


<?php
}/* Continuaremos aqui con la funcion para editar el artículo en post mode */

?>


<!-- Footer -->
<?php
require("./includes/footer.php");
?>