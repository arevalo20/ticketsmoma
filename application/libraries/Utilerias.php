<?php
defined('BASEPATH') or exit('No direct script access allowed');

define("NOMBRE_PROYECTO", "Tickets Moma");
define('DATOSUSUARIO', "datos_usuario_tickets");

define("ZONAHORARIA", "America/Mexico_City");

// types alert bootstrap 4
define("FLASH_MESSAGE", "flash_message");
define("MESSAGE_SUCCESS", "success");
define("MESSAGE_ERROR", "danger");

// AJUSTES GRID
define("VALORES_XPAGINA", 10);
define("GRID_THEME", 'titulo-tabla');
define("PAGINA_ACTUAL_GRID", "grid_pagactual_tickets");

// TIPOS DE USUARIO
define("USUARIO_TIPO_SISTEMAS", 1);
define("USUARIO_TIPO_ADMINISTRADOR", 2);
define("USUARIO_TIPO_TESTER", 3);

// ESTATUS TICKETS
define("ESTATUS_PENDIENTE", 1);
define("ESTATUS_AUTORIZADA", 2);
define("ESTATUS_RESUELTA", 3);
define("ESTATUS_PRODUCCION", 4);

// PRIORIDAD TICKETS
define("PRIORIDAD_NORMAL", "N");
define("PRIORIDAD_URGENTE", "U");

class Utilerias
{
  public function __construct()
  {
    date_default_timezone_set(ZONAHORARIA);
  }

  public static function set_session($contexto, $name, $value)
  {
    $contexto->session->set_userdata($name, $value);
  } // set_session()

  public static function get_session($contexto, $name)
  {
    if (self::is_session_open($contexto)) {
      return $contexto->session->userdata($name);
    } else {
      return NULL;
    }
  } // get_session()

  public static function set_flash_message($contexto, $tipo, $mensaje)
  {
    $str_html = " <div id='flash_message' class='alert alert-{$tipo} alert-dismissible fade show' role='alert'>
  											 <span> {$mensaje} </span>
  											 <button type='button' class='close' data-dismiss='alert'>&times;</button>
  										 </div>
  									 ";

    // \Session::flash(FLASH_MESSAGE, $str_html); //<--FLASH MESSAGE
    $contexto->session->set_flashdata(FLASH_MESSAGE, $str_html);
  } // get_flash_message()

  public static function verifica_session_redirige($contexto)
  {
    if (!Utilerias::is_session_open($contexto)) {
      redirect("", "refresh");
    }
    return TRUE;
  } // verifica_session_redirige()


  public static function is_session_open($contexto)
  {
    return $contexto->session->has_userdata(DATOSUSUARIO);
  } // is_session_open()

  public static function isRequestAjax($contexto)
  {
    if ($contexto->input->is_ajax_request()) {
      if (self::is_session_open($contexto)) {
        return TRUE;
      } else {
        redirect("", "refresh");
      }
    } else {
      redirect("", "refresh");
    }
  } // isRequestAjax()


  public static function destroy_all_session($contexto)
  {
    // Vacio los datos
    $contexto->session->unset_userdata(DATOSUSUARIO);
    $contexto->session->sess_destroy();
    return true;
  } // destroy_all_session()

  public static function load_page_backend($contexto, $vista, $data)
  {
    $contexto->load->view('templates/back_head', $data);
    $contexto->load->view($vista, $data);
    $contexto->load->view('templates/back_footer', $data);
    // $contexto->load->view($vista, $data);
  } // load_page_backend()

  public static function get_nombremes($mes)
  {
    setlocale(LC_TIME, 'spanish');
    $nombre = strftime("%B", mktime(0, 0, 0, $mes, 1, 2000));
    return strtoupper($nombre);
  } // get_nombremes()

  public static function get_fecha_datetimepicker($fecha)
  {
    if ($fecha == '0000-00-00 00:00:00' || strlen(trim($fecha)) == 0) {
      return '';
    }

    $date = new DateTime($fecha);
    $date_format = $date->format('d-m-Y H:i:s');
    $porciones_p = explode(" ", $date_format);

    $anio_mes_dia = $porciones_p[0];
    $hora_minuto_segundo = $porciones_p[1];

    $porciones = explode("-", $anio_mes_dia);
    return $porciones[0] . " " . self::get_nombremes($porciones[1]) . " " . $porciones[2] . " " . $hora_minuto_segundo;
  } // get_fecha_datetimepicker()

  public static function envia_datos_json($status, $data, $contexto)
  {
    return $contexto->output
      ->set_status_header($status)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
      ->_display();
  } // envia_datos_json()
} // class Utilerias
