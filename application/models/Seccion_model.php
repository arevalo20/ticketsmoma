<?php

class Seccion_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function get(){
    $str_query = " SELECT c.idseccion, c.seccion
                   FROM seccion AS c
                   ORDER BY c.seccion ASC
                  ";
    return $this->db->query($str_query)->result_array();
  }// get()


}// class
