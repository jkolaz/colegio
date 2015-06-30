<?php if(!defined('BASEPATH')) exit('no permitir el acceso al script');
class Acesso {
    public function acceder(){
        $arrSession = $this->session->userdata;
        if(!isset($arrSession['acceso']) && $arrSession['acceso']!=1){
            redirect('index');
        }
    }
}
