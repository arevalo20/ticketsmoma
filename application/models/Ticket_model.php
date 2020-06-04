<?php

class Ticket_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function get($titulo, $offset,$limit){
    if($offset<0 || $limit<0){
      $concat_p = "";
    }
    else{
      $concat_p = " LIMIT {$offset}, {$limit}";
    }
    $str_query = "SELECT ti.idticket, ti.titulo, ti.descripcion,
    IF(ti.prioridad = 'N', 'NORMAL', 'URGENTE') AS prioridad,
    -- IF(ti.estatus = 'P', 'PENDIENTE', 'ATENDIDA') AS estatus,
    st.estatus AS estatus,
    ti.fcreacion,
    IF(ti.fautorizacion IS NULL OR ti.fautorizacion='', 'Sin autorización', ti.fautorizacion) AS fautorizacion,
    ti.idestatus AS idestatus,
    img.imgurl,
    se.seccion,
    us.nombre AS nombre_usuario,

    ti.fcreacion AS fcreacion,

    ti.idticket AS ver_detalles,
    ti.idticket AS autorizar_ticket,
    ti.idticket AS solucionar_ticket,
    ti.idticket AS mensajes

    FROM ticket ti
    INNER JOIN seccion se ON se.idseccion = ti.idseccion
    INNER JOIN imagenes_xticket img ON img.idticket = ti.idticket
    INNER JOIN ticket_estatus st ON st.idestatus = ti.idestatus
    INNER JOIN usuario us ON us.idusuario = ti.idusuario
    WHERE ti.titulo LIKE '%{$titulo}%'
    ORDER BY ti.idticket DESC
    {$concat_p}
    ";
    if($offset<0 || $limit<0){
      return $this->db->query($str_query)->num_rows();

    }
    else{
      return $this->db->query($str_query)->result_array();
    }
  }// get()

  function get_xidticket($idticket){

    $str_query = " SELECT ti.idticket, ti.titulo, ti.descripcion, IF(ti.prioridad = 'N', 'NORMAL', 'URGENTE') AS prioridad,
    -- IF(ti.estatus = 'P', 'PENDIENTE', 'ATENDIDA') AS estatus,
    st.estatus AS estatus,
    ti.idestatus,
    ti.fcreacion,
    ti.fautorizacion,
    img.imgurl,
    se.seccion
    FROM ticket ti
    INNER JOIN seccion se ON se.idseccion = ti.idseccion
    INNER JOIN imagenes_xticket img ON img.idticket = ti.idticket
    INNER JOIN ticket_estatus st ON st.idestatus = ti.idestatus
    WHERE ti.idticket = ?
    ";
    return $this->db->query($str_query, array($idticket))->row_array();
  }// get_xidticket()

  function create($array_ticket, $idusuario){
    $fcreacion = date("Y-m-d H:i:s");
    $str_query = " INSERT INTO ticket(titulo, descripcion, fcreacion, prioridad,
      idseccion, idusuario, idestatus)
                   VALUES (?, ?, ?, ?,
                      ?, ?, ?)";
    $this->db->query( $str_query, array(
      $array_ticket['titulo'], $array_ticket['descripcion'], $fcreacion, $array_ticket['prioridad'],
      $array_ticket['idseccion'], $idusuario, $array_ticket['idestatus'])
   );
     return $this->db->insert_id();
  }// create()

  public function autorizar($idticket){
      $fhoy = date("Y-m-d H:i:s");
      $str_query = "UPDATE ticket ti
                    SET ti.idestatus = ?, ti.fautorizacion  = ?
                    WHERE ti.idticket = ?
                   ";

     return $this->db->query($str_query, array(ESTATUS_AUTORIZADA, $fhoy, $idticket));
  } // autorizar()

  public function solucionar($idticket){
      $fhoy = date("Y-m-d H:i:s");
      $str_query = "UPDATE ticket ti
                    SET ti.idestatus = ?, ti.fatencion  = ?
                    WHERE ti.idticket = ?
                   ";

     return $this->db->query($str_query, array(ESTATUS_RESUELTA, $fhoy, $idticket));
  } // solucionar()


}// class
