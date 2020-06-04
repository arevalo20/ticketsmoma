<?php

class Reporte_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function get_tickets($finicial, $ffinal){
    $str_query = " SELECT i.idticket AS ticket, i.titulo, i.descripcion
                    FROM ticket i
                    WHERE i.fatencion BETWEEN '{$finicial}' AND '{$ffinal}'
                    ORDER BY i.idticket
                  ";
    return $this->db->query($str_query)->result_array();
  }// get_tickets()


}// class
