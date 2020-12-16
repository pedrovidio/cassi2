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

      date_default_timezone_set('America/Sao_Paulo');
      $date = Date('Y-m-d');
      $send['totalFinalizadosHoje'] = count($this->respondentes->findByDate($date));

      $headers['headers'] = ['style','menu','home'];
      $headers['js'] = 0;
      $this->load->view('slices/header', $headers);
      $this->load->view('admin/components/menu');
      $this->load->view('admin/home/index.php', $send);
      $this->load->view('slices/footer');
    }
}