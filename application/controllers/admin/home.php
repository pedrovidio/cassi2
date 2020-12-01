<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Respondentes_model','respondentes');
        $this->load->model('oper_model','opers');
    }

    public function index() {
      $send['total'] = $this->respondentes->allCount();
      $send['totalDisponiveis'] = $this->respondentes->findAvailablesCount();
      $send['totalAgendados'] = $this->respondentes->findScheduledAllCount();
      $send['totalFinalizados'] = $this->respondentes->findFinishedCount();

      $qtdOpers = count($this->opers->findActive());
      $dados = array(
        'qtdOpers'  => $qtdOpers
      );
      $this->session->set_userdata($dados);

      if($this->uri->segment(4) === 'ok'){
        $send['msg'] = 'Distribuição dos contatos realizado.';
        $send['class'] = 'success';
      }
      if($this->uri->segment(4) === 'err'){
        $send['msg'] = 'Nenhum operador logado. Clique no botão "Operadores" para ativá-los';
        $send['class'] = 'danger';
      }

      date_default_timezone_set('America/Sao_Paulo');
      $date = Date('Y-m-d');
      $send['totalFinalizadosHoje'] = count($this->respondentes->findByDate($date));

      $headers['headers'] = ['bootstrap.min','menu','style', 'admin', 'home'];
      $headers['js'] = 0;
      $this->load->view('slices/header', $headers);
      $this->load->view('admin/components/menu');
      $this->load->view('admin/home/index.php', $send);
      $this->load->view('slices/footer');
    }
}