<?php

class Imagenes_xticket_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function create($idticket, $imgurl){
    $str_query = " INSERT INTO imagenes_xticket(idticket, imgurl)
                   VALUES (?, ?)";
    $this->db->query( $str_query, array($idticket, $imgurl)
   );
     return $this->db->insert_id();
  }// create()

}// class
