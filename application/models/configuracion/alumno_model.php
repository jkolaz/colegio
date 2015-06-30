<?php
class Archivo_model extends CI_Model{
    protected $_name = "au_archivos";
    protected $_dbColegio = "";
    public function __construct(){
            parent::__construct();
            $this->_dbColegio = $this->load->database('default',TRUE);
    }
    public function image_alumno($alu){
        $where = array('MM_Codigo'=>$alu->MM_Codigo,
                        'ARC_FlagEstado'=>'1');
        $query = $this->_dbColegio->where($where)->get($this->_name,1);
        $data = array();
        if($query->num_rows>0){
            foreach ($query->result() as $value) {
                $data[] = $value;
            }
        }
        return $data;
    }

}
?>