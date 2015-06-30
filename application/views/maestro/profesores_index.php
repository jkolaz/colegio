<!--Cuerpo web-->
<div class="container">
    <div class="container">
        <h1>Galería de <?php echo $titulo;?></h1>
        <ul class="breadcrumb">
            <li><a href="#">Home</a> <span class="divider">/</span></li>
            <li class="active"><?php echo $titulo;?></li>
        </ul>
        <div class="row-fluid mod-label">
            <form action="<?php echo $nuevo;?>" method='post'>
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-info"><i class="icon-plus icon-white"></i> <span>Registrar Profesor</span></button>
                    </div>
                </div>
            </form>
            <table class="table table-hover table-striped table-bordered toAddItem zebra-striped" id="buscador">
                <thead>
                    <tr>
                        <th width="4%">#</th>
                        <th width="10%">Codigo</th>
                        <th width="36%">Nombre del <?php echo $titulo;?> </th>
                        <th width="15%">DNI</th>
                        <th width="8%">Editar</th>
                        <th width="8%">Status</th>
                        <th width="10%">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if(count($listado) > 0){
                        foreach($listado as $indice =>$valor){
                            $generales = strtoupper($valor[2].' '.$valor[3]).', '.$valor[1];
                ?>
                    <tr>
                        <td><?php echo $indice +1?></td>
                        <td><?php  echo 'CODINTERNO';?></td>
                        <td class="text-info"><?php  echo $generales; ?></td>
                        <td class="text-info"><?php  echo $valor[4];?></td>
                        <td>
                            <a href="<?php echo base_url()?>index.php/configuracion/curso/editar/<?php echo $valor[0];?>">
                                <span class="btn btn-warning"><i class="icon-edit icon-white"></i></span>
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo base_url()?>index.php/maestro/maestro/estado/<?php echo $valor[0];?>">
                                <?php if($valor[5]==1){?>
                                    <span class="btn btn-success"><i class="icon-ok icon-white"></i></span>
                                <?php }else{?>	
                                    <span class="btn btn-danger cancel"><i class="icon-off icon-white"></i></span>
                                <?php }?>
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo base_url()?>index.php/maestro/maestro/eliminar_profesor/<?php echo $valor[0];?>">
                                <span class="btn btn-danger delete"><i class="icon-trash icon-white"></i></span>
                            </a>
                        </td>
                    </tr>
                <?php
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
<!--End Cuerpo-->