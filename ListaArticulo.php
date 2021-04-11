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
                    <th scope="col"><a href="">ID</a></th>
                    <th scope="col"><a href="#">Categoria</a></th>
                    <th scope="col"><a href="#">Nombre</a></th>
                    <th scope="col"><a href="#">Coste</a></th>
                    <th scope="col"><a href="#">Precio</a></th>
                </tr>
            </thead>
            <tbody>
                <?php

                $query = "SELECT C.Name as catName, P.ProductID, P.Name, P.Cost, P.Price 
                FROM 
                product P 
                JOIN 
                category C 
                ON P.CategoryID = C.CategoryID";

                $result_tasks = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result_tasks)) { ?>
                    <tr>
                        <td><?php echo  $row['ProductID'] ?></td>
                        <td><?php echo  $row['catName'] ?></td>
                        <td><?php echo $row['Name'] ?></td>
                        <td><?php echo $row['Cost'] ?></td>
                        <td><?php echo $row['Price'] ?></td>
                        <td>
                            <a href="FormArticulo.php?id=<?php echo $row['ProductID']; ?>" class="btn btn-secondary">
                                <i class="far fa-edit"></i>
                            </a>
                            <a href="FormArticulo.php?id=<?php echo $row['ProductID']; ?>" class="btn btn-danger">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    <!-- Pasar esto a una funcion a BaseDatos.php y replicar rutas
                    como en ListaUsuarios, ademas añadir paginacion -->
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Footer -->
<?php
require("./includes/footer.php");
?>