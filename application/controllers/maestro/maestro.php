<?php
    class Maestro extends CI_Controller{
        public function __construct() {
            parent::__construct();
            $this->load->model('seguridad/usuario_model');
            $this->load->model('maestro/personal_model');
            $this->load->model('maestro/persona_model');
            $this->load->model('configuracion/curso_model');
            $this->load->library('layout','layout');
        }
        public function lista_profesores(){
            $lista      = $this->personal_model->lista_profesores();
            $listado    = array();
            if(count($lista)>0){
                foreach ($lista as $indice=>$valor){
                    $id_personal    = $valor->PERS_Codigo;
                    $nombre         = $valor->PER_Nombre;
                    $paterno        = $valor->PER_Paterno;
                    $materno        = $valor->PER_Materno;
                    $dni            = $valor->PER_DNI;
                    $flagestado     = $valor->PERS_FlagEstado;
                    $listado[]      = array($id_personal,$nombre,$paterno,$materno,$dni,$flagestado);
                }
            }
            $data['titulo']     = 'Profesores';
            $data['nuevo']      = base_url().'index.php/maestro/maestro/nuevo_profesor';
            $data['listado']    = $listado;
            $this->layout->view('maestro/profesores_index',$data);
        }
        public function nuevo_profesor(){
            $data['error']          = '';
            $data['modulo']         = 'Cursos';
            $data['action']         = base_url().'index.php/maestro/maestro/insertar_profesor';
            $data['idform']         = "frmNuevoCurso";
            $codigopro              = "";
            $nombre                 = "";
            $paterno                = "";
            $materno                = "";
            $dni                    = "";
            $observacion            = "";
            $codigo                 = "";
            $fecha_nac              = "";
            $lugar_nac              = "";
            $lugar_red              = "";
            $direccion              = "";
            $fecha                  = "0000-00-00";
            $fecha_actualizacion    = "0000-00-00";
            $datos[]                = array($codigo, $codigopro, $nombre, $paterno, $materno, $dni, $observacion, $fecha_nac, $lugar_nac, $lugar_red, $direccion, $fecha, $fecha_actualizacion);
            $data['datos']          = $datos;
            $data['placeholder']    = "Codigo del Profesor";
            $data['placeholder1']   = "Nombre del Profesor";
            $data['placeholder2']   = "Apellido Paterno";
            $data['placeholder3']   = "Apellido Materno";
            $data['placeholder4']   = "D.N.I.";
            $data['size_img']       = "";
            $data['oculto']         = "";
            
            $data['titulo']         = 'Curso';
            $data['multiple']       = 'multiple';
            $data['btnAceptar']     = base_url().'index.php/maestro/maestro/insertar_profesor';
            $data['btnCancelar']    = base_url().'index.php/maestro/maestro/lista_profesores';
            $this->layout->view('maestro/profesor_nuevo',$data);
        }
        public function insertar_profesor(){
            $codigopro  = $this->input->post("codigo");
            $nombre     = $this->input->post("nombre");
            $paterno    = $this->input->post("paterno");
            $materno    = $this->input->post("materno");
            $dni        = $this->input->post("dni");
            $fecha_nac  = $this->input->post("fecha_nac");
            $lugar_nac  = $this->input->post("lugar_nac");
            $lugar_red  = $this->input->post("lugar_red");
            $direccion  = $this->input->post("direccion");
            $stpersona  = new stdClass();
            $stpersona->nombre      = $nombre;
            $stpersona->paterno     = $paterno;
            $stpersona->materno     = $materno;
            $stpersona->dni         = $dni;
            $stpersona->fecha_nac   = $fecha_nac;
            $stpersona->sexo        = "";
            $idpersona              = $this->persona_model->insertar($stpersona);
//            echo $this->_db->last_query();
            if($idpersona){
                $stdprofesor            = new stdClass();
                $stdprofesor->persona   = $idpersona;
                $idpersonal             = $this->personal_model->insertar_profesor($stdprofesor);
                if($idpersonal){
                    echo "<script type='text/javascript'>top.location='" .base_url()."index.php/maestro/maestro/lista_profesores'</script>";
                }
            }
        }
        public function estado($id){
            $datos  = $this->personal_model->obtener($id);
            $flag   = $datos[0]->PERS_FlagEstado;
            if($flag==0){
                $cambio = 1;
            }
            if($flag==1){
                $cambio = 0;
            }
            $this->personal_model->cambiar_estado($id,$cambio);
            echo "<script type='text/javascript'>top.location='" .base_url()."index.php/maestro/maestro/lista_profesores'</script>";
        }
        public function eliminar_profesor($id){
            $this->personal_model->eliminar($id);
            echo "<script type='text/javascript'>top.location='" .base_url()."index.php/maestro/maestro/lista_profesores'</script>";
        }
        public function editar(){
            $data['error']          = '';
            $data['modulo']         = 'Cursos';
            $data['action']         = base_url().'index.php/maestro/maestro/insertar_profesor';
            $data['idform']         = "frmNuevoCurso";
            $codigopro              = "";
            $nombre                 = "";
            $paterno                = "";
            $materno                = "";
            $dni                    = "";
            $observacion            = "";
            $codigo                 = "";
            $fecha_nac              = "";
            $lugar_nac              = "";
            $lugar_red              = "";
            $direccion              = "";
            $fecha                  = "0000-00-00";
            $fecha_actualizacion    = "0000-00-00";
            $datos[]                = array($codigo, $codigopro, $nombre, $paterno, $materno, $dni, $observacion, $fecha_nac, $lugar_nac, $lugar_red, $direccion, $fecha, $fecha_actualizacion);
            $data['datos']          = $datos;
            $data['placeholder']    = "Codigo del Profesor";
            $data['placeholder1']   = "Nombre del Profesor";
            $data['placeholder2']   = "Apellido Paterno";
            $data['placeholder3']   = "Apellido Materno";
            $data['placeholder4']   = "D.N.I.";
            $data['size_img']       = "";
            $data['oculto']         = "";
            
            $data['titulo']         = 'Curso';
            $data['multiple']       = 'multiple';
            $data['btnAceptar']     = base_url().'index.php/maestro/maestro/insertar_profesor';
            $data['btnCancelar']    = base_url().'index.php/maestro/maestro/lista_profesores';
            $this->layout->view('maestro/profesor_nuevo',$data);
        }
    }
?>