<?php
echo 'cantidad: '.count($listado);
if(count($listado) > 0){
                        foreach($listado as $indice =>$valor){
                            echo $valor[1];
                        }
}
?>
