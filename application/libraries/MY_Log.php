<?php

class MY_Log extends CI_Log {

  function __construct()
  {
    parent::__construct();

    //updated log levels according to the correct order
    $this->_levels  = array('APP' => '1', 'ERROR' => '2', 'INFO' => '3',  'DEBUG' => '4', 'ALL' => '5');
  }
}