<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

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

		$this->load->model("model_siswa");
		$data['tabelsiswa'] = $this->model_siswa->getdata();

		$data['page']="siswa";
		$this->load->view("view_siswa",$data);
		

	}

	public function paging($offset=0){

		$this->load->model("model_siswa");
		$this->load->library('pagination');

		$config['base_url'] = site_url("siswa/paging");
		$config['total_rows'] = $this->model_siswa->total();
		$config['per_page'] = 3;

		$this->pagination->initialize($config);

		$data['tabelsiswa'] = $this->model_siswa->getdatapaging($offset,3);
		$this->load->view("view_paging_siswa",$data);
	}


	public function add(){

		$this->load->view("view_add_siswa");

	}


	public function save (){
		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 10000;
        $config['max_width']            = 10240;
        $config['max_height']           = 7680;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('foto'))
        {
                // $error = array('error' => $this->upload->display_errors());

                // $this->load->view('upload_form', $error);
        	$foto="";
        }
        else
        {
                // $data = array('upload_data' => $this->upload->data());

                // $this->load->view('upload_success', $data);
        	$foto=$this->upload->data('file_name');  
        }

		$arrsiswa=array(
			"nis"=>$this->input->post('nis'),
			"nama"=>$this->input->post('nama'),
			"alamat"=>$this->input->post('alamat'),
			"lahir"=>$this->input->post('lahir'),
			"nilai"=>$this->input->post('nilai'),
			"foto"=>$foto
			);
		$this->load->model("model_siswa");
		$this->model_siswa->insertdata($arrsiswa);
		redirect("siswa");


	}
	public function del(){
		$nis=$this->uri->segment(3);
		$this->load->model("model_siswa");
		$this->model_siswa->deldata($nis);
		redirect("siswa");
	}
	
	public function edit()
	{
		$nis=$this->uri->segment(3);
		$this->load->model("model_siswa");
		$data['barissiswa']=$this->model_siswa->selectdata($nis);
		$this->load->view("view_edit_siswa",$data);
	}
	public function update (){
		$nis=$this->uri->segment(3);
		$arrsiswa=array(
			"nis"=>$this->input->post('nis'),
			"nama"=>$this->input->post('nama'),
			"alamat"=>$this->input->post('alamat'),
			"lahir"=>$this->input->post('lahir'),
			"nilai"=>$this->input->post('nilai'),
			"foto"=>$this->input->post('foto')
			);
		$this->load->model("model_siswa");
		$this->model_siswa->updatedata($arrsiswa,$nis);
		redirect("siswa");


	}
}
