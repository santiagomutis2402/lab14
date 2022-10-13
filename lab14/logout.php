<?php
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (isset($_SESSION["usuario_valido"])) {
        session_destroy();
        print("<br><br><P align='center'>conexion finalizada</P>\n");
        print("<P align='center'>[<a href='login.php'>Conectar</a>]</P>\n]");
    } else {
        print("<br><br>/n");
        print("<P align=center'>No existe una conexion activa</P>\n");
        print("<P align='center'>[<a href='login.php'>Conectar</a>]</P>\n");
    }
    ?>
</body>

</html>