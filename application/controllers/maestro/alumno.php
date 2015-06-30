<?php
    class Alumno extends CI_Controller{
        public function __construct() {
            parent::__construct();
            $this->load->model('seguridad/usuario_model');
            $this->load->model('configuracion/archivo_model');
            $this->load->model('maestro/alumno_model');
            $this->load->library('layout','layout');
        }
        public function index(){
            $arrSession = $this->session->userdata;
            $data['nombre'] = $arrSession['nombre'].' '.$arrSession['paterno'].' '.$arrSession['materno'];
            $data['code'] = $arrSession['usuario'];
            $alu = new stdClass();
            $alu->MM_Codigo = 1;
            $image_alu = $this->archivo_model->image_alumno($alu);
            if(count($image_alu)>0){
                $data['image_alu'] = $image_alu[0]->ARC_Nombre;
            }else{
                $data['image_alu'] = "default.jpg";
            }
            $alumno = $arrSession['id'];
            $data['error']  = "";
            $data['modulo'] = "Perfil de Estudiantes";
            $data['action'] = "alumno/password";
            $data['idform'] = "idForm";
            $data['datos'] = "";
            $data['btnCancelar'] = "../index/index";
            $this->layout->view("maestro/alumno_perfil",$data);
        }
        public function password(){
            $arrSession = $this->session->userdata;
            $usuario = $arrSession['usuario'];
            $password = $this->input->post('txt_password_act');
            $passwordNew = $this->input->post('txt_password_new');
            $passwordConf = $this->input->post('txt_password_conf');
            $objAlumno = $this->usuario_model->obtener_usuario($usuario, $password);
            if(count($objAlumno)>0){
                if($passwordNew == $passwordConf){
                    /*se puede cambiar la contraseña*/
                    $objUsu = new stdClass();
                    $objUsu->USU_Nombre         = $usuario;
                    $objUsu->USU_Passwordnew    = md5($passwordNew);
                    $objUsu->USU_Password       = md5($password);
                    $update = $this->usuario_model->change_password($objUsu);
                    if($update==1){
                        redirect('index/inicio');
                    }else{
                        redirect('maestro/alumno');
                    }
                }else{
                    redirect('maestro/alumno');
                }
            }else{
                redirect('maestro/alumno');
            }
        }
    }
?>
