<?php
class Padre_model extends CI_Model{
    protected $_name        = "au_padre";
    protected $_dbColegio   = "";
    public function __construct(){
        parent::__construct();
        $this->_dbColegio = $this->load->database('default',TRUE);
    }
    public function obtener_persona($padre){
        $where = array(
                    "PAD_Flag" => 1,
                    "PAD_Codigo" => $padre
                );
        $query = $this->_dbColegio->where($where)
                    ->join("au_persona","au_persona.PER_Codigo=au_padre.PER_Codigo")
                    ->get($this->_name);
        $data = array();
        if($query->num_rows > 0){
            foreach ($query->result() as $fila){
                $data[] = $fila;
            }
        }
        return $data;
    }
    public function insertar($stdPadre) {
        $insert = array("PER_Codigo"=>$stdPadre->PER_Codigo);
        $query  = $this->_dbColegio->insert($this->_name, $insert);
        if($query){
            $id = $this->_dbColegio->insert_id();
        }else{
            $id = -1;
        }
        return $id;
    }
}
?>
