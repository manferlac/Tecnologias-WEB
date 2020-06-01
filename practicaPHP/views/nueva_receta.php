<?php

  if(!isset($_SESSION['username'])){
    header('Location: ?p=404');
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $ok = true;
        $id = $_POST['id'];
        $tit = trim($_POST['tituloReceta']);
        $cat = trim($_POST['categoriaReceta']);
        $des = trim($_POST['descripcionReceta']);
        $ingre = trim($_POST['ingredientesReceta']);
        $prepa = trim($_POST['preparacionReceta']);
        
        $nombre_img = $_FILES['imagenReceta']['name'];
        $tipo = $_FILES['imagenReceta']['type'];
        $tamano = $_FILES['imagenReceta']['size'];
        

    if(!empty($tit)){
        $titulo = $tit;
    }else{
        $errorTitulo = "El titulo no puede estar vacío";
        $ok = false;
    }

    if(!empty($cat)){
        $categoria = $cat;
    }else{
        $errorCategoria = "La categoría no puede estar vacía";
        $ok = false;
    }

    if(!empty($des)){
        $descripcion = $des;
    }else{
        $errorDescripcion = "La descripción no puede estar vacía";
        $ok = false;
    }

    if(!empty($ingre)){
        $ingredientes = $ingre;
    }else{
        $errorIngredientes = "Los ingredientes no pueden estar vacios";
        $ok = false;
    }

    if(!empty($prepa)){
        $preparacion = $prepa;
    }else{
        $errorPreparacion = "La preparación no puede estar vacía";
        $ok = false;
    }

    if(($nombre_img == !NULL) AND ($_FILES['imagenReceta']['size'] <= 200000)){
        if(($_FILES["imagenReceta"]["type"] == "image/gif") || ($_FILES["imagenReceta"]["type"] == "image/jpeg") || ($_FILES["imagenReceta"]["type"] == "image/jpg") || ($_FILES["imagenReceta"]["type"] == "image/png")){

            
        }else{
            $errorImagen = "Formato incorrecto";
            $ok = false;
        }
    }else{
        if($nombre_img == !NULL){
            $errorImagen = "La imagen es demasiado grande";
            $ok = false;
        }else{
            if(isset($receta->fotografia)){
                $no_cambiar = true;
            }else{
                $errorImagen = "Tienes que introducir una imagen correcta";
                $ok = false;
            }   
        } 
    }

    if($ok){
        if(isset($no_cambiar)){
            $rutaImagen = $receta->fotografia; 
        }else{
            $directorio = 'img/imagenesRecetas/';
            $nombreDeArchivo = explode(".", $nombre_img);
            $rutaImagen = $directorio.$nombreDeArchivo[0].$id.'.'.$nombreDeArchivo[1];
            move_uploaded_file($_FILES['imagenReceta']['tmp_name'],$rutaImagen);
        }
        
        header('Location: ?p=Confirmar&id='.$id.'&titulo='.$titulo.'&categoria='.$categoria.'&descripcion='.$descripcion.'&ingredientes='.$ingredientes.'&preparacion='.$preparacion.'&ruta='.$rutaImagen.'');
    }
  }
?>

<section class="container-principal">
    <section id="nombre-valoracion-receta">
        <section>
            <h3>
            <?php if(isset($receta->id)){
                echo 'Editando '.$receta->titulo;
            }else{
                echo 'Nueva receta';
            }
            ?>
            </h3>
        </section>
    </section>
    <section>
        <section id="tags-autor">
            <section class="tags">
                <small>Práctica PHP - Tecnologías Web</small>
            </section>
            <section class="tags">
                <small>Autor: Manuel Fernández La-Chica</small>
            </section>
        </section>
        <section id="receta">
            <form method="post" id="contacto" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php if(isset($receta->id)) echo $receta->id ?>">
            <section>
                <label for="tituloReceta">Título:</label>
                <input type="text" class="inputContacto" id="tituloReceta" name="tituloReceta" value="<?php if(isset($receta->id)){echo $receta->titulo;}elseif(isset($titulo)){echo $titulo;}  ?>">
                <span class="error"><?php if(isset($errorTitulo)) echo $errorTitulo ?></span>
            </section>
            <section>
                <label for="categoriaReceta">Categoría:</label>
                <input type="text" class="inputContacto" id="categoriaReceta" name="categoriaReceta" value="<?php if(isset($receta->id)){echo $receta->categoria;}elseif(isset($categoria)){echo $categoria;} ?>">
                <span class="error"><?php if(isset($errorCategoria)) echo $errorCategoria ?></span>
            </section>
            <section>
                <label for="descripcionReceta">Descripción:</label>
                <textarea id="descripcionReceta" name="descripcionReceta" rows="8" cols="100"><?php if(isset($receta->id)){echo $receta->descripcion;}elseif(isset($descripcion)){echo $descripcion;} ?></textarea>
                <span class="error"><?php if(isset($errorDescripcion)) echo $errorDescripcion ?></span>
            </section>
            <section>
                <label for="ingredientesReceta">Ingredientes:</label>
                <textarea id="ingredientesReceta" placeholder="Ej. ingrediente1;ingrediente2;ingrediente3;... (Separados por ; )" name="ingredientesReceta" rows="8" cols="100"><?php if(isset($receta->id)){echo $receta->ingredientes;}elseif(isset($ingredientes)){echo $ingredientes;} ?></textarea>
                <span class="error"><?php if(isset($errorIngredientes)) echo $errorIngredientes ?></span>
            </section>
            <section>
                <label for="preparacionReceta">Preparación:</label>
                <textarea id="preparacionReceta" placeholder="Ej. paso1;paso2;paso3;... (Separados por ; )" name="preparacionReceta" rows="8" cols="100"><?php if(isset($receta->id)){echo $receta->preparacion;}elseif(isset($preparacion)){echo $preparacion;} ?></textarea>
                <span class="error"><?php if(isset($errorPreparacion)) echo $errorPreparacion ?></span>
            </section>
            <section id="imagenConfirmacion">
                <label for="imagenReceta">Imagen:</label>
                <?php if(isset($receta->fotografia)){
                ?>
                    <img src="<?php echo $receta->fotografia ?>" alt="Imagen principal" id="imagen-principal">
                <?php
                }
                ?>
                <input type="file" class="form-control" id="imagenReceta" name="imagenReceta" multiple>
                <span class="error"><?php if(isset($errorImagen)) echo $errorImagen ?></span>
            </section>
            <section>
                <input type="submit" value="<?php if(isset($receta->id)){echo 'Editar';}else{echo 'Añadir';}?>">
            </section>
            </form>
        </section>
    </section>
</section>