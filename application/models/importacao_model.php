<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Importacao_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function cadastro($data) {
		$retorno = $this->db->insert_batch('respondentes', $data);
		return $retorno;
	}

	public function update($data) {
		return $this->db->update_batch('respondentes', $data, 'id');
	}
}
