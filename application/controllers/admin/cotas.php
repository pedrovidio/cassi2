<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cotas extends CI_Controller {

    public function __construct(){

    parent::__construct();
    $this->load->model('Cotas_model', 'cotas');
    $this->load->model('Respondentes_model','respondentes');
    }

    public function index() {
      $this->recalculate();

      $toast = array();
      if($this->uri->segment(2) === 'ok'){
        $toast['msg'] = 'Cotas cadastradas com sucesso.';
        $toast['class'] = 'success';
      }

      if($this->uri->segment(2) === 'up'){
        $toast['msg'] = 'Cotas atualizadas com sucesso.';
        $toast['class'] = 'success';
      }

      $cotas = $this->cotas->all();
      $send['cotas'] = ($cotas)? $cotas: null;

      $headers['headers'] = ['bootstrap.min', 'style', 'menu', 'admin', 'list','toast'];
      $headers['js'] = 1;

      $this->load->view('slices/header', $headers);
      $this->load->view('admin/components/menu');
      $this->load->view('components/toast', $toast);
      $this->load->view('admin/cotas/index.php', $send);
      $this->load->view('slices/footer');
    }

    public function add(){
      $cotas = $this->cotas->all();
      foreach($cotas as $cota){
        $filters = explode('/', $cota['cotas']);

        $empresa = $filters[0];
        $tipo = $filters[1];

        $this->respondentes->ApplyIdCota($cota['id'], $empresa, $tipo);
      }

      redirect(base_url('cotas/ok'));
    }

    public function update(){
      $cotas['status'] = ($this->uri->segment(5) === "Ativo")? 0: 1;
      $this->cotas->update($this->uri->segment(4), $cotas);

      redirect(base_url('cotas/up'));
    }

    public function recalculate(){
      $this->load->helper('api/get_helper');

      $survey = "cassipesquisa_2020";
      $variables = "publico;uf";
      $sample = 'Perfil_Rendimento <> ""';

      $response = get($survey, $variables, $sample);

      foreach($response as $key => $value){
        if($key > 1 && $response[$key] !== false){
          $cota[] = implode("/", $value);
        }
      }

      $cotas = array_count_values($cota);

      $cotasBd = $this->cotas->all();
      foreach($cotas as $cota => $count){
        foreach($cotasBd as $keyBd => $cotaBd){
          if($cota === $cotaBd['cotas']){
            $cotaBd['qtd'] = $count;
            $cotaBd['status'] = ($cotaBd['meta'] <= $count)? false : true;
            $cotasBd[$keyBd] = $cotaBd;
            break;
          }
        }
      }
      
      $this->cotas->updateQtd($cotasBd);
    }
  }