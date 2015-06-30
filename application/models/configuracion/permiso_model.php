<?php
    class Permiso_model extends CI_Model{
        protected $_name        = "au_permiso";
        protected $_dbColegio   = "";
        public function __construct(){
            parent::__construct();
            $this->_dbColegio = $this->load->database('default',TRUE);
            //$this->somevar['rol'] = $this->session->userdata('rol');
        }
        public function obtener_menu(){
            $where = array(
                            'ROL_Codigo' => $this->session->userdata('rol'),
                            'PERM_Flag' => 1,
                            'MEN_padre' => 0
                    );
            $query = $this->_dbColegio->where($where)
                            ->join('au_menu','au_menu.MEN_Codigo=au_permiso.MEN_Codigo')
                            ->get($this->_name);
            $data = array();
            if($query->num_rows >0){
                foreach ($query->result() as $fila){
                    $data[] = $fila;
                }
            }
            return $data;
        }
    }
?>
