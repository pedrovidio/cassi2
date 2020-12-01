<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cotas extends CI_Controller {

    public function __construct(){

    parent::__construct();
    $this->load->model('Cotas_model', 'cotas');
    $this->load->model('Respondentes_model','respondentes');
    }

    public function index() {
      $cotas = $this->cotas->all();
      $send['cotas'] = ($cotas)? $cotas: null;

      $headers['headers'] = ['bootstrap.min', 'style', 'menu', 'admin', 'list'];
      $headers['js'] = 1;

      $this->load->view('slices/header', $headers);
      $this->load->view('admin/components/menu');
      $this->load->view('admin/cotas/index.php', $send);
      $this->load->view('slices/footer');
    }

    public function add(){
      $cotas = $this->cotas->all();
      foreach($cotas as $cota){
        $filters = explode('/', $cota['cotas']);

        $publico = $filters[0];
        $uf = $filters[1];

        $this->respondentes->ApplyIdCota($cota['id'], $publico, $uf);
      }

      redirect(base_url('cotas'));
    }

    public function update(){
      $cotas['status'] = ($this->uri->segment(5) === "Ativo")? 0: 1;
      $this->cotas->update($this->uri->segment(4), $cotas);

      $data = $this->cotas->findById($this->uri->segment(4));

      $this->cotas->updateCotaRespondentes($data['id'], $cotas['status'] );

      redirect(base_url('cotas'));
    }
  }