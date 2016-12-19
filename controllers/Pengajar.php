<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajar extends CI_Controller {

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

		$this->load->model("model_pengajar");
		$data['tabelpengajar'] = $this->model_pengajar->getdata();

		$data['page']="pengajar";
		$data['content']="view_pengajar2";
		$this->load->view("view_template",$data);
		

	}

	public function paging($offset=0){

		$this->load->model("model_pengajar");
		$this->load->library('pagination');

		$config['base_url'] = site_url("pengajar/paging");
		$config['total_rows'] = $this->model_pengajar->total();
		$config['per_page'] = 3;

		$this->pagination->initialize($config);

		$data['tabelpengajar'] = $this->model_pengajar->getdatapaging($offset,3);
		$this->load->view("view_paging_pengajar",$data);
	}


	public function add(){

		$this->load->view("view_add_pengajar2");

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

		$arrpengajar=array(
			"nip"=>$this->input->post('nip'),
			"nama"=>$this->input->post('nama'),
			"alamat"=>$this->input->post('alamat'),
			"lahir"=>$this->input->post('lahir'),
			"nilai"=>$this->input->post('nilai'),
			"foto"=>$foto
			);
		$this->load->model("model_pengajar");
		$this->model_pengajar->insertdata($arrpengajar);
		redirect("pengajar");


	}
	public function del(){
		$nip=$this->uri->segment(3);
		$this->load->model("model_pengajar");
		$this->model_pengajar->deldata($nip);
		redirect("pengajar");
	}
	
	public function edit()
	{
		$nip=$this->uri->segment(3);
		$this->load->model("model_pengajar");
		$data['barispengajar']=$this->model_pengajar->selectdata($nip);
		$this->load->view("view_edit_pengajar2",$data);
	}
	public function update (){
		$nip=$this->uri->segment(3);
		$arrpengajar=array(
			"nip"=>$this->input->post('nip'),
			"nama"=>$this->input->post('nama'),
			"alamat"=>$this->input->post('alamat'),
			"lahir"=>$this->input->post('lahir'),
			"nilai"=>$this->input->post('nilai'),
			"foto"=>$this->input->post('foto')
			);
		$this->load->model("model_pengajar");
		$this->model_pengajar->updatedata($arrpengajar,$nip);
		redirect("pengajar");


	}
}
