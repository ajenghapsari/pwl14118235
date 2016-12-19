<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_kelas extends CI_Model {


	public function getdata()
	{
		//$hasil = $this->db->get("siswa")->result();
		//$hasil=$this->db->query("SELECT * FROM kelas")->result();
		//$hasil=$this->db->query("SELECT * FROM kelas LEFT JOIN peserta ON kelas.kode=pelatihan.kode")->result();
		$this->db->select("kelas.*,pelatihan.judul,pengajar.nama");
		$this->db->from("kelas");
		$this->db->join("pelatihan","kelas.kode = pelatihan.kode","left");
		$this-> db ->join('pengajar','pengajar.nip=kelas.nip','left');
		$hasil=$this->db->get()->result();
        return $hasil;
    }

    public function getpesertabyidkelas($id_kelas)
	{
		$this->db->select("peserta.*,siswa.nama");
		$this->db->from("peserta");
		$this->db->join("siswa","siswa.nis=peserta.nis","left");
		$this->db->where("id_kelas",$id_kelas);
		$hasil = $this->db->get()->result();
		
        return $hasil;
    }

    public function getdatapaging($offset,$limit)
	{
		$this->db->limit($limit,$offset);
		$hasil=$this->db->get("kelas")->result();
        return $hasil;
    }

    function insertdata($data){

		$this->db->insert("kelas", $data);


	}

	function insertpeserta($data){

		$this->db->insert("peserta", $data);


	}

	function deldata ($id_kelas) {

		$this->db->where("id_kelas", $id_kelas);
		$this->db->delete("kelas");
	}

	function delpeserta ($id_kelas) {

		$this->db->where("id_kelas", $id_kelas);
		$this->db->delete("peserta");
	}


	function selectdata($id_kelas)
	{
		$this->db->where("id_kelas",$id_kelas);
		$baris=$this->db->get("kelas")->row();
		return $baris;
	}
	function updatedata($data, $id_kelas){
		$this->db->where("id_kelas",$id_kelas);
		$this->db->update("kelas", $data);


	}
	function total(){
		return $this->db->get("kelas")->num_rows();
	}

}

