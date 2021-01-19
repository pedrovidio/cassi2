<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Elegiveis_model extends CI_Model {
  private $table = 'respondentes';

	function __construct()
	{
		parent::__construct();
  }

  public function findAvailables( ) {
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
		$this->db->where('respondentes.Status','1');
		$this->db->where('respondentes.publico','Elegíveis');
		$this->db->where('respondentes.statusLigacao',null);
		$this->db->order_by('respondentes.id', 'RANDOM');
		$this->db->limit( 1, 0 );
		$row = $this->db->get($this->table)->result_array();

		$contact = ($row)? $row[0] : null;
		return $contact;
  }
}
