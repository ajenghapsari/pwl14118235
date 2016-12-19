<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pelatihan extends CI_Model {


	public function getdata()
	{
		$hasil = $this->db->get("pelatihan")->result();
        return $hasil;
        }
    public function getdatapaging($offset,$limit)
	{
		$this->db->limit($limit,$offset);
		$hasil=$this->db->get("pelatihan")->result();
        return $hasil;
    }
	
	function insertdata($data){
		$this->db->insert("pelatihan",$data);
	}
	function deldata ($kode) {

		$this->db->where("kode", $kode);
		$this->db->delete("pelatihan");
	}
	function selectdata($kode){
		$this->db->where("kode",$kode);
		$baris=$this->db->get("pelatihan")->row();
		return $baris;
	}
	function updatedata($data, $kode){
		$this->db->where("kode",$kode);
		$this->db->update("pelatihan", $data);
	}
	function total(){
		return $this->db->get("siswa")->num_rows();
	}
	public function caridata($keyword)
	{
		$hasil = $this->db->query("SELECT*FROM pelatihan WHERE judul LIKE '%$keyword%' OR materi LIKE '%$keyword%'")->result();
    	return $hasil;
    }

}
