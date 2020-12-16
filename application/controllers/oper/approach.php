<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Approach extends CI_Controller {

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

    public function form() {
      $idRespondente = $this->uri->segment(4);
      $send['oper'] = $this->session->userdata('usuario');
      $send['contact'] = $this->respondentes->findById($idRespondente);
            
      $headers['headers'] = ['style', 'form', 'home', 'menu'];
      $headers['js'] = 0;
      $this->load->view('slices/header', $headers);
      $this->load->view('oper/components/menu',$send);
      $this->load->view('oper/approach/index.php',$send);
      $this->load->view('slices/footer');
    }

    public function getForm(){
      $dados = array(
        'idContato'  => ""
      );
      $this->session->set_userdata($dados);

      $log['list'] = $this->session->userdata('list_painel_oper');
      $log['motivo'] = $this->input->post('motivo');

      if ($this->input->post('dia') != ''){
        $log['dia'] = $this->input->post('dia');
        $respondente['dia'] = $this->input->post('dia');
      }

      $respondente['hora'] = $this->input->post('hora');
      $respondente['operador'] = $this->session->userdata('usuario');

      $log['hora'] = $this->input->post('hora');
      $log['respondentes_id'] = $this->input->post('id');
      $log['cotas_id'] = $this->input->post('cotas_id');
      $log['opers_id'] = $this->session->userdata('id');

      if($this->input->post('filtro2') === 'nao_tem_poder_decisao'){
        $log['statusLigacao'] = "Não tem poder de decisão";
        $respondente['statusLigacao'] = "Não tem poder de decisão";
      }else{
        if($this->input->post('filtro1') === 'tem_interesse' || $this->input->post('filtro2') === "tem_poder_decisao"){
          $log['statusLigacao'] = "Entrevista em andamento";
          
          $respondente['statusLigacao'] = "Entrevista em andamento";
          $respondente['logs_id'] = $this->logs->add($log);
          
          $this->respondentes->update_unique($respondente, $this->input->post('id'));
  
          $cota = $this->cotas->countCota($this->input->post('cotas_id'));
          $cota['qtd']++;
  
          if($cota['qtd'] >= $cota['meta']){
            $cota['status'] = false;
          }else{
            $cota['status'] = true;
          }
  
          $this->cotas->update($this->input->post('cotas_id'), $cota);
  
          $respondente = $this->respondentes->findById($this->input->post('id'));
          $complement = '';
          foreach($respondente as $key => $val){
            $complement .= "&$key=$val";
          }
          redirect('https://admsnw2.sphinxnaweb.com/SurveyServer/s/opiniao/cassipesquisa_2020/coleta.htm?key=id'.$this->input->post('id').Date('Y-m-d').$complement.'');
        }
  
        if($this->input->post('filtro1') === 'nao_tem'){
          switch ($this->input->post('statusLigacao')){
            case "Agendado com dia e hora certo":
              $log['statusLigacao'] = "Agendado com dia e hora certo";
              $respondente['statusLigacao'] = "Agendado com dia e hora certo";
              $respondente['status'] = 0;
            break;
            case "Caixa postal/Fax/ Secretária Eletrônica":
              $log['statusLigacao'] = "Caixa postal/Fax/ Secretária Eletrônica";
              $respondente['statusLigacao'] = "Caixa postal/Fax/ Secretária Eletrônica";
              $respondente['status'] = 1;
            break;
            case "Ligação caiu/ Não atende mais":
              $log['statusLigacao'] = "Ligação caiu/ Não atende mais";
              $respondente['statusLigacao'] = "Ligação caiu/ Não atende mais";
              $respondente['status'] = 1;
            break;
            case "Ligar depois":
              $log['statusLigacao'] = "Ligar depois";
              $respondente['statusLigacao'] = "Ligar depois";
              $respondente['status'] = 1;
            break;
            case "Não atende":
              $log['statusLigacao'] = "Não atende";
              $respondente['statusLigacao'] = "Não atende";
              $respondente['status'] = 1;
            break;
            case "Pessoa falecida":
              $log['statusLigacao'] = "Pessoa falecida";
              $respondente['statusLigacao'] = "Pessoa falecida";
              $respondente['status'] = 0;
            break;
            case "Pessoa incapaz de responder":
              $log['statusLigacao'] = "Pessoa incapaz de responder";
              $respondente['statusLigacao'] = "Pessoa incapaz de responder";
              $respondente['status'] = 0;
            break;
            case "Recusa":
              $log['statusLigacao'] = "Recusa";
              $respondente['statusLigacao'] = "Recusa";
              $respondente['status'] = 0;
            break;
            case "Recusa por terceiro (não quis passar o telefone p/ pessoa responsável)":
              $log['statusLigacao'] = "Recusa por terceiro (não quis passar o telefone p/ pessoa responsável)";
              $respondente['statusLigacao'] = "Recusa por terceiro (não quis passar o telefone p/ pessoa responsável)";
              $respondente['status'] = 0;
            break;
            case "Responsável menor de idade":
              $log['statusLigacao'] = "Responsável menor de idade";
              $respondente['statusLigacao'] = "Responsável menor de idade";
              $respondente['status'] = 0;
            break;
            case "Telefone errado":
              $log['statusLigacao'] = "Telefone errado";
              $respondente['statusLigacao'] = "Telefone errado";
              $respondente['status'] = 0;
            break;
            case "Telefone inexistente (número não completa chamada)":
              $log['statusLigacao'] = "Telefone inexistente (número não completa chamada)";
              $respondente['statusLigacao'] = "Telefone inexistente (número não completa chamada)";
              $respondente['status'] = 0;
            break;
            case "Telefone indisponível ou fora de serviço":
              $log['statusLigacao'] = "Telefone indisponível ou fora de serviço";
              $respondente['statusLigacao'] = "Telefone indisponível ou fora de serviço";
              $respondente['status'] = 1;
            break;
            case "Telefone ocupado":
              $log['statusLigacao'] = "Telefone ocupado";
              $respondente['statusLigacao'] = "Telefone ocupado";
              $respondente['status'] = 1;
            break;
            case "Telefone mudo":
              $log['statusLigacao'] = "Telefone mudo";
              $respondente['statusLigacao'] = "Telefone mudo";
              $respondente['status'] = 1;
            break;
            case "Sem telefone para contato":
              $log['statusLigacao'] = "Sem telefone para contato";
              $respondente['statusLigacao'] = "Sem telefone para contato";
              $respondente['status'] = 0;
            break;
            case "Contato duplicado":
              $log['statusLigacao'] = "Contato duplicado";
              $respondente['statusLigacao'] = "Contato duplicado";
              $respondente['status'] = 0;
            break;
          }
        }
      }

      $respondente['logs_id'] = $this->logs->add($log);

      $this->respondentes->update_unique($respondente, $this->input->post('id'));

      redirect(base_url('painel'));
    }
  }