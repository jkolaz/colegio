<?php
class Alumno_model extends CI_Model{
    protected $_name = "au_alumno";
    protected $_dbColegio = "";
    public function __construct(){
            parent::__construct();
            $this->_dbColegio = $this->load->database('default',TRUE);
    }
    public function obtener_persona($alumno){
            $where  = array('ALU_Flag'=>1,
                            'ALU_Codigo'=>$alumno
                            );
            $query = $this->_dbColegio->where($where)
                            ->join('au_persona','au_alumno.PER_Codigo=au_persona.PER_Codigo')
                            ->get($this->_name);
            $data = array();
            if($query->num_rows > 0){
                foreach($query->result() as $fila){
                    $data[] = $fila;
                }
            }
            return $data;
    }
    public function insertar($stdAlu) {
        $insert = array("PER_Codigo"=>$stdAlu->PER_Codigo);
        $query  = $this->_dbColegio->insert($this->_name,$insert);
        if($query){
            $id = $this->_dbColegio->insert_id();
        }else{
            $id = -1;
        }
        return $id;
    }

}
?>