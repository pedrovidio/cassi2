<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function dashboardLogs() {
    return $this->db->get('dashboard_logs')->result_array();
  }

  public function dashboardRespondentes() {
    return $this->db->get('dashboard_respondentes')->result_array();
  }
}
