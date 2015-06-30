<?php
class Nivel_model extends CI_Model{
    protected $_table = "au_nivel";
    protected $_db      = "";
    public function __construct() {
        parent::__construct();
        $this->_db = $this->load->database("default",TRUE);
    }
    public function listar(){
        $sql = "select A.*
                from au_nivel A";
        $query = $this->_db->query($sql);
        $data = array();
        if($query->num_rows > 0){
            foreach ($query->result() as $fila){
                $data[] = $fila;
            }
        }
        return $data;
    }
    public function obtener($nivel){
        $where  = array("NIV_Codigo"=>$nivel);
        $query  = $this->_db->where($where)->get($this->_table);
        $data = array();
        if($query->num_rows > 0){
            foreach ($query->result() as $fila){
                $data[] = $fila;
            }
        }
        return $data;
    }
    public function lista_turno($nivel){
        $sql  = "select AE_Codigo, NIV_Codigo, TUR_codigo,
                (select TUR_Desc from au_turno where au_turno.TUR_Codigo=au_anio_escolar.TUR_Codigo) turno
                from au_anio_escolar
                where NIV_Codigo=".$nivel."
                group by TUR_Codigo";
        $query = $this->_db->query($sql);
        $data   = array();
        if($query->num_rows > 0){
            foreach ($query->result() as $fila){
                $data[] = $fila;
            }
        }
        return $data;
    }
    public function nivel_texto($id){
        $where = array("NIV_Codigo"=>$id);
        $query  = $this->_db->where($where)->get($this->_table,1);
        $data = "";
        if($query->num_rows >0){
            foreach ($query->result() as $fila){
                $data = $fila->NIV_Desc;
            }
        }
        return $data;
    }
}
