<!-- Lista de articulos -->
<!-- Header -->
<?php
require("BaseDatos.php");
require("./includes/header.php");

/* Pagina 1 por defecto */
if (!$_GET) {
    header('Location:ListaArticulo.php?pagina=1');
}
/* Numero de paginas y numero de registros */
list($numPags, $numFilas) = contarFilas($conn);
?>

<div class="container p-2">
    <div class="row justify-content-center">
        <div class="d-grid gap-2 col-4">
            <a href="index.php" class='btn btn-warning'>Volver</a>
            <a href="FormArticulo.php" class='btn btn-success'>Crear Articulo</a>
            <!-- Aqui mostramos los mensajes que nos devuelve el servidor -->
            <?php if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
                /* Reseteamos las variables de SESSION */
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
            }
            ?>
        </div>
        <!-- paginación -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php if (isset($_GET['price'])) { ?>
                    <!-- Si price es true -->
                    <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href='ListaArticulo.php?price=1&pagina=<?php echo $_GET['pagina'] - 1 ?>'>Anterior</a>
                    </li>
                    <?php for ($i = 0; $i < $numPags; $i++) { ?>
                        <li class="page-item <?php echo $_GET['pagina'] == $i + 1 ? 'active' : '' ?>">
                            <a class="page-link" href='ListaArticulo.php?price=1&pagina=<?php echo $i + 1 ?>'>
                                <?php echo $i + 1 ?>
                            </a>
                        </li>
                    <?php
                    }
                } elseif (isset($_GET['cost'])) { ?>
                    <!-- Si cost es true -->
                    <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href='ListaArticulo.php?cost=1&pagina=<?php echo $_GET['pagina'] - 1 ?>'>Anterior</a>
                    </li>
                    <?php for ($i = 0; $i < $numPags; $i++) { ?>
                        <li class="page-item <?php echo $_GET['pagina'] == $i + 1 ? 'active' : '' ?>">
                            <a class="page-link" href='ListaArticulo.php?cost=1&pagina=<?php echo $i + 1 ?>'>
                                <?php echo $i + 1 ?>
                            </a>
                        </li>
                    <?php
                    }
                } elseif (isset($_GET['id'])) { ?>
                    <!-- Si id es true -->
                    <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href='ListaArticulo.php?id=1&pagina=<?php echo $_GET['pagina'] - 1 ?>'>Anterior</a>
                    </li>
                    <?php for ($i = 0; $i < $numPags; $i++) { ?>
                        <li class="page-item <?php echo $_GET['pagina'] == $i + 1 ? 'active' : '' ?>">
                            <a class="page-link" href='ListaArticulo.php?id=1&pagina=<?php echo $i + 1 ?>'>
                                <?php echo $i + 1 ?>
                            </a>
                        </li>
                    <?php
                    }
                } elseif (isset($_GET['catID'])) { ?>
                    <!-- Si catID es true -->
                    <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href='ListaArticulo.php?catID=1&pagina=<?php echo $_GET['pagina'] - 1 ?>'>Anterior</a>
                    </li>
                    <?php for ($i = 0; $i < $numPags; $i++) { ?>
                        <li class="page-item <?php echo $_GET['pagina'] == $i + 1 ? 'active' : '' ?>">
                            <a class="page-link" href='ListaArticulo.php?catID=1&pagina=<?php echo $i + 1 ?>'>
                                <?php echo $i + 1 ?>
                            </a>
                        </li>
                    <?php
                    }
                } elseif (isset($_GET['name'])) { ?>
                    <!-- Si name es true -->
                    <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href='ListaArticulo.php?name=1&pagina=<?php echo $_GET['pagina'] - 1 ?>'>Anterior</a>
                    </li>
                    <?php for ($i = 0; $i < $numPags; $i++) { ?>
                        <li class="page-item <?php echo $_GET['pagina'] == $i + 1 ? 'active' : '' ?>">
                            <a class="page-link" href='ListaArticulo.php?name=1&pagina=<?php echo $i + 1 ?>'>
                                <?php echo $i + 1 ?>
                            </a>
                        </li>
                    <?php
                    }
                } else { ?>
                    <!-- Si solo pagina existe -->
                    <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href='ListaArticulo.php?pagina=<?php echo $_GET['pagina'] - 1 ?>'>Anterior</a>
                    </li>
                    <?php for ($i = 0; $i < $numPags; $i++) { ?>
                        <li class="page-item <?php echo $_GET['pagina'] == $i + 1 ? 'active' : '' ?>">
                            <a class="page-link" href='ListaArticulo.php?pagina=<?php echo $i + 1 ?>'>
                                <?php echo $i + 1 ?>
                            </a>
                        </li>
                <?php
                    }
                }
                ?>

                <?php if (isset($_GET['price'])) { ?>
                    <!-- Si price es true -->
                    <li class="page-item <?php echo $_GET['pagina'] >= $numPags ? 'disabled' : '' ?>">
                        <a class="page-link" href='ListaArticulo.php?price=1&pagina=<?php echo $_GET['pagina'] + 1 ?>'>Siguiente</a>
                    </li>
                <?php } elseif (isset($_GET['cost'])) { ?>
                    <!-- Si cost es true -->
                    <li class="page-item <?php echo $_GET['pagina'] >= $numPags ? 'disabled' : '' ?>">
                        <a class="page-link" href='ListaArticulo.php?cost=1&pagina=<?php echo $_GET['pagina'] + 1 ?>'>Siguiente</a>
                    </li>
                <?php } elseif (isset($_GET['id'])) { ?>
                    <!-- Si id es true -->
                    <li class="page-item <?php echo $_GET['pagina'] >= $numPags ? 'disabled' : '' ?>">
                        <a class="page-link" href='ListaArticulo.php?id=1&pagina=<?php echo $_GET['pagina'] + 1 ?>'>Siguiente</a>
                    </li>
                <?php } elseif (isset($_GET['catID'])) { ?>
                    <!-- Si catID es true -->
                    <li class="page-item <?php echo $_GET['pagina'] >= $numPags ? 'disabled' : '' ?>">
                        <a class="page-link" href='ListaArticulo.php?catID=1&pagina=<?php echo $_GET['pagina'] + 1 ?>'>Siguiente</a>
                    </li>
                <?php } elseif (isset($_GET['name'])) { ?>
                    <!-- Si name es true -->
                    <li class="page-item <?php echo $_GET['pagina'] >= $numPags ? 'disabled' : '' ?>">
                        <a class="page-link" href='ListaArticulo.php?name=1&pagina=<?php echo $_GET['pagina'] + 1 ?>'>Siguiente</a>
                    </li>
                <?php } else { ?>
                    <!-- Si solo pagina existe -->
                    <li class="page-item <?php echo $_GET['pagina'] >= $numPags ? 'disabled' : '' ?>">
                        <a class="page-link" href='ListaArticulo.php?pagina=<?php echo $_GET['pagina'] + 1 ?>'>Siguiente</a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"><a href="ListaArticulo.php?id=<?php echo true; ?>&pagina=1">ID</a></th>
                    <th scope="col"><a href="ListaArticulo.php?catID=<?php echo true; ?>&pagina=1">Categoria</a></th>
                    <th scope="col"><a href="ListaArticulo.php?name=<?php echo true; ?>&pagina=1">Nombre</a></th>
                    <th scope="col"><a href="ListaArticulo.php?cost=<?php echo true; ?>&pagina=1">Coste</a></th>
                    <th scope="col"><a href="ListaArticulo.php?price=<?php echo true; ?>&pagina=1">Precio</a></th>
                </tr>
            </thead>
            <tbody>
                <?php
                /* En función de lo que recibamos por GET ordenamos los articulos */
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
                } else {/* Ordenación por defecto */
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