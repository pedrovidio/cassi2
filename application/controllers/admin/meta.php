<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Meta extends CI_Controller {

  public function __construct(){

  parent::__construct();
    $this->load->model('Meta_model','meta');
  }

  public function index() {
    $metaEntrevistas = array("qtd" => $this->input->post('qtd'));
    $this->meta->update($metaEntrevistas);
    return "ok";
  }
}