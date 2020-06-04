<?php

class Seguridad_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

     function validar_login($username,$clave){

       $str_query = "SELECT se.username, se.estatus, se.idusuario,
                        us.nombre, us.apellido1, us.apellido2, us.idtipousuario, us.email,us.ntelefono,
                        tu.tipousuario
                        FROM seguridad se
                        INNER JOIN usuario us ON us.idusuario = se.idusuario
                        INNER JOIN tipousuario tu ON tu.idtipousuario = us.idtipousuario
                        WHERE se.username = ? AND se.clave = ?
          ";
       return $this->db->query($str_query, array($username, md5($clave) ))->result_array();
     }// validar_login()

}// class
