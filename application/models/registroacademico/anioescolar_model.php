<?php
class anioescolar_model extends CI_Model{
    protected $_table = "au_anio_escolar";
    protected $_primary_key = "AE_Codigo";
    protected $_db = "";
    public function __construct() {
        parent::__construct();
        $this->_db = $this->load->database('default',TRUE);
    }
    public function listar(){
        $where  = array("AE_FlagEstado"=>"1");
        $query = $this->_db->where($where)->get($this->_table);
        $data = array();
        if($query->num_rows > 0){
            foreach ($query->result() as $value){
                $data[] = $value;
            }
        }
        return $data;
    }
}
