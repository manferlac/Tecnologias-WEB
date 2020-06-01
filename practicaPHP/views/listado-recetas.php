<?php
$controller = 'recetaController';
require_once "controllers/$controller.php";
$controller = ucwords($controller);
$controller = new $controller;

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(empty($_POST['titulo']) AND empty($_POST['orden'])){
        header('Location: ?p=recetas');
    }else{
        if(!empty($_POST['titulo'])){
            $titulo = $_POST['titulo'];
        }else{
            $titulo = FALSE;
        }

        if(!empty($_POST['orden'])){
            $orden = $_POST['orden'];
        }else{
            $orden = FALSE;
        }

        header('Location: ?p=Filtrar&titulo='.$titulo.'&orden='.$orden.'');
    }
  }
?>

<section class="container-principal">
    <section id="nombre-valoracion-receta">
        <section>
            <h3>Listado de recetas</h3>
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
            
            <section id="filtro">
                <h4>Filtro y ordenación</h4>
                <form method="post">
                    <label for=titulo>Título:</label>
                    <input type="text" id="titulo" name="titulo"><br>
                    <input type="radio" id="orden" name="orden" value="ascendente">
                    <label for="ascendente">Ascendente</label><br>
                    <input type="radio" id="orden" name="orden" value="descendente">
                    <label for="descendente">Descendente</label><br>
                    <input type="submit" value="Filtrar">
                </form>
            </section>
            <section id="confirmacion">
                <?php if(isset($new_receta)){
                ?>
                    <span class="recibido">
                        <?php if($new_receta){echo $tituloReceta .' creada con éxito';}else{echo $tituloReceta .' editada con éxito';} ?>
                    </span>
                <?php
                } ?>
            </section>
            <section id="listado-recetas">
                <?php
                    if(isset($sin_resultados)){
                ?>
                    <h4>No se ha encontrado ninguna receta</h4>
                <?php
                    }else{
                ?>
                <table>
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Categoría</th>
                            <th>Visualizar</th>
                            <?php
                            if(isset($_SESSION['username'])){
                            ?>
                            <th>Editar</th>           
                            <th>Borrar</th>
                            <?php
                            }
                            ?>   
                        </tr>
                    </thead>
                    <tbody id="edicion">
                        <?php foreach($recetas as $r): ?>
                        <tr>
                            <td><?php echo $r->titulo; ?></td>
                            <td><?php echo $r->categoria; ?></td>
                            <td><a id="editar" href="?p=Visualizar&id=<?php echo $r->id; ?>"><img src="img/iconos/visualizar.png" alt="Visualizar"></a></td>
                            <?php
                                if(isset($_SESSION['username'])){
                            ?>
                            <td><a id="editar" href="?p=Crud&id=<?php echo $r->id; ?>"><img src="img/iconos/editar.png" alt="Editar"></a></td>
                            <td><a id="cancelar" onclick="javascript:return confirm('¿Seguro de eliminar esta receta?');" href="?p=Eliminar&id=<?php echo $r->id; ?>"><img src="img/iconos/cancelar.png" alt="Cancelar"></a></td>
                            <?php
                                }
                            ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php
                    }
                ?>
                
            </section>
        </section>
    </section>
</section>