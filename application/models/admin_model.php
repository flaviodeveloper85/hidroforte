<?php

class Admin_model extends CI_Model{

	function __construct(){

		parent::__construct();
	}

	public function autenticar($user, $pass){

		$this->db->where('usuario', $user); 
		$this->db->where('password', $pass); 
        $user = $this->db->get('tb_admin')->row_array(); 
        return $user; 

	}

}