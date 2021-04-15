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
                            <a href='FormUsuario.php?deleteId=" . $row['UserID'] . "' class='btn btn-danger $disabled'>
                                <i class='far fa-trash-alt'></i>
                            </a>
                        </td>
                    </tr>";
    }
}
/* Listado ordenado por nombre, email, ultimo acceso, ID o Enabled */
function listarPorOrden($conn, $option)
{
    $query = "SELECT * FROM user $option";
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
                            <a href='FormUsuario.php?deleteId=" . $row['UserID'] . "' class='btn btn-danger $disabled'>
                                <i class='far fa-trash-alt'></i>
                            </a>
                        </td>
                    </tr>";
    }
}

/********************** FIN FUNCIONES DE ORDENACION USUARIOS ******************/

/********************** FUNCIONES DE EDITAR Y CREAR USUARIOS ******************/

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
        $_SESSION['message'] = 'Usuario Actualizado.';
        $_SESSION['message_type'] = 'info';
        header("Location: ListaUsuario.php");
        die();
    } else {
        $_SESSION['message'] = 'Error en la actualización.';
        $_SESSION['message_type'] = 'danger';
        header("Location: ListaUsuario.php");
        die();
    }
    /* funcionalidad eliminar usuario
    funcionalidad crear usuario */
}

/* Función para crear usuario */
function crearUsuario($conn)
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $birthDate = $_POST['birthDate'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalCode'];
    $lastAccess = date('Y-m-d');
    $enabled = 1;

    $query = "INSERT INTO 
                        user
                        (BirthDate, Email, Address, PostalCode, Password, City, State, FullName, LastAccess, Enabled) 
                    VALUES 
                        ('$birthDate', '$email', '$address', '$postalCode', '$password', '$city', '$state', '$name', '$lastAccess', $enabled)";

    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = 'Nuevo Usuario Guardado.';
        $_SESSION['message_type'] = 'info';
        header("Location: ListaUsuario.php");
        die();
    } else {
        $_SESSION['message'] = 'Error en el proceso de guardado.';
        $_SESSION['message_type'] = 'danger';
        header("Location: ListaUsuario.php");
        die();
    }
}

/********************** FIN FUNCIONES DE EDITAR Y CREAR USUARIOS ******************/



/********************** FUNCIONES PARA ORDENAR ARTICULOS  **********************************/
/* Listado por defecto */
function listarArticulos($conn)
{
    $query = "SELECT C.Name as catName, P.ProductID, P.Name, P.Cost, P.Price 
                FROM 
                product P 
                JOIN 
                category C 
                ON P.CategoryID = C.CategoryID 
                ORDER BY ProductID ASC";
    $result_tasks = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($result_tasks)) {

        echo    "<tr>
                        <td>" . $row['ProductID'] . "</td>
                        <td>" . $row['catName'] . "</td>
                        <td>" . $row['Name'] . "</td>
                        <td>" . $row['Cost'] . "</td>
                        <td>" . $row['Price'] . "</td>
                        
                        <td>
                            <a href='FormArticulo.php?editId=" . $row['ProductID'] . "' class='btn btn-secondary'>
                                <i class='far fa-edit'></i>
                            </a>
                            <a href='FormArticulo.php?deleteId=" . $row['ProductID'] . "' class='btn btn-danger'>
                                <i class='far fa-trash-alt'></i>
                            </a>
                        </td>
                    </tr>";
    }
}

function listarArticulosPorOrden($conn, $option)
{
    $query = "SELECT C.Name as catName, P.ProductID, P.Name, P.Cost, P.Price 
                FROM 
                product P 
                JOIN 
                category C 
                ON P.CategoryID = C.CategoryID $option";
    $result_tasks = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($result_tasks)) {

        echo    "<tr>
                        <td>" . $row['ProductID'] . "</td>
                        <td>" . $row['catName'] . "</td>
                        <td>" . $row['Name'] . "</td>
                        <td>" . $row['Cost'] . "</td>
                        <td>" . $row['Price'] . "</td>
                        
                        <td>
                            <a href='FormArticulo.php?editId=" . $row['ProductID'] . "' class='btn btn-secondary'>
                                <i class='far fa-edit'></i>
                            </a>
                            <a href='FormArticulo.php?deleteId=" . $row['ProductID'] . "' class='btn btn-danger'>
                                <i class='far fa-trash-alt'></i>
                            </a>
                        </td>
                    </tr>";
    }
}
/********************** FIN FUNCIONES ORDENACION ARTICULOS ******************/

/********************** FUNCIONES DE EDITAR Y CREAR ARTICULOS ******************/

/* Funcion para mostar el articulo a editar GET */
function editarArticuloGet($conn, $productId)
{
    $query = "SELECT C.Name as catName, P.ProductID, P.Name, P.Cost, P.Price, P.CategoryID  
                FROM 
                product P 
                JOIN 
                category C 
                ON P.CategoryID = C.CategoryID 
                WHERE ProductId = $productId";
    $result_tasks = mysqli_query($conn, $query);
    if (mysqli_num_rows($result_tasks)) {
        $row = mysqli_fetch_array($result_tasks);
        $name = $row['Name'];
        $cost = $row['Cost'];
        $price = $row['Price'];
        $catName = $row['catName'];
        $catId = $row['CategoryID'];
    }
    return array($name, $cost, $price, $catName, $productId, $catId);
}

/* Funcion para editar articulo POST */
function editarArticuloPost($conn)
{
    $name = $_POST['name'];
    $cost = $_POST['cost'];
    $price = $_POST['price'];
    $idProduct = $_POST['idProduct'];
    $catId = intval($_POST['catName']);

    $query = "UPDATE product SET 
                            Name = '$name', 
                            Cost = '$cost', 
                            Price = '$price', 
                            CategoryID = $catId
                        WHERE ProductID = '$idProduct' ";
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = 'Articulo Actualizado.';
        $_SESSION['message_type'] = 'info';
        header("Location: ListaArticulo.php");
        die();
    } else {
        $_SESSION['message'] = 'Error en la actualización.';
        $_SESSION['message_type'] = 'danger';
        header("Location: ListaArticulo.php");
        die();
    }
}

/* Funcion para crear articulos */
function crearArticulo($conn)
{
    $name = $_POST['name'];
    $cost = $_POST['cost'];
    $price = $_POST['price'];
    $catId = $_POST['catId'];

    $query = "INSERT INTO 
                product(Name, Cost, Price, CategoryID) 
                values('$name', $cost, $price, $catId)";

    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = 'Nuevo Articulo Guardado.';
        $_SESSION['message_type'] = 'info';
        header("Location: ListaArticulo.php");
        die();
    } else {
        $_SESSION['message'] = 'Error en el proceso de guardado.';
        $_SESSION['message_type'] = 'danger';
        header("Location: ListaArticulo.php");
        die();
    }
}

/* Aqui metodo para eliminar articulos */



?>