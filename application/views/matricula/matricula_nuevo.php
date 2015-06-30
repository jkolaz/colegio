
<script type="text/javascript">
    $(document).ready(function(){        
        $('#editor_loco').on('keydown',function(e){
            valor_tecla=String.fromCharCode(e.which);
            $('#editor2').append(valor_tecla);
        });
        $('#guardar').click(function(){            
            $('#<?php echo $idform; ?>').submit();
        });   
        
        $('#error_close').click(function(){
            $('#error_box').fadeOut('slow', $('#error_box').remove());
        })
        
    });
</script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/k-editor.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.fileupload-ui.css">
<style type="text/css">
    <?php echo $error_close_style; ?>
</style>
<div class="container">
    <?php echo $error; ?>
    <h1>
        <?= $modulo; ?>:
        <?php 
        foreach ($grado as $i){
            echo $i->anio." - ".$i->seccion."/".$i->nivel."/".$i->turno;
        }
        ?>
    </h1>
    <ul class="breadcrumb">
        <li><a href="#">Home</a> <span class="divider">/</span></li>
        <li class="active"><?php echo $modulo; ?></li>
    </ul>
    <div class="row-fluid mod-label">
        <form class="form-horizontal" accept-charset="utf-8" action="<?php echo $action; ?>" method="post" id="<?php echo $idform ?>" enctype="multipart/form-data">
            <?php foreach ($grado as $j){ ?>
            <input type="hidden" name="txt_anio" id="txt_anio" value="<?=$j->AN_Codigo?>"/>
            <input type="hidden" name="txt_nivel" id="txt_nivel" value="<?=$j->NIV_Codigo?>"/>
            <input type="hidden" name="txt_turno" id="txt_turno" value="<?=$j->TUR_Codigo?>"/>
            <input type="hidden" name="txt_secc" id="txt_secc" value="<?=$j->SEC_Codigo?>"/>
            <?php }?>
            <fieldset>
                <legend>Información del Contenido</legend>
                <ul class="nav nav-tabs" id="myTab">
                    <li><a href="#editor"><i class="icon icon-font"></i> Datos del alumno</a></li>
                    <li><a href="#tutor"><i class="icon icon-font"></i> Padre o Tutor</a></li>
                    <li><a href="#procedencia"><i class="icon icon-font"></i> Notas</a></li>
                    <li><a href="#adjunto"><i class="icon icon-font"></i> Doc. Adjuntos</a></li>
                </ul>
                <input type="hidden" id="id" name="id" value="" >
                <div class="tab-content">
                    <!-- Editor-->
                    <div class="tab-pane" id="editor">
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i> I. E. Anterior</label>
                            <div class="controls">
                                <input class="input-xxmedium" type="text" id="alu_procedencia" name="alu_procedencia" placeholder="Nombre del alumno" value="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i> Nombre(s)</label>
                            <div class="controls">
                                <input class="input-xxmedium" type="text" id="alu_nombre" name="alu_nombre" placeholder="Nombre del alumno" value="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i> Apellidos</label>
                            <div class="controls">
                                <input class="input-xxmedium" type="text" id="alu_paterno" name="alu_paterno" placeholder="Apellido paterno" value="">
                                <input class="input-xxmedium" type="text" id="alu_materno" name="alu_materno" placeholder="Apellido materno" value="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i> D.N.I.</label>
                            <div class="controls">
                                <input class="input-xxmediun" type="text" id="alu_dni" name="alu_dni" placeholder="D.N.I. del alumno" value="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i> Sexo</label>
                            <div class="controls">
                                <select name="alu_sexo" id="alu_sexo">
                                    <option>-- Seleccione --</option>
                                    <option value="M">Hombre</option>
                                    <option value="F">Mujer</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i> Fecha de Nacimiento</label>
                            <div class="controls">
                                <input class="input-xxmediun" type="text" id="alu_nac" name="alu_nac" placeholder="Fecha de Nacimiento" value="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-picture"></i> Icono</label>
                            <div class="controls">
                                <span class="btn btn-success fileinput-button">
                                    <i class="icon-plus icon-white"></i>
                                    <span>Adjuntar Icono...</span>
                                    <input type="file" name="files" id="files"/>
                                </span>
                                <p>Tama&ntilde;o m&aacute;ximo de &iacute;cono: <?php echo $size_img; ?></p>
                            </div>
                        </div>
                    </div>
                    <!--Ini Tutor-->
                    <div class="tab-pane" id="tutor">
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i> Nombre del padre o tutor</label>
                            <div class="controls">
                                <input class="input-xxmediun" type="text" id="pad_nombre" name="pad_nombre" placeholder="Nombre" value="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i> Apellidos del padre o tutor</label>
                            <div class="controls">
                                <input class="input-xxmediun" type="text" id="pad_paterno" name="pad_paterno" placeholder="Apellido materno" value="">
                                <input class="input-xxmediun" type="text" id="pad_materno" name="pad_materno" placeholder="Apellido paterno" value="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i> D.N.I. del padre o tutor</label>
                            <div class="controls">
                                <input class="input-xxmediun" type="text" id="pad_dni" name="pad_dni" placeholder="D.N.I. del padre o tutor" value="">
                            </div>
                        </div>
                    </div>
                    <!--End Tutor-->
                    <!--Ini Notas-->
                    <div class="tab-pane" id="procedencia">
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i> Cursos</label>
                            <div class="controls">
                                <table class="table table-hover table-striped table-bordered toAddItem zebra-stripe" id="buscador">
                                    <tbody>
                                        <tr>
                                            <th>Matematica</th>
                                            <th>Lenguaje</th>
                                            <th>P.F.R.H.<br><span>Persona Familia y Relaciones Humanas</span></th>
                                            <th>C.T.A<br><span>Ciencia Tecnología y Ambiente</span></th>
                                            <th>Ciencias Sociales</th>
                                        </tr>
                                        <tr>
                                            <td><input class="input-mini" type="text" id="txt_1" name="txt_1" placeholder="Nota" value=""></td>
                                            <td><input class="input-mini" type="text" id="txt_2" name="txt_2" placeholder="Nota" value=""></td>
                                            <td><input class="input-mini" type="text" id="txt_3" name="txt_3" placeholder="Nota" value=""></td>
                                            <td><input class="input-mini" type="text" id="txt_4" name="txt_4" placeholder="Nota" value=""></td>
                                            <td><input class="input-mini" type="text" id="txt_5" name="txt_5" placeholder="Nota" value=""></td>
                                        </tr>
                                        <tr>
                                            <th>Ingles</th>
                                            <th>Educación Religiosa</th>
                                            <th>Educación Fisica</span></th>
                                            <th>R.M.<br><span>Razonamiento Matematico</span></th>
                                            <th>R.V.<br><span>Razonamiento Verbal</span></th>
                                        </tr>
                                        <tr>
                                            <td><input class="input-mini" type="text" id="txt_6" name="txt_6" placeholder="Nota" value=""></td>
                                            <td><input class="input-mini" type="text" id="txt_7" name="txt_7" placeholder="Nota" value=""></td>
                                            <td><input class="input-mini" type="text" id="txt_8" name="txt_8" placeholder="Nota" value=""></td>
                                            <td><input class="input-mini" type="text" id="txt_9" name="txt_9" placeholder="Nota" value=""></td>
                                            <td><input class="input-mini" type="text" id="txt_10" name="txt_10" placeholder="Nota" value=""></td>
                                        </tr>
                                        <tr>
                                            <th>E.P.T.<br><span>Educación por el Trabajo</span></th>
                                        </tr>
                                        <tr>
                                            <td><input class="input-mini" type="text" id="txt_11" name="txt_11" placeholder="Nota" value=""></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--End Notas-->
                </div>
                <?= $oculto;?>
                <div class="control-group">
                    <div class="controls">
                        <button type="button" class="btn btn-info" id="guardar"><i class="icon-ok icon-white"></i> <span>Guardar</span></button>
                        <a href="<?php echo $btnCancelar; ?>"><button type="button" class="btn btn-danger cancel" id="btn-cancelar"><i class="icon-ban-circle icon-white"></i> <span>Cancelar</span></button></a>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
