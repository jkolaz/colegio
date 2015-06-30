<?php
class Configuracion_model extends CI_Model{
    protected $_db = "";
    protected $_table = "au_configuracion";
    protected $_primary_key = "CONF_Codigo";
    
    public function __construct() {
        parent::__construct();
        $this->_db = $this->load->database("default",true);
    }
    public function listar($conf=""){
        $where = array();
        if($conf!=""){
            $where = array($this->_primary_key=>$conf);
        }
        $query = $this->_db->where($where)->order_by($this->_primary_key,"asc")->get($this->_table,1);
        $data   = array();
            if($query->num_rows > 0){
                foreach ($query->result() as $fila){
                    $data[] = $fila;
                }
            }
            return $data;
    }
    public function editar($id,$objCONF){
        $where  = array($this->_primary_key=>$id);
        $update = array("CONF_Anio"=>$objCONF->CONF_Anio,
                        "CONF_Correlativo"=>$objCONF->CONF_Correlativo,
                        "CONF_PRHoraInicio"=>$objCONF->CONF_PRHoraInicio,
                        "CONF_PRHoraFin"=>$objCONF->CONF_PRHoraFin,
                        "CONF_PRReseso"=>$objCONF->CONF_PRReseso,
                        "CONF_PRCanthours"=>$objCONF->CONF_PRCanthours,
                        "CONF_SEHoraInicio"=>$objCONF->CONF_SEHoraInicio,
                        "CONF_SEHoraFin"=>$objCONF->CONF_SEHoraFin,
                        "CONF_SEReseso"=>$objCONF->CONF_SEReseso,
                        "CONF_SECantHours"=>$objCONF->CONF_SECantHours);
        $this->_db->where($where)->update($this->_table,$update);
    }
    public  function update_correlativo($id,$objCONF){
        $where  = array($this->_primary_key=>$id);
        $update = array("CONF_Correlativo"=>$objCONF->CONF_Correlativo);
        $this->_db->where($where)->update($this->_table,$update);
    }
}

