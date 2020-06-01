<?php
    require_once 'models/database.php';

    $pagina = 'inicio';
    $controller = 'recetaController';

    if(isset($_REQUEST['p'])){
        $pagina = $_REQUEST['p'];
    }

    require_once "controllers/$controller.php";
    $controller = ucwords($controller);
    $controller = new $controller;

    require 'views/comun/header.php';
    switch($pagina){
        case 'recetas':
            $controller->Index();
            break;
        case 'contacto':
            require 'views/contacto.php';
            break;
        case 'inicio':
            require 'views/inicio.php';
            break;
        case 'Visualizar':
            $controller->Visualizar();
            break;
        case 'Crud':
            $controller->Crud();
            break;
        case 'Confirmar':
            $id = $_GET["id"];
            $titulo = $_GET["titulo"];
            $categoria = $_GET["categoria"];
            $descripcion = $_GET["descripcion"];
            $ingredientes = $_GET["ingredientes"];
            $preparacion = $_GET["preparacion"];
            $rutaImagen = $_GET["ruta"];
            $controller->Confirmar($id,$titulo,$categoria,$descripcion,$ingredientes,$preparacion,$rutaImagen);
            break;
        case 'Guardar':
            $controller->Guardar();
            break;
        case 'Filtrar':
            $titulo = $_GET["titulo"];
            $orden = $_GET["orden"];
            $controller->VisualizarFiltro($titulo,$orden);
            break;
        case 'Eliminar':
            $controller->Eliminar();
            break;
        default:
            require 'views/404.php';
            break;
    }

    require 'views/comun/footer.php';
?>