<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


	public function index()
	{
	if($this->session->userdata("username")==""){
		redirect("home/login");
		exit;
	}

$data['content']="view_admin2";
		$this->load->view("view_template", $data);
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect("home/login");
	}

	public function rekapnilai(){
		$this->load->model("model_siswa");
		$this->load->model("model_pelatihan");
		$tabelpelatihan= $this->model_pelatihan->getdata();
		foreach($tabelpelatihan as $barispelatihan){
			$tabelsiswa=$this->model_siswa->getdatabykode($barispelatihan->kode);
			foreach($tabelsiswa as $barissiswa){
				$rekap[$barispelatihan->judul][$barissiswa->nama]=$barissiswa->nilai;
			}
		}
		$data["rekap"]=$rekap;
		//$data['tabelpelatihan']=$tabelpelatihan; $data['tabelsiswa']=$tabelsiswa;

		$this->load->view("view_rekap",$data);
	}
}	
