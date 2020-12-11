<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redistribute_model extends CI_Model {
	private $table = 'respondentes';

	function __construct()
	{
		parent::__construct();
	}

	public function index() {
		$this->db->where('status','1');
		$this->db->where('statusCota',true);
    return $this->db->get($this->table)->result_array();
	}
}
