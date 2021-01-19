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
      $this->load->model('Log_model','logs');
      $this->load->model('Approach_model', 'approach');
      $this->load->model('Elegiveis_model', 'elegiveis');
    }

    public function index() {
      $menu['oper'] = $this->session->userdata('usuario');
      if($this->session->userdata('idContato')){
        $definedContact['operador'] = null;
        $this->approach->definedOperatorToContact($this->session->userdata('idContato'), $definedContact);  
      }

      $dados = array(
        'list_painel_oper'  => 'Disponivel'
      );
      $this->session->set_userdata($dados);

      $headers['headers'] = ['style', 'form', 'home', 'menu'];
      $headers['js'] = 0;

      $this->load->view('slices/header', $headers);
      $this->load->view('oper/components/menu', $menu);

      // pega o id do último log
      $log_id = $this->logs->last($this->session->userdata('id'));
      if($log_id){
        // identifica o tipo de publico
        $public = $this->approach->findLastTypePublic($log_id);
      }else{
        $public = null;
      }
      // procura um contato com tipo de publico diferente, se existir 
      $send['contact'] = $this->approach->findAvailables($public);
      if($send['contact'] === null) {
        $send['contact'] = $this->approach->findContacted(); 
      }
      $definedContact['operador'] = $this->session->userdata('usuario');
      // define o operador para o contato
      $this->approach->definedOperatorToContact($send['contact']['id'], $definedContact);

      $dados = array(
        'idContato'  => $send['contact']['id']
      );
      $this->session->set_userdata($dados);

      if($send['contact'] === null){
        $send['msg'] = 'Você não possui mais contatos disponíveis. Contate o administrador.';
      }

      $this->load->view('oper/approach/index.php',$send);
      $this->load->view('slices/footer');
    }

    public function elegiveis() {
      $menu['oper'] = $this->session->userdata('usuario');
      if($this->session->userdata('idContato')){
        $definedContact['operador'] = null;
        $this->approach->definedOperatorToContact($this->session->userdata('idContato'), $definedContact);  
      }

      $dados = array(
        'list_painel_oper'  => 'Disponivel'
      );
      $this->session->set_userdata($dados);

      $headers['headers'] = ['style', 'form', 'home', 'menu'];
      $headers['js'] = 0;

      $this->load->view('slices/header', $headers);
      $this->load->view('oper/components/menu', $menu);

      $send['contact'] = $this->elegiveis->findAvailables();
      
      $definedContact['operador'] = $this->session->userdata('usuario');
      // define o operador para o contato
      $this->approach->definedOperatorToContact($send['contact']['id'], $definedContact);

      $dados = array(
        'idContato'  => $send['contact']['id']
      );
      $this->session->set_userdata($dados);

      if($send['contact'] === null){
        $send['msg'] = 'Você não possui mais contatos disponíveis. Contate o administrador.';
      }

      $this->load->view('oper/approach/index.php',$send);
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
        case "contatados":
          $send['list'] = 'contatados';
          $contacts = $this->respondentes->findContactedOper($this->session->userdata('usuario'));
        break;
      }

      $send['oper'] = $this->session->userdata('usuario');

      $headers['headers'] = ['style','listOper','menu'];
      $headers['js'] = 0;
      $this->load->view('slices/header', $headers);
      $this->load->view('oper/components/menu', $send);
      $send['contacts'] = $contacts;

      $this->load->view('oper/lists/index.php',$send);
      $this->load->view('slices/footer');
    }
  }