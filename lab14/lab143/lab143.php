<?php

session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/estilo.css">
</head>

<body>
    <?php
    if (isset($_SESSION["usuario_valido"])) {

    ?>
        <h1>Consulta de noticias</h1>

    <?php
        require_once("class/noticias.php");


        $obj_noticia = new noticia();
        $obj_noticia2 = new noticia();

        //cantidad registros
        $num = $obj_noticia2->paginacionMax();
        $cant = $num['count(n.id)'];

        //valido la url
        if (!empty($_REQUEST["nume"])) {
            $_REQUEST["nume"] = $_REQUEST["nume"];
        } else {
            $_REQUEST["nume"] = '1';
        }
        if ($_REQUEST["nume"] == "") {
            $_REQUEST["nume"] = "1";
        }

        $registros = '5';
        $pagina = $_REQUEST['nume'];

        if (is_numeric($pagina))
            $inicio = (($pagina - 1) * $registros);
        else
            $inicio = 0;
        $noticias = $obj_noticia->consultar_noticias2($inicio, $registros);
        $paginas = ceil($cant / $registros);

        $nfilas = count($noticias);


        ///////////////////
        if ($_REQUEST["nume"] == "1") {
            $_REQUEST["nume"] == "0";
            echo "";
        } else {
            if ($pagina < 1)
                $ant = $_REQUEST["nume"] - 1;
            echo "<a  aria-label='Anterior' href='lab11.php?nume=" . ceil($pagina - 1) . "'>Anterior</a>";
        }
        $sigui = $_REQUEST["nume"] + 1;
        $ultima = $cant / $registros;
        if ($ultima == $_REQUEST["nume"] + 1) {
            $ultima == "";
        }
        if ($pagina < $paginas && $paginas > 1)
            echo "
            <a  aria-label='Siguiente'
                    href='lab11.php?nume=" . ceil($pagina + 1) . "'>Siguiente</a>";
        ///////////////////acaba aqui
        if ($nfilas > 0) {
            print("<TABLE>\n");
            print("<TR>\n");
            print("<TH>Titulo</TH>\n");
            print("<TH>Texto</TH>\n");
            print("<TH>Categoria</TH>\n");
            print("<TH>Fecha</TH>\n");
            print("<TH>Imagen</TH>\n");
            print("</TR>\n");

            foreach ($noticias as $resultado) {
                print("<TR>\n");
                print("<TD>" . $resultado['titulo'] . "</TD>\n");
                print("<TD>" . $resultado['texto'] . "</TD>\n");
                print("<TD>" . $resultado['categoria'] . "</TD>\n");
                print("<TD>" . date("j/n/Y", strtotime($resultado['fecha'])) . "</TD>\n");

                if ($resultado['imagen'] != "") {
                    print("<TD><A TARGET='_blank' HREF='img/" . $resultado['imagen'] . "'>
            <IMG BORDER='0' SRC='img/iconotexto.gif'></A></TD>\n");
                } else {
                    print("<TD>&nbsp;</TD>\n");
                }
                print("</TR>\n");
            }
            print("</TABLE\n");
        } else {
            print("No hay noticias disponibles");
        }
    } else {
        print("<br><br>\n");
        print("<P align='center'>Acceso no autorizado</P>\n");
        print("<P align='center'>[<a href='login.php' target='_top'>Conectar</a>]</P>\n");
    }

    ?>

</body>

</html>