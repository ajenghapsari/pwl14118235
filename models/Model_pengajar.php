<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pengajar extends CI_Model {


	public function getdata()
	{
		//$hasil = $this->db->get("pengajar")->result();
		//$hasil=$this->db->query("SELECT * FROM pengajar")->result();
		//$hasil=$this->db->query("SELECT * FROM pengajar LEFT JOIN pelatihan ON pengajar.kode=pelatihan.kode")->result();
		$this->db->select("pengajar.*");
		$this->db->from("pengajar");
		//$this->db->join("pelatihan","pengajar.kode = pelatihan.kode","left");
		$hasil=$this->db->get()->result();
        return $hasil;
    }

 //    public function getdatabykode($kode)
	// {
	// 	$this->db->where("kode",$kode);
	// 	$hasil = $this->db->get("pengajar")->result();
		
 //        return $hasil;
 //    }

    public function getdatapaging($offset,$limit)
	{
		$this->db->limit($limit,$offset);
		$hasil=$this->db->get("pengajar")->result();
        return $hasil;
    }

    function insertdata($data){

		$this->db->insert("pengajar", $data);


	}
	function deldata ($nip) {

		$this->db->where("nip", $nip);
		$this->db->delete("pengajar");
	}

	function selectdata($nip)
	{
		$this->db->where("nip",$nip);
		$baris=$this->db->get("pengajar")->row();
		return $baris;
	}
	function updatedata($data, $nip){
		$this->db->where("nip",$nip);
		$this->db->update("pengajar", $data);


	}
	function total(){
		return $this->db->get("pengajar")->num_rows();
	}

}

