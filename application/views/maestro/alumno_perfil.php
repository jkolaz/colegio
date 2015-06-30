<script src="<?php echo base_url(); ?>assets/js/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#guardar').click(function(){
            //$('#guardar').attr("disabled", "disabled");
            if($('.required').val()==""){
                alert("falta alguno de los siguientes campos:\n\
                        * Contraseña Actual\n\
                        * Contraseña Nueva\n\
                        * Confirmar Contraseña");
                $('#txt_password_act').focus();
                return false;
            }else{
                $('#<?php echo $idform; ?>').submit();
            }
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
    <h3>Alumno : <?= $code.' - '.$nombre; ?></h3>
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
                </ul>
                <input type="hidden" id="id" name="id" value="" >
                <div class="tab-content">
                    <!-- Editor-->
                    <div class="tab-pane" id="editor">
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i>Image</label>
                            <div class="controls">
                                <img src="<?=  base_url()?>upload/<?= $image_alu?>" width="80px" height="120px">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i>Contraseña Actual</label>
                            <div class="controls">
                                <input class="input-xxlarge required" type="password" id="txt_password_act" name="txt_password_act" placeholder="Digite su contraseña">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i>Contraseña Nueva</label>
                            <div class="controls">
                                <input class="input-xxlarge required" type="password" id="txt_password_new" name="txt_password_new" placeholder="Ingrese contraseña nueva" value="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i>Confirme Contraseña Nueva</label>
                            <div class="controls">
                                <input class="input-xxlarge required" type="password" id="txt_password_conf" name="txt_password_conf" placeholder="Confirme su nueva contraseña" value="">
                            </div>
                        </div>
                    </div>
                </div>
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

