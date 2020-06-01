<?php
    session_start();

    $controller = 'recetaController';
    require_once "controllers/$controller.php";
    $controller = ucwords($controller);
    $controller = new $controller;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Práctica PHP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="img/icono.png"/>
    <link rel="stylesheet" type="text/css" href="style/estilo.css">
</head>
<body>
<header>
    <section id="cabecera">
        <section></section>
        <a href="pag_inicio.php" title="RECETAS GRATIS">
            <img src="img/logo.png" alt="RECETAS GRATIS" id="logotipo">
        </a>
        <h1>Comida sana para todos los días</h1>
    </section>
    <nav class="menu">
        <ul>
            <li><a href="?p=inicio">Inicio</a></li>
            <li><a href="?p=recetas">Listado de recetas</a></li>
            <?php if(isset($_SESSION['username'])){?> <li><a href="?p=Crud">Añadir receta</a></li><?php } ?>
            <li><a href="?p=contacto">Contacto</a></li>
        </ul>
    </nav>
    </header>

    <main>
        <section class="container">
            <section>
                <section class="cont-lateral">
                    <section class="titulo-cont-lateral">
                    <?php
                        if(isset($_SESSION['username'])){
                    ?>
                        <h3>Bienvenido</h3>
                    <?php
                        }else{
                    ?>
                        <h3>Login</h3>
                    <?php
                        }
                    ?>
                        
                    </section>
                    <section id="login">
                        <?php 
                            if(isset($_SESSION['username'])){
                        ?>
                        
                                <span>Usuario: <?php echo $_SESSION['username'] ?></span><br>
                                <a href="php/logout.php" id="logout">Cerrar sesión</a>
                            
                            
                        <?php
                            }else{
                        ?>
                            <form action="php/login.php" method="post">
                                <section>
                                    <label for="usuario">Usuario</label>
                                    <input type="text" id="usuario" name="usuario" required><br>
                                </section>
                                <section>
                                    <label for="clave">Clave</label>
                                    <input type="password" id="password" name="password" required><br>
                                </section>
                                <section>
                                    <span class="error">
                                    <?php 
                                    if(isset($_SESSION['loggedin'])){
                                        if($_SESSION['loggedin'] == false){
                                    ?>
                                    Usuario o contraseña incorrect@
                                    <?php
                                        }
                                    } 
                                    ?>
                                    </span>
                                </section>
                                <section>
                                    <input type="submit" value="Login">
                                </section>
                            </form>
                        <?php
                            }
                        ?>
                    </section>
                </section>
                <section class="cont-lateral valoraciones-recetas">
                    <section class="titulo-cont-lateral">
                        <h3>Últimas recetas</h3>
                    </section>
                    <section>
                        <?php foreach($controller->ultimasRecetas() as $ulti): ?>
                        <article class="mejor-valorada">
                            <section><span><a id="enlace-receta" href="?p=Visualizar&id=<?php echo $ulti->id; ?>"><?php echo $ulti->titulo; ?></a></span></section>
                        </article>
                        <?php endforeach; ?>
                    </section>
                </section>
                <section class="cont-lateral valoraciones-recetas">
                    <section class="titulo-cont-lateral"><h3>nº recetas</h3></section>
                    <section id="numero-recetas"><span>El sitio contiene <?php echo $controller->numRecetas() ?> recetas diferentes</span></section>
                </section>
            </section>