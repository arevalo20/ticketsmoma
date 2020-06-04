<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends CI_Controller {
	private $array_user_session;

	function __construct() {
		parent::__construct();
		$this->load->library('Utilerias');
		$this->load->library('Grid');

		$this->load->model('Ticket_model');

		if(Utilerias::verifica_session_redirige($this)){
			$this->array_user_session = Utilerias::get_session($this, DATOSUSUARIO);
			// echo "<pre>"; print_r($this->array_user_session); die();
			$this->user_logueado = 'Usuario '.$this->array_user_session->seguridad['tipousuario'].' - '.$this->array_user_session->seguridad['nombre'];
		}// verifica_session_redirige

}// __construct()

public function index(){
	if(Utilerias::verifica_session_redirige($this)){
		if (Utilerias::is_session_open($this)) {
			redirect("tickets", "refresh");
		} else {
			redirect("login", "refresh");
		}// else
	}// verifica_sesion_redirige
}// index()

}// class
