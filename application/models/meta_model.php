<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meta_model extends CI_Model {
	private $table = 'meta';

	function __construct()
	{
		parent::__construct();
	}

	public function update($metaEntrevistas) {
		$this->db->where('id',1);
		return $this->db->update($this->table, $metaEntrevistas);
	}

	public function qtd() {
		$this->db->select('qtd');
		$this->db->where('id',1);
		$count = $this->db->get($this->table)->result();

		return $count[0]->qtd;
	}
}
