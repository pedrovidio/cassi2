<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct(){

    parent::__construct();
      $this->load->library('session');
      $this->load->model('Admin_model','admin');
      $this->load->model('Login_model','login');
      $this->load->model('Oper_model','opers');
      $this->load->model('Respondentes_model','respondentes');
    }

    public function index($msg = NULL) {
      if($msg === null) {$msg = array('msg' => '');}

      $headers['headers'] = ['bootstrap.min','style', 'login', 'admin'];
        $headers['js'] = 0;
        $this->load->view('slices/header', $headers);
      $this->load->view('login/login',$msg);
      $this->load->view('slices/footer');
    }

    public function validate(){
      $user = $this->input->post('user');
      $password = $this->input->post('password');

      $id = $this->login->validate($user, $password);

      if($id){
        $data['active'] = true;
        $this->login->update($id, $data);

        $dados = array(
          'usuario'  => $user,
          'id'  => $id
        );
  
        $this->session->set_userdata($dados);
        redirect(base_url('painel'));
      }
      
      $idAdmin = $this->admin->findOne($user, $password);

      if ($idAdmin) {
        $qtdOpers = count($this->opers->findActive());
        $dados = array(
          'usuario'  => 'Administrador',
          'qtdOpers'  => $qtdOpers
        );
        $this->session->set_userdata($dados);
        redirect(base_url('home'));
      }

      $msg['msg'] = "Login inválido";
      $this->index($msg);
    }

    public function logout(){
      if ($this->session->userdata('usuario') == 'Administrador') {
        $this->session->sess_destroy();
        redirect(base_url('login'));
      }
      
      $data['active'] = false;
      $this->login->update($this->session->userdata('id'), $data);
      $this->session->sess_destroy();

      redirect(base_url('login'));
    }
  }