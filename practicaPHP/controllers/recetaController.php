<?php
require_once 'models/receta.php';


class recetaController{
    private $modelo;

    public function __construct(){
        $this->modelo = new receta();
    }

    public function Index(){
        if(isset($_REQUEST['new_receta'])){
            if($_REQUEST['new_receta'] == 'ok'){
                $new_receta = TRUE;
            }else{
                $new_receta = FALSE;
            }

            $tituloReceta = $_REQUEST['titulo'];
            
            
        }
        $recetas = $this->modelo->Listar();
        if(empty($recetas)){
            $sin_resultados = TRUE;
        }
        require 'views/listado-recetas.php';
    }

    public function numRecetas(){
        $numRecetas = $this->modelo->numeroTotalRecetas();
        return $numRecetas;
    }

    public function ultimasRecetas(){
        $ultimasRecetas = $this->modelo->ultimasRecetas();
        return $ultimasRecetas;
    }

    public function VisualizarFiltro($titulo,$orden){
        $recetas = $this->modelo->ListarFiltro($titulo,$orden);
		if(empty($recetas)){
            $sin_resultados = TRUE;
        }
        require 'views/listado-recetas.php';
    }

    public function Visualizar(){
        $receta = new receta();
        if(isset($_REQUEST['id'])){
            $receta = $this->modelo->Obtener($_REQUEST['id']);
        }

        require 'views/receta.php';
    }

    public function Crud(){
        $receta = new receta();
        if(isset($_REQUEST['id'])){
            $receta = $this->modelo->Obtener($_REQUEST['id']);
        }

        require 'views/nueva_receta.php';
    }

    public function Confirmar($id,$titulo,$categoria,$descripcion,$ingredientes,$preparacion,$rutaImagen){
        $receta = new receta();
        $receta->id = $id;
        $receta->titulo = $titulo;
        $receta->categoria = $categoria;
        $receta->descripcion = $descripcion;
        $receta->ingredientes = $ingredientes;
        $receta->preparacion = $preparacion;
        $receta->fotografia = $rutaImagen; 

        require 'views/confirmacion.php';
    }

    public function Guardar(){
        $receta = new receta();
        $receta->id = $_REQUEST['id'];
        $receta->titulo = trim($_REQUEST['tituloReceta']);
        $receta->autor = trim($_REQUEST['autorReceta']);
        $receta->categoria = trim($_REQUEST['categoriaReceta']);
        $receta->descripcion = trim($_REQUEST['descripcionReceta']);
        $receta->ingredientes = trim($_REQUEST['ingredientesReceta']);
        $receta->preparacion = trim($_REQUEST['preparacionReceta']);
        $receta->fotografia = $_REQUEST['imagenReceta'];

        if($receta->id >0){
            $this->modelo->Actualizar($receta);
            header('Location: ?p=recetas&new_receta=no&titulo='.$receta->titulo.'');
        }else{
            $this->modelo->Insertar($receta);
            header('Location: ?p=recetas&new_receta=ok&titulo='.$receta->titulo.'');
        }
    }

    public function Eliminar(){
        $this->modelo->Eliminar($_REQUEST['id']);
        header('Location: ?p=recetas');
    }
}
?>