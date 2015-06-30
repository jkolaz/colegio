<script src="<?php echo base_url(); ?>assets/js/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function(){        
//        $('#editor_loco').on('keydown',function(e){
//            valor_tecla=String.fromCharCode(e.which);
//            $('#editor2').append(valor_tecla);
//        });
        $('#guardar').click(function(){
            //$('#<?php echo $idform; ?>').submit();
//            $('#guardar').attr("disabled", "disabled");
//            $('.cke_button__source').click();
//            valor_editor=$('#after_edit').val();
//            
//            count_comillas=valor_editor.split('"').length-1;
//            //alert(count_comillas);
//            i=0;
//            for(i=0;i<count_comillas;i++){
//                valor_editor=valor_editor.replace('"', "||");
//            }
//            
//            count_etiqueta_left=valor_editor.split('<').length-1;
//            j=0;
//            for(j=0;j<count_etiqueta_left;j++){
//                valor_editor=valor_editor.replace('<', "|left|");
//                valor_editor=valor_editor.replace('>', "|right|");               
//            }
//            
//            $('#contenido_editor').val(valor_editor.toString())
//            if($('#contenido_editor').val()==''){                
//                $('.cke_button__source').click();
//                $('#guardar').removeAttr("disabled");
//                return false;
//            }
            
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
                    <li><a href="#editor"><i class="icon icon-font"></i> Editor</a></li>
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
                                <input class="input-xxlarge" type="text" id="codigo" name="codigo" placeholder="<?php echo $placeholder;?>" value="<?php echo $value[1]; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i>Nivel</label>
                            <div class="controls">
                                <select name="cbo_nivel" id="cbo_nivel">
                                    <option value="1">PRIMARÍA</option>
                                    <option value="2">SECUNDARIA</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i> Titulo</label>
                            <div class="controls">
                                <input class="input-xxlarge" type="text" id="descripcion" name="descripcion" placeholder="<?php echo $placeholder1;?>" value="<?php echo $value[2]; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-pencil"></i> Nombre Corto</label>
                            <div class="controls">
                                <input class="input-xxlarge" type="text" id="nom_corto" name="nom_corto" placeholder="<?php echo $placeholder1;?>" value="<?php echo $value[6]; ?>">
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
                                <textarea class="ckeditor input-xxlarge" name="editor" id="editor"><?php echo $value[3]; ?></textarea>
                                <input type="hidden" name="contenido_editor" id="contenido_editor" value=""/>
                            </div>
                        </div>
                    </div>
                    <!--End Editor-->
                    
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