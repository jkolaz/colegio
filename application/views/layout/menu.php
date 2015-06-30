<!--Menu-->
<?php
$base_url = base_url();
$CI = get_instance();
$this->load->model('configuracion/permiso_model');
$this->load->model('configuracion/menu_model');
// print_r($_SESSION);
$menu_datos = $CI->permiso_model->obtener_menu();
$lista = $menu_datos;
?>

<div class="navbar navbar-inverse">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" href="<?php echo base_url()?>index.php/index/inicio" target="">Inicio</a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <?php
                    if (count($lista) > 0) {
                        foreach ($lista as $indice => $valor) {

                            //if ($valor->id_menu == 3) {
                                ?>
                                <li class="dropdown">
                                    <a href="<?php echo base_url() . $valor->MEN_Url; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $valor->MEN_Descripcion; ?><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <?php
                                        //cargo lo cosulta al submenu 
                                        $submenu_datos  = $CI->menu_model->submenu($valor->MEN_Codigo);
                                        $sublista       = $submenu_datos;
                                        if (count($sublista) > 0) {
                                            foreach ($sublista as $i => $v) {
                                                ?>
                                                <li><a href="<?php echo base_url() .  $v->MEN_Url; ?>"><?php echo $v->MEN_Descripcion; ?></a></li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <?php
                            //} else {
                                ?>
                                <!--<li><a href="<?php echo base_url(). $valor->MEN_Url; ?>"><?php echo $valor->MEN_Descripcion; ?></a></li>-->
                                <?php
                            //}
                        }
                    }
                    ?>


                </ul>
            </div>
        </div>
    </div>
</div><!--End Menu-->