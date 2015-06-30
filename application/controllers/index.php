<?php
    class Index extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('seguridad/usuario_model');
            $this->load->model('seguridad/administrador_model');
            $this->load->model('maestro/alumno_model');
            $this->load->model('maestro/personal_model');
            $this->load->library('layout','layout');
        }
        public function acceso(){
            $arrSession = $this->session->userdata;
            if(!isset($arrSession['acceso'])){
                /* no inicio session*/
                $this->load->view('seguridad/index');
            }else{
                $this->inicio();
            }
        }

        public function index(){
            $this->acceso();
        }
        public function inicio(){
            if (!$this->session->userdata('usuario')) {
                redirect('index/index');
            }
            $data['bienvenido'] = strtoupper($this->session->userdata('nombre').' '.$this->session->userdata('paterno'));
            $this->layout->view('inicio',$data);
        }
        public function validarUsuario(){
            $url = 'index/inicio';
            if(!$_POST){
                    redirect('index/index');
            }
            $usuario 	= $this->input->post("usuario");
            $password 	= $this->input->post("password");
            $datos_usuario = $this->usuario_model->obtener_usuario($usuario,$password);
            if(count($datos_usuario)>0){
                if($datos_usuario[0]->USU_Nombre == strtoupper($usuario) && $datos_usuario[0]->USU_Password == md5($password)){
                    if($datos_usuario[0]->USU_Flag == 2){
                        $mensaje = "El usuario esta deshabilitado, comuníquese con el administrador.";
                    }else{
                        $rol = $datos_usuario[0]->ROL_Codigo;
                        switch($rol){
                            case 1:
                                    //administrador
                                    $parametro = $datos_usuario[0]->ADM_Codigo;
                                    $datos_u = $this->administrador_model->obtener_persona($parametro);
                                    //print_r($datos_u);
                                    break;
                            case 2:
                                    //alumno
                                    $url = "maestro/alumno";
                                    $parametro =  $datos_usuario[0]->ALU_Codigo;
                                    $datos_u = $this->alumno_model->obtener_persona($parametro);
                                    break;
                            case 3:
                                    //profesor
                                    $parametro = $datos_usuario[0]->PERS_Codigo;
                                    $datos_u = $this->personal_model->obtener_persona($parametro);
                                    break;
                            case 4:
                                    //director
                                    $parametro = $datos_usuario[0]->PERS_Codigo;
                                    $datos_u = $this->personal_model->obtener_persona($parametro);
                                    break;
                            case 5:
                                    //padre de familia
                                    $parametro = $datos_usuario[0]->PAD_Codigo;
                                    $datos_u = $this->padre_model->obtener_persona($parametro);
                                    break;
                        }
                        $data_session = array(
                                            "id"=>$datos_usuario[0]->USU_Codigo,
                                            "usuario"=>$datos_usuario[0]->USU_Nombre,
                                            "password"=>$datos_usuario[0]->USU_Password,
                                            "rol"=>$rol,
                                            "nombre"=>$datos_u[0]->PER_Nombre,
                                            "paterno"=>$datos_u[0]->PER_Paterno,
                                            "materno"=>$datos_u[0]->PER_Materno,
                                            "acceso"=>1
                                        );
                        $this->session->set_userdata($data_session);
                        redirect($url);
                    }
                }
            }else{
                $mensaje = "Usuario y/o clave incorrecta.";
            }
            $data['mensaje'] = $mensaje;
            $this->load->view('seguridad/index',$data);
        }
        public function salir(){
            $arreglo = array(
                            "usuario"=>'',
                            "password"=>'',
                            "rol"=>'',
                            "nombre"=>'',
                            "paterno"=>'',
                            "materno"=>'',
                            "acceso"=>''
                        );
            $this->session->unset_userdata($arreglo);
            redirect('index/index');
        }
    }
?>
