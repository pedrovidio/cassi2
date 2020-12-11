<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approach_model extends CI_Model {
  private $table = 'respondentes';

	function __construct()
	{
		parent::__construct();
  }

  public function findLastTypePublic($logs_id){
    $this->db->select('publico');
    $this->db->where('logs_id', $logs_id);
    $row = $this->db->get($this->table)->result_array();

    $publico = ($row)? $row[0]['publico'] : null;
    return $publico;
  }

  public function findAvailables($publico ) {
		// die('disponivel oper');
		$this->db->select('
		respondentes.id,
		respondentes.beneficiario,
    respondentes.nome,
		respondentes.publico,
		respondentes.uf,
		respondentes.municipio,
    respondentes.dddcelular,
		respondentes.celular,
		respondentes.dddtelefone1,
    respondentes.telefone1,
    respondentes.dddtelefone2,
		respondentes.telefone2,
		respondentes.status,
		respondentes.statusLigacao,
		respondentes.dia,
		respondentes.hora,
		respondentes.sexo,
		respondentes.operador,
		respondentes.logs_id,
		respondentes.cotas_id,
		respondentes.statusCota,
		cotas.id as cotas_id,
		cotas.cotas,
		cotas.meta,
		cotas.qtd
		');
		$this->db->join('cotas', 'respondentes.cotas_id = cotas.id');
    $this->db->where('cotas.status',true);
    if($publico){
      $this->db->where('if(
      (SELECT COUNT(publico) FROM respondentes WHERE publico <> "'.$publico.'") > 0, 
      respondentes.publico <> "'.$publico.'", 
      respondentes.publico = "'.$publico.'")');
    }
		$this->db->where('respondentes.Status','1');
		$this->db->where('respondentes.statusLigacao',null);
		$this->db->order_by('respondentes.id', 'RANDOM');
		$this->db->limit( 1, 0 );
		$row = $this->db->get($this->table)->result_array();

		$contact = ($row)? $row[0] : null;
		return $contact;
  }
  
  public function definedOperatorToContact($id, $data){
    $this->db->where('id',$id);
		return $this->db->update($this->table, $data);
  }
}
