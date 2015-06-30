<?php
class horario extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library('layout','layout');
        $this->load->model('administracion/horario_model');
        $this->acceso();
    }
    public function index(){
        echo _HORARIO;
    }
    public function horario_aula($id){
        $listado            = $this->horario_model->horario_aula($id);
        $data['listado']    = $listado;
        $data['titulo']     = "hola";
        $this->layout->view('administracion/edit_horario',$data);
    }
    public function acceso(){
        $arrSession = $this->session->userdata;
        if(!isset($arrSession['acceso']) && $arrSession['acceso']!=1){
            /* no inicio session*/
            redirect('index');
        }
    }
}
