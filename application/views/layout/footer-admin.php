 <?php if(isset($activa_upload)){?>


<!--						--------------------------------------------------------------------------------		-->


		 		<script  src="<?php echo base_url();?>assets/js/fileupload/jquery-1.7.min.js" ></script>
 		
 	    <script  type="text/javascript" src="<?php echo base_url();?>assets/js/fileupload/tmpl.js" ></script>
 	    <script  type="text/javascript" src="<?php echo base_url();?>assets/js/fileupload/vendor/jquery.ui.widget.js" ></script>
        <script  type="text/javascript" src="<?php echo base_url();?>assets/js/fileupload/load-image.js" ></script>
        <script  type="text/javascript" src="<?php echo base_url();?>assets/js/fileupload/canvas-to-blob.js" ></script>
        <script  type="text/javascript" src="<?php echo base_url();?>assets/js/fileupload/bootstrap.min.js" ></script>
        <script  type="text/javascript" src="<?php echo base_url();?>assets/js/fileupload/bootstrap-image-gallery.min.js" ></script>
        <script  type="text/javascript" src="<?php echo base_url();?>assets/js/fileupload/jquery.iframe-transport.js" ></script>
        <script  type="text/javascript" src="<?php echo base_url();?>assets/js/fileupload/jquery.fileupload.js" ></script>
        <script  type="text/javascript" src="<?php echo base_url();?>assets/js/fileupload/jquery.fileupload-ip.js" ></script>
	 <?php if(isset($upload_unidad)){?>
        <script  type="text/javascript" src="<?php echo base_url();?>assets/js/fileupload/jquery.fileuploadlimit-ui.js" ></script>
		<?php }else{?>
		<script  type="text/javascript" src="<?php echo base_url();?>assets/js/fileupload/jquery.fileupload-ui.js" ></script>
		<?php }?>
        <script  type="text/javascript" src="<?php echo base_url();?>assets/js/fileupload/locale.js" ></script>
        <script  type="text/javascript" src="<?php echo base_url();?>assets/js/fileupload/main.js" ></script>
 

                        <!-- modal-gallery is the modal dialog used for the image gallery -->
                        <div id="modal-gallery" class="modal modal-gallery hide fade">
                            <div class="modal-header">
                                <a class="close" data-dismiss="modal">&times;</a>
                                <h3 class="modal-title"></h3>
                            </div>
                            <div class="modal-body"><div class="modal-image"></div></div>
                            <div class="modal-footer">
                                <a class="btn btn-primary modal-next">Next <i class="icon-arrow-right icon-white"></i></a>
                                <a class="btn btn-info modal-prev"><i class="icon-arrow-left icon-white"></i> Previous</a>
                                <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000"><i class="icon-play icon-white"></i> Slideshow</a>
                                <a class="btn modal-download" target="_blank"><i class="icon-download"></i> Download</a>
                            </div>
                        </div>




                        <!-- The template to display files available for upload -->
                        <script id="template-upload" type="text/x-tmpl">
                            {% for (var i=0, files=o.files, l=files.length, file=files[0]; i< l; file=files[++i]) { %}
                            <tr class="template-upload fade">
                                <td class="preview"><span class="fade"></span></td>
                                <td class="name">{%=file.name%}</td>
                                <td class="size">{%=o.formatFileSize(file.size)%}</td>
                                {% if (file.error) { %}
                                <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
                                {% } else if (o.files.valid && !i) { %}
                                <td>
                                    <div class="progress progress-success progress-striped active"><div class="bar" style="width:0%;"></div></div>
                                </td>
                                <td class="start">{% if (!o.options.autoUpload) { %}
                                    <button class="btn btn-primary">
                                        <i class="icon-upload icon-white"></i> {%=locale.fileupload.start%}
                                    </button>
                                    {% } %}</td>
                                {% } else { %}
                                <td colspan="2"></td>
                                {% } %}
                                <td class="cancel">{% if (!i) { %}
                                    <button class="btn btn-warning">
                                        <i class="icon-ban-circle icon-white"></i> {%=locale.fileupload.cancel%}
                                    </button>
                                    {% } %}</td>
                            </tr>
                            {% } %}
                            </script>

                            <div id="download-files">
                            <!-- The template to display files available for download -->
                            <script id="template-download" type="text/x-tmpl">
                                {% for (var i=0, files=o.files, l=files.length, file=files[0]; i< l; file=files[++i]) { %}
                                <tr class="template-download fade">
                                    {% if (file.error) { %}
                                    <td></td>
                                    <td class="name">{%=file.name%}</td>
                                    <td class="size">{%=o.formatFileSize(file.size)%}</td>
                                    <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
                                    {% } else { %}
                                    <td class="preview">{% if (file.thumbnail_url) { %}
                                        <a href="<?php echo base_url()?>{%=file.url%}" title="{%=file.name%}" rel="gallery" download="{%=file.name%}"><img width="100px" src="<?php echo base_url()?>{%=file.thumbnail_url%}"></a>
                                        {% } %}</td>
                                    <td class="name">
                                        <a href="<?php echo base_url()?>{%=file.url%}" title="{%=file.name%}" rel="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
                                    </td>
                                    <td class="size">{%=o.formatFileSize(file.size)%}</td>
                                    <td colspan="2"></td>
                                    {% } %}
                                    <td class="delete">
                                        <button class="btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}">
                                            <i class="icon-trash icon-white"></i> {%=locale.fileupload.destroy%}
                                        </button>
                                        <input type="checkbox" name="delete" value="1">
                                    </td>

                          
                                </tr>
                                {% } %}

                               
                                </script>
                            </div>


<script type="text/javascript">
//cargo el valor del combo a un input oculto para realizar el guardar
 $(document).ready(function() {
    // Así accedemos al Valor de la opción seleccionada
    var valor = $("#eleccion").val();
     $("#entrada").val(valor);
	 });
    $("#eleccion").change(function() {
    // Así accedemos al Valor de la opción seleccionada
    var valor = $("#eleccion").val();
     $("#entrada").val(valor);
    // Si seleccionamos la opción "Texto 1"
    // nos mostrará por pantalla "1"
});
 
</script>
							

<?php }?>


</div>
<div class="footer">
      <div class="container">
        <p>Diseñado y Desarrollado por <a href="https://www.facebook.com/J.KOlaZ1" target="_blank">J-A KolaZ</a></p>
        <p>© J-A KolaZ. Todos los derechos reservados 2013.</p>
        <p>Lima-Perú | Teléfono: 511 354 8094 | Movil: 511 99 7707642 | Email: j.salsavilca@gmail.com </p>
      </div>
    </div>
 <?php if(!isset($activa_upload)){?>	
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/holder/holder.js"></script>
<script src="<?php echo base_url(); ?>assets/js/shadow-box/shadowbox.js"></script>
<script type="text/javascript">
	Shadowbox.init({
		handleOversize: "drag",
		modal: true
	});
</script>
<script type="text/javascript">

</script>
<?php } ?>
<!--Fin-->
</div>
</body>
</html>

