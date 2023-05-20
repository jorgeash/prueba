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

        $this->db->select('*');
        $this->db->from('Pagos');
        $this->db->where('usuarios.usuario_id', $usuario_id);
        $this->db->join('Usuarios', 'usuarios.usuario_id = pagos.usuario_id');
        $query = $this->db->get();
        
        return  $query->result();;
    }

    public function getPagosAdmin(){

        $this->db->select('*');
        $this->db->from('Pagos');
        $this->db->join('Usuarios', 'usuarios.usuario_id = pagos.usuario_id');
        $this->db->order_by('Usuarios.nombre', 'asc');
        $query = $this->db->get();
        
        return  $query->result();;
    }
}