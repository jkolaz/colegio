<?php
class Administrador_model extends CI_Model{
    protected $_name        = "au_administrador";
    protected $_dbColegio   = "";
    public function __construct(){
        parent::__construct();
        $this->_dbColegio = $this->load->database('default',TRUE);
    }
    public function obtener_persona($personal){
        $where = array(
                        "ADM_FlagEstado"=>'1',
                        "ADM_Codigo"=>$personal
                        );
        $query = $this->_dbColegio->where($where)
                    ->join("au_persona","au_persona.PER_Codigo=".$this->_name.".PER_Codigo")
                    ->get($this->_name);
        $data = array();
        if($query->num_rows > 0){
            foreach ($query->result() as $fila){
                $data[] = $fila;
            }
        }
        return $data;
    }
}
