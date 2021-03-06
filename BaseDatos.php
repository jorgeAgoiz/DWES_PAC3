<!-- Conexion a la base de datos y TODAS las funciones SQL necesarias -->

<?php
/* Iniciamos la SESSION y creamos la conexion */
session_start();
$conn = mysqli_connect(
    'localhost',
    'root',
    'tuContraseñaAqui',
    'pac3_daw'
);

/************** FUNCIONES DE ORDENACION USUARIOS *****************/

/* Listado por defecto */
function listarUsuarios($conn)
{
    $query = "SELECT * FROM user";
    $result_tasks = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($result_tasks)) {
        if ($row['UserID'] == 3) {/* Si es superAdmin aplicaremos estos estilos */
            $superadminStyle = 'background-color:blue; color:white; border: 2px solid black;';
            $disabled = 'disabled';
        } else {/* Si no es superAdmin no se aplican estilos diferenciadores */
            $superadminStyle = null;
            $disabled = null;
        }
        /* Insertamos tantos elementos usuarios como existan */
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
        if ($row['UserID'] == 3) {/* Si es superAdmin aplicaremos estos estilos */
            $superadminStyle = 'background-color:blue; color:white; border: 2px solid black;';
            $disabled = 'disabled';
        } else {/* Si no es superAdmin no se aplican estilos diferenciadores */
            $superadminStyle = null;
            $disabled = null;
        }
        /* Insertamos tantos elementos usuarios como existan */
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
/* ********************************************************************************* */
/********************** FUNCIONES DE EDITAR, ELIMINAR Y CREAR USUARIOS ******************/

/* Funcion para mostar el usuario a editar GET */
function editarUsuarioGet($conn, $userId)
{
    $query = "SELECT * FROM user WHERE UserID = $userId";
    $result_tasks = mysqli_query($conn, $query);

    if (mysqli_num_rows($result_tasks)) {/* Guardamos cada campo en una variable */
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
    /* Devolvemos las variables para poder insertarlas en nuestro formulario HTML */
    return array($name, $email, $birthDate, $address, $postalCode, $password, $city, $state);
}

/* Funcion para modificar el usuario en la BBDD POST */
function editarUsuarioPost($conn, $UserId)
{   /* Recogemos todas las variables enviadas por POST */
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalCode'];
    $lastAccess = date('Y-m-d');

    if ($_POST['birthDate']) {/* Si se ha enviado una fecha de nacimiento */
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
    } else {/* Si no se ha enviado fecha de nacimiento */
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

    if (mysqli_query($conn, $query)) {/* Si se actualiza correctamente el usuario mostramos este mensaje*/
        $_SESSION['message'] = 'Usuario Actualizado.';
        $_SESSION['message_type'] = 'info';
        header("Location: ListaUsuario.php");
        die();
    } else {/* Si no se actualiza correctamente el usuario mostramos este mensaje */
        $_SESSION['message'] = 'Error en la actualización.';
        $_SESSION['message_type'] = 'danger';
        header("Location: ListaUsuario.php");
        die();
    }
}

/* Función para crear usuario */
function crearUsuario($conn)
{/* Recogemos las variables enviadas por POST */
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

    if (mysqli_query($conn, $query)) {/* Si se crea correctamente el usuario mostramos este mensaje*/
        $_SESSION['message'] = 'Nuevo Usuario Guardado.';
        $_SESSION['message_type'] = 'info';
        header("Location: ListaUsuario.php");
        die();
    } else {/* Si no se crea correctamente el usuario mostramos este mensaje */
        $_SESSION['message'] = 'Error en el proceso de guardado.';
        $_SESSION['message_type'] = 'danger';
        header("Location: ListaUsuario.php");
        die();
    }
}
/* Funcion eliminar usuario */
function deleteUser($conn, $userId)
{
    $query = "DELETE FROM user
        WHERE UserID = $userId";
    if (mysqli_query($conn, $query)) {/* Si se elimina correctamente el usuario mostramos este mensaje */
        $_SESSION['message'] = 'Usuario Eliminado.';
        $_SESSION['message_type'] = 'info';
        header("Location: ListaUsuario.php");
        die();
    } else {/* Si no se elimina correctamente el usuario mostramos este mensaje */
        $_SESSION['message'] = 'Error Usuario No Eliminado.';
        $_SESSION['message_type'] = 'danger';
        header("Location: ListaUsuario.php");
        die();
    };
}

/********************** FIN FUNCIONES DE EDITAR, ELIMINAR Y CREAR USUARIOS ******************/
/* ************************************************************************************+*** */
/********************** FUNCIONES PARA ORDENAR ARTICULOS  **********************************/
/* Listado por defecto */
function listarArticulos($conn)
{
    $articulos_por_pagina = 10;/* Cantidad de articulos a mostrar por pagina */
    $inicio = ($_GET['pagina'] - 1) * $articulos_por_pagina;/* Variable para usar el LIMIT de SQL */

    $query = "SELECT C.Name as catName, P.ProductID, P.Name, P.Cost, P.Price 
                FROM 
                product P 
                JOIN 
                category C 
                ON P.CategoryID = C.CategoryID 
                ORDER BY ProductID ASC 
                LIMIT $inicio, 10";
    $result_tasks = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($result_tasks)) {
        /* Mostramos tantos articulos en el HTML como nos devuelva la sentencia */
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
/* Listado con ordenación */
function listarArticulosPorOrden($conn, $option)
{
    $articulos_por_pagina = 10;/* Cantidad de articulos a mostrar por pagina */
    $inicio = ($_GET['pagina'] - 1) * $articulos_por_pagina;/* Variable para usar el LIMIT de SQL */

    $query = "SELECT C.Name as catName, P.ProductID, P.Name, P.Cost, P.Price 
                FROM 
                product P 
                JOIN 
                category C 
                ON P.CategoryID = C.CategoryID $option 
                LIMIT $inicio, 10";
    $result_tasks = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($result_tasks)) {
        /* Mostramos tantos articulos en el HTML como nos devuelva la sentencia */
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
/* Funcion para contar registros y paginar */
function contarFilas($conn)
{
    $query = "SELECT * FROM product";
    if ($result = mysqli_query($conn, $query)) {
        $numRows = mysqli_num_rows($result);/* Cuenta las filas devueltas */
    }

    $numPages = $numRows / 10;/* Las paginas seran el numero de filas entre los articulos por pagina */
    $numPages = ceil($numPages);/* Redondeamos el resultado a la alta */

    return array($numPages, $numRows);/* Devolvemos numero de paginas y numero de filas */
}



/********************** FIN FUNCIONES ORDENACION ARTICULOS ******************/
/* ****************************************************************************** */
/********************** FUNCIONES DE EDITAR, ELIMINAR Y CREAR ARTICULOS ******************/

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
    if (mysqli_num_rows($result_tasks)) {/* Guardamos los campos de cada fila en una variable */
        $row = mysqli_fetch_array($result_tasks);
        $name = $row['Name'];
        $cost = $row['Cost'];
        $price = $row['Price'];
        $catName = $row['catName'];
        $catId = $row['CategoryID'];
    }
    /* Devolvemos las variables para poder insertarlas en el formulario HTML */
    return array($name, $cost, $price, $catName, $productId, $catId);
}

/* Funcion para editar articulo POST */
function editarArticuloPost($conn)
{   /* Recogemos las variables enviadas por POST */
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
    if (mysqli_query($conn, $query)) {/* Si se actualiza correctamente mostramos este mensaje */
        $_SESSION['message'] = 'Articulo Actualizado.';
        $_SESSION['message_type'] = 'info';
        header("Location: ListaArticulo.php?pagina=1");
        die();
    } else {/* Si no se actualiza correctamente mostramos este mensaje */
        $_SESSION['message'] = 'Error en la actualización.';
        $_SESSION['message_type'] = 'danger';
        header("Location: ListaArticulo.php?pagina=1");
        die();
    }
}

/* Funcion para crear articulos */
function crearArticulo($conn)
{   /* Recogemos las variables enviadas por POST */
    $name = $_POST['name'];
    $cost = $_POST['cost'];
    $price = $_POST['price'];
    $catId = $_POST['catId'];

    $query = "INSERT INTO 
                product(Name, Cost, Price, CategoryID) 
                values('$name', $cost, $price, $catId)";

    if (mysqli_query($conn, $query)) {/* Si se crea correctamente mostramos este mensaje */
        $_SESSION['message'] = 'Nuevo Articulo Guardado.';
        $_SESSION['message_type'] = 'info';
        header("Location: ListaArticulo.php?pagina=1");
        die();
    } else {/* Si no se crea correctamente mostramos este mensaje */
        $_SESSION['message'] = 'Error en el proceso de guardado.';
        $_SESSION['message_type'] = 'danger';
        header("Location: ListaArticulo.php?pagina=1");
        die();
    }
}

/* funcion para eliminar articulos */
function deleteProduct($conn, $productId)
{
    $query = "DELETE FROM product
        WHERE ProductID = $productId";
    if (mysqli_query($conn, $query)) {/* Si se elimina correctamente mostramos este mensaje */
        $_SESSION['message'] = 'Artículo Eliminado.';
        $_SESSION['message_type'] = 'info';
        header("Location: ListaArticulo.php?pagina=1");
        die();
    } else {/* Si no se elimina correctamente mostramos este mensaje */
        $_SESSION['message'] = 'Error Artículo No Eliminado.';
        $_SESSION['message_type'] = 'danger';
        header("Location: ListaArticulo.php?pagina=1");
        die();
    };
}

/********************** FIN DE FUNCIONES DE EDITAR, ELIMINAR Y CREAR ARTICULOS ******************/
/* ******************************************************************************** */
/****************************** AUTENTICACION DE USUARIOS ************************/
if (isset($_POST['authUser'])) {/* Si se recibe por post el campo indicado */
    /* Recogemos el email y password */
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $query = "SELECT * FROM user 
                WHERE Email = '$email' 
                AND Password = '$pass'";
    $result_user = mysqli_query($conn, $query);
    if (mysqli_num_rows($result_user) > 0) {/* Si nos devuelve un usuario la setencia */
        while ($row = mysqli_fetch_array($result_user)) {
            if ($row['Enabled'] == 1) {/* Si el usuario esta habilitado */
                $lastAccess = date('Y-m-d');
                $id = $row['UserID'];
                /* Actualizamos el ultimo acceso del usuario */
                $queryUpdate = "UPDATE user SET LastAccess = '$lastAccess' 
                        WHERE UserID = $id ";
                $resultUpdate = mysqli_query($conn, $queryUpdate);
                $_SESSION['user'] = $row['Email'];/* Guardamos en SESSION el usuario */
                $_SESSION['attemps'] = 0;/* Reseteamos los intentos a 0 */
                unset($_SESSION['lastEmail']);/* reseteamos esta variable de session */
                header("Location: index.php");/* Redireccionamos al index.php */
            } else {/* Si el usuario no esta habilitado */
                $_SESSION['message'] = 'Usuario Inhabilitado.';
                $_SESSION['message_type'] = 'danger';
                header("Location: Validacion.php");
            }
        }
    } else {/* Si no se encuentra un usuario valido */

        /* Llamamos a la funcion pasandole el email ingresado y capturamos el mensaje a mostrar y los intentos actuales */
        list($message, $response) = bloquearUsuario($conn, $email, 1);
        /* Devolvemos el siguiente mensaje */
        $_SESSION['message'] = $message . "<br>Intento: " . $response;
        $_SESSION['message_type'] = 'danger';
        header("Location: Validacion.php");/* Redireccionamos al formulario de validación */
    }
}

/* ********************* FUNCION PARA BLOQUEAR USUARIOS ************************** */
function bloquearUsuario($conn, $email, $attemps)
{
    // Si Existe un ultimo email y no es igual al que hemos pasado reseteamos los intentos
    if ($_SESSION['lastEmail'] && $_SESSION['lastEmail'] != $email) {
        $_SESSION['attemps'] = 0;
    }
    //Buscamos el email en los usuarios
    $query = "SELECT UserID from user 
                WHERE Email = '$email'";
    $result = mysqli_query($conn, $query);
    //Si nos devuelve resultado
    if (mysqli_num_rows($result)) {

        $row = mysqli_fetch_assoc($result);
        $idToBlock = $row['UserID'];
        if ($idToBlock == 3) { //Si eres super admin sin limite de intentos
            return array("Super Admin sin limite de intentos.", 0);
        }
        //Si los intentos son 3 bloqueamos el usuario
        if ($_SESSION['attemps'] >= 2) {
            // Seteando el Enabled a 0
            $blockQuery = "UPDATE user 
                            SET Enabled = 0 
                            WHERE 
                            UserID = $idToBlock";
            $userBlocked = mysqli_query($conn, $blockQuery);
            //Ejecutamos el update y si diera error:
            if (!$userBlocked) {
                return array("Algo fue mal.", $_SESSION['attemps']);
            }
            //Si se ha bloqueado correctamente
            $_SESSION['attemps'] = 0;
            return array("Usuario deshabilitado", $_SESSION['attemps']);
        } else {
            //Si no se han agotado los 3 intentos todavia
            $_SESSION['lastEmail'] = $email;
            $_SESSION['attemps'] = $_SESSION['attemps'] + $attemps;
            return array("Intento fallido de inicio de sesion.", $_SESSION['attemps']);
        }
    } else {
        //Si no se encontro usuario con el email indicado
        return array("Email no registrado.", $_SESSION['attemps']);
    }
}

/* ********************** FUNCION PARA COMPROBAR EL AUTH **************************** */
function comprobarAuth($conn)
{
    $query = "SELECT * FROM setup";
    $result = mysqli_query($conn, $query);
    while ($row = $result->fetch_assoc()) {
        $authAct = $row['Autenticación'];
    }
    return $authAct;
}

/* ************ ACTIVAR/DESACTIVAR AUTENTICACION *************** */

if (isset($_GET['auth'])) {
    $authValue = $_GET['auth'];
    $query = "UPDATE setup 
                    SET Autenticación = $authValue 
                    WHERE SuperAdmin = 3";
    $response = mysqli_query($conn, $query);
    if ($response) {
        unset($_SESSION['user']);
        header("Location: index.php");
    }
}


?>