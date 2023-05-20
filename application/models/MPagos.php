<?php

class MPagos extends CI_Model {


    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function guardaPagos($data) {
        $this->db->insert('Pagos', $data);
        return $this->db->insert_id();
    }

    public function getPagos($usuario_id){

        $this->db->where('usuario_id', $usuario_id);
        $query = $this->db->get('Pagos');
        
        return  $query->result();;
    }

    public function getPagosAdmin(){

        $query = $this->db->get('Pagos');
        
        return  $query->result();;
    }
}