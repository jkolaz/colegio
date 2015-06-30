<!--Cuerpo web-->
<div class="container">
    <div class="container">
        <h1><?php echo $titulo;?>(<?php echo count($listado); ?>)</h1>
        <ul class="breadcrumb">
            <li><a href="#">Home</a> <span class="divider">/</span></li>
            <li class="active"><?php echo $titulo;?></li>
        </ul>
        <div class="row-fluid mod-label">
            <table class="table table-hover table-striped table-bordered toAddItem zebra-striped" id="buscador">
                <thead>
                    <tr>
                        <th rowspan="3">Grado</th>
                        <th>Niveles</th>
                    </tr>
                    <?php if(count($listado) > 0){ ?>
                    <tr>
                        <?php foreach($listado as $indice =>$valor){ ?>
                        <th width="15%" colspan="<?php echo count($valor->turno); ?>"><?php  echo $valor->NIV_Desc."(".$valor->cant_grados.")";?></th>
                        <?php } ?>
                    </tr>
                    <tr>
                        <?php 
                            foreach($listado as $i =>$valor){
                                foreach ($valor->turno as $j=>$turno){
                        ?>
                        <th><?php echo $turno->turno; ?></th>
                        <?php
                                }
                            }
                        ?>
                    </tr>
                    <?php } ?>
                </thead>
                <?php if(count($lista_body)>0){ ?>
                <tbody>
                    <?php foreach ($lista_body as $k=>$value){ ?>
                    <tr>
                        <td><?= $value->AN_AnioText; ?></td>
                        <?php 
                            foreach ($value->nivel as $j=>$val){
                                foreach ($val->turno as $l=>$valor){
                        ?>
                        <td>
                            <?php 
                                if(is_array($valor->grados)){
                                    foreach ($valor->grados as $va) { 
                            ?>
                            <a href="<?=base_url()._MATRICULA."nuevo/".$va->AE_Codigo?>" title="Registrar matricula"><font style="font-size: 16px; font-weight: bold"><?=$va->seccion?></font></a>
                            <a href="<?= base_url()._MATRICULA?>aulaListar/<?=$va->AE_Codigo?>" title="<?=$va->cap." alumnos matriculados de ".$va->AE_Capacidad?>"><?= "(".$va->cap."/".$va->AE_Capacidad.")"; ?></a>
                            <font style="font-style: italic; font-size: 16px; font-weight: bold;">
                                <a href="<?=base_url()._HORARIO?>horario_aula/<?=$va->AE_Codigo?>" style="color: goldenrod;">Ver Horario</a>
                            </font>
                            <br>
                            <?php 
                                    }
                                }else{
                                    echo $valor->grados;
                                }
                            ?>
                        </td>
                        <?php
                                }
                            }
                        ?>
                    </tr>
                    <?php } ?>
                </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
<!--End Cuerpo-->