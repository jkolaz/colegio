<!--Cuerpo web-->
<div class="container">
    <div class="container">
        <h1><?php echo $titulo;?></h1>
        <ul class="breadcrumb">
            <li><a href="#">Home</a> <span class="divider">/</span></li>
            <li class="active"><?php echo $titulo;?></li>
        </ul>
        <div class="row-fluid mod-label">
            <table class="table table-hover table-striped table-bordered toAddItem zebra-striped" id="buscador">
                <thead>
                    <tr>
                        <th width="4%">#</th>
                        <th width="10%">Grado</th>
                        <th width="15%">Secciones</th>
                        <th width="8%">Ver<br>Grados</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if(count($listado) > 0){
                        foreach($listado as $indice =>$valor){
                            
                ?>
                    <tr>
                        <td><?php echo $indice +1?></td>
                        <td><?php  echo $valor->texto;?></td>
                        <td class="text-info">
                            <table width="200px">
                                <tbody>
                                    <tr>
                                        <th>dfdd</th>
                                        <th>dfdd</th>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <a href="<?php echo base_url()._GRADO; ?>listar/">
                                <span class="btn btn-inverse"><i class="icon-edit icon-white"></i></span>
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