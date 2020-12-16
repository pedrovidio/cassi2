<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Respondentes_model extends CI_Model {
	private $table = 'respondentes';

	function __construct()
	{
		parent::__construct();
	}

	public function all() {
		$this->db->where('respondentes.statusLigacao <> ""');
    return $this->db->get($this->table)->result_array();
	}

	public function allCount() {
		$this->db->where('respondentes.statusLigacao <> ""');
    return $this->db->count_all_results($this->table);
	}

	/** {admin home} {admin lists} */
	public function findByDate($date){
		// die('finalizados hj');
		$respondentes = [];

		$this->db->where('save_dt',$date);
		$respondentes = $this->db->get($this->table)->result_array();

		return $respondentes;
	}

	/** {login} {admin home} {admin lists} */
	public function findAvailables() {
		// die('disponivel');
		$this->db->join('cotas', 'respondentes.cotas_id = cotas.id');
		$this->db->where('respondentes.Status','1');
		$this->db->where('respondentes.statusLigacao',null);
		$this->db->where('cotas.status',true);
    return $this->db->get($this->table)->result_array();
	}

	public function findAvailablesCount() {
		// die('disponivel');
		$this->db->join('cotas', 'respondentes.cotas_id = cotas.id');
		$this->db->where('respondentes.statusLigacao',null);
		$this->db->where('cotas.status',true);
    return $this->db->count_all_results($this->table);
	}

	/** {admin home} {admin lists} {oper painel} */
	public function findScheduledAll() {
		// die('agendados todos');
		$this->db->where('statusLigacao','Agendado com dia e hora certo');
		$this->db->where('statusCota',true);
		$this->db->order_by('dia', 'asc');
    return $this->db->get($this->table)->result_array();
	}

	public function findScheduledAllCount() {
		// die('agendados todos');
		$this->db->where('statusLigacao','Agendado com dia e hora certo');
		$this->db->where('statusCota',true);
		$this->db->order_by('dia', 'asc');
    return $this->db->count_all_results($this->table);
	}

	/** {oper painel} */
	public function findScheduledOper($oper) {
		// die('agendados oper');
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
		$this->db->where('respondentes.operador',$oper);
		$this->db->where('respondentes.statusLigacao','Agendado com dia e hora certo');
		$this->db->order_by('dia', 'asc');
		$this->db->limit( 25, 0 );
    return $this->db->get($this->table)->result_array();
	}

	/** {oper painel} */
	public function findUnfinished($oper) {
		// die('andamento');
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
		$this->db->where('respondentes.operador',$oper);
		$this->db->where('respondentes.statusLigacao', "Entrevista em andamento");
		$this->db->where('respondentes.status', true);
		$this->db->limit( 25, 0 );
    return $this->db->get($this->table)->result_array();
	}

	public function findContactedOper($oper){
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
		$this->db->where('respondentes.operador',$oper);
		$this->db->where('respondentes.statusLigacao is not null');
		$this->db->where('respondentes.statusLigacao <> "Entrevista em andamento"');
		$this->db->where('respondentes.status', true);
		$this->db->limit( 25, 0 );
    return $this->db->get($this->table)->result_array();
	}

	/** {admin home} {admin lists} */
	public function findFinished() {
		// die('finalizados');
		$this->db->where('statusLigacao', 'Finalizado');
    return $this->db->get($this->table)->result_array();
	}

	public function findFinishedCount() {
		// die('finalizados');
		$this->db->where('statusLigacao', 'Finalizado');
    return $this->db->count_all_results($this->table);
	}

	/** {oper painel} */
	public function findFinishedOper($oper) {
		// die('finalizados');
		$this->db->where('operador',$oper);
		$this->db->where('statusLigacao', 'Finalizado');
    return $this->db->get($this->table)->result_array();
	}

	/** finish */
	public function findById($id){
		$this->db->where('id',$id);
		$data = $this->db->get($this->table)->result_array();
		
		foreach($data[0] as $key => $val){
			$respondente[$key] = $val;
		}
    return $respondente;
	}

	/** CRUD * Create, Retrive, Update, Destroy */

	public function update($contacts){
		$this->db->update_batch($this->table, $contacts,'id');
		
		return 1;
	}

	public function update_unique($data, $id){
		$this->db->where('id',$id);
		return $this->db->update($this->table, $data);
	}

	public function add($data){
		$this->db->insert('excluded', $data);
    $id = $this->db->insert_id();
		return $id;
	}

	public function delete($id){
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}

	/** COTA */
	public function ApplyIdCota($cotas_id, $publico, $uf){
		$this->db->where('publico',$publico);
		$this->db->where('uf',$uf);
		return $this->db->update($this->table, array('cotas_id' => $cotas_id));
	}
}
