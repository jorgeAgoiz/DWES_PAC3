<!-- Conexion a la base de datos y TODAS las funciones SQL necesarias -->

<?php
session_start();

$conn = mysqli_connect(
    'localhost',
    'root',
    'nodecomplete2020',
    'pac3_daw'
);

/************** FUNCIONES DE ORDENACION USUARIOS *****************/

/* Listado por defecto */
function listarUsuarios($conn)
{
    $query = "SELECT * FROM user";
    $result_tasks = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($result_tasks)) {
        if ($row['UserID'] == 3) {
            $superadminStyle = 'background-color:blue; color:white; border: 2px solid black;';
        } else {
            $superadminStyle = null;
        }
        echo    "<tr style='$superadminStyle'>
                        <td>" . $row['UserID'] . "</td>
                        <td>" . $row['FullName'] . "</td>
                        <td>" . $row['Email'] . "</td>
                        <td>" . $row['LastAccess'] . "</td>
                        <td>" . $row['Enabled'] . "</td>
                        <td>
                            <a href='FormUsuario.php?id=" . $row['UserID'] . "' class='btn btn-secondary'>
                                <i class='far fa-edit'></i>
                            </a>
                            <a href='FormUsuario.php?id=" . $row['UserID'] . "' class='btn btn-danger'>
                                <i class='far fa-trash-alt'></i>
                            </a>
                        </td>
                    </tr>";
    }
}
/* Listado ordenado por nombre */
function listarPorNombre($conn)
{
    $query = "SELECT * FROM user ORDER BY FullName";
    $result_tasks = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($result_tasks)) {
        if ($row['UserID'] == 3) {
            $superadminStyle = 'background-color:blue; color:white; border: 2px solid black;';
        } else {
            $superadminStyle = null;
        }
        echo    "<tr style='$superadminStyle'>
                        <td>" . $row['UserID'] . "</td>
                        <td>" . $row['FullName'] . "</td>
                        <td>" . $row['Email'] . "</td>
                        <td>" . $row['LastAccess'] . "</td>
                        <td>" . $row['Enabled'] . "</td>
                        <td>
                            <a href='FormUsuario.php?id=" . $row['UserID'] . "' class='btn btn-secondary'>
                                <i class='far fa-edit'></i>
                            </a>
                            <a href='FormUsuario.php?id=" . $row['UserID'] . "' class='btn btn-danger'>
                                <i class='far fa-trash-alt'></i>
                            </a>
                        </td>
                    </tr>";
    }
}
/* Listado ordenado por Email */
function listarPorEmail($conn)
{
    $query = "SELECT * FROM user ORDER BY Email";
    $result_tasks = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($result_tasks)) {
        if ($row['UserID'] == 3) {
            $superadminStyle = 'background-color:blue; color:white; border: 2px solid black;';
        } else {
            $superadminStyle = null;
        }
        echo    "<tr style='$superadminStyle'>
                        <td>" . $row['UserID'] . "</td>
                        <td>" . $row['FullName'] . "</td>
                        <td>" . $row['Email'] . "</td>
                        <td>" . $row['LastAccess'] . "</td>
                        <td>" . $row['Enabled'] . "</td>
                        <td>
                            <a href='FormUsuario.php?id=" . $row['UserID'] . "' class='btn btn-secondary'>
                                <i class='far fa-edit'></i>
                            </a>
                            <a href='FormUsuario.php?id=" . $row['UserID'] . "' class='btn btn-danger'>
                                <i class='far fa-trash-alt'></i>
                            </a>
                        </td>
                    </tr>";
    }
}
/* Listado ordenado por ultimo acceso */
function listarPorAcceso($conn)
{
    $query = "SELECT * FROM user ORDER BY LastAccess";
    $result_tasks = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($result_tasks)) {
        if ($row['UserID'] == 3) {
            $superadminStyle = 'background-color:blue; color:white; border: 2px solid black;';
        } else {
            $superadminStyle = null;
        }
        echo    "<tr style='$superadminStyle'>
                        <td>" . $row['UserID'] . "</td>
                        <td>" . $row['FullName'] . "</td>
                        <td>" . $row['Email'] . "</td>
                        <td>" . $row['LastAccess'] . "</td>
                        <td>" . $row['Enabled'] . "</td>
                        <td>
                            <a href='FormUsuario.php?id=" . $row['UserID'] . "' class='btn btn-secondary'>
                                <i class='far fa-edit'></i>
                            </a>
                            <a href='FormUsuario.php?id=" . $row['UserID'] . "' class='btn btn-danger'>
                                <i class='far fa-trash-alt'></i>
                            </a>
                        </td>
                    </tr>";
    }
}
/* Listado ordenado por ID de usuario */
function listarPorID($conn)
{
    $query = "SELECT * FROM user ORDER BY UserID";
    $result_tasks = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($result_tasks)) {
        if ($row['UserID'] == 3) {
            $superadminStyle = 'background-color:blue; color:white; border: 2px solid black;';
        } else {
            $superadminStyle = null;
        }
        echo    "<tr style='$superadminStyle'>
                        <td>" . $row['UserID'] . "</td>
                        <td>" . $row['FullName'] . "</td>
                        <td>" . $row['Email'] . "</td>
                        <td>" . $row['LastAccess'] . "</td>
                        <td>" . $row['Enabled'] . "</td>
                        <td>
                            <a href='FormUsuario.php?id=" . $row['UserID'] . "' class='btn btn-secondary'>
                                <i class='far fa-edit'></i>
                            </a>
                            <a href='FormUsuario.php?id=" . $row['UserID'] . "' class='btn btn-danger'>
                                <i class='far fa-trash-alt'></i>
                            </a>
                        </td>
                    </tr>";
    }
}
/* Listado ordenado por Enabled */
function listarPorEnabled($conn)
{
    $query = "SELECT * FROM user ORDER BY Enabled";
    $result_tasks = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($result_tasks)) {
        if ($row['UserID'] == 3) {
            $superadminStyle = 'background-color:blue; color:white; border: 2px solid black;';
        } else {
            $superadminStyle = null;
        }
        echo    "<tr style='$superadminStyle'>
                        <td>" . $row['UserID'] . "</td>
                        <td>" . $row['FullName'] . "</td>
                        <td>" . $row['Email'] . "</td>
                        <td>" . $row['LastAccess'] . "</td>
                        <td>" . $row['Enabled'] . "</td>
                        <td>
                            <a href='FormUsuario.php?id=" . $row['UserID'] . "' class='btn btn-secondary'>
                                <i class='far fa-edit'></i>
                            </a>
                            <a href='FormUsuario.php?id=" . $row['UserID'] . "' class='btn btn-danger'>
                                <i class='far fa-trash-alt'></i>
                            </a>
                        </td>
                    </tr>";
    }
}



?>