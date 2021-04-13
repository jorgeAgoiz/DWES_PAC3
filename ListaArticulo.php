<!-- Lista de articulos -->
<!-- Header -->
<?php
require("BaseDatos.php");
require("./includes/header.php");
?>


<div class="container p-2">
    <div class="row justify-content-center">
        <div class="d-grid gap-2 col-4">
            <a href="index.php" class='btn btn-info'>Volver</a>
            <a href="FormArticulo.php" class='btn btn-success'>Crear Articulo</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"><a href="ListaArticulo.php?id=<?php echo true; ?>">ID</a></th>
                    <th scope="col"><a href="ListaArticulo.php?catID=<?php echo true; ?>">Categoria</a></th>
                    <th scope="col"><a href="ListaArticulo.php?name=<?php echo true; ?>">Nombre</a></th>
                    <th scope="col"><a href="ListaArticulo.php?cost=<?php echo true; ?>">Coste</a></th>
                    <th scope="col"><a href="ListaArticulo.php?price=<?php echo true; ?>">Precio</a></th>
                </tr>
            </thead>
            <tbody>
                <?php

                if (isset($_GET['id'])) {
                    listarArticulosPorOrden($conn, "ORDER BY ProductID ASC");
                } elseif (isset($_GET['catID'])) {
                    listarArticulosPorOrden($conn, "ORDER BY catName ASC");
                } elseif (isset($_GET['name'])) {
                    listarArticulosPorOrden($conn, "ORDER BY Name ASC");
                } elseif (isset($_GET['cost'])) {
                    listarArticulosPorOrden($conn, "ORDER BY Cost ASC");
                } elseif (isset($_GET['price'])) {
                    listarArticulosPorOrden($conn, "ORDER BY Price ASC");
                } else {
                    listarArticulos($conn);
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