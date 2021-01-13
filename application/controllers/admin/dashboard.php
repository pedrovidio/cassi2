<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct(){
      parent::__construct();
      $this->load->model('Dashboard_model', 'dash');
    }

    public function index() {
      // $dashboardLogs = $this->dash->dashboardLogs();
      $dashboard = $this->dash->dashboardRespondentes();

      foreach ($dashboard as $val) {
        $data[$val['dt']][$val['user']][] = $val['statusLigacao'];
        $data[$val['dt']][$val['user']][$val['statusLigacao']] = $val['qtd'];
      }

      $send['statusLigacaoBd'] = ['Finalizado','Agendado com dia e hora certo','Caixa postal/Fax/ Secretária Eletrônica','Ligação caiu/ Não atende mais','Ligar depois','Não atende','Pessoa falecida','Pessoa incapaz de responder','Recusa','Recusa por terceiro (não quis passar o telefone p/ pessoa responsável)','Responsável menor de idade','Telefone errado','Telefone inexistente (número não completa chamada)','Telefone indisponível ou fora de serviço','Telefone ocupado','Telefone mudo','Sem telefone para contato','Contato duplicado'];
      $send['dashboard'] = $data;

      $headers['headers'] = ['bootstrap.min', 'style', 'menu', 'list'];
      $headers['js'] = 1;
      $this->load->view('slices/header', $headers);
      $this->load->view('admin/components/menu');
      $this->load->view('admin/dashboard/index.php', $send);
      $this->load->view('slices/footer');
    }

}