<!-- Lista de articulos -->
<!-- Header -->
<?php
require("BaseDatos.php");
require("./includes/header.php");
?>

<?php

$query = "SELECT * FROM product";
$result_tasks = mysqli_query($conn, $query);

while ($row = mysqli_fetch_array($result_tasks)) { ?>
    <div class="container p-4">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered">
                    <tr>
                        <td><?php echo  $row['ProductID'] ?></td>
                        <td><?php echo $row['Name'] ?></td>
                        <td><?php echo $row['Cost'] ?></td>
                        <td><?php echo $row['Price'] ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


<?php } ?>


<!-- Footer -->
<?php
require("./includes/footer.php");
?>