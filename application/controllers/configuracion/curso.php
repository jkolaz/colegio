<?php
    class Curso extends CI_Controller{
        public function __construct() {
            parent::__construct();
            $this->load->model('seguridad/usuario_model');
            $this->load->model('maestro/alumno_model');
            $this->load->model('maestro/personal_model');
            $this->load->model('matricula/nivel_model');
            $this->load->model('configuracion/curso_model');
            $this->load->library('layout','layout');
        }
        public function cursos(){
            /* falta validar la url */
            if (!$this->session->userdata('usuario')&& $this->sesseion->userdata('rol')!=1) {
                redirect('index/index');
            }
            $lista              = $this->curso_model->lista();
            foreach ($lista as $i=>$list){
                $nivel = $this->nivel_model->nivel_texto($list->NIV_Codigo);
                $lista[$i]->NIV_Text = $nivel;
            }
            $data['listado']    = $lista;
            $data['nuevo']      = base_url().'index.php/configuracion/curso/nuevo';
            $data['titulo']     ='Curso';
            $this->layout->view('configuracion/cursos_index',$data);
        }
        public function nuevo(){
            $data['error']          = '';
            $data['modulo']         = 'Cursos';
            $data['action']         = base_url().'index.php/configuracion/curso/insertar';
            $data['idform']         = "frmNuevoCurso";
            $codigocur              = "";
            $nombre                 = "";
            $observacion            = "";
            $codigo                 = "";
            $fecha                  = "0000-00-00";
            $fecha_actualizacion    = "0000-00-00";
            $nombreCor              = "";
            $datos[]                = array($codigo, $codigocur, $nombre, $observacion, $fecha, $fecha_actualizacion,$nombreCor);
            $data['datos']          = $datos;
            $data['placeholder']    = "Codigo del Curso";
            $data['placeholder1']   = "Nombre del Curso";
            $data['size_img']       = "";
            $data['oculto']         = "";
            
            $data['titulo']         = 'Curso';
            $data['multiple']       = 'multiple';
            $data['btnAceptar']     = base_url().'index.php/configuracion/curso/insertar';
            $data['btnCancelar']    = base_url().'index.php/configuracion/curso/cursos';
            $this->layout->view('configuracion/curso_nuevo',$data);
        }
        public function insertar(){
            $codigo                         = $this->input->post('codigo');
            $descripcion                    = $this->input->post('descripcion');
            $nombreCorto                    = $this->input->post('nom_corto');
            $observacion                    = $this->input->post('editor');
            $nivel                          = $this->input->post('cbo_nivel');
            $observacioncss                 = $this->input->post('contenido_editor');
            $observacioncss                 = str_replace("|left|", "<", $observacioncss);
            $observacioncss                 = str_replace("|right|", ">", $observacioncss);
            $observacioncss                 = str_replace("||", "'", $observacioncss);
            $objcurso                       = new stdClass();
            $objcurso->CUR_CodigoInterno    = $codigo;
            $objcurso->NIV_Codigo           = $nivel;
            $objcurso->CUR_Descripcion      = $descripcion;
            $objcurso->CUR_NomCorto         = $nombreCorto;
            $idCurso                        = $this->curso_model->insertar($objcurso);
            if($idCurso>0){
                echo "<script type='text/javascript'>top.location='" . base_url() . "index.php/configuracion/curso/cursos'</script>";
            }
        }
        public function estado($id){
            $datos  = $this->curso_model->obtener($id);
            $flag   = $datos[0]->CUR_FlagEstado;
            if($flag==0){
                $cambio = 1;
            }
            if($flag==1){
                $cambio = 0;
            }
            $this->curso_model->cambiar_estado($id,$cambio);
            echo "<script type='text/javascript'>top.location='" .base_url()."index.php/configuracion/curso/cursos'</script>";
        }
        public function eliminar($id){
            $this->curso_model->eliminar_curso($id);
            echo "<script type='text/javascript'>top.location='" .base_url()."index.php/configuracion/curso/cursos'</script>";
        }
        public function editar($id){
            $curso                  = $this->curso_model->obtener($id);
            $data['error']          = "";
            $data['modulo']         = 'Cursos';
            $data['action']         = base_url().'index.php/configuracion/curso/modificar';
            $data['idform']         = "frmNuevoCurso";
            $codigocur              = $curso[0]->CUR_CodigoInterno;
            $nombre                 = $curso[0]->CUR_Descripcion;
            $nombreCor              = $curso[0]->CUR_NomCorto;
            $observacion            = "aqu&iacute; ira la descripcion.";
            $codigo                 = $curso[0]->CUR_Codigo;
            $fecha                  = "0000-00-00";
            $fecha_actualizacion    = "0000-00-00";
            $datos[]                = array($codigo, $codigocur, $nombre, $observacion, $fecha, $fecha_actualizacion,$nombreCor);
            $data['datos']          = $datos;
            $data['placeholder']    = "Codigo del Curso";
            $data['placeholder1']   = "Nombre del Curso";
            $data['size_img']       = "";
            $data['oculto']         = "";
            
            $data['titulo']         = 'Curso';
            $data['multiple']       = 'multiple';
            $data['btnCancelar']    = base_url().'index.php/configuracion/curso/cursos';
            $this->layout->view('configuracion/curso_nuevo',$data);
        }
        public function modificar(){
            $id                             = $this->input->post("id");
            $codigo                         = $this->input->post("codigo");
            $descripcion                    = $this->input->post("descripcion");
            $nivel                          = $this->input->post("cbo_nivel");
            $nombrecorto                    = $this->input->post("nom_corto");
            $stdcurso                       = new stdClass();
            $stdcurso->CUR_CodigoInterno    = $codigo;
            $stdcurso->CUR_NomCorto         = $nombrecorto;
            $stdcurso->NIV_Codigo           = $nivel;
            $stdcurso->CUR_Descripcion      = $descripcion;
            $this->curso_model->modificar($id,$stdcurso);
            echo "<script type='text/javascript'>top.location='" . base_url() . "index.php/configuracion/curso/cursos'</script>";
        }
        public function profesor($id){
            if($this->input->post("cbo_profesor")!=""){
                $profesor = $this->input->post("cbo_profesor");
                $objCP = new stdClass();
                $objCP->PERS_Codigo = $profesor;
                $objCP->CUR_Codigo = $id;
                if(!$this->personal_model->CP_disponible($objCP)){
                    $this->personal_model->insertar_CP($objCP);
                }
            }
            $data['profesores'] = $this->personal_model->profesor_libre();
//            print_r($data['profesores']);
            $data['titulo'] = "PROFESORES";
            $data['listado'] = $this->curso_model->profesor($id);
            $this->layout->view("configuracion/curso_profesor_index",$data);
        }
    }
?>
