<?php
define('BASEPATH', 'name', 'value') OR exit('No direct script access allowed');

class Model_Jadwal extends CI_Model {

	public function getdata()
	{
		$hasil = $this->db->get("jadwal")->result();
    	return $hasil;
    }

    public function caridata($keyword)
	{
		$hasil = $this->db->query("SELECT*FROM jadwal WHERE jadwal LIKE '%$keyword%' OR subjek LIKE '%$keyword%'")->result();
    	return $hasil;
    }
}   
?>