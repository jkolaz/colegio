<script type="text/javascript">
    $(document).ready(function(){
        if($("#agregar").val()==""){
           $("#agregar").attr("disabled", "disabled"); 
        }
        
        $("#cbo_profesor").change( function(){
           if($(this).val()==""){
               $("#agregar").attr("disabled", "disabled");
           }else{
               $("#agregar").removeAttr("disabled");
           }
        });
    })
</script>
<!--Cuerpo web-->
<div class="container">
    <div class="container">
        <h1><?php echo $titulo;?></h1>
        <ul class="breadcrumb">
            <li><a href="#">Home</a> <span class="divider">/</span></li>
            <li class="active"><?php echo $titulo;?></li>
        </ul>
        <div class="row-fluid mod-label">
            <form method="post">
                <table class="table table-hover table-striped table-bordered toAddItem zebra-striped">
                    <thead>
                        <tr>
                            <th colspan="2">+Agregar Profesor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Profesor</td>
                            <td>
                                <select name="cbo_profesor" id="cbo_profesor">
                                    <option value="">--Profesor--</option>
                                    <?php if (is_array($profesores)){?>
                                    <?php foreach ($profesores as $row){?>
                                    <option value="<?=$row->PERS_Codigo?>"><?=$row->PER_Nombre." ".$row->PER_Paterno." ".$row->PER_Materno?></option>
                                    <?php }?>
                                    <?php }?>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="btn btn-info" id="agregar" name="agregar">
                                    <i class="icon-plus icon-white"></i> <span>Registrar Curso</span>
                                </button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
        <div class="row-fluid mod-label">
            <table class="table table-hover table-striped table-bordered toAddItem zebra-striped" id="buscador">
                <thead>
                    <tr>
                        <th width="10%">Item</th>
                        <th width="80%">Docente</th>
                        <th>Niveles</th>
                </thead>
                <tbody>
                    <?php if(is_array($listado)){ ?>
                    <?php foreach ($listado as $i=>$fila){ ?>
                    <tr>
                        <td><?=$i+1?></td>
                        <td>
                            <?=$fila->PER_Nombre?> 
                            <?=$fila->PER_Paterno?> 
                            <?=$fila->PER_Materno?> 
                        </td>
                        <td></td>
                    </tr>
                    <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<!--End Cuerpo-->