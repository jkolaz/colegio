<?php
    class Curso_model extends CI_Model{
        protected $_name        = "au_curso";
        protected $_curso_profesor  = "au_curso_profesor";
        protected $_profesor  = "au_personal";
        protected $_persona  = "au_persona";
        protected $_dbColegio   = "";
        public function __construct() {
            parent::__construct();
            $this->_dbColegio = $this->load->database('default',TRUE);
        }
        public function lista(){
            $where  = array(
                            'CUR_Flag' =>1
                        );
            $query  = $this->_dbColegio->where($where)
                        ->get($this->_name);
            $data = array();
            if($query->num_rows>0){
                foreach($query->result() as $fila){
                    $data[] = $fila;
                }
            }
            return $data;
        }
        public function insertar($objcurso){
            $array  = array("CUR_CodigoInterno" => $objcurso->CUR_CodigoInterno,
                            "NIV_Codigo" => $objcurso->NIV_Codigo,
                            "CUR_NomCorto" => $objcurso->CUR_NomCorto,
                            "CUR_Descripcion"   => $objcurso->CUR_Descripcion
                        );
            $this->_dbColegio->insert("au_curso",$array);
            return $this->_dbColegio->insert_id();
        }
        public function obtener($id){
            $where  = array("CUR_Codigo"=>$id);
            $query  = $this->_dbColegio->where($where)
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
            $update = array("CUR_FlagEstado"=>$cambio);
            $this->_dbColegio->where("CUR_Codigo",$id)->update($this->_name,$update);
        }
        public function eliminar_curso($id){
            $update = array("CUR_Flag"=>0);
            $this->_dbColegio->where("CUR_Codigo",$id)->update($this->_name,$update);
        }
        public function modificar($id,$stdcurso){
            $update = array("CUR_CodigoInterno" => $stdcurso->CUR_CodigoInterno,
                            "NIV_Codigo" => $stdcurso->NIV_Codigo,
                            "CUR_NomCorto"   => $stdcurso->CUR_NomCorto,
                            "CUR_Descripcion"   => $stdcurso->CUR_Descripcion);
            $this->_dbColegio->where("CUR_Codigo",$id)->update($this->_name,$update);
        }
        public function profesor($id){
            $where = array($this->_name.".CUR_Codigo"=>$id);
            $query = $this->_dbColegio->where($where)
                    ->join($this->_curso_profesor,  $this->_curso_profesor.".CUR_Codigo=".$this->_name.".CUR_Codigo")
                    ->join($this->_profesor,  $this->_profesor.".PERS_Codigo=".$this->_curso_profesor.".PERS_Codigo")
                    ->join($this->_persona,  $this->_persona.".PER_Codigo=".$this->_profesor.".PER_Codigo")
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
?>
