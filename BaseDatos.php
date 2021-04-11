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
            $disabled = 'disabled';
        } else {
            $superadminStyle = null;
            $disabled = null;
        }
        echo    "<tr style='$superadminStyle'>
                        <td>" . $row['UserID'] . "</td>
                        <td>" . $row['FullName'] . "</td>
                        <td>" . $row['Email'] . "</td>
                        <td>" . $row['LastAccess'] . "</td>
                        <td>" . $row['Enabled'] . "</td>
                        <td>
                            <a href='FormUsuario.php?id=" . $row['UserID'] . "' class='btn btn-secondary $disabled' >
                                <i class='far fa-edit'></i>
                            </a>
                            <a href='FormUsuario.php?id=" . $row['UserID'] . "' class='btn btn-danger $disabled'>
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
            $disabled = 'disabled';
        } else {
            $superadminStyle = null;
            $disabled = null;
        }
        echo    "<tr style='$superadminStyle'>
                        <td>" . $row['UserID'] . "</td>
                        <td>" . $row['FullName'] . "</td>
                        <td>" . $row['Email'] . "</td>
                        <td>" . $row['LastAccess'] . "</td>
                        <td>" . $row['Enabled'] . "</td>
                        <td>
                            <a href='FormUsuario.php?id=" . $row['UserID'] . "' class='btn btn-secondary $disabled'>
                                <i class='far fa-edit'></i>
                            </a>
                            <a href='FormUsuario.php?id=" . $row['UserID'] . "' class='btn btn-danger $disabled'>
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
            $disabled = 'disabled';
        } else {
            $superadminStyle = null;
            $disabled = null;
        }
        echo    "<tr style='$superadminStyle'>
                        <td>" . $row['UserID'] . "</td>
                        <td>" . $row['FullName'] . "</td>
                        <td>" . $row['Email'] . "</td>
                        <td>" . $row['LastAccess'] . "</td>
                        <td>" . $row['Enabled'] . "</td>
                        <td>
                            <a href='FormUsuario.php?id=" . $row['UserID'] . "' class='btn btn-secondary $disabled'>
                                <i class='far fa-edit'></i>
                            </a>
                            <a href='FormUsuario.php?id=" . $row['UserID'] . "' class='btn btn-danger $disabled'>
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
            $disabled = 'disabled';
        } else {
            $superadminStyle = null;
            $disabled = null;
        }
        echo    "<tr style='$superadminStyle'>
                        <td>" . $row['UserID'] . "</td>
                        <td>" . $row['FullName'] . "</td>
                        <td>" . $row['Email'] . "</td>
                        <td>" . $row['LastAccess'] . "</td>
                        <td>" . $row['Enabled'] . "</td>
                        <td>
                            <a href='FormUsuario.php?id=" . $row['UserID'] . "' class='btn btn-secondary $disabled'>
                                <i class='far fa-edit'></i>
                            </a>
                            <a href='FormUsuario.php?id=" . $row['UserID'] . "' class='btn btn-danger $disabled'>
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
            $disabled = 'disabled';
        } else {
            $superadminStyle = null;
            $disabled = null;
        }
        echo    "<tr style='$superadminStyle'>
                        <td>" . $row['UserID'] . "</td>
                        <td>" . $row['FullName'] . "</td>
                        <td>" . $row['Email'] . "</td>
                        <td>" . $row['LastAccess'] . "</td>
                        <td>" . $row['Enabled'] . "</td>
                        <td>
                            <a href='FormUsuario.php?id=" . $row['UserID'] . "' class='btn btn-secondary $disabled'>
                                <i class='far fa-edit'></i>
                            </a>
                            <a href='FormUsuario.php?id=" . $row['UserID'] . "' class='btn btn-danger $disabled'>
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
            $disabled = 'disabled';
        } else {
            $superadminStyle = null;
            $disabled = null;
        }
        echo    "<tr style='$superadminStyle'>
                        <td>" . $row['UserID'] . "</td>
                        <td>" . $row['FullName'] . "</td>
                        <td>" . $row['Email'] . "</td>
                        <td>" . $row['LastAccess'] . "</td>
                        <td>" . $row['Enabled'] . "</td>
                        <td>
                            <a href='FormUsuario.php?id=" . $row['UserID'] . "' class='btn btn-secondary $disabled'>
                                <i class='far fa-edit'></i>
                            </a>
                            <a href='FormUsuario.php?id=" . $row['UserID'] . "' class='btn btn-danger $disabled'>
                                <i class='far fa-trash-alt'></i>
                            </a>
                        </td>
                    </tr>";
    }
}

/********************** FIN FUNCIONES DE ORDENACION USUARIOS ******************/

/********************** FUNCIONES DE EDITAR, ELIMINAR Y CREAR USUARIOS ******************/

/* Funcion para mostar el usuario a editar GET */
function editarUsuarioGet($conn, $userId)
{
    $query = "SELECT * FROM user WHERE UserID = $userId";
    $result_tasks = mysqli_query($conn, $query);
    if (mysqli_num_rows($result_tasks)) {
        $row = mysqli_fetch_array($result_tasks);
        $name = $row['FullName'];
        $email = $row['Email'];
        $birthDate = $row['BirthDate'];
        $address = $row['Address'];
        $postalCode = $row['PostalCode'];
        $password = $row['Password'];
        $city = $row['City'];
        $state = $row['State'];
    }
    return array($name, $email, $birthDate, $address, $postalCode, $password, $city, $state);
}

/* Funcion para modificar el usuario en la BBDD POST */
function editarUsuarioPost($conn, $UserId)
{

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalCode'];
    $lastAccess = date('Y-m-d');
    if ($_POST['birthDate']) {
        $birthDate = $_POST['birthDate'];
        $query = "UPDATE user SET 
                            BirthDate='$birthDate', 
                            Email='$email', 
                            Address='$address', 
                            PostalCode='$postalCode', 
                            Password='$password', 
                            City='$city', 
                            State='$state', 
                            FullName='$name', 
                            LastAccess = '$lastAccess' 
                        WHERE UserId = $UserId ";
    } else {
        $query = "UPDATE user SET 
                            BirthDate=null, 
                            Email='$email', 
                            Address='$address', 
                            PostalCode='$postalCode', 
                            Password='$password', 
                            City='$city', 
                            State='$state', 
                            FullName='$name', 
                            LastAccess = '$lastAccess' 
                        WHERE UserId = $UserId ";
    };
    if (mysqli_query($conn, $query)) {
        header("Location: ListaUsuario.php");
        die();
    } else {
        printf("Error: %s\n", mysqli_error($conn));
    }
    /* Mostar mensaje de actualización exitosa o actualización no grabada
    funcionalidad eliminar usuario
    funcionalidad crear usuario */
}


/********************** FIN FUNCIONES DE EDITAR, ELIMINAR Y CREAR USUARIOS ******************/

?>