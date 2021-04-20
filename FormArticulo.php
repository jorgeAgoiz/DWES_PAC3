<!-- Crear, modificar y eliminar articulos -->
<!-- Header -->
<?php
require("BaseDatos.php");
require("./includes/header.php");

if (isset($_GET['deleteId'])) {/* Si deleteId es enviado por GET */
    $productId = $_GET['deleteId'];
    deleteProduct($conn, $productId);
} elseif (isset($_GET['editId'])) {/* Si editId es enviado por GET */
    $prodId = $_GET['editId'];
    /* Recogemos en variables todo lo que nos devuelve la funcion y lo insertamos en nuestro formulario */
    list($name, $cost, $price, $catName, $idProd, $catId) = editarArticuloGet($conn, $prodId);
?>

    <div class="container">
        <div class="row">
            <div class="d-grid gap-2 col-6 mx-auto mt-2 pt-2 mb-2 mt-2 text-center">
                <h1 class="display-1 mt-4 mb-4">Editar Articulo</h1>
                <form action="FormArticulo.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre Producto</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>">
                    </div>
                    <div class="mb-3">
                        <label for="cost" class="form-label">Costo</label>
                        <input type="text" class="form-control" id="cost" name="cost" value="<?php echo $cost ?>">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Precio</label>
                        <input type="text" class="form-control" id="price" name="price" value="<?php echo $price ?>">
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Categoria</label>
                        <select class="form-select" id="catName" name="catName">
                            <option <?php if ($catName == "CAMISA") {
                                        echo "selected";
                                    } ?> value="2">Camisa</option>
                            <option <?php if ($catName == "PANTALÓN") {
                                        echo "selected";
                                    } ?> value="1">Pantalón</option>
                            <option <?php if ($catName == "JERSEY") {
                                        echo "selected";
                                    } ?> value="3">Jersey</option>
                            <option <?php if ($catName == "CHAQUETA") {
                                        echo "selected";
                                    } ?> value="4">Chaqueta</option>
                        </select>
                    </div>
                    <input type="hidden" class="form-control" id="idProduct" name="idProduct" value="<?php echo $idProd ?>">
                    <input type="hidden" class="form-control" id="catId" name="catId" value="<?php echo $catId ?>">
                    <button type="submit" class="btn btn-outline-primary"">Guardar</button>
            </form>
        </div>
    </div>
</div>


<?php
} elseif (isset($_POST['idProduct'])) {/* Si idProduct es enviado por POST */
    editarArticuloPost($conn);
} elseif (isset($_POST['newProduct'])) {/* Si newProduct es enviado por POST */
    crearArticulo($conn);
} else {/* Si no enviamos nada ni por POST o GET mostramos el formulario de Crear Articulo normal */
?>
<div class=" container">
                        <div class="row">
                            <div class="d-grid gap-2 col-6 mx-auto mt-2 pt-2 mb-2 mt-2 text-center">
                                <h1 class="display-1 mt-4 mb-4">Crear Articulo</h1>
                                <form action="FormArticulo.php" method="POST">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nombre Producto</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="cost" class="form-label">Costo</label>
                                        <input type="text" class="form-control" id="cost" name="cost">
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Precio</label>
                                        <input type="text" class="form-control" id="price" name="price">
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Categoria</label>
                                        <select class="form-select" id="catId" name="catId">
                                            <option value="2">Camisa</option>
                                            <option value="1">Pantalón</option>
                                            <option value="3">Jersey</option>
                                            <option value="4">Chaqueta</option>
                                        </select>
                                    </div>
                                    <input type="hidden" class="form-control" id="newProduct" name="newProduct" value="1">
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