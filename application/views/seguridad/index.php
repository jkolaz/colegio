<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>.:: COLEGIO - Login::.</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="<?php echo base_url(); ?>assets/css/login.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
            <!--[if lt IE 9]>
              <script src="assets/js/html5shiv.js"></script>
            <![endif]-->
    </head>
    <body class="home yui-skin-sam" data-twttr-rendered="true">
        <!-- Contendor general-->
        <div class="wrapper">
            <div class="container">
                <div id="logeo-user" class="loginbox">
                    <img src="<?php echo base_url(); ?>assets/img/LOGO1.png" alt="Ideas Studio Web" />
                    <div class="loginbox-white">
                        <!-- Mensajes del Login-->
                        <div class="alert-popup alert-popup-green" style="display:none;">
                            <strong><i class="icon-ok icon-white"></i> Ingresando al Sistema</strong>
                        </div>
                        <div class="alert-popup alert-popup-blue" style="display:none;">
                            <strong><i class="icon-retweet icon-white"></i> Identificando Usuario</strong>
                        </div>
                        <?php
                        if(isset($_POST['btnIngresar'])){
                        ?>
                            <div class="alert-popup alert-popup-red" style="display:block;">
                                <strong><i class="icon-warning-sign icon-white"></i><?php echo $mensaje; ?></strong>
                            </div>
                        <?php
                        }
                        ?>
                        <!--End mensajes -->
                        <h4>Panel de Usuario</h4>
                        <form id="login" class="" method="POST" action="<?php echo base_url() ?>index.php/index/validarUsuario">
                            <fieldset>
                                <div class="control-group ">
                                    <div class="controls">
                                        <input class="input-medium" type="text" placeholder="Ingrese Usuario" value="" name="usuario" id="usuario">
                                    </div>
                                </div>
                                <div class="control-group ">
                                    <div class="controls">
                                        <input class="input-medium" type="password" placeholder="Ingrese Contraseña" value="" name="password" id="password">
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button class="btn btn-primary btn btn-info" type="submit" name="btnIngresar"><i class="icon-lock icon-white icon-button"></i> Ingresar</button>
                                    <button class="btn btn-primary btn-danger" type="submit"><i class="icon-remove icon-white icon-button"></i> Cancelar</button>
                                </div>
                           </fieldset>
                        </form>
                    </div>
                </div>        
            </div>
            <div class="footer">
                <!--<div class="container">
                    <p>Diseñado y Desarrollado por <a href="http://www.jkolaz.com" target="_blank">Dev Studio</a></p>
                    <p>© DevStudio. Todos los derechos reservados 2013.</p>
                    <p>Lima-Perú | Teléfono: 511 354 3548094 | Movil: 511 95 41241261 | Email: j.salsavilca@jkolaz.com </p>
                </div>-->
            </div>
            <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
            <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
            <!--Fin-->
        </div>
    </body>
</html>