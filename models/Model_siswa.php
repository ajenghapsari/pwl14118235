<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_siswa extends CI_Model {


	public function getdata()
	{
		//$hasil = $this->db->get("siswa")->result();
		//$hasil=$this->db->query("SELECT * FROM siswa")->result();
		//$hasil=$this->db->query("SELECT * FROM siswa LEFT JOIN pelatihan ON siswa.kode=pelatihan.kode")->result();
		$this->db->select("siswa.*,pelatihan.judul");
		$this->db->from("siswa");
		$this->db->join("pelatihan","siswa.kode = pelatihan.kode","left");
		$hasil=$this->db->get()->result();
        return $hasil;
    }

    public function getdatabykode($kode)
	{
		$this->db->where("kode",$kode);
		$hasil = $this->db->get("siswa")->result();
		
        return $hasil;
    }

    public function getdatapaging($offset,$limit)
	{
		$this->db->limit($limit,$offset);
		$hasil=$this->db->get("siswa")->result();
        return $hasil;
    }

    function insertdata($data){

		$this->db->insert("siswa", $data);


	}

	function deldata ($nis) {

		$this->db->where("nis", $nis);
		$this->db->delete("siswa");
	}

	function selectdata($nis)
	{
		$this->db->where("nis",$nis);
		$baris=$this->db->get("siswa")->row();
		return $baris;
	}
	function updatedata($data, $nis){
		$this->db->where("nis",$nis);
		$this->db->update("siswa", $data);


	}
	function total(){
		return $this->db->get("siswa")->num_rows();
	}

}

