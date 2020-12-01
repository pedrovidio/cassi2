<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lists extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Respondentes_model','respondentes');
    }

    public function index() {
        date_default_timezone_set('America/Sao_Paulo');
        switch($this->uri->segment(3)){
            case "disponiveis":
                $contacts = $this->respondentes->findAvailables();
            break;
            case "agendados":
                $contacts = $this->respondentes->findScheduledAll();
            break;
            case "finalizados":
                $contacts = $this->respondentes->findFinished();
            break;
            case "finalizadosHoje":
                $date = Date('Y-m-d');
                $contacts = $this->respondentes->findByDate($date);
            break;
            default:
            $contacts = $this->respondentes->all();
            break;
        }

        $envia['contacts'] = $contacts;

        $headers['headers'] = ['bootstrap.min', 'style', 'menu', 'list'];
        $headers['js'] = 1;
        $this->load->view('slices/header', $headers);
        $this->load->view('admin/components/menu');
        $this->load->view('admin/lists/index.php',$envia);
        $this->load->view('slices/footer');
    }
}