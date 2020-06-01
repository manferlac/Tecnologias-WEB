<?php
if(!isset($_SESSION['username'])){
    header('Location: ?p=404');
  }
?>
<section class="container-principal">
    <section id="nombre-valoracion-receta">
        <section>
            <h3>
            <?php echo 'Confirmar '.$receta->titulo ?>
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
            <form method="post" id="contacto" action="?p=Guardar">
            <input type="hidden" name="id" value="<?php if(isset($receta->id)) echo $receta->id ?>">
            <section>
                <label for="tituloReceta">Título:</label>
                <input type="text" class="inputContacto" id="tituloReceta" name="tituloReceta" value="<?php echo $receta->titulo ?>" readonly>
            </section>
            <section>
                <label for="categoriaReceta">Categoría:</label>
                <input type="text" class="inputContacto" id="categoriaReceta" name="categoriaReceta" value="<?php echo $receta->categoria ?>" readonly>
            </section>
            <section>
                <label for="autorReceta">Autor:</label>
                <input type="text" class="inputContacto" id="autorReceta" name="autorReceta" value="<?php echo $_SESSION['username'] ?>" readonly>
            </section>
            <section>
                <label for="descripcionReceta">Descripción:</label>
                <textarea id="descripcionReceta" name="descripcionReceta" rows="8" cols="100" readonly>
                    <?php echo $receta->descripcion ?>
                </textarea>
            </section>
            <section>
                <label for="ingredientesReceta">Ingredientes:</label>
                <textarea id="ingredientesReceta" name="ingredientesReceta" rows="8" cols="100" readonly>
                    <?php echo $receta->ingredientes ?>                
                </textarea>
            </section>
            <section>
                <label for="preparacionReceta">Preparación:</label>
                <textarea id="preparacionReceta" name="preparacionReceta" rows="8" cols="100" readonly>
                    <?php echo $receta->preparacion ?>              
                </textarea>
            </section>
            <section id="imagenConfirmacion">
                <img src="<?php echo $receta->fotografia ?>" alt="Imagen principal" id="imagen-principal">
                <input type="hidden" name="imagenReceta" value="<?php echo $receta->fotografia ?>">
            </section>
            <section>
                <input type="submit" value="Confirmar">
            </section>
            </form>
        </section>
    </section>
</section>