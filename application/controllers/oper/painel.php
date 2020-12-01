<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Painel extends CI_Controller {

    public function __construct(){

    parent::__construct();
      $this->load->library('session');

      if(!$this->session->userdata('id')){
        redirect(base_url());
      }
      $this->load->model('Respondentes_model','respondentes');
      $this->load->model('Oper_model','opers');
      $this->load->model('meta_model','meta');
    }

    public function index() {
      $menu['oper'] = $this->session->userdata('usuario');

      $dados = array(
        'list_painel_oper'  => 'Disponivel'
      );
      $this->session->set_userdata($dados);

      $headers['headers'] = ['bootstrap.min', 'style', 'form', 'home', 'menu', 'login'];
      $headers['js'] = 0;
      $this->load->view('slices/header', $headers);
      $this->load->view('painel/components/menu', $menu);

      $send['contact'] = $this->respondentes->findAvailablesOper($this->session->userdata('usuario'));

      $this->load->view('painel/approach/index.php',$send);
      
      $this->load->view('slices/footer');
    }

    public function lists() {
      $dados = array(
        'list_painel_oper' => $this->uri->segment(3)
      );
      $this->session->set_userdata($dados);
      switch($this->uri->segment(3)){
        case "agendados":
            $contacts = $this->respondentes->findScheduledOper($this->session->userdata('usuario'));
        break;
        case "agendadosTodos":
          $contacts = $this->respondentes->findScheduledAll();
        break;
        case "andamento":
          $contacts = $this->respondentes->findUnfinished($this->session->userdata('usuario'));
        break;
        case "finalizados":
          $send['list'] = 'finalizados';
          $contacts = $this->respondentes->findFinishedOper($this->session->userdata('usuario'));
        break;
      }

      $send['oper'] = $this->session->userdata('usuario');

      $headers['headers'] = ['bootstrap.min', 'style', 'menu', 'admin', 'form', 'home'];
      $headers['js'] = 0;
      $this->load->view('slices/header', $headers);
      $this->load->view('painel/components/menu', $send);
      $send['contacts'] = $contacts;

      $this->load->view('painel/lists/index.php',$send);
      $this->load->view('slices/footer');
    }
  }