<?php
    class Personal_model extends CI_Model{
        protected $_name        = "au_personal";
        protected $_persona     = "au_persona";
        protected $_curso_profesor   = "au_curso_profesor";
        protected $_dbColegio   = "";
        public function __construct(){
            parent::__construct();
            $this->_dbColegio = $this->load->database('default',TRUE);
        }
        public function obtener_persona($personal){
            $where = array(
                            "PERS_Flag"=>1,
                            "PERS_Codigo"=>$personal
                            );
            $query = $this->_dbColegio->where($where)
                        ->join("au_persona","au_persona.PER_Codigo=au_personal.PER_Codigo")
                        ->get($this->_name);
            $data = array();
            if($query->num_rows > 0){
                foreach ($query->result() as $fila){
                    $data[] = $fila;
                }
            }
            return $data;
        }
        public function lista_profesores(){
            $where  = array("ROL_codigo"=>3,
                            "PERS_Flag"=>1);
            $query  = $this->_dbColegio->where($where)
                        ->join("au_persona","au_persona.PER_Codigo=au_personal.PER_Codigo")
                        ->get($this->_name);
            $data   = array();
            if($query->num_rows > 0){
                foreach($query->result() as $fila){
                    $data[] = $fila;
                }
            }
            return $data;
        }
        public function obtener($id){
            $where = array("PERS_Codigo"=>$id);
            $query = $this->_dbColegio->where($where)
                        ->get($this->_name);
            $data   = array();
            if($query->num_rows > 0){
                foreach ($query->result() as $fila){
                    $data[] = $fila;
                }
            }
            return $data;
        }
        public function cambiar_estado($id,$cambio){
            $update = array("PERS_FlagEstado"=>$cambio);
            $where  = array("PERS_Codigo"=>$id);
            $this->_dbColegio->where($where)->update($this->_name,$update);
        }
        public function eliminar($id){
            $update = array("PERS_Flag"=>0);
            $where  = array("PERS_Codigo"=>$id);
            $this->_dbColegio->where($where)->update($this->_name,$update);
        }
        public function insertar_profesor($stdprofesor){
            $array  = array("PER_Codigo"=>$stdprofesor->persona,
                            "ROL_Codigo"=>3);
            $this->_dbColegio->insert($this->_name,$array);
            return $this->_dbColegio->insert_id();
        }
        public function profesor_libre(){
            $where = array();
            $query = $this->_dbColegio->where($where)
                    ->join($this->_name,  $this->_curso_profesor.".PERS_Codigo!=".$this->_name.".PERS_Codigo")
                    ->join($this->_persona,  $this->_persona.".PER_Codigo=".$this->_name.".PER_Codigo")
                    ->get($this->_curso_profesor);
            $data = array();
            if($query->num_rows >0){
                foreach ($query->result() as $fila){
                    $data[] = $fila;
                }
            }
            return $data;
        }
        public function CP_disponible($objCP){
            $where = array("CUR_Codigo"=>$objCP->CUR_Codigo,
                            "PERS_Codigo"=>$objCP->PERS_Codigo);
            $query = $this->_dbColegio->where($where)
                    ->get($this->_curso_profesor);
            if ($query->num_rows>0){
                return true;
            }else{
                return false;
            }
        }

        public function insertar_CP($objCP){
            $insert = array("PERS_Codigo"=>$objCP->PERS_Codigo,
                            "CUR_Codigo"=>$objCP->CUR_Codigo);
            $this->_dbColegio->insert($this->_curso_profesor,$insert);
            return $this->_dbColegio->insert_id();
        }
    }
?>
