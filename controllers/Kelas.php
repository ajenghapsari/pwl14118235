<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

	function __construct() {
        parent::__construct();

        if($this->session->userdata("username")==""){
				redirect("home/login");
				exit;
		}
    }

	public function index()
	{
		//include("Rumus.php");
		//$r = new Rumus();
		//$data['hasil'] = $r->tambah(2, 3);

		$this->load->library("rumus");
		$data['hasil'] = $this->rumus->tambah(2, 3);

		$this->load->model("model_kelas");
		$tabelkelas = $this->model_kelas->getdata();
		$data['tabelkelas'] = $tabelkelas;
		foreach ($tabelkelas as $rowkelas){
			$tabelpeserta[$rowkelas->id_kelas]= $this->model_kelas->getpesertabyidkelas($rowkelas->id_kelas);
		}
		$data['tabelpeserta']=$tabelpeserta;
		

		$data['page']="kelas";
		$data['content']="view_kelas";
		$this->load->view("view_template",$data);
		

	}

	public function paging($offset=0){

		$this->load->model("model_kelas");
		$this->load->library('pagination');

		$config['base_url'] = site_url("kelas/paging");
		$config['total_rows'] = $this->model_kelas->total();
		$config['per_page'] = 3;

		$this->pagination->initialize($config);

		$data['tabelkelas'] = $this->model_kelas->getdatapaging($offset,3);
		$this->load->view("view_paging_kelas",$data);
	}


	public function add(){
		$this->load->model("model_pelatihan");
		$data['tabelpelatihan'] = $this->model_pelatihan->getdata();
		$this->load->model("model_pengajar");
		$data['tabelpengajar'] = $this->model_pengajar->getdata();
		$this->load->model("model_siswa");
		$data['tabelsiswa'] = $this->model_siswa->getdata();
		$this->load->view("view_add_kelas2",$data);

	}


	public function save (){
		

		$arrkelas=array(
			"kode"=>$this->input->post('kode'),
			"nip"=>$this->input->post('nip'),
			"mulai"=>$this->input->post('mulai')
			);
		$this->load->model("model_kelas");
		$this->model_kelas->insertdata($arrkelas);
		$id_kelas = $this->db->insert_id();

		for ($i=1; $i<10; $i++){
			if ($this->input->post('nis'.$i) !=""){
				$arrpeserta=array(
				"id_kelas"=>$id_kelas,
				"nis"=>$this->input->post('nis'.$i)
				);
				$this->model_kelas->insertpeserta ($arrpeserta);
			}

		}
		redirect("kelas");


	}
	public function del(){
		$id_kelas=$this->uri->segment(3);
		$this->load->model("model_kelas");
		$this->model_kelas->delpeserta($id_kelas);
	    $this->model_kelas->deldata($id_kelas);
		redirect("kelas");
	}
	
	public function edit()
	{
		$id_kelas=$this->uri->segment(3);
		$this->load->model("model_kelas");
		$data['bariskelas']=$this->model_kelas->selectdata($id_kelas);
		$this->load->model("model_pelatihan");
		$data['tabelpelatihan'] = $this->model_pelatihan->getdata();
		$this->load->model("model_pengajar");
		$data['tabelpengajar'] = $this->model_pengajar->getdata();
		$this->load->model("model_siswa");
		$data['tabelsiswa'] = $this->model_siswa->getdata();
		$data['tabelpeserta']= $this->model_kelas->getpesertabyidkelas($id_kelas);
		$this->load->view("view_edit_kelas2",$data);
	}
	public function update (){
		$id_kelas=$this->uri->segment(3);
		$arrkelas=array(
			"kode"=>$this->input->post('kode'),
			"nip"=>$this->input->post('nip'),
			"mulai"=>$this->input->post('mulai')
			);
		echo $id_kelas;
		$this->load->model("model_kelas");
		$this->model_kelas->updatedata($arrkelas,$id_kelas);

		$this->model_kelas->delpeserta($id_kelas);
	    
		for ($i=1; $i<10; $i++){
			if ($this->input->post('nis'.$i) !=""){
				$arrpeserta=array(
				"id_kelas"=>$id_kelas,
				"nis"=>$this->input->post('nis'.$i)
				);
				$this->model_kelas->insertpeserta ($arrpeserta);
			}

		}
		redirect("kelas");


	}
}
