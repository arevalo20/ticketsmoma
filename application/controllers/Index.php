<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('Utilerias');

  } // __construct()

  public function index()
  {
    echo "Index"; die();
  }

  
} // class
