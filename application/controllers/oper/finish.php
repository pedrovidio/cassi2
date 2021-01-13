<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Finish extends CI_Controller {

    public function __construct(){

    parent::__construct();
      $this->load->library('session');
      if(!$this->session->userdata('id')){
        redirect(base_url());
      }

      $this->load->model('Respondentes_model','respondentes');
      $this->load->model('Cotas_model','cotas');
      $this->load->model('Log_model','logs');
    }

    public function index() {
      date_default_timezone_set('America/Sao_Paulo');
      $log['respondentes_id'] = $this->uri->segment(4);
      $log['opers_id'] = $this->session->userdata('id');

      switch($this->uri->segment(5)){
        case 'Finalizado':
          $status = 'Finalizado';
          $respondente['save_dt'] = Date('Y-m-d');
          $respondente['status'] = 0;
        break;
        case 'andamento':
          $status = 'Entrevista em andamento';
          $respondente['status'] = 1;
        break;
        case 'recusa':
          $status = 'Recusa';
          $respondente['status'] = 0;
        break;
        case 'caiu':
          $status = 'Ligação caiu/ Não atende mais';
          $respondente['status'] = 1;
        break;
      }
      $log['statusLigacao'] = $status;
      
      $respondente['statusLigacao'] = $status;

      $respondenteBd = $this->respondentes->findById($this->uri->segment(4));

      if($this->uri->segment(5) !== 'Finalizado'){
        $cota = $this->cotas->countCota($respondenteBd['cotas_id']);
        $cota['qtd']--;

        if($cota['qtd'] >= $cota['meta']){
          $cota['status'] = false;
        }else{
          $cota['status'] = true;
        }

        $this->cotas->update($respondenteBd['cotas_id'], $cota);
      }

      $this->logs->update($log, $respondenteBd['logs_id']);
        
      $this->respondentes->update_unique($respondente, $this->uri->segment(4));

      redirect(base_url('painel'));
    }
  }