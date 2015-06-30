<?php
class Archivo_model extends CI_Model{
    protected $_table = "au_archivos";
    protected $_db = "";
    public function __construct() {
        parent::__construct();
        $this->_db = $this->load->database("default",true);
    }
    public function insertar($objArc){
        $insert = array("MM_Codigo"=>$objArc->MM_Codigo,
                        "TA_Codigo"=>1,
                        "ARC_Nombre"=>$objArc->ARC_Nombre,
                        "ARC_Fecha"=>date('Y-m-d H:i:s'));
        $this->_db->insert($this->_table,$insert);
        return $this->_db->insert_id();
    }
    public function image_alumno($alu){
        $where = array('MM_Codigo'=>$alu->MM_Codigo,
                        'ARC_FlagEstado'=>'1');
        $query = $this->_db->where($where)->get($this->_table,1);
        $data = array();
        if($query->num_rows>0){
            foreach ($query->result() as $value) {
                $data[] = $value;
            }
        }
        return $data;
    }
}
