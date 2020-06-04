<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('Utilerias');
		$this->load->library('form_validation');

		$this->load->model('Seguridad_model');


	}

	public function index(){
		if (Utilerias::is_session_open($this)) {
			redirect("panel", "refresh");
		} else {
			$this->load->view('login/index');
		}
	}// index()

	public function validar(){
		if (Utilerias::is_session_open($this)) {
			redirect("panel", "refresh");
		} else {
			if($this->form_validation_login()){
				$username = $this->input->post('itxt_login_username');
				$clave = $this->input->post('itxt_login_clave');

				$result = $this->Seguridad_model->validar_login($username,$clave);
				// echo "<pre>"; print_r($result); die();
				if(count($result) > 0){
					if($result[0]['estatus'] == 0){
						Utilerias::set_flash_message($this, MESSAGE_ERROR, 'Acceso bloqueado');
						$this->load->view('login/index', array());
					}else{
						$usuario = new \stdClass;
						$usuario->seguridad = $result[0];

						// echo "<pre>"; print_r($usuario); die();
						// (object)$result[0];
						Utilerias::set_session($this, DATOSUSUARIO, $usuario);

						redirect("panel", "refresh");
					}
				}else{
					Utilerias::set_flash_message($this, MESSAGE_ERROR, 'Datos incorrectos');
					redirect('login', 'refresh');
				}
			}
		}// else
	}// validar()

	function cerrar_sesion() {
		// $this->session->unset_userdata(array(DATOSUSUARIO, VENTALOCAL));
		$this->session->unset_userdata(array(DATOSUSUARIO));
		session_destroy();
		redirect('/');
	}

	function form_validation_login() {
		$this->form_validation->set_rules('itxt_login_username', 'usuario', 'required',  array('required' => 'Ingrese su %s'));
		$this->form_validation->set_rules('itxt_login_clave', 'contraseña', 'required', array('required' => 'Ingrese su %s'));
		// return $this->form_validation->run();
		if (!$this->form_validation->run()) {
			Utilerias::set_flash_message($this, MESSAGE_ERROR, 'Atienda los errores');
			$data['array_errors'] = $this->form_validation->error_array();
			$this->load->view('login/index', $data);
		} else {
			return TRUE;
		}
	}// formulario_valido_login()

}// class
