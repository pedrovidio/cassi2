<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Redistribute extends CI_Controller {

    public function __construct(){

    parent::__construct();
      $this->load->library('session');
      $this->load->model('Oper_model','opers');
      $this->load->model('Redistribute_model','redistribute');
      $this->load->model('Respondentes_model','respondentes');
    }

    public function index(){
      $opers = $this->opers->findActive();

      if(empty($opers)){
        redirect(base_url('admin/home/index/err'));
      }

      $contacts = $this->redistribute->index();
      
      if($contacts){
        #redistribui a lista de contatos entre os operadores ativos
        $count = count($opers);
        $aux = 0;
        foreach($contacts as $key => $val){
          $contactsUpdate[$key]['operador'] = $opers[$aux]['user'];
          $contactsUpdate[$key]['id'] = $val['id'];
          $aux = ($aux === $count - 1)? 0 : $aux + 1;
        }

        $this->respondentes->update($contactsUpdate);

        redirect(base_url('admin/home/index/ok'));
      }
    }
  }