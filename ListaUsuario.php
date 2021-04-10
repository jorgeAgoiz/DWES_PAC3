<!-- Lista de usuarios -->
<!-- Header -->
<?php
require("BaseDatos.php");
require("./includes/header.php");
?>

<?php

$query = "SELECT * FROM user";
$result_tasks = mysqli_query($conn, $query);

while ($row = mysqli_fetch_array($result_tasks)) { ?>
    <div class="container p-4">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered">
                    <tr>
                        <td><?php echo  $row['UserID'] ?></td>
                        <td><?php echo $row['FullName'] ?></td>
                        <td><?php echo $row['Email'] ?></td>
                        <td><?php echo $row['LastAccess'] ?></td>
                        <td><?php echo $row['Enabled'] ?></td>
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