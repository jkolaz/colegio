<script src="<?php echo base_url(); ?>assets/js/ckeditor.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        
        $('#editor_loco').on('keydown',function(e){
            valor_tecla=String.fromCharCode(e.which);
            $('#editor2').append(valor_tecla);
        });
        $('#guardar').click(function(){
            //$('#<?php echo $idform; ?>').submit();
            $('#guardar').attr("disabled", "disabled");
            
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
                    <li><a href="#editor"><i class="icon icon-font"></i> Generales</a></li>
                    <li><a href="#seo"><i class="icon icon-search"></i> Procedencia</a></li>
                    <li><a href="#info"><i class="icon icon-info-sign"></i> Información</a></li>
                </ul>
                <?php
                    foreach ($datos as $key => $value) {
                ?>
                <input type="hidden" id="id" name="id" value="<?php echo $value[0]; ?>" >
                <div class="tab-content">
                    <!-- Editor-->
                    <div class="tab-pane" id="editor">
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i> Codigo</label>
                            <div class="controls">
                                <input class="input-xxmediun" type="text" id="codigo" name="codigo" autocomplete="off" placeholder="<?php echo $placeholder;?>" value="<?php echo $value[1]; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i> Nombre(s)</label>
                            <div class="controls">
                                <input class="input-xxmedium" type="text" id="nombre" name="nombre" autocomplete="off" placeholder="<?php echo $placeholder1;?>" value="<?php echo $value[2]; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i> Apellidos</label>
                            <div class="controls">
                                <input class="input-xxmedium" type="text" id="paterno" name="paterno" autocomplete="off" placeholder="<?php echo $placeholder2;?>" value="<?php echo $value[3]; ?>">
                                <input class="input-xxmedium" type="text" id="paterno" name="materno" autocomplete="off" placeholder="<?php echo $placeholder3;?>" value="<?php echo $value[4]; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i> D.N.I.</label>
                            <div class="controls">
                                <input class="input-xxmediun" type="text" id="dni" name="dni" placeholder="<?php echo $placeholder4;?>" value="<?php echo $value[5]; ?>">
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
                                <textarea class="ckeditor input-xxlarge" name="editor" id="editor"><?php echo $value[6]; ?></textarea>
                                <input type="hidden" name="contenido_editor" id="contenido_editor" value=""/>
                            </div>
                        </div>
                    </div>
                    <!--End Editor-->
                    <div class="tab-pane" id="seo">
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i> Fecha de Nacimiento</label>
                            <div class="controls">
                                <input class="input-xxmedium" type="text" id="fecha_nac" name="fecha_nac" placeholder="Fecha de Nacimiento" value="<?php echo $value[7]; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i> Lugar de Nacimiento</label>
                            <div class="controls">
                                <input class="input-xxmedium" type="text" id="lugar_nac" name="lugar_nac" placeholder="Lugar de nacimiento" value="<?php echo $value[8]; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i> Lugar de Residencia</label>
                            <div class="controls">
                                <input class="input-xxmedium" type="text" id="lugar_red" name="lugar_red" placeholder="Lugar de residencia" value="<?php echo $value[9]; ?>">
                                <input class="input-xxlarge" type="text" id="direccion" name="direccion" placeholder="Direccion" value="<?php echo $value[10]; ?>">
                            </div>
                        </div>
                    </div>
                    <!-- End SEO-->
                    <!-- Info-->
                    <div class="tab-pane" id="info">
                        <table class="table table-striped tablesort">
                            <tbody>
                                <tr>
                                    <td><i class="icon-globe icon-grey"></i> Enlace a la página</td>
                                    <td><a target="_blank" href="http://www.ideas-studio.pe/quienes_somos.php">http://www.ideas-studio.pe/quienes_somos.php</a></td>
                                </tr>
                                <tr>
                                    <td><i class="icon-hdd icon-grey"></i> Numero ID</td>
                                    <td><?php echo $value[0]; ?></td>
                                </tr>
                                <tr>
                                    <td><i class="icon-calendar icon-grey"></i> Fecha de Creación </td>
                                    <td><?php echo $value[4]; ?></td>
                                </tr>
                                <tr>
                                    <td><i class="icon-calendar icon-grey"></i> Última actualización</td>
                                    <td><?php echo $value[5]; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- End Info-->
                </div>
                <?php
                    }
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
