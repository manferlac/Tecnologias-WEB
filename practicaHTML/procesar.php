<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>QUÉ LIBROS!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="img/logo.png"/>
    </head>
    <body>
        <?php
            echo "<p>Variables POST: </p>";
            echo "<ul>";
            foreach ($_POST as $c => $v){
                if(is_array($v)){
                    echo "<li>$c = ";
                    print_r($v);
                    echo "</li>";
                }else
                    echo "<li>$c = $v</li>";
            }
            echo "</ul>";
        ?>
    </body>
</html>