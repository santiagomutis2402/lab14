<?php
session_start();
if (isset($_REQUEST['usuario']) && isset($_REQUEST['clave'])) {
    $usuario = $_REQUEST['usuario'];
    $clave = $_REQUEST['clave'];

    $salt = substr($usuario, 0, 2);
    $clave_crypt = crypt($clave, $salt);

    require_once("class/usuarios.php");

    $obj_usuarios = new usuarios();
    $usuario_valido = $obj_usuarios->validar_usuario($usuario, $clave_crypt);

    foreach ($usuario_valido as $array_resp) {
        foreach ($array_resp as $value) {
            $nfilas = $value;
        }
    }

    if ($nfilas > 0) {
        $usuario_valido = $usuario;
        $_SESSION["usuario_valido"] = $usuario_valido;
    }
}
?>
<!DOCTYPE html public "-//W3C/DTC HTML 4.0//EN">
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio 14</title>

    <link rel="stylesheet" href="css/estilo.css">

</head>

<body>
    <?php
    if (isset($_SESSION['usuario_valido'])) {
    ?>
    <h1>Gerencia de noticias</h1>
    <hr>
    <ul>
        <li><a href="lab142.php">listar todas las noticias</a></li>
        <li><a href="lab143.php">Listar noticias por partes</a></li>
        <li><a href="lab144.php">Buscar Noticias</a></li>
    </ul>

    <hr>
    <P><a href="logout.php">Desconectar</a></P>
    <?php }

    //inteneto de entrada fallido
    else if (isset($usuario)) {

        print("<BR><BR>\n");
        print("<P align='CENTER'> Acceso no autorizado</P>\n");
        print("<P align='CENTER'>[<a href='login.php'>Conectar</a>]</P>\n");
    }
    //sesion no iniciada
    else {
        print("<br><br>\n");
        print("<P class='parrafocentrado'>Esta zona tiene el acceso restringido.<br>" . "Para entrar debe identificarse</P>\n");

        print("<FORM class='entrada' name='login' action='login.php' method='post'>\n");

        print("<P><label class='etiqueta-entrada'>Usuario</label>\n");
        print("<INPUT type='text' name='usuario' size='15'></P>\n");
        print("<P><label class='etiqueta-entrada'>Clave:</label>\n");
        print("<INPUT type='password' name='clave' size='15'></P>\n");
        print("<P><INPUT type='submit' value='entrar'></P>\n");
        print("</FORM\n");

        print("<P class='parrafocentrado'>Nota: si o no dispone de identificacion o tiene problemas" . "para entrar <BR> pongase en contacto con el " . "<a href='mailto:webmaster@localhost'>administrador</a> del sitio </P>\n");
    }
    ?>

</body>

</html>