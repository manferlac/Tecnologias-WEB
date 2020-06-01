<section class="container-principal">
    <section id="nombre-valoracion-receta">
        <section>
            <h3><?php echo $receta->titulo; ?> </h3>
        </section>
        <section>
            <small id="autorReceta">Autor: <?php echo $receta->autor; ?></small>
        </section>
    </section>
    <section>
    <section id="descripcion">
        <section id="texto-descripcion">
            <p>
                <?php echo $receta->descripcion; ?>
            </p>
        </section>
        <section id="container-imagen-principal">
            <img src="<?php echo $receta->fotografia; ?>" alt="Imagen principal" id="imagen-principal">
        </section>
    </section>
    <section id="receta">
        <section id="ingredientes-receta">
            <ul>
                <?php
                    $arrayIngredientes = array();
                    $arrayIngredientes = explode(";", $receta->ingredientes);

                    foreach($arrayIngredientes as $ingre){
                        echo "<li>".$ingre."</li>";
                    }
                ?>
            </ul> 
        </section>
        <section id="pasos-receta">
            <ol>
                <?php
                    $arrayPreparacion = array();
                    $arrayPreparacion = explode(";", $receta->preparacion);

                    foreach($arrayPreparacion as $paso){
                        echo "<li>".$paso."</li>";
                    }
                ?>
            </ol>            
        </section>
    </section>
    <?php
    if(isset($_SESSION['username'])){
    ?>
    <section id="comentarios-barra">
        <section id="barra-edicion">
            <section id="edicion">
                <a id="editar" href="?p=Crud&id=<?php echo $receta->id; ?>"><img src="img/iconos/editar.png" alt="Editar"></a>
                <a onclick="javascript:return confirm('¿Seguro de eliminar esta receta?');" id="cancelar" href="?p=Eliminar&id=<?php echo $receta->id; ?>"><img src="img/iconos/cancelar.png" alt="Cancelar"></a>
            </section>
        </section>
    </section> 
    <?php
    }
    ?>
         
</section>
</section>