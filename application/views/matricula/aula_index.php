<script>
    $(document).ready(function(){
        $('#btnPDF').on('click', function(){
            location.href = "../PDF/"+$('#aula').val();
        });
    });
</script>
<!--Cuerpo web-->
<input type="hidden" name="aula" id="aula" value="<?= $id ?>"/>
<div class="container">
    <div class="container">
        <h1><?= $grado[0]->anio." '".$grado[0]->seccion."' DE ".$grado[0]->nivel." / Turno: ".$grado[0]->turno;?></h1>
        <ul class="breadcrumb">
            <li><a href="#">Home</a> <span class="divider">/</span></li>
            <li class="active"><?php echo $titulo;?></li>
        </ul>
        <div class="row-fluid mod-label">
            <form action="<?php echo $nuevo;?>" method='post'>
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-info"><i class="icon-plus icon-white"></i> <span>Registrar Nueva Matricula</span></button>
                    </div>
                </div>
            </form>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-danger" id="btnPDF"><i class="icon-plus icon-white"></i> <span>Relación de alumnos</span></button>
                </div>
            </div>
            <table class="table table-hover table-striped table-bordered toAddItem zebra-striped" id="buscador">
                <thead>
                    <tr>
                        <th width="4%">#</th>
                        <th width="10%">Código</th>
                        <th width="15%">Alumno</th>
                        <th width="15%">Padre o Tutor</th>
                        <th width="8%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if(count($listado) > 0){
                        foreach($listado as $indice =>$valor){
                            
                ?>
                    <tr>
                        <td><?php echo $indice +1?></td>
                        <td><?php  echo $valor->MM_Code;?></td>
                        <td class="text-info" style="text-transform: capitalize;"><?=$valor->ALU_Dni." - ".$valor->ALU_Nombre." ".$valor->ALU_Paterno." ".$valor->ALU_Materno?></td>
                        <td class="text-info" style="text-transform: capitalize;"><?=$valor->PER_Dni." - ".$valor->PER_Nombre." ".$valor->PER_Materno." ".$valor->PER_Paterno?></td>
                        <td>
                            <a href="<?php echo base_url()._GRADO; ?>listar/">
                                <span class="btn btn-success"><i class="icon-edit icon-white"></i></span>
                            </a>
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