<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <meta name="theme-color" content="#2196F3">
    <title>Material UI LocalHost</title>

    <!-- CSS  -->
    <link href="material/css/materialize.css" type="text/css" rel="stylesheet">
    <link href="material/css/style.css" type="text/css" rel="stylesheet" >
    <link href="material/img/favicon.ico" rel="icon" type="image/x-icon" />
    <link href="material/css/font-awesome.min.css" type="text/css" rel="stylesheet" >
    <script src="material/js/modernizr.js"></script> <!-- Modernizr -->
</head>
<body id="top" class="scrollspy">

    <!-- Pre Loader -->
    <div id="loader-wrapper">
        <div id="loader"></div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

    </div>

    <!--Navigation-->
    <div class="navbar-fixed">
        <nav id="nav_f" class="default_color" role="navigation">
            <div class="container">
                <div class="nav-wrapper"><a id="logo-container" href="#top" class="brand-logo">LocalHost</a>
                    <ul id="nav-mobile" class="right side-nav">
                        <li><a href="#proyectos">Proyectos</a></li>
                        <li><a href="http://localhost/phpmyadmin" target="_blank">phpMyAdmin</a></li>
                        <li><a href="#nuevo">Nuevo</a></li>
                        <li><a href="info.php">Info PHP</a></li>
                    </ul><a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
                </div>
            </div>
        </nav>
    </div>


    <!--Team-->
    <div class="section scrollspy" id="proyectos">
        <div class="container">
            <h2 class="header text_b"> Proyectos </h2>
            <div class="row">
                <?php
                    // open this directory
                    $myDirectory = opendir($_SERVER['DOCUMENT_ROOT'] . "/.");
                    $list = 0;
                    $ingnorados = array(
                                    ".",
                                    "..",
                                    "material",
                                    "index.php",
                                    "crear.php",
                                    "info.php"
                                );

                    // get each entry
                    while (false !== ($entryName = readdir($myDirectory)))
                    {
                        if (!in_array($entryName, $ingnorados))
                        {
                            $dirArray[] = $entryName;
                            //  count elements in array
                            $indexCount = count($dirArray);
                            //Print ("$indexCount files<br>\n");

                            // sort 'em
                            sort($dirArray);
                        }

                    }
                    if (isset($indexCount)) {
                        // loop through the array of files and print them all
                        // Quite la variable $list. enumera las carpetas
                        for($index=0; $index < $indexCount; $index++)
                        {
                            $list++;
                            echo '
                            <div class="col s12 m3">
                                <a href="http://localhost/'.$dirArray[$index].'">
                                <div class="card card-avatar">
                                    <div class="waves-effect waves-block waves-light">
                                        <i class="fa fa-folder-o fa-4x"></i>
                                    </div>
                                    <div class="card-content">
                                        <span class="card-title activator grey-text text-darken-4">
                                            '.$dirArray[$index].'
                                        </span>
                                    </div>
                                </div>
                                </a>
                            </div>
                            ';
                        }
                    }

                    if ($list == 0)
                    {
                        echo '
                        <div class="col s12 m3">
                            <div class="card card-avatar">
                                <div class="waves-effect waves-block waves-light">
                                    <i class="fa fa-folder-o fa-4x"></i>
                                </div>
                                <div class="card-content">
                                    <span class="card-title activator grey-text text-darken-4">
                                        No hay proyectos por el momento.
                                    </span>
                                </div>
                            </div>
                        </div>
                        ';
                    }
                    // close directory
                    closedir($myDirectory);
                ?>
            </div>
        </div>
    </div>

    <!--Parallax-->


    <!--phpMyAdmin-->
    <!--<div class="section scrollspy" id="phpMyAdmin">
        <div class="container">
            <h2 class="header text_b"> phpMyAdmin </h2>
            <div class="row">
                <div class="col s12">
                    <div class="card-content-phpMyAdmin">
                        <iframe style="width:100%;height:100%;" src="http://localhost/phpMyAdmin/index.php?db=&table=&token=1d525352024fff0faccd2984cb0f59d5&lang=es#PMAURL-0:index.php?db=&table=&server=1&target=&token=1d525352024fff0faccd2984cb0f59d5"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>-->


    <!--Footer-->
    <footer id="nuevo" class="page-footer default_color scrollspy">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <form class="col s12" id="formNuevo">
                        <div class="row">
                            <div class="input-field col s6">
                                <i class="mdi-file-folder prefix white-text"></i>
                                <input id="icon_prefix" type="text" name="proyecto" class="validate white-text">
                                <label for="icon_prefix" class="white-text">Proyecto</label>
                            </div>
                            <div class="input-field col s6">
                                <button class="btn waves-effect waves-light red darken-1" type="submit" name="action">Crear!
                                    <i class="mdi-content-send right white-text"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col l3 s12">
                    <h5 class="white-text" id="mensaje"></h5>
                </div>

            </div>
        </div>
        <div class="footer-copyright default_color">
            <div class="container">
                Material Design LocalHost <?= date("Y") ?>. By Isaac Vqz.
            </div>
        </div>
    </footer>


    <!--  Scripts-->
    <script src="material/js/jquery-2.1.1.min.js"></script>
    <script src="material/js/materialize.js"></script>
    <script src="material/js/init.js"></script>

    <script>
        $(document).on("ready", function() {

            $("#formNuevo").on("submit", function(e) {
                event.preventDefault();
                var data = $("#formNuevo").serializeArray();

                $.ajax({
                    type: "post",
                    dataType: 'json',
                    url: "crear.php",
                    data: data,
                }).done(function(respuesta){
                    //$("#mensaje").html(respuesta.mensaje);
                    alert(respuesta.mensaje);
                    location.reload(true);
                });
                return false;
            });

        });
    </script>
</body>
</html>