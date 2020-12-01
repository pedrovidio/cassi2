<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class historic extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->model('Historic_model', 'historic');
    }

    public function index() {
      $send['contacts'] = $this->historic->all();
      // var_dump($send);die;

      // $send['titles'] = array(
      //   0 => 'Beneficiário',
      //   1 => 'Nome',
      //   2 => 'Público',
      //   3 => 'UF',
      //   4 => 'Celular',
      //   5 => 'Telefone1',
      //   6 => 'Telefone2',
      //   7 => 'Dia',
      //   8 => 'Hora',
      //   9 => 'Operador',
      //   10 => 'Status Ligação',
      //   11 => 'Status',
      //   12 => 'Data registro'
      // );
      $headers['headers'] = ['bootstrap.min', 'style', 'menu', 'admin', 'list', 'home', 'modal'];
      $headers['js'] = 1;
      $this->load->view('slices/header', $headers);
      $this->load->view('admin/components/menu');
      $this->load->view('admin/components/modal');
      $this->load->view('admin/historic/index.php', $send);
      // $this->load->view('components/table.php', $send);
      $this->load->view('slices/footer');
    }

    public function update(){
      $this->historic->update($this->input->post('log_id'));
      redirect(base_url('historico'));
    }
}