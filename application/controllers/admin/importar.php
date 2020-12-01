<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'third_party/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Importar extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('Respondentes_model','respondentes');
    }

  public function index($msg = NULL) {
    if($msg === null) {$msg = array('msg' => '');}
    $headers['headers'] = ['bootstrap.min', 'style', 'menu', 'admin', 'form'];
    $headers['js'] = 0;

    $this->load->view('slices/header', $headers);
    $this->load->view('admin/components/menu');
    $this->load->view('admin/upload/form', $msg);
    $this->load->view('slices/footer');
  }

  public function upload() {
    $this->load->model('Importacao_model','importa');

    if (!empty($_FILES['userfile']['name'])) {
      $inputFileName = $_FILES['userfile']['tmp_name'];
      $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

      $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

      foreach ($sheetData as $key => $value) {
        foreach ($value as $cel => $data) {
          if ($key > 1) {
            $contatos[$key][$sheetData[1][$cel]] = $data;
          }
        }
      }
      if($this->input->post('tipo') === 'cadastrar'){
        $retorno = $this->importa->cadastro($contatos);
  
        if ($retorno == true){
          $msg['msg'] = "Dados importados com sucesso";
          $this->index($msg);
        }
      }else{
        // $this->importa->update($contatos);
        
        // $msg['msg'] = "Dados atualizados com sucesso";
        // $this->index($msg);
      }

    } else {
      echo "Por favor, selecione um arquivo Excel pra importar";
    }
  }
}