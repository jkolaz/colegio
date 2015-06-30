<!--Cuerpo web-->
<div class="container">
    <div class="container">
        <h1>Lista de <?php echo $titulo;?></h1>
        <ul class="breadcrumb">
            <li><a href="#">Home</a> <span class="divider">/</span></li>
            <li class="active"><?php echo $titulo;?></li>
        </ul>
        <div class="row-fluid mod-label">
            <form action="<?php echo $nuevo;?>" method='post'>
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-info"><i class="icon-plus icon-white"></i> <span>Registrar Curso</span></button>
                    </div>
                </div>
            </form>
            <table class="table table-hover table-striped table-bordered toAddItem zebra-striped" id="buscador">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="10%">Codigo</th>
                        <th width="55%" colspan="2">Nombre del <?php echo $titulo;?> </th>
                        <th width="10%">Nivel</th>
                        <th width="5%">Profesores</th>
                        <th width="5%">Editar</th>
                        <th width="5%">Status</th>
                        <th width="5%">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if(is_array($listado)){
                                                //print_r($listado);
                        foreach($listado as $indice =>$valor){								
                ?>
                    <tr>
                        <td><?php echo $indice +1?></td>
                        <td><?php  echo $valor->CUR_CodigoInterno;?></td>
                        <td class="text-info"><?= $valor->CUR_Descripcion;?></td>
                        <td class="text-info"><?= $valor->CUR_NomCorto;?></td>
                        <td class="text-info"><?= $valor->NIV_Text;?></td>
                        <td>
                            <a href="<?php echo base_url()?>index.php/configuracion/curso/profesor/<?php echo $valor->CUR_Codigo;?>">
                                <span class="btn btn-success"><i class="icon-edit icon-white"></i></span>
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo base_url()?>index.php/configuracion/curso/editar/<?php echo $valor->CUR_Codigo;?>">
                                <span class="btn btn-warning"><i class="icon-edit icon-white"></i></span>
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo base_url()?>index.php/configuracion/curso/estado/<?php echo $valor->CUR_Codigo;?>">
                                <?php if($valor->CUR_FlagEstado==1){?>
                                    <span class="btn btn-success"><i class="icon-ok icon-white"></i></span>
                                <?php }else{?>	
                                    <span class="btn btn-danger cancel"><i class="icon-off icon-white"></i></span>
                                <?php }?>
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo base_url()?>index.php/configuracion/curso/eliminar/<?php echo $valor->CUR_Codigo;?>">
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