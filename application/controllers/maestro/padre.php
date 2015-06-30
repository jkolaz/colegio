<?php
class padre extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library('layout','layout');
        $this->load->model('maestro/padre_model');
    }
    public function index(){
        $this->acceso();
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
                    $this->lista_adm();
                    break;
                default :
                    redirect('index/inicio');
            }
        }
    }
    public function lista_adm(){
       echo "hola"; 
    }
}

?>
