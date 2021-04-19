<!-- Lista de articulos -->
<!-- Header -->
<?php
require("BaseDatos.php");
require("./includes/header.php");
?>


<div class="container p-2">
    <div class="row justify-content-center">
        <div class="d-grid gap-2 col-4">
            <a href="index.php" class='btn btn-warning'>Volver</a>
            <a href="FormArticulo.php" class='btn btn-success'>Crear Articulo</a>
            <?php if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
            }
            ?>
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
        <!-- Lo dejamos por hoy en la paginación -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>
</div>


<!-- Footer -->
<?php
require("./includes/footer.php");
?>