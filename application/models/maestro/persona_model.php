<?php
    class Persona_model extends CI_Model{
        protected $_name        = "au_persona";
        protected $_dbColegio   = "";
        public function __construct() {
            parent::__construct();
            $this->_dbColegio   = $this->load->database("default",TRUE);
        }
        public function insertar($stdpersona){
            $array  = array("PER_Nombre"    =>$stdpersona->nombre,
                            "PER_Paterno"   =>$stdpersona->paterno,
                            "PER_Materno"   =>$stdpersona->materno,
                            "PER_DNI"       =>$stdpersona->dni,
                            "PER_FechaNac"  =>$stdpersona->fecha_nac,
                            "PER_Sexo"      =>$stdpersona->sexo,
                            "PER_FechaReg"  =>'');
            $query  = $this->_dbColegio->insert($this->_name,$array);
            if($query){
                return $this->_dbColegio->insert_id();
            }else{
                0;
            }
        }
    }
?>