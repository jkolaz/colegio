<!--Cuerpo web-->
<style>
    span{
        font-size: 15px;
    }
</style>
<script type="text/javascript">
//    JQuery(document).ready(function (){
//        $('.caja').click(function(){
//            alert($(this).attr('coord'));
//        });
//    });
    function edit_horario(t,d){
        $('#url_'+t+'_'+d).hide();
        $('#lbl_'+t+'_'+d).show();
    }
</script>
<div class="container">
    <div class="container">
        <h1>Galería de <?php echo $titulo;?></h1>
        <ul class="breadcrumb">
            <li><a href="#">Home</a> <span class="divider">/</span></li>
            <li class="active"><?php echo $titulo;?></li>
        </ul>
        <div class="row-fluid mod-label">
            <!--<form action="<?php echo $nuevo;?>" method='post'>
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-info"><i class="icon-plus icon-white"></i> <span>Registrar Profesor</span></button>
                    </div>
                </div>
            </form>-->
            <table class="table table-hover table-striped table-bordered toAddItem zebra-striped" id="buscador">
                <thead>
                    <tr>
                        <th width="4%">#</th>
                        <th width="16%">HORA
                        <th width="16%">LUNES</th>
                        <th width="16%">MARTES</th>
                        <th width="16%">MIERCOLES</th>
                        <th width="16%">JUEVES</th>
                        <th width="16%">VIERNES</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if(count($listado) > 0){
                        foreach($listado as $indice =>$valor){
                            $lunes = "No asignado";
                            if($valor->HOR_Lunes!=0){
                                $lunes = $valor->HOR_Lunes;
                            }
                            $martes = "No asignado";
                            if($valor->HOR_Martes!=0){
                                $martes = $valor->HOR_Martes;
                            }
                            $miercoles = "No asignado";
                            if($valor->HOR_Miercoles!=0){
                                $miercoles = $valor->HOR_Miercoles;
                            }
                            $jueves = "No asignado";
                            if($valor->HOR_Jueves!=0){
                                $jueves = $valor->HOR_Jueves;
                            }
                            $viernes = "No asignado";
                            if($valor->HOR_Viernes!=0){
                                $viernes = $valor->HOR_Viernes;
                            }
                ?>
                    <tr>
                        <td><?php echo $indice +1?></td>
                        <?php
                        if($indice!=3){
                        ?>
                        <td class="text-info"><?=$valor->HOR_HoraIni." - ".$valor->HOR_HoraFin?></td>
                        <td class="text-info">
                            <span id="url_<?=$indice?>_1">
                                <a class="caja" onclick="edit_horario(<?=$indice?>,1)"><?=$lunes?></a>
                            </span>
                            <span id="lbl_<?=$indice?>_1" style="display: none">
                                <input type="text" name="cur_<?=$indice?>_1" id="cur_<?=$indice?>" >
                            </span>
                        </td>
                        <td class="text-info">
                            <span id="url_<?=$indice?>_2">
                                <a class="caja" onclick="edit_horario(<?=$indice?>,2)"><?=$martes?></a>
                            </span>
                            <span id="lbl_<?=$indice?>_2" style="display: none">
                                <input type="text" name="cur_<?=$indice?>_2" id="cur_<?=$indice?>" >
                            </span>
                        </td>
                        <td class="text-info">
                            <span id="url_<?=$indice?>_3">
                                <a class="caja" onclick="edit_horario(<?=$indice?>,3)"><?=$miercoles?></a>
                            </span>
                            <span id="lbl_<?=$indice?>_3" style="display: none">
                                <input type="text" name="cur_<?=$indice?>_3" id="cur_<?=$indice?>" >
                            </span>
                        </td>
                        <td class="text-info">
                            <span id="url_<?=$indice?>_4">
                                <a class="caja" onclick="edit_horario(<?=$indice?>,4)"><?=$jueves?></a>
                            </span>
                            <span id="lbl_<?=$indice?>_4" style="display: none">
                                <input type="text" name="cur_<?=$indice?>_4" id="cur_<?=$indice?>" >
                            </span>
                        </td>
                        <td class="text-info">
                            <span id="url_<?=$indice?>_5">
                                <a class="caja" onclick="edit_horario(<?=$indice?>,5)"><?=$viernes?></a>
                            </span>
                            <span id="lbl_<?=$indice?>_5" style="display: none">
                                <input type="text" name="cur_<?=$indice?>_5" id="cur_<?=$indice?>" >
                            </span>
                        </td>
                        <?php
                        }else{
                        ?>
                        <td class="text-info" style="background-color: #3A87AD; color: #DDDDDD; font-weight: bolder"><?=$valor->HOR_HoraIni." - ".$valor->HOR_HoraFin?></td>
                        <?php
                            for($i=0; $i<5 ; $i++){
                        ?>
                        <td class="text-info" style="background-color: #3A87AD; color: #DDDDDD; font-weight: bolder">RECREO</td>
                        <?php
                            }
                        }
                        ?>
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