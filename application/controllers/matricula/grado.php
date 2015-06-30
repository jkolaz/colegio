<?php
class Grado extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('matricula/grado_model');
        $this->load->model('matricula/nivel_model');
        $this->load->library('layout','layout');
    }
    public function index($nivel=1) {
        $this->listar($nivel);
    }
    public function listar($nivel=1) {
        $arrGrado           = $this->grado_model->obtener_gradoText($nivel);
        $arrNivel           = $this->nivel_model->obtener($nivel);
                //print_r($arrNivel);exit;
        $data['titulo']     = 'LISTA DE GRADOS DEL NIVEL '.$arrNivel[0]->NIV_Desc;
        $data['listado']    = $arrGrado;
        $this->layout->view("matricula/grado_index",$data);
    }
}
