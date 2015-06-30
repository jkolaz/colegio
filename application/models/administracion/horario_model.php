<?php
class horario_model extends CI_Model{
    protected $_table = "au_horario";
    protected $_primary_key = "HOR_Codigo";
    protected $_db = "";
    public function __construct() {
        parent::__construct();
        $this->_db = $this->load->database("default",true);
    }
    public function generar_prehorario($objHorario){
        $insert = array("AE_Codigo"     => $objHorario->AE_Codigo,
                        "HOR_HoraIni"   => $objHorario->HOR_HoraIni,
                        "HOR_HoraFin"   => $objHorario->HOR_HoraFin,
                        "HOR_Lunes"     => $objHorario->HOR_Lunes,
                        "HOR_Martes"    => $objHorario->HOR_Martes,
                        "HOR_Miercoles" => $objHorario->HOR_Miercoles,
                        "HOR_Jueves"    => $objHorario->HOR_Jueves,
                        "HOR_Viernes"   => $objHorario->HOR_Viernes,
                        "HOR_Anio"      => $objHorario->HOR_Anio);
        $query  = $this->_db->insert($this->_table,$insert);
        if($query){
            return $this->_db->insert_id();
        }else{
            return -1;
        }
    }
    public function is_generar_prehorario() {
        $where  = array("HOR_Anio"=>date("Y"),
                        "HOR_FlagEstado"=>"1");
        $query  = $this->_db->where($where)->get($this->_table);
        if($query->num_rows > 0){
            return FALSE;
        }else{
            return TRUE;
        }
    }
    public function horario_aula($id) {
        $where  = array("AE_Codigo"=>$id,
                        "HOR_Anio"=>date("Y"),
                        "HOR_FlagEstado"=>"1");
        $query  = $this->_db->where($where)->get($this->_table);
        $data   = array();
        if($query->num_rows > 0){
            foreach($query->result() as $fila){
                $data[] = $fila;
            }
        }
        return $data;
    }
}
