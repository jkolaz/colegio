<?php
	class Usuario_model extends CI_Model{
		protected $_name= "au_usuario";
		protected $_dbColegio = "";
		public function __construct(){
			parent::__construct();
			$this->_dbColegio = $this->load->database("default",TRUE);
		}
		public function obtener_usuario($usuario, $password){
			$where = array(
						'USU_Nombre'=>$usuario,
						'USU_Password'=>  md5($password),
						'USU_Flag'=>'1'
					);
			$query = $this->_dbColegio->where($where)->get($this->_name,1);
			$data = array();
			if($query->num_rows > 0){
				foreach($query->result() as $fila){
					$data[] = $fila;
				}
			}
			return $data;
		}
                public function insert_usuario($objUsuario) {
                    $arrUsuario = array("USU_Nombre"=>$objUsuario->USU_Nombre,
                                        "USU_Password"=>  md5($objUsuario->USU_Password));
                    switch ($objUsuario->ROL_Codigo){
                        case 1:/*ADMINISTRADOR*/
                            $arrUsuario['ADM_Codigo'] = $objUsuario->ADM_Codigo;
                            break;
                        case 2:/*ALUMNO*/
                            $arrUsuario['ALU_Codigo'] = $objUsuario->ALU_Codigo;
                            break;
                        case 3:/*PROFESOR*/
                            $arrUsuario['PERS_Codigo'] = $objUsuario->PERS_Codigo;
                            break;
                        case 4:/*DIRECTOR*/
                            $arrUsuario['PERS_Codigo'] = $objUsuario->PERS_Codigo;
                            break;
                        case 5:/*PADRE*/
                            $arrUsuario['PAD_Codigo'] = $objUsuario->PAD_Codigo;
                            break;
                    }
                    $arrUsuario['ROL_Codigo']=$objUsuario->ROL_Codigo;
                    $query = $this->_dbColegio->insert($this->_name,$arrUsuario);
                    if($query){
                        return $this->_dbColegio->insert_id();
                    }else{
                        return -1;
                    }
                }
                
                public function obtener_id($id) {
                    $where = array("USU_Codigo"=>$id,
                                    "USU_Flag"=>'1');
                    $query = $this->_dbColegio->where($where)->get($this->_name,1);
                    $data = array();
                    if($query->num_rows >0){
                        foreach ($query->result() as $value){
                            $data[] = $value;
                        }
                    }
                    return $data;
                }
                public function change_password($objUsuario){
                    $update = array("USU_Password"=>$objUsuario->USU_Passwordnew);
                    $where = array("USU_Password"=>$objUsuario->USU_Password,
                                    "USU_Nombre"=>$objUsuario->USU_Nombre);
                    $query = $this->_dbColegio
                            ->where($where)
                            ->update($this->_name,$update);
                    if($query){
                        return 1;
                    }else{
                        return 0;
                    }
                }
	}
?>