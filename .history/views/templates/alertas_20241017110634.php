<?php

foreach($alertas as $key => $mensajes):
    foreach($mensajes as $mensaje):
?>
    <div class="alerta <?php echo $key; ?>" ></div>
<?php
    endforeach; 
endforeach;

?>