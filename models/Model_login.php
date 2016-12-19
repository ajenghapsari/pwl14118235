<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_login extends CI_Model {


	public function cekdata($username, $password)
	{
		$this->db->where("username",$username);
		$this->db->where("password",$password);
		$hasil = $this->db->get("login")->row();
		
        return $hasil;
    }

    

}

