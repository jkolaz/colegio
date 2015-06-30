<!-- Bootstrap Image Gallery styles -->
<link rel="stylesheet" href="http://blueimp.github.com/Bootstrap-Image-Gallery/css/bootstrap-image-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fileupload/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.fileupload-ui-noscript.css"></noscript>
<!-- Shim to make HTML5 elements usable in older Internet Explorer versions -->
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<!--Cuerpo web-->

<div class="container">
    <h1>Galería de <?php echo $titulo;?></h1>
    <ul class="breadcrumb">
        <li><a href="#">Home</a> <span class="divider">/</span></li>
        <li class="active">Registro de <?php echo $titulo;?></li>
    </ul>
    <div class="row-fluid mod-label">
        <form id="fileupload" action="<?php echo base_url() . 'index.php/multimedia/multimedia/upload_img'; ?>" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Información del Contenido</legend>
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#banner"><i class="icon icon-picture"></i> <?php echo $titulo;?></a></li>
                    <li><a href="#info"><i class="icon icon-info-sign"></i> Información</a></li>
                </ul>
                <div class="tab-content">
                    <!-- Tabs -->
                    <div class="tab-pane active" id="banner">
                        <!-- banner Edit-->
                        <div class="control-group">
                            <label class="control-label"><i class="icon-file"></i> Codigo:</label>
                            <div class="controls">
                                <input id="codigo" name="codigo" class="input-xlarge" type="text" aria-controls="buscador">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><i class="icon-file"></i> Nombre:</label>
                            <div class="controls">
                                <input id="descripcion" name="descripcion" class="input-xlarge" type="text" aria-controls="buscador">
                            </div>
                        </div>
                        <br>                        
                    </div>
                    <!-- End Banner -->
                    <!-- Info-->
                    <div class="tab-pane" id="info">
                        <table class="table table-striped tablesort">
                            <tbody>
                                <tr>
                                    <td><i class="icon-globe icon-grey"></i> Enlace a la página</td>
                                    <td><a target="blank" href="http://www.ideas-studio.pe/index.php">http://www.ideas-studio.pe/index.php</a></td>
                                </tr>
                                <tr>
                                    <td><i class="icon-hdd icon-grey"></i> Numero ID</td>
                                    <td>737</td>
                                </tr>
                                <tr>
                                    <td><i class="icon-calendar icon-grey"></i> Fecha de Creación </td>
                                    <td>2013-03-18 1:18:31</td>
                                </tr>
                                <tr>
                                    <td><i class="icon-calendar icon-grey"></i> Última actualización</td>
                                    <td>2013-03-18 1:21:42</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- End Info-->
                </div>
            </fieldset>
        </form>
        <form action="<?php echo $btnAceptar;?>" method='post'>
            <input type='hidden' name='entrada' id='entrada' />
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-info">
                        <i class="icon-ok icon-white"></i>
                        <span>Guardar</span>
                    </button>
                    <a href='<?php echo $btnCancelar;?>'>
                        <button type="button" class="btn btn-danger cancel">
                            <i class="icon-ban-circle icon-white"></i> <span>Cancelar</span>
                        </button>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
<!--End Cuerpo-->