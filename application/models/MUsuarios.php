<?php

class MUsuarios extends CI_Model {


    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function validarUsuario($user) {

        $this->db->where('estado', 'Activo' );
        $this->db->where('email', $user );
        $query = $this->db->get('Usuarios');
        
        return $query->row();
    }

    public function getUsuarios() {
        //$this->db->where('estado');
        $query = $this->db->get('Usuarios');
        
        return  $query->result();;
    }

    public function getUsuariosPagos() {
        $this->db->where('estado','Activo');
        $query = $this->db->get('Usuarios');
        
        return  $query->result();;
    }

    public function guardarUsuarios($data) {
        $this->db->insert('Usuarios', $data);
        return $this->db->insert_id();
    }

    public function borrarUsuarios($id) {
        $this->db->where('usuario_id', $id);
        $this->db->delete('Usuarios');
        return $this->db->affected_rows();
    }
}