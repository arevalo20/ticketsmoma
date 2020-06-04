<?php

class Ticket_mensajes_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }


  function get_xidticket($idticket){
    $str_query = " SELECT tim.idusuario, tim.idticket, tim.mensaje, tim.fcreacion, CONCAT(u.nombre, ' ', u.apellido1, ' ', u.apellido2) AS nombre_completo
                  FROM
                  ticket_mensajes tim
                  INNER JOIN ticket ti ON ti.idticket = tim.idticket
                  INNER JOIN usuario u ON u.idusuario = tim.idusuario
    WHERE tim.idticket = ?
    ";
    return $this->db->query($str_query, array($idticket))->result_array();
  }// get_xidticket()

  function create($array_mensaje){
    $fcreacion = date("Y-m-d H:i:s");
    $str_query = " INSERT INTO ticket_mensajes(idticket, idusuario, mensaje, fcreacion)
                   VALUES (?, ?, ?, ?)";
    $this->db->query( $str_query, array(
      $array_mensaje['idticket'], $array_mensaje['idusuario'], $array_mensaje['mensaje'], $fcreacion)
      );
     return $this->db->insert_id();
  }// create()

}// class
