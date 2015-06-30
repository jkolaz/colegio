<?php
class Grado_model extends CI_Model{
    protected $_table   = "au_anio_escolar";
    protected $_tAnio   = "au_anio";
    protected $_db      = "";
    public function __construct() {
        parent::__construct();
        $this->_db = $this->load->database("default",TRUE);
    }
    public function listar($nivel){
        $where = array("NIV_Codigo"=>$nivel);
        $query = $this->_db->where($where)
                ->join("au_anio","au_anio_escolar.AN_Codigo = au_anio.AN_Codigo")
                ->get($this->_table);
        $data   = array();
        if($query->num_rows > 0){
            foreach ($query->result() as $fila){
                $data[] = $fila;
            }
        }
        return $data;
    }
    public function obtener_gradoNivel($nivel){
        $sql  = "select distinct AN_Codigo
                from au_anio_escolar
                where au_anio_escolar.NIV_Codigo=".$nivel;
        $query = $this->_db->query($sql);
        $data   = array();
        if($query->num_rows > 0){
            foreach ($query->result() as $fila){
                $data[] = $fila;
            }
        }
        return $data;
    }
    public function obtener_gradoText($nivel) {
        $sql = "select distinct au_anio_escolar.AN_Codigo,
                (select AN_AnioText from au_anio where au_anio_escolar.AN_Codigo=au_anio.AN_Codigo) as texto
                from au_anio_escolar
                where au_anio_escolar.NIV_Codigo=".$nivel;
        $query = $this->_db->query($sql);
        $data   = array();
        if($query->num_rows > 0){
            foreach ($query->result() as $fila){
                $data[] = $fila;
            }
        }
        return $data;
    }
    public function grados(){
        $where = array();
        $query  = $this->_db->order_by($this->_tAnio.".AN_AnioNum","asc")->get($this->_tAnio);
        $data   = array();
        if($query->num_rows > 0){
            foreach ($query->result() as $fila){
                $data[] = $fila;
            }
        }
        return $data;
    }
    public function listar_gradoSeccion($nivel, $anio, $turno){
        $sql  = "select AE_Codigo, NIV_Codigo, AE_Capacidad,
                (select SEC_Desc from au_seccion where au_seccion.SEC_Codigo=au_anio_escolar.SEC_Codigo) seccion
                from au_anio_escolar
                where AN_Codigo={$anio}
                and NIV_Codigo={$nivel}
                and TUR_Codigo={$turno}";
        $query = $this->_db->query($sql);
        $data   = array();
        if($query->num_rows > 0){
            foreach ($query->result() as $fila){
                $data[] = $fila;
            }
        }
        return $data;
    }
    public function obtener_grado($id) {
        $sql = "select AE_Codigo, TUR_Codigo, SEC_Codigo, NIV_Codigo, AN_Codigo,
                ( select TUR_Desc from au_turno where au_turno.TUR_Codigo=au_anio_escolar.TUR_Codigo ) as turno,
                ( select SEC_Desc from au_seccion where au_seccion.SEC_Codigo={$this->_table}.SEC_Codigo ) as seccion,
                ( select NIV_Desc from au_nivel where au_nivel.NIV_Codigo={$this->_table}.NIV_Codigo ) as nivel,
                ( select AN_AnioText from au_anio where au_anio.AN_Codigo={$this->_table}.AN_Codigo ) as anio
                from {$this->_table}
                where AE_Codigo=".$id;
        $query = $this->_db->query($sql);
        $data   = array();
        if($query->num_rows > 0){
            foreach ($query->result() as $fila){
                $data[] = $fila;
            }
        }
        return $data;
    }
}
