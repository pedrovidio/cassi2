<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Historic_model extends CI_Model {
  private $table = 'logs';

  function __construct()
	{
		parent::__construct();
  }
  
  public function all(){
    $this->db->select('
    respondentes.beneficiario,
    respondentes.nome,
		respondentes.publico,
		respondentes.uf,
		respondentes.municipio,
		respondentes.email,
    respondentes.dddcelular,
		respondentes.celular,
		respondentes.dddtelefone1,
    respondentes.telefone1,
    respondentes.dddtelefone2,
		respondentes.telefone2,
		respondentes.dia,
		respondentes.hora,
    respondentes.statusCota,
    opers.user as operador,
    respondentes.save_dt,
    logs.statusLigacao,
    logs.created_at');
    $this->db->join('respondentes', 'respondentes.id = logs.respondentes_id');
    $this->db->join('opers', 'opers.id = logs.opers_id');
    $this->db->where('logs.statusLigacao <> "Finalizado"');
    return $this->db->get($this->table)->result_array();
  }

  public function update($id){
    $this->db->where('id', $id);
    $log['statusLigacao'] = "Cancelado";
		return $this->db->update($this->table, $log);
	}
}
