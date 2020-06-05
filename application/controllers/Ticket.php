<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ticket extends CI_Controller
{
	private $array_user_session;

	function __construct()
	{
		parent::__construct();
		$this->load->library('Utilerias');
		$this->load->library('Grid');
		$this->load->library('form_validation');

		$this->load->model('Ticket_model');
		$this->load->model('Seccion_model');
		$this->load->model('Imagenes_xticket_model');
		$this->load->model('Ticket_mensajes_model');

		if (Utilerias::verifica_session_redirige($this)) {
			$this->array_user_session = Utilerias::get_session($this, DATOSUSUARIO);
			// $this->user_logueado = $this->array_user_session->seguridad['nombre'];
			// echo "<pre>"; print_r($this->array_user_session); die();
			$this->user_logueado = $this->array_user_session->seguridad['nombre'] . ' ' .
				$this->array_user_session->seguridad['apellido1'] . ' ' .
				$this->array_user_session->seguridad['apellido2'] . '[' . $this->array_user_session->seguridad['tipousuario'] . ']';
		} // verifica_session_redirige

		$this->idkey = "idticket";
		$this->arr_columnas_grid =
			array(
				"idticket" => array("type" => "hidden", "header" => "ID", "width" => "5%"),
				"titulo" => array("type" => "text", "header" => "Título", "width" => "85%"),
				"seccion" => array("type" => "text", "header" => "Sección", "width" => "85%"),
				"prioridad" => array("type" => "text", "header" => "Prioridad", "width" => "85%")


			);

		if (true) {
			$this->arr_columnas_grid['ver_detalles'] = array(
				"type" => "button", "header" => "", "width" => "5%",
				"arr_config" => array(
					'link' => 'tickets/detalles',
					'accion' => 'to_route',
					'icon' => '<i class="fa fa-info"></i>',
					'class_btn' => 'btn btn-info btn-sm',
					'tooltip' => 'Ver detalles'
				)
			);
		}



		$this->grid = new Grid();

		$this->arr_prioridades = (object) array(
			array('idprioridad' => 'N', 'prioridad' => 'NORMAL'),
			array('idprioridad' => 'U', 'prioridad' => 'URGENTE')
		);

		$this->array_ticket = array(
			"idticket" => 0,
			"titulo" => "",
			"descripcion" => 0,
			"prioridad" => "",
			"idseccion" => 0,
			"idestatus" => 0
		);


		//
		$this->idkey = "idticket";
		$this->arr_columnas_grid =
			array(
				"idticket" => array("type" => "text", "header" => "Ticket", "width" => "5%"),
				"titulo" => array("type" => "text", "header" => "Título", "width" => "40%"),
				"seccion" => array("type" => "text", "header" => "Sección", "width" => "10%"),
				"prioridad" => array("type" => "text", "header" => "Prioridad", "width" => "10%"),
				"estatus" => array("type" => "text_class", "header" => "Estatus", "width" => "10%"),
				"fcreacion" => array("type" => "datetime", "header" => "Fecha de registro", "width" => "25%")

			);

		if (true) {
			$this->arr_columnas_grid['ver_detalles'] = array(
				"type" => "button", "header" => "", "width" => "5%",
				"arr_config" => array(
					'link' => 'tickets/detalles',
					'accion' => 'to_route',
					'icon' => '<i class="fa fa-info-circle"></i>',
					'class_btn' => 'btn btn-detalles btn-sm',
					'tooltip' => 'Ver detalles'
				)
			);
			$this->arr_columnas_grid['mensajes'] = array(
				"type" => "button", "header" => "", "width" => "5%",
				"arr_config" => array(
					'link' => 'tickets/respuestas',
					'accion' => 'to_route',
					'icon' => '<i class="fa fa-envelope"></i>',
					'class_btn' => 'btn btn-secondary btn-sm',
					'tooltip' => 'Ver / escribir una respuesta'
				)
			);
		}

		// echo "<pre>";  print_r($this->array_user_session->seguridad['idtipousuario']); die();
		if (($this->array_user_session->seguridad['idtipousuario'] == USUARIO_TIPO_SISTEMAS) || ($this->array_user_session->seguridad['idtipousuario'] == USUARIO_TIPO_ADMINISTRADOR)) {
			$this->arr_columnas_grid['autorizar_ticket'] = array(
				"type" => "button", "header" => "", "width" => "5%",
				"arr_config" => array(
					'link' => '',
					'accion' => 'autorizar_ticket',
					'icon' => '<i class="fa fa-check"></i>',
					'class_btn' => 'btn btn-autorizar btn-sm',
					'tooltip' => 'Autorizar ticket'
				)
			);
		}

		if (($this->array_user_session->seguridad['idtipousuario'] == USUARIO_TIPO_SISTEMAS)) {
			$this->arr_columnas_grid['solucionar_ticket'] = array(
				"type" => "button", "header" => "", "width" => "5%",
				"arr_config" => array(
					'link' => '',
					'accion' => 'solucionar_ticket',
					'icon' => '<i class="fa fa-check-double"></i>',
					'class_btn' => 'btn btn-realizado btn-sm',
					'tooltip' => 'Marcar como solucionado'
				)
			);
		}

		$this->grid = new Grid();
	} // __construct()

	public function index()
	{
		if (Utilerias::verifica_session_redirige($this)) {
			// echo "panel";
			$data = array();
			// echo "<pre>"; print_r($this->array_user_session->seguridad['idtipousuario']); die();
			$total_datos = $this->Ticket_model->get('', -1, -1);
			$this->grid->set_configs_paginador($this->arr_columnas_grid, $this->idkey, GRID_THEME, $total_datos, VALORES_XPAGINA);
			$offset = $this->grid->get_offset($_POST);
			$array_tickets = $this->Ticket_model->get('', $offset, VALORES_XPAGINA);
			// echo "<pre>"; print_r($array_tickets); die();
			$this->grid->set_data($array_tickets);
			$str_grid = $this->grid->get_table();

			$data['idtipousuario'] = $this->array_user_session->seguridad['idtipousuario'];
			$data['str_grid'] = $str_grid;

			Utilerias::load_page_backend($this, 'ticket/index', $data);
		} // verifica_sesion_redirige
	} // index()

	public function get_gridpaginador()
	{
		if (Utilerias::isRequestAjax($this)) {

			$data = array();

			$total_datos = $this->Ticket_model->get('', -1, -1);
			$this->grid->set_configs_paginador($this->arr_columnas_grid, $this->idkey, GRID_THEME, $total_datos, VALORES_XPAGINA);
			$offset = $this->grid->get_offset($_POST);
			$array_tickets = $this->Ticket_model->get('', $offset, VALORES_XPAGINA);
			// echo "<pre>"; print_r($array_tickets); die();
			$this->grid->set_data($array_tickets);
			$str_grid = $this->grid->get_table();

			$response = array('str_grid' => $str_grid);
			Utilerias::envia_datos_json(200, $response, $this);
			exit;
		}
	} // get_gridpaginador()

	public function autorizar()
	{
		if (Utilerias::isRequestAjax($this)) {
			$idticket = $this->input->post('idticket');



			$array_ticket = $this->Ticket_model->get_xidticket($idticket);
			// echo "<pre>"; print_r($array_ticket); die();
			$tipo_error = '';
			if ($array_ticket['idestatus'] == ESTATUS_RESUELTA) {
				$result = false;
				$tipo_error = 'estatus_resuelto';
			} else {
				$result = $this->Ticket_model->autorizar($idticket);
			}

			$response = array(
				'result' => $result,
				'tipo_error' => $tipo_error
			);
			Utilerias::envia_datos_json(200, $response, $this);
			exit;
		}
	} // autorizar()

	public function solucionar()
	{
		if (Utilerias::isRequestAjax($this)) {
			$idticket = $this->input->post('idticket');


			$array_ticket = $this->Ticket_model->get_xidticket($idticket);
			// echo "<pre>"; print_r($array_ticket); die();
			$tipo_error = '';
			if ($array_ticket['idestatus'] == ESTATUS_PENDIENTE) {
				$result = false;
				$tipo_error = 'estatus_pendiente';
			} else {
				$result = $this->Ticket_model->solucionar($idticket);
			}



			$response = array(
				'result' => $result,
				'tipo_error' => $tipo_error
			);
			Utilerias::envia_datos_json(200, $response, $this);
			exit;
		}
	} // solucionar()


	public function detalles($idticket)
	{
		if (Utilerias::verifica_session_redirige($this)) {
			$data = array();
			$data['array_ticket'] = $this->Ticket_model->get_xidticket($idticket);

			Utilerias::load_page_backend($this, 'ticket/detalles', $data);
		} // verifica_sesion_redirige
	} // detalles()

	public function respuestas($idticket)
	{
		if (Utilerias::verifica_session_redirige($this)) {
			$data = array();
			$data['array_ticket'] = $this->Ticket_model->get_xidticket($idticket);
			$data['array_mensajes'] = $this->Ticket_mensajes_model->get_xidticket($idticket);
			$data['mi_idusuario'] = $this->array_user_session->seguridad['idusuario'];
			$data['idticket'] = $idticket;
			// echo "<pre>"; print_r($this->array_user_session->seguridad['idusuario']); die();
			Utilerias::load_page_backend($this, 'ticket/respuestas', $data);
		} // verifica_sesion_redirige
	} // respuestas()

	public function create()
	{
		if (Utilerias::verifica_session_redirige($this)) {
			// $data['array_marca'] = $this->array_marca;
			// $data['title'] = 'Nueva marca';
			// $data['user_logueado'] = $this->user_logueado;
			$data = array();
			$data['array_ticket'] = $this->array_ticket;
			$data['array_secciones'] = $this->Seccion_model->get();
			$data['array_prioridades'] = $this->arr_prioridades;
			// echo "<pre>"; print_r($data); die();
			Utilerias::load_page_backend($this, 'ticket/create', $data);
		} // verifica_session_redirige
	} // create()

	public function save()
	{
		if (Utilerias::verifica_session_redirige($this)) {

			$idticket = $this->input->post('itxt_ticket_idticket');
			$this->array_ticket = array(
				"idticket" => $idticket,
				"titulo" => trim($this->input->post('itxt_ticket_titulo')),
				"descripcion" => trim($this->input->post('itxt_ticket_descripcion')),
				"prioridad" => $this->input->post('itxt_ticket_idprioridad'),
				"idseccion" => $this->input->post('slc_ticket_idseccion'),
				"idestatus" => ESTATUS_PENDIENTE
			);

			if ($this->form_validation_ticket()) {
				// echo "VALIDO";
				if ($idticket == 0) {
					$action = "creado";
					$idticket_insert = $this->Ticket_model->create($this->array_ticket, $this->array_user_session->seguridad['idusuario']);
					if ($idticket_insert > 0) {
						$result = true;
						if ($_FILES['ifile_ticket_img']['size'] > 0) { // Hay archivo cargado
							$imgurl = $this->upload_image($idticket_insert);
							$result = $this->Imagenes_xticket_model->create($idticket_insert, $imgurl);
						}
					} else {
						$result = false;
					}
				}

				$type_message = ($result) ? MESSAGE_SUCCESS : MESSAGE_ERROR;
				$message = ($result) ? "Ticket {$action} correctamente" : "Ocurrió un error, reintente por favor";
				Utilerias::set_flash_message($this, $type_message, $message);
				redirect("panel", "refresh");
			}
		} // verifica_session_redirige
	} // save()




	function form_validation_ticket()
	{
		$this->form_validation->set_rules('itxt_ticket_titulo', 'titulo', 'required', array('required' => 'Ingrese %s'));
		$this->form_validation->set_rules('slc_ticket_idseccion', 'sección', 'greater_than_equal_to[1]', array('greater_than_equal_to' => 'Seleccione %s'));
		$this->form_validation->set_rules('itxt_ticket_descripcion', 'descripción', 'required', array('required' => 'Ingrese %s'));

		$this->form_validation->set_rules('ifile_ticket_img', 'archivo', "callback_imagen_valida");

		if (!$this->form_validation->run()) {
			// Utilerias::set_flash_message($this, MESSAGE_ERROR, 'Atienda los errores');
			$data['array_errors'] = $this->form_validation->error_array();

			// $data = array();
			$data['array_ticket'] = $this->array_ticket;
			$data['array_secciones'] = $this->Seccion_model->get();
			$data['array_prioridades'] = $this->arr_prioridades;
			// echo "<pre>"; print_r($data); die();
			Utilerias::load_page_backend($this, 'ticket/create', $data);
		} else {
			return true;
		}
	} // form_validation_armazon()

	public function imagen_valida()
	{
		$error_types_file = array(
			1 => 'El archivo supera el tamaño permitido en el servidor',
			'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
			'The uploaded file was only partially uploaded.',
			'Seleccione un archivo',
			6 => 'Missing a temporary folder.',
			'Failed to write file to disk.',
			'A PHP extension stopped the file upload.'
		);

		$idarmazon = $this->input->post('itxt_armazon_idarmazon');
		// if($_FILES['ifile_armazon_imagen']['error']==4 && $idarmazon>0){} // UTIL CUANDO ERA REQUERIDA LA IMAGEN. NO subió imagen Y ESTÁ ACTUALIZANDO DATOS DE ARMAZON, no hay problema
		if ($_FILES['ifile_ticket_img']['error'] == 4) { // NO subió imagen Y ESTÁ ACTUALIZANDO DATOS DE ARMAZON, no hay problema
			// return TRUE;
			$this->form_validation->set_message('imagen_valida', 'Seleccione una imagen JPG, PNG o GIF');
			return false;
		} else {
			#####
			if ($_FILES['ifile_ticket_img']['error'] == 0) { // No hay error al cargar el archivo, vamos a procesar
				/////////////////////
				$file_type = $_FILES["ifile_ticket_img"]["type"];
				if ($file_type != "image/jpg" && $file_type != "image/png" && $file_type != "image/jpeg" && $file_type != "image/gif") {
					$this->form_validation->set_message('imagen_valida', 'Formato de archivo no valido, selecione una imagen: JPG, PNG o GIF');
					return false;
				} else {
					return true;
				}
				////////////////////
			} else {
				$error_message = $error_types_file[$_FILES['ifile_ticket_img']['error']];
				$this->form_validation->set_message('imagen_valida', $error_message);
				return false;
			} // else tipos de error
			#####
		} // else
	} // imagen_valida()

	private function upload_image($idticket)
	{
		// echo "<pre>"; print_r(); die();
		$name_aux = $_FILES['ifile_ticket_img']['name'];
		$tmp_name = $_FILES['ifile_ticket_img']['tmp_name'];
		// echo $name_aux; die();
		$dir_subida = "archivos/imagenes/tickets/" . $idticket . "/";

		$array_partes_img = explode('.', $name_aux);
		$extension = $array_partes_img[1];
		// echo "<pre>"; print_r($array_partes_img); die();
		$nombre_file = "ticket_" . $idticket . "." . $extension;

		// echo $nombre_file; die();

		$fichero_subir = $dir_subida . $nombre_file;
		if (file_exists($dir_subida)) {
			if (move_uploaded_file($tmp_name, $fichero_subir)) {
				return $fichero_subir;
			} else {
				return '';
			}
		} else {
			if (mkdir($dir_subida, 0777, true)) {
				if (move_uploaded_file($tmp_name, $fichero_subir)) {
					return $fichero_subir;
				} else {
					return '';
				}
			}
		}
	} // upload_image();

	public function guardar_mensaje()
	{
		if (Utilerias::verifica_session_redirige($this)) {

			$array_mensaje = array(
				"idticket" => $this->input->post('idticket'),
				"mensaje" => trim($this->input->post('mensaje')),
				"idusuario" => $this->array_user_session->seguridad['idusuario']
			);

			$result = $this->Ticket_mensajes_model->create($array_mensaje);

			$type_message = ($result) ? MESSAGE_SUCCESS : MESSAGE_ERROR;
			$message = ($result) ? "Respuesta guardada correctamente" : "Ocurrió un error, reintente por favor";
			Utilerias::set_flash_message($this, $type_message, $message);
			redirect("tickets/respuestas/" . $this->input->post('idticket'), "refresh");
		} // verifica_session_redirige
	} // guardar_mensaje()




	// usuaarios
	public function usuarios()
	{
		if (Utilerias::verifica_session_redirige($this)) {
			$data = array();
			$data['array_ticket'] = $this->array_ticket;
			$data['array_secciones'] = $this->Seccion_model->get();
			$data['array_prioridades'] = $this->arr_prioridades;
			// echo "<pre>"; print_r($data); die();
			Utilerias::load_page_backend($this, 'ticket/usuarios', $data);
		} // verifica_session_redirige
	} // usuarios()
}// class
