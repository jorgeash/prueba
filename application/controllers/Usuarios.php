<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->model('MUsuarios');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('encryption');
    }

	public function usuario()
	{
        $data['nombre_usuario'] = ($this->session->userdata('nombre_usuario'));
        $data['usuario_rol']    = ($this->session->userdata('rol'));

        $this->load->view('templade/header', $data);

		$this->load->view('usuarios/usuario');

		$this->load->view('templade/footer');

	}

	public function login()
	{

		$this->form_validation->set_rules('usuario', 'Correo', 'required');
        $this->form_validation->set_rules('contrasena', 'Contraseña', 'required');


        if ($this->form_validation->run() == FALSE) {
            // La validación del formulario falló, mostrar errores
            $data['validacion'] = validation_errors();
            $data['msg'] = "error";
            echo json_encode( $data);
            return;

        } 

		$user 			=  trim($_POST['usuario']);
		$passwordForm 	=  trim($_POST['contrasena']);
	
		$data = $this->MUsuarios->validarUsuario($user);

		
        if ($data && $this->encryption->decrypt($data->password) == $passwordForm) {
                // Las credenciales son correctas, iniciar sesión
               	$this->session->set_userdata('usuario_id', $data->usuario_id);
				$this->session->set_userdata('nombre_usuario', $data->nombre);
				$this->session->set_userdata('rol', $data->rol);

				echo json_encode(array('status' => 'success'));
				
            }else{
				echo json_encode(array('status' => 'error'));

			}

	}

	public function getUsuario() {

        $data = $this->MUsuarios->getUsuarios();
      
		echo json_encode($data);
    }

	public function getUsuarioPago() {

        $data = $this->MUsuarios->getUsuariosPagos();
      
		echo json_encode($data);
    }

	public function guardarUsuario()
	{

		$this->form_validation->set_rules('nombres', 'Nombre', 'required');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
        $this->form_validation->set_rules('password', 'Contraseña', 'required');
        $this->form_validation->set_rules('rol_usuario', 'Tipo rol', 'required');
		$this->form_validation->set_rules('estado', 'Estado', 'required');


        if ($this->form_validation->run() == FALSE) {
            // La validación del formulario falló, mostrar errores
            $data['validacion'] = validation_errors();
            $data['msg'] = "error";
            echo json_encode( $data);
            return;

        } 
  
		$password =  $this->input->post('password');
		$encrypted_password = $this->encryption->encrypt($password);
        $data = array(

                'nombre'    => $this->input->post('nombres'),
                'apellido'  => $this->input->post('apellidos'),
                'email'     => $this->input->post('email'),
                'password'  => $encrypted_password,
                'rol'     	=> $this->input->post('rol_usuario'),
                'estado'    => $this->input->post('estado'),
        );

        $pagos = $this->MUsuarios->guardarUsuarios($data);
        echo json_encode(array('status' => 'success'));

	}

	public function borrarUsuario(){

		$usuario_id = $this->input->post('usuario_id');
		$this->MUsuarios->borrarUsuarios($usuario_id);
        echo json_encode(array('status' => 'success'));


	}

	public function salir() {

		$this->session->sess_destroy();
		redirect(base_url('Welcome'));
	}

	
}
