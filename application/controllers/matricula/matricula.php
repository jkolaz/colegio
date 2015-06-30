<?php
class Matricula extends CI_Controller{
    protected $_mod = "index.php/matricula/matricula";
    protected $_rolAlu  = 2;
    public function __construct() {
        parent::__construct();
        $this->load->library('layout','layout');
        $this->load->model('matricula/matricula_model');
        $this->load->model('seguridad/usuario_model');
        $this->load->model('configuracion/curso_model');
        $this->load->model('configuracion/archivo_model');
        $this->load->model('configuracion/configuracion_model');
        $this->load->model('matricula/nivel_model');
        $this->load->model('matricula/grado_model');
        $this->load->model('maestro/persona_model');
        $this->load->model('maestro/alumno_model');
        $this->load->model('maestro/padre_model');
        $this->acceso();
    }
    public function acceso(){
        $arrSession = $this->session->userdata;
        if(!isset($arrSession['acceso']) && $arrSession['acceso']!=1){
            /* no inicio session*/
            redirect('index');
        }else{
            /* inicio session*/
            if($arrSession['rol']!=1){
                /*no tiene permiso*/
                redirect('index/inicio');
            }
        }
    }
    public function index(){
        $data['titulo'] = "NIVELES ACADEMICOS";
        $data['_mod']       = _MATRICULA;
        $listado = $this->nivel_model->listar();
        foreach ($listado as $id=>$value){
            $listado[$id]->cant_grados = count($this->grado_model->obtener_gradoNivel($value->NIV_Codigo)); 
            $listado[$id]->turno        = $this->nivel_model->lista_turno($value->NIV_Codigo);
        }
        //print_r($listado);
        $data['listado'] = $listado;
        $lista_body = $this->grado_model->grados();
        foreach ($lista_body as $j=>$val){
            $nivel = $this->nivel_model->listar();
            foreach ($nivel as $k=>$valor){
//                $nivel[$k]->turno = $this->nivel_model->lista_turno($valor->NIV_Codigo);
                $turno = $this->nivel_model->lista_turno($valor->NIV_Codigo);
                foreach ($turno as $l=>$va){
                    $grados = $this->grado_model->listar_gradoSeccion($valor->NIV_Codigo,$val->AN_Codigo,$va->TUR_codigo);
                    if(count($grados)>0){
                        foreach ($grados as $ITEM=>$grad){
                            $grados[$ITEM]->cap = count($this->matricula_model->matricula_aula($grad->AE_Codigo));
                        }
                        $turno[$l]->grados = $grados;
                    }else{
                        $turno[$l]->grados = "---";
                    }
                }
                $nivel[$k]->turno = $turno;
            }
            $lista_body[$j]->nivel = $nivel;
        }
        $data['lista_body'] = $lista_body;
//        print_r($data['lista_body']);exit;
        $this->layout->view("matricula/matricula_index",$data);
    }
    
    public function nuevo($id){
        $data['error']          = "";
        $data['modulo']         = "Nueva Matricula";
        $data['action']         = base_url()._MATRICULA."insertar/".$id;
        $data['idform']         = "frmAddMatricula";
        $data['grado']          = $this->grado_model->obtener_grado($id);
        $data['oculto']         = "";
        $data['btnCancelar']    = base_url()._MATRICULA."index";
        $data['size_img']       = "3 MB.";
        $this->layout->view("matricula/matricula_nuevo",$data);
    }
    
    public function insertar($grado) {
        if(true){
            /*insertar alumno*/
            $alu_nombre     = $this->input->post('alu_nombre');
            $alu_paterno    = $this->input->post('alu_paterno');
            $alu_materno    = $this->input->post('alu_materno');
            $alu_dni        = $this->input->post('alu_dni');
            $alu_sexo       = $this->input->post('alu_sexo');
            $alu_nac        = $this->input->post('alu_nac');
            $stdPerAlu      = new stdClass();
            $stdPerAlu->nombre      = $alu_nombre;
            $stdPerAlu->paterno     = $alu_paterno;
            $stdPerAlu->materno     = $alu_materno;
            $stdPerAlu->dni         = $alu_dni;
            $stdPerAlu->fecha_nac   = $alu_nac;
            $stdPerAlu->sexo        = $alu_sexo;
            $peralu_id              = $this->persona_model->insertar($stdPerAlu);
            if($peralu_id > 0){
                $stdAlu = new stdClass();
                $stdAlu->PER_Codigo = $peralu_id;
                $alu_id = $this->alumno_model->insertar($stdAlu);
            }
            /*Fin insertar alumno*/

            /*insertar tutor*/
            $tut_nombre     = $this->input->post('pad_nombre');
            $tut_paterno    = $this->input->post('pad_paterno');
            $tut_materno    = $this->input->post('pad_materno');
            $tut_dni        = $this->input->post('pad_dni');
            $stdPerTut      = new stdClass();
            $stdPerTut->nombre      = $tut_nombre;
            $stdPerTut->paterno     = $tut_paterno;
            $stdPerTut->materno     = $tut_materno;
            $stdPerTut->dni         = $tut_dni;
            $stdPerTut->fecha_nac   = "";
            $stdPerTut->sexo        = "";
            $pertut_id      = $this->persona_model->insertar($stdPerTut);
            if($pertut_id>0){
                $stdTut     = new stdClass();
                $stdTut->PER_Codigo = $pertut_id;
                $tut_id     = $this->padre_model->insertar($stdTut);
            }
            /*Fin insertar tutor*/
            /*insertar matricula*/
            if($alu_id>0 && $tut_id>0){
                
                $mm_proc    = $this->input->post('alu_procedencia');
                $mm_code    = $this->generar_codigo_interno();
                $mm_tutor   = $tut_id;
                $mm_alu     = $alu_id;
                $mm_anioe   = $grado;
                $mm_anio    = date("Y");
                $stdMM      = new stdClass();
                $stdMM->MM_Procedencia  = $mm_proc;
                $stdMM->MM_Code         = $mm_code;
                $stdMM->PAD_Codigo      = $mm_tutor;
                $stdMM->ALU_Codigo      = $mm_alu;
                $stdMM->AE_Codigo       = $mm_anioe;
                $stdMM->MM_Anio         = $mm_anio;
                $mm_id      = $this->matricula_model->registro_maestroMatricula($stdMM);
                if($mm_id>0){
                    $config['upload_path'] = './upload/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '2000';
                    $config['max_width'] = '2024';
                    $config['max_height'] = '2008';
                    $config['width'] = '1024';
                    $config['height'] = '1024';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('files')) {
                        $error = array('error' => $this->upload->display_errors());
                        print_r($error);
                    }  else {
                        $file_info = $this->upload->data();
                        $objArc = new stdClass();
                        $objArc->ARC_Nombre = $file_info['file_name'];
                        $objArc->MM_Codigo = $mm_id;
                        $this->archivo_model->insertar($objArc);
                    }
                    $this->uddateCI();
                    /*insertar matricula del año*/
                    $stdMat = new stdClass();
                    $stdMat->MM_Codigo  = $mm_id;
                    $stdMat->AE_Codigo  = $grado;
                    $mat_id = $this->matricula_model->registro_matricula($stdMat);
                    if($mat_id>0){
                        $lista  = $this->curso_model->lista();
                        foreach ($lista as $is=>$value){
                            $stdMMDet = new stdClass();
                            $stdMMDet->MM_Codigo    = $mm_id;
                            $stdMMDet->CUR_Codigo   = $value->CUR_Codigo;
                            $stdMMDet->MMD_Nota     = $this->input->post('txt_'.$value->CUR_Codigo);
                            $mmDet_id = $this->matricula_model->registro_maestroMatriculaDetalle($stdMMDet);
                        }
                        $this->crear_usuario($mm_code, $mm_code, $alu_id, $this->_rolAlu);
                    }
                    /*Fin insertar matricula del año*/
                }
                redirect('matricula/matricula/index');
            }else{
                echo "error";
            }
        }
    }
    public function aulaListar($id){
        $data['grado']      = $this->grado_model->obtener_grado($id);
        $data['titulo']     = "AULA: ";
        $data['listado']    = $this->matricula_model->aula_listar($id);
        $data['nuevo']      = base_url()._MATRICULA."nuevo/".$id;
        $data['id']         = $id;
        $this->layout->view("matricula/aula_index", $data);
    }
    public function generar_codigo_interno(){
        $arrConf = $this->configuracion_model->listar(_PKCONF);
        $correlativo = $arrConf[0]->CONF_Correlativo;
        $anio = date('y');
        $tamCorrelativo = strlen($correlativo);
        $tamCI          = 8;/*CI = Código Interno*/
        $limit          = $tamCI-(strlen($anio)+$tamCorrelativo);
        for($i=1;$i<=$limit;$i++){
            $correlativo = "0".$correlativo;
        }
        return $anio.$correlativo;
    }
    public function uddateCI() {
        $arrConf = $this->configuracion_model->listar(_PKCONF);
        $correlativo = $arrConf[0]->CONF_Correlativo;
        $objCONF        = new stdClass();
        $objCONF->CONF_Correlativo = $correlativo+1;
        $this->configuracion_model->update_correlativo(_PKCONF,$objCONF);
    }
    public function crear_usuario($nombre, $pass, $id, $rol){
        $objUsuario = new stdClass();
        $objUsuario->USU_Nombre     = $nombre;
        $objUsuario->USU_Password   = $pass;
        $objUsuario->ALU_Codigo     = $id;
        $objUsuario->ROL_Codigo     = $rol;
        $idUsu = $this->usuario_model->insert_usuario($objUsuario);
        return $idUsu;
    }
    public function PDF($id){
        $data      = $this->grado_model->obtener_grado($id);
        $this->load->library('pdf');
        $this->pdf = new Pdf();
        $this->pdf->AddPage();
        $this->pdf->AliasNbPages();
        $this->pdf->SetTitle("Lista de alumnos");
        $this->pdf->SetLeftMargin(15);
        $this->pdf->SetRightMargin(15);
        $this->pdf->SetFillColor(200,200,200);
        /*Cabecera*/
        $this->pdf->SetFont('Arial', 'B', 9);
        $this->pdf->Cell(45,10,  utf8_decode('Nombre de la Instución'),'TBL',0,'C','1');
        $this->pdf->SetFillColor(255,255,255);
        $this->pdf->Cell(70,10,  utf8_decode('N° 1256 Alfonso Ugarte'),'TBL',0,'C','1');
        $this->pdf->SetFillColor(200,200,200);
        $this->pdf->Cell(25,5,  utf8_decode('DIRE'),'TBR',0,'C','1');
        $this->pdf->SetFillColor(255,255,255);
        $this->pdf->Cell(25,5,  utf8_decode(''),'TBR',0,'C','1');
        $this->pdf->SetFillColor(200,200,200);
        $this->pdf->Ln(5);
        $this->pdf->setX(130);
        $this->pdf->Cell(25,5,  utf8_decode('UGEL'),'TBR',0,'C','1');
        $this->pdf->SetFillColor(255,255,255);
        $this->pdf->Cell(25,5,  utf8_decode('06'),'TBR',0,'C','1');
        $this->pdf->Ln();
        $this->pdf->SetFillColor(200,200,200);
        $this->pdf->Cell(45,5,  utf8_decode('CODIGO MODULAR'),'TBL',0,'C','1');
        $this->pdf->Cell(25,5,  utf8_decode('Direción'),'TBL',0,'C','1');
        $this->pdf->SetFillColor(255,255,255);
        $this->pdf->Cell(95,5,  utf8_decode(''),'TBR',0,'C','1');
        $this->pdf->Ln();
        for($i=1; $i<=6; $i++){
            $this->pdf->Cell(7.5,5,  utf8_decode(''),'TBL',0,'C','1');
        }
        $this->pdf->SetFillColor(200,200,200);
        $this->pdf->Cell(32,5,  utf8_decode('Provincia'),'TBL',0,'C','1');
        $this->pdf->SetFillColor(255,255,255);
        $this->pdf->Cell(26,5,  utf8_decode('Lima'),'TBL',0,'C','1');
        $this->pdf->SetFillColor(200,200,200);
        $this->pdf->Cell(28,5,  utf8_decode('Distrito'),'TBL',0,'C','1');
        $this->pdf->SetFillColor(255,255,255);
        $this->pdf->Cell(34,5,  utf8_decode('Santa Anita'),'TBR',0,'C','1');
        $this->pdf->Ln();
        $this->pdf->SetFillColor(200,200,200);
        $this->pdf->Cell(20.6,5,  utf8_decode('Año/Grado'),'TBL',0,'C','1');
        $this->pdf->SetFillColor(255,255,255);
        $this->pdf->Cell(21,5,  utf8_decode($data[0]->anio),'TBR',0,'C','1');
        $this->pdf->SetFillColor(200,200,200);
        $this->pdf->Cell(20.4,5,  utf8_decode('Sección'),'TBL',0,'C','1');
        $this->pdf->SetFillColor(255,255,255);
        $this->pdf->Cell(20.6,5,  utf8_decode($data[0]->seccion),'TBR',0,'C','1');
        $this->pdf->SetFillColor(200,200,200);
        $this->pdf->Cell(20.6,5,  utf8_decode('Nivel'),'TBL',0,'C','1');
        $this->pdf->SetFillColor(255,255,255);
        $this->pdf->Cell(20.6,5,  utf8_decode($data[0]->nivel),'TBR',0,'C','1');
        $this->pdf->SetFillColor(200,200,200);
        $this->pdf->Cell(20.6,5,  utf8_decode('Turno'),'TBL',0,'C','1');
        $this->pdf->SetFillColor(255,255,255);
        $this->pdf->Cell(20.6,5,  utf8_decode($data[0]->turno),'TBR',0,'C','1');
        /*Fin Cabecera*/
        $this->pdf->Ln(10);
        /*Cuerpo*/
        $this->pdf->SetFillColor(200,200,200);
        $this->pdf->Cell(5,15,  utf8_decode('N°'),1,0,'C','1');
        $this->pdf->Cell(20,15,  utf8_decode('N° Matrícula'),1,0,'C','1');
        $this->pdf->Cell(90,15,  utf8_decode('Nombres y Apellidos'),1,0,'C','1');
        $this->pdf->Cell(5,15,  utf8_decode('S'),1,0,'C','1');
        $this->pdf->Cell(40,5,  utf8_decode('F. Nac'),1,0,'C','1');
        $this->pdf->Cell(15,15,  utf8_decode('Edad'),1,0,'C','1');
        $this->pdf->setXY(135,45);
        $this->pdf->Cell(10,10,  utf8_decode('D'),1,0,'C','1');
        $this->pdf->Cell(10,10,  utf8_decode('M'),1,0,'C','1');
        $this->pdf->Cell(20,10,  utf8_decode('M'),1,0,'C','1');
        $this->pdf->Ln();
        $lista = $this->matricula_model->aula_listar($id);
        foreach($lista as $id=>$value){
            $this->pdf->SetFillColor(200,200,200);
            $this->pdf->Cell(5,5,  utf8_decode($id+1),1,0,'C','1');
            $this->pdf->SetFillColor(255,255,255);
            $this->pdf->Cell(20,5,  utf8_decode($value->MM_Code),1,0,'C','1');
            $this->pdf->Cell(90,5,  utf8_decode($value->ALU_Nombre." ".$value->ALU_Paterno." ".$value->ALU_Materno),1,0,'L','1');
            $this->pdf->Cell(5,5,  utf8_decode($value->ALU_Sexo),1,0,'C','1');
            $this->pdf->Cell(10,5,  utf8_decode(date("d",  strtotime($value->ALU_Nac))),1,0,'C','1');
            $this->pdf->Cell(10,5,  utf8_decode(date("m",  strtotime($value->ALU_Nac))),1,0,'C','1');
            $this->pdf->Cell(20,5,  utf8_decode(date("Y",  strtotime($value->ALU_Nac))),1,0,'C','1');
            $this->pdf->Cell(15,5,  utf8_decode('24'),1,0,'C','1');
            $this->pdf->Ln();
        }
        /*Fin Cuerpo*/
        $this->pdf->Output("Lista_de_alumnos.pdf", 'D');
        exit();
    }
    
    
}
