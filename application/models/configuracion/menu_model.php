<?php
    class Menu_model extends CI_Model{
        protected $_name        = "au_menu";
        protected $_dbColegio   = "";
        public function __construct(){
            parent::__construct();
            $this->_dbColegio = $this->load->database('default',TRUE);
        }
        public function submenu($padre){
            $where = array(
                            'MEN_Padre'=>$padre,
                            'MEN_Flag'=>1
                        );
            $query = $this->_dbColegio->where($where)
                            ->get($this->_name);
            $data = array();
            if($query->num_rows > 0){
                foreach($query->result() as $fila){
                    $data[] = $fila;
                }
            }
            return $data;
        }
        public function menu(){
             $where = array(
                            'MEN_Padre'=>0,
                            'MEN_Flag'=>1
                        );
            $query = $this->_dbColegio->where($where)
                            ->get($this->_name);
            $data = array();
            if($query->num_rows > 0){
                foreach($query->result() as $fila){
                    $data[] = $fila;
                }
            }
            return $data;
        }
    }
?>
