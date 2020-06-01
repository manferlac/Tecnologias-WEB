<?php
class receta{
    private $pdo;
    
    public $id;
    public $titulo;
    public $autor;
    public $categoria;
    public $descripcion;
    public $ingredientes;
    public $preparacion;
    public $fotografia;

    public function __construct(){
        try{
            $this->pdo = Database::Conectar();
        }catch(Exception $e){
            die($$e.getMessage());
        }
    }

    public function getId(){
        return $this->id;
    }

    public function Listar(){
        try{
            //$resultado = array();
            $sentencia = $this->pdo->prepare("SELECT * FROM recetas");
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($$e.getMessage());
        }
    }

    public function ListarFiltro($titulo,$orden){
        try{
            //$resultado = array();
            if($titulo!=FALSE AND $orden==FALSE){ //solo titulo
                $sentencia = $this->pdo->prepare("SELECT * FROM recetas WHERE titulo LIKE '%".$titulo."%'");
            }else if($titulo==FALSE AND $orden!=FALSE){ //solo orden
                if($orden=='ascendente'){
                    $sentencia = $this->pdo->prepare("SELECT * FROM recetas ORDER BY titulo ASC");
                }else{
                    $sentencia = $this->pdo->prepare("SELECT * FROM recetas ORDER BY titulo DESC");
                }
            }else{ // titulo y orden
                if($orden=='ascendente'){
                    $sentencia = $this->pdo->prepare("SELECT * FROM recetas WHERE titulo LIKE '%".$titulo."%' ORDER BY titulo ASC");
                }else{
                    $sentencia = $this->pdo->prepare("SELECT * FROM recetas WHERE titulo LIKE '%".$titulo."%' ORDER BY titulo DESC");
                } 
            }
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($$e.getMessage());
        }
    }

    public function numeroTotalRecetas(){
        try{
            $sentencia = "SELECT count(*) FROM recetas"; 
            $result = $this->pdo->prepare($sentencia); 
            $result->execute(); 
            $number_of_rows = $result->fetchColumn();
            return $number_of_rows;
        }catch(Exception $e){
            die($$e.getMessage());
        }
    }

    public function ultimasRecetas(){
        try{
            $resultado = array();
            $sentencia = $this->pdo->prepare("SELECT * FROM recetas ORDER BY id DESC LIMIT 3");
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($$e.getMessage());
        }
    }

    public function Obtener($id){
        try{
            $sentencia = $this->pdo->prepare("SELECT * FROM recetas WHERE id = ?");
            $sentencia->execute(array($id));
            return $sentencia->fetch(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($$e.getMessage());
        }
    }

    public function Eliminar($id){
        try{
            $sentencia = $this->pdo->prepare("DELETE FROM recetas WHERE id = ?");
            $sentencia->execute(array($id));
        }catch(Exception $e){
            die($$e.getMessage());
        }
    }

    public function Actualizar($datos){
        try{
            $sql = "UPDATE recetas SET
                    titulo = ?,
                    autor = ?,
                    categoria = ?,
                    descripcion = ?,
                    ingredientes = ?,
                    preparacion = ?,
                    fotografia = ?
                    WHERE id = ?";

            $this->pdo->prepare($sql)->execute(array($datos->titulo, $datos->autor, $datos->categoria, $datos->descripcion, $datos->ingredientes, $datos->preparacion, $datos->fotografia, $datos->id));
        }catch(Exception $e){
            die($$e.getMessage());
        }
    }

    public function Insertar(receta $datos){
        try{
            $sql = "INSERT INTO recetas (titulo, autor, categoria, descripcion, ingredientes, preparacion, fotografia) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $this->pdo->prepare($sql)->execute(array($datos->titulo, $datos->autor, $datos->categoria, $datos->descripcion, $datos->ingredientes, $datos->preparacion, $datos->fotografia));
        }catch(Exception $e){
            die($$e.getMessage());
        }
    }
}
?>