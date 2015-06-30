<script src="<?php echo base_url(); ?>assets/js/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#guardar').click(function(){
            //$('#guardar').attr("disabled", "disabled");
            if($('.required').val()==""){
                alert("falta");
                return false;
            }else{
                $('#<?php echo $idform; ?>').submit();
            }
        }); 
        $('#generar').click(function(){
            var url = '<?=base_url()._CONF;?>prehorario';
            location.href = url;
        });
    });
</script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/k-editor.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.fileupload-ui.css">
<style type="text/css">
    <?php echo $error_close_style; ?>
</style>
<div class="container">
    <?php echo $error; ?>
    <h1><?php echo $modulo; ?></h1>
    <ul class="breadcrumb">
        <li><a href="#">Home</a> <span class="divider">/</span></li>
        <li class="active"><?php echo $modulo; ?></li>
    </ul>
    <div class="row-fluid mod-label">
        <form class="form-horizontal" action="<?php echo $action; ?>" method="post" id="<?php echo $idform ?>" enctype="multipart/form-data">
            <fieldset>
                <legend>Información del Contenido</legend>
                <ul class="nav nav-tabs" id="myTab">
                    <li><a href="#editor"><i class="icon icon-font"></i> Editor</a></li>
                    <li><a href="#primaria"><i class="icon icon-info-sign"></i> Primaria</a></li>
                    <li><a href="#secundaria"><i class="icon icon-info-sign"></i> Secundaria</a></li>
                    <li><a href="#administracion"><i class="icon icon-info-sign"></i> Administración</a></li>
                </ul>
                <input type="hidden" id="id" name="id" value="<?php echo $datos[0]->CONF_Codigo; ?>" >
                <div class="tab-content">
                    <!-- Editor-->
                    <div class="tab-pane" id="editor">
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i> Año Escolar</label>
                            <div class="controls">
                                <input class="input-xxlarge required" type="text" id="anio" name="anio" placeholder="<?php echo $placeholder;?>" value="<?php echo $datos[0]->CONF_Anio;?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i> Correlativo</label>
                            <div class="controls">
                                <input class="input-xxlarge required" type="text" id="correlativo" name="correlativo" placeholder="Digite el numero correlativo" value="<?php echo $datos[0]->CONF_Correlativo;?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-picture"></i> Icono</label>
                            <div class="controls">
                                <span class="btn btn-success fileinput-button">
                                    <i class="icon-plus icon-white"></i>
                                    <span>Adjuntar Icono...</span>
                                    <input type="file" name="files" accept="image/*" id="files"/>
                                </span>
                                <p>Tama&ntilde;o m&aacute;ximo de &iacute;cono: <?php echo $size_img; ?></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i> Editar Contenido</label>
                            <div class="controls">
                                <textarea class="ckeditor input-xxlarge required" name="editor" id="editor"><?php echo $datos[0]->CONF_Codigo; ?></textarea>
                                <input type="hidden" name="contenido_editor" id="contenido_editor" value=""/>
                            </div>
                        </div>
                    </div>
                    <!-- primaria-->
                    <div class="tab-pane" id="primaria">
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i>Hora de entrada</label>
                            <div class="controls">
                                <input class="input-xxlarge required" type="text" id="pri_ent" name="pri_ent" placeholder="hora de inicio" value="<?php echo $datos[0]->CONF_PRHoraInicio;?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i>Hora de salida</label>
                            <div class="controls">
                                <input class="input-xxlarge required" type="text" id="pri_sal" name="pri_sal" placeholder="hora de salida" value="<?php echo $datos[0]->CONF_PRHoraFin;?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i>Duración de recreo (min)</label>
                            <div class="controls">
                                <input class="input-xxlarge required" type="text" id="pri_rec" name="pri_rec" placeholder="Duración de recreo (min)" value="<?php echo $datos[0]->CONF_PRReseso;?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i>cantidad de horas academicas</label>
                            <div class="controls">
                                <input class="input-xxlarge required" type="text" id="pri_cant" name="pri_cant" placeholder="cantidad de horas academicas" value="<?php echo $datos[0]->CONF_PRCanthours;?>">
                            </div>
                        </div>
                    </div>
                    <!-- End primaria-->
                    <!-- secundaria-->
                    <div class="tab-pane" id="secundaria">
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i>Hora de entrada</label>
                            <div class="controls">
                                <input class="input-xxlarge required" type="text" id="sec_ent" name="sec_ent" placeholder="hora de inicio" value="<?php echo $datos[0]->CONF_SEHoraInicio;?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i>Hora de salida</label>
                            <div class="controls">
                                <input class="input-xxlarge required" type="text" id="sec_sal" name="sec_sal" placeholder="hora de salida" value="<?php echo $datos[0]->CONF_SEHoraFin;?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i>Duración de recreo (min)</label>
                            <div class="controls">
                                <input class="input-xxlarge required" type="text" id="sec_rec" name="sec_rec" placeholder="Duración de recreo (min)" value="<?php echo $datos[0]->CONF_SEReseso;?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i>cantidad de horas academicas</label>
                            <div class="controls">
                                <input class="input-xxlarge required" type="text" id="sec_cant" name="sec_cant" placeholder="cantidad de horas academicas" value="<?php echo $datos[0]->CONF_SECantHours;?>">
                            </div>
                        </div>
                    </div>
                    <!-- End secundaria-->
                    <!-- administracion-->
                    <div class="tab-pane" id="administracion">
                         <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i>Menú</label>
                            <div class="controls">
                                <ul>
                                    <?php
                                    foreach ($menuPadre as $valor){
                                    ?>
                                    <li>
                                        <input type="checkbox" name="vehicle" value="Bike"><?=$valor->MEN_Descripcion?>
                                        <ul>
                                            <?php
                                            foreach ($valor->submenu as $value){
                                            ?>
                                            <li><input type="checkbox" name="vehicle" value="Bike"><?=$value->MEN_Descripcion?></li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="button" class="btn btn-info" <?=$disabled?> id="generar" name="generar"><i class="icon-ok icon-white"></i> <span>Generear Pre-Horario</span></button>
                            </div>
                        </div>
                    </div>
                    <!-- Fin administracion-->
                </div>
                <?php
                    echo $oculto;
                ?>
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

