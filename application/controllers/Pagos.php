<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pagos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('MPagos');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function listPagosUsurios()
	{

        if ($this->session->userdata('nombre_usuario')) {

            $data['nombre_usuario'] = ($this->session->userdata('nombre_usuario'));
            $data['usuario_rol']    = ($this->session->userdata('rol'));
    
            $this->load->view('templade/header', $data);
    
            $this->load->view('pagos/pagos_usuarios');
    
            $this->load->view('templade/footer');
            
        } else {
            // La sesión no existe
                redirect(base_url('Welcome'));
        }

       

	}

	public function pago()
	{
        $data['nombre_usuario'] = ($this->session->userdata('nombre_usuario'));
        $data['usuario_rol']    = ($this->session->userdata('rol'));
    
    

        if (($this->session->userdata('rol') == 'Administrador')){

            $this->load->view('templade/header', $data);

            $this->load->view('pagos/pago');
    
            $this->load->view('templade/footer');

        }else{

            $this->load->view('templade/header', $data);

            $this->load->view('pagos/pagos_usuarios');
    
            $this->load->view('templade/footer');

        }
       

	}
	
	public function guardarPago()
	{

        $this->form_validation->set_rules('usuario_id', 'Usuario', 'required');
        $this->form_validation->set_rules('tipo_pago', 'Tipo de Pago', 'required');
        $this->form_validation->set_rules('cantidad', 'Cantidad', 'required');
        $this->form_validation->set_rules('monto_pagar', 'Monto a pagar', 'required');


        if ($this->form_validation->run() == FALSE) {
            // La validación del formulario falló, mostrar errores
            $data['validacion'] = validation_errors();
            $data['msg'] = "error";
            echo json_encode( $data);
            return;

        } 

        $fecha = $this->input->post('fecha_pagar');
        $fecha_formateada = date('Y/m/d', strtotime(substr($fecha, 0, 24)));

        $data = array(

                'usuario_id'     => $this->input->post('usuario_id'),
                'tipo_pago'      => $this->input->post('tipo_pago'),
                'cantidad'       => $this->input->post('cantidad'),
                'monto_pagar'    => $this->input->post('monto_pagar'),
                'total_pagar'    => ($this->input->post('cantidad') * $this->input->post('monto_pagar')),
                'fecha_pago'     => $fecha_formateada,
                'comentario'     => $this->input->post('comentario'),
        );

        $pagos = $this->MPagos->guardaPagos($data);
        echo json_encode(array('status' => 'success'));

	}

    public function getPago(){

        $this->load->model('MUsuarios');

        $usuario_rol = ($this->session->userdata('rol'));

        if ($usuario_rol == 'Administrador'){

            $data = $this->MPagos->getPagosAdmin();
            
            echo json_encode($data);
            return;
        }

        $usuario_id = ($this->session->userdata('usuario_id'));
        $data = $this->MPagos->getPagos($usuario_id);
      
		echo json_encode($data);


    }
}
