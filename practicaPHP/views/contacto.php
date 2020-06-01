<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $nombre = trim($_POST['nombre']);
      $correo = trim($_POST['correo']);
      $telefono = trim($_POST['telefono']);
      $comentario = trim($_POST['comentarioContacto']);

      $ok = true;

      if(empty($nombre)){
        $errorNombre = "El nombre no puede estar vacío";
        $ok = false;
      }
      if(empty($correo)){
        $errorCorreo = "El correo no puede estar vacío";
        $ok = false;
      }
      if(!empty($correo) AND !filter_var($correo, FILTER_VALIDATE_EMAIL)){
        $errorCorreo = "El correo introducido no es válido";
        $ok = false;
      }

      if(!preg_match("/^[9|8|6|7][0-9]{8}$/", $telefono) AND !preg_match("/^6[0-9]{8}$/", $telefono)){
        $errorTelefono = "Formato de teléfono incorrecto";
        $ok = false;
      }

      if(empty($comentario)){
        $errorComentario = "El comentario no puede estar vacío";
        $ok = false;
      }
      if($ok){
        $recibido = "El mensaje ha sido enviado con éxito con los siguientes datos: \nNombre: $nombre\nCorreo electrónico: $correo\nTeléfono: $telefono\nComentario: $comentario";
      }
  }
?>

<section class="container-principal">
    <section id="nombre-valoracion-receta">
        <section>
            <h3>Contacto</h3>
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
            <form method="post" id="contacto">
                <section>
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="inputContacto" id="nombre" name="nombre" >
                    <span class="error"><?php if(isset($errorNombre)) echo $errorNombre ?></span>
                </section>
                <section>
                    <label for="correo">Correo electrónico:</label>
                    <input type="text" class="inputContacto" id="correo" name="correo" placeholder="Ej. micorreo@dominio.com">
                    <span class="error"><?php if(isset($errorCorreo)) echo $errorCorreo ?></span>
                </section>
                <section>
                    <label for="telefono">Teléfono:</label>
                    <input type="tel" class="inputContacto" id="telefono" name="telefono" placeholder="No permite prefijos">
                    <span class="error"><?php if(isset($errorTelefono)) echo $errorTelefono ?></span>
                </section>
                <section>
                    <label for="comentario">Comentario:</label>
                    <textarea id="comentarioContacto" name="comentarioContacto" rows="4" cols="50" form="contacto">
                    </textarea>
                    <span class="error"><?php if(isset($errorComentario)) echo $errorComentario ?></span>
                </section>
                <section>
                    <input type="submit" value="Enviar"><br>
                </section>
                <section>
                    <span class="recibido"><?php if(isset($recibido)) echo $recibido ?></span>
                </section>
            </form>
        </section>
    </section>
</section>