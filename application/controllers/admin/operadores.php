<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Operadores extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('oper_model','opers');
    }

    public function index() {
      $qtdOpers = count($this->opers->findActive());
      $dados = array(
        'qtdOpers'  => $qtdOpers
      );
      $this->session->set_userdata($dados);

      $send['opers'] = $this->opers->all();

      $headers['headers'] = [ 'menu', 'admin', 'list'];
      $headers['js'] = 1;
      $this->load->view('slices/header', $headers);
      $this->load->view('admin/components/menu');
      $this->load->view('admin/operadores/index.php', $send);
      $this->load->view('slices/footer');
    }

    public function form() {
      $send['oper'] = '';
      if($this->uri->segment(4) > 0){
        $send['oper'] = $this->opers->findById($this->uri->segment(4));
      }

      $headers['headers'] = [ 'bootstrap.min', 'menu', 'admin', 'list', 'form'];
      $headers['js'] = 1;
      $this->load->view('slices/header', $headers);
      $this->load->view('admin/components/menu');
      $this->load->view('admin/operadores/form', $send);
      $this->load->view('slices/footer');
    }

    public function add() {
      $operador['user'] = $this->input->post('user');
      $operador['password'] = $this->input->post('password');
      $id = $this->input->post('id');
      if(empty($id)){
        $this->opers->add($operador);
      }else{
        $this->opers->update($id, $operador);
      }

      redirect(base_url('operadores'));
    }

    public function updateSatatus(){
      $cotas['active'] = ($this->uri->segment(5) === "Ativo")? 0: 1;
      $this->opers->update($this->uri->segment(4), $cotas);

      redirect(base_url('operadores'));
    }
}