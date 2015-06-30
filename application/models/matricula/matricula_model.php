<?php
class Matricula_model extends CI_Model{
    protected $_TMaestra        = "au_maestro_matricula";
    protected $_TMaestraDet     = "au_maestro_matricula_detalle";
    protected $_TMatricula      = "au_matricula";
    protected $_TMatriculaDet   = "au_matricula_detalle";
    protected $_db              = "";
    public function __construct() {
        parent::__construct();
        $this->_db = $this->load->database("default", TRUE);
    }
    public function registro_maestroMatricula(stdClass $obj){
        $insertMM   = array("MM_Procedencia"=>$obj->MM_Procedencia,
                            "ALU_Codigo"=>$obj->ALU_Codigo,
                            "PAD_Codigo"=>$obj->PAD_Codigo,
                            "MM_Code"=>$obj->MM_Code,
                            "AE_Codigo"=>$obj->AE_Codigo,
                            "MM_Anio"=>$obj->MM_Anio);
        $query = $this->_db->insert($this->_TMaestra,$insertMM);
        if($query){
            $id = $this->_db->insert_id();
        }else{
            $id = -1;
        }
        return $id;
    }
    public function registro_maestroMatriculaDetalle(stdClass $obj){
        $insert = array("MM_Codigo"=>$obj->MM_Codigo,
                        "CUR_Codigo"=>$obj->CUR_Codigo,
                        "MMD_Nota"=>$obj->MMD_Nota);
        $query = $this->_db->insert($this->_TMaestraDet,$insert);
         if($query){
            $id = $this->_db->insert_id();
        }else{
            $id = -1;
        }
        return $id;
    }
    public function registro_matriculaDetalle(stdClass $obj){
        $insertMD   = array("MAT_Codigo"=>$obj->MAT_Codigo,
                            "CUR_Codigo"=>$obj->CUR_Codigo);
        $query = $this->_db->insert($this->_TMatriculaDet,$insertMD);
        if($query){
            $id = $this->_db->insert_id();
        }else{
            $id = -1;
        }
        return $id;
    }
    public function registro_matricula(stdClass $obj){
        $insert     = array("MM_Codigo"=>$obj->MM_Codigo,
                            "AE_Codigo"=>$obj->AE_Codigo);
        $query = $this->_db->insert($this->_TMatricula,$insert);
        if($query){
            $id = $this->_db->insert_id();
        }else{
            $id = -1;
        }
        return $id;
    }
    public function matricula_aula($id){
        $where = array("AE_Codigo"=>$id,
                        "MAT_FlagEstado"=>"1");
        $query = $this->_db->where($where)->get($this->_TMatricula);
        $data = array();
        if($query->num_rows>0){
            foreach ($query->result() as $valor){
                $data[] = $valor;
            }
        }
        return $data;
    }
    public function aula_listar($id) {
        $sQuery1    = "(select au_persona.PER_Nombre from au_persona 
                        inner join au_alumno on au_persona.PER_Codigo=au_alumno.PER_Codigo
                        where au_alumno.ALU_Codigo=au_maestro_matricula.ALU_Codigo) as ALU_Nombre
                        ";
        $sQuery2    = "(select au_persona.PER_Paterno from au_persona 
                        inner join au_alumno on au_persona.PER_Codigo=au_alumno.PER_Codigo
                        where au_alumno.ALU_Codigo=au_maestro_matricula.ALU_Codigo) as ALU_Paterno
                        ";
        $sQuery3    = "(select au_persona.PER_Materno from au_persona 
                        inner join au_alumno on au_persona.PER_Codigo=au_alumno.PER_Codigo
                        where au_alumno.ALU_Codigo=au_maestro_matricula.ALU_Codigo) as ALU_Materno
                        ";
        $sQuery4    = "(select au_persona.PER_Dni from au_persona 
                        inner join au_alumno on au_persona.PER_Codigo=au_alumno.PER_Codigo
                        where au_alumno.ALU_Codigo=au_maestro_matricula.ALU_Codigo) as ALU_Dni
                        ";
        $sQuery5    = "(select au_persona.PER_Sexo from au_persona 
                        inner join au_alumno on au_persona.PER_Codigo=au_alumno.PER_Codigo
                        where au_alumno.ALU_Codigo=au_maestro_matricula.ALU_Codigo) as ALU_Sexo
                        ";
        $sQuery6    = "(select au_persona.PER_FechaNac from au_persona 
                        inner join au_alumno on au_persona.PER_Codigo=au_alumno.PER_Codigo
                        where au_alumno.ALU_Codigo=au_maestro_matricula.ALU_Codigo) as ALU_Nac
                        ";
        $where = array("au_matricula.AE_Codigo"=>$id,
                        "MAT_FlagEstado"=>"1");
        $query = $this->_db->where($where)
                ->join($this->_TMaestra,"au_matricula.MM_Codigo=au_maestro_matricula.MM_Codigo")
                ->join("au_padre","au_padre.PAD_Codigo=au_maestro_matricula.PAD_Codigo")
                ->join("au_persona","au_persona.PER_Codigo=au_padre.PER_Codigo")
                ->select("au_maestro_matricula.MM_Codigo,
                        au_maestro_matricula.MM_Code,
                        au_matricula.MAT_Codigo,
                        au_matricula.AE_Codigo,
                        au_maestro_matricula.PAD_Codigo,
                        au_maestro_matricula.ALU_Codigo,
                        au_padre.PER_Codigo,
                        au_persona.PER_Nombre,
                        au_persona.PER_Materno,
                        au_persona.PER_Paterno,
                        au_persona.PER_Dni,
                        ".$sQuery1.",".
                        $sQuery2.",".
                        $sQuery3.",".
                        $sQuery4.",".
                        $sQuery5.",".
                        $sQuery6)
                ->get($this->_TMatricula);
        $data = array();
        if($query->num_rows>0){
            foreach ($query->result() as $valor){
                $data[] = $valor;
            }
        }
        return $data;
    }
}
