<?php
class Configuracion extends CI_Controller{
    protected $_mod = "index.php/configuracion/configuracion/";
    public function __construct() {
        parent::__construct();
        $this->load->library('layout','layout');
        $this->load->model('configuracion/configuracion_model');
        $this->load->model('configuracion/menu_model');
        $this->load->model('registroacademico/anioescolar_model');
        $this->load->model('administracion/horario_model');
    }
    public function acceso(){
        $arrSession = $this->session->userdata;
        if(!isset($arrSession['acceso']) && $arrSession['acceso']!=1){
            /* no inicio session*/
            redirect('index');
        }else{
            /* inicio session*/
            switch ($arrSession['rol']){
                case 1:
                    /*perfil administrador*/
                    $this->nuevo();
                    break;
                case 2:
                    redirect('maestro/alumno');
                    break;
                default :
                    redirect('index/inicio');
            }
        }
    }

    public function index(){
        $this->acceso();
    }
    public function nuevo(){
        $arrayMenuPadre = $this->menu_model->menu();
        foreach ($arrayMenuPadre as $item=>$val){
            $arrayMenuPadre[$item]->submenu = $this->menu_model->submenu($val->MEN_Codigo);
        }
//        print_r($arrayMenuPadre);
        $data['modulo'] = "Configuracion";
        $data['error']  = "";
        $data['action']  = base_url().$this->_mod."editar";
        $data['idform']  = "frmNuevaConf";
        $data['placeholder']  = "Año Escolar";
        $data['datos']  = $this->configuracion_model->listar();
        $data['size_img'] = "";
        $data['oculto'] = "";
        $data['disabled'] = "";
        $data['menuPadre'] = $arrayMenuPadre;
        if(!$isGenerar = $this->horario_model->is_generar_prehorario()){
            $data['disabled'] = 'disabled="disabled"';
        }
        $data['btnCancelar'] = base_url()."index.php/index/inicio";
        $this->layout->view("configuracion/configuracion",$data);
    }
    public function editar(){
        if(isset($_REQUEST['anio']) && $_REQUEST['anio']!=""){
            /*Los campos contienen Datos*/
            $id = $_REQUEST['id'];
            $objCONF = new stdClass();
            $objCONF->CONF_Anio = $_REQUEST['anio'];
            $objCONF->CONF_Correlativo = $_REQUEST['correlativo'];
            $objCONF->CONF_PRHoraInicio = $_REQUEST['pri_ent'];
            $objCONF->CONF_PRHoraFin    = $_REQUEST['pri_sal'];
            $objCONF->CONF_PRReseso     = $_REQUEST['pri_rec'];
            $objCONF->CONF_PRCanthours  = $_REQUEST['pri_cant'];
            $objCONF->CONF_SEHoraInicio = $_REQUEST['sec_ent'];
            $objCONF->CONF_SEHoraFin    = $_REQUEST['sec_sal'];
            $objCONF->CONF_SEReseso     = $_REQUEST['sec_rec'];
            $objCONF->CONF_SECantHours  = $_REQUEST['sec_cant'];
            $this->configuracion_model->editar(1,$objCONF);
            echo "<script type='text/javascript'>top.location='" .base_url().$this->_mod."'</script>";
        }else{
            /*Los campos no contienen datos*/
            echo "<script type='text/javascript'>top.location='" .base_url().$this->_mod."'</script>";
        }
    }
    public function prehorario() {
        $isGenerar = $this->horario_model->is_generar_prehorario();
        if($isGenerar){
            $hora1 = strtotime(date("Y-m-d")." 08:00:00");
            $hora2 = strtotime(date("Y-m-d")." 13:00:00");
            $intervalo1 = 45*60;
            $intervalo2 = 45*60;
            $durRecreo1 = 15*60;
            $durRecreo2 = 15*60;
            $arrAnioEsc = $this->anioescolar_model->listar();
            foreach ($arrAnioEsc as $id=>$value){
            switch ($value->TUR_Codigo){
                case 1:
                    $hour1 = $hora1;
                    for($i=1;$i<8;$i++){
                        if($i!=4){
                            $objHorario = new stdClass();
                            $objHorario->AE_Codigo      = $value->AE_Codigo;
                            $objHorario->HOR_HoraIni    = date("h:i A",$hour1);
                            $objHorario->HOR_HoraFin    = date("h:i A",$hour1+$intervalo1);
                            $objHorario->HOR_Anio       = date("Y");
                            $objHorario->HOR_Lunes      = 0;
                            $objHorario->HOR_Martes     = 0;
                            $objHorario->HOR_Miercoles  = 0;
                            $objHorario->HOR_Jueves     = 0;
                            $objHorario->HOR_Viernes    = 0;
                            $this->horario_model->generar_prehorario($objHorario);
                            $hour1+=$intervalo1;
                        }else{
                            $objHorario = new stdClass();
                            $objHorario->AE_Codigo      = $value->AE_Codigo;
                            $objHorario->HOR_HoraIni    = date("h:i A",$hour1);
                            $objHorario->HOR_HoraFin    = date("h:i A",$hour1+$durRecreo1);
                            $objHorario->HOR_Anio       = date("Y");
                            $objHorario->HOR_Lunes      = 0;
                            $objHorario->HOR_Martes     = 0;
                            $objHorario->HOR_Miercoles  = 0;
                            $objHorario->HOR_Jueves     = 0;
                            $objHorario->HOR_Viernes    = 0;
                            $this->horario_model->generar_prehorario($objHorario);
                            $hour1+=$durRecreo1;
                        }
                    }
                    break;
                case 2:
                    $hour2 = $hora2;
                    for($i=1;$i<9;$i++){
                        if($i!=4){
                            $objHorario = new stdClass();
                            $objHorario->AE_Codigo      = $value->AE_Codigo;
                            $objHorario->HOR_HoraIni    = date("h:i A",$hour2);
                            $objHorario->HOR_HoraFin    = date("h:i A",$hour2+$intervalo2);
                            $objHorario->HOR_Anio       = date("Y");
                            $objHorario->HOR_Lunes      = 0;
                            $objHorario->HOR_Martes     = 0;
                            $objHorario->HOR_Miercoles  = 0;
                            $objHorario->HOR_Jueves     = 0;
                            $objHorario->HOR_Viernes    = 0;
                            $this->horario_model->generar_prehorario($objHorario);
                            $hour2+=$intervalo2;
                        }else{
                            $objHorario = new stdClass();
                            $objHorario->AE_Codigo      = $value->AE_Codigo;
                            $objHorario->HOR_HoraIni    = date("h:i A",$hour2);
                            $objHorario->HOR_HoraFin    = date("h:i A",$hour2+$durRecreo2);
                            $objHorario->HOR_Anio       = date("Y");
                            $objHorario->HOR_Lunes      = 0;
                            $objHorario->HOR_Martes     = 0;
                            $objHorario->HOR_Miercoles  = 0;
                            $objHorario->HOR_Jueves     = 0;
                            $objHorario->HOR_Viernes    = 0;
                            $this->horario_model->generar_prehorario($objHorario);
                            $hour2+=$durRecreo2;
                        }
                    }
                    break;
            }
        }
        }
        $this->index();
    }
}
