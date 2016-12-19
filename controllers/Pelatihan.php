<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelatihan extends CI_Controller {

function __construct() {
        parent::__construct();

        if($this->session->userdata("username")==""){
				redirect("home/login");
				exit;
			}
		}
	public function index()
	{
		$this->load->model("model_pelatihan");
			if ($this->input->post("keyword")==""){
				$data['tabelpelatihan'] = $this->model_pelatihan->getdata();
			}else{
				$data['tabelpelatihan']= $this->model_pelatihan->caridata($this->input->post("keyword"));
			}
			$data['content']="view_pelatihan2";
			$this->load->view("view_template",$data);
			
	}
	public function paging($offset=0){

		$this->load->model("model_pelatihan");
		$this->load->library('pagination');

		$config['base_url'] = site_url("pelatihan/paging");
		$config['total_rows'] = $this->model_pelatihan->total();
		$config['per_page'] = 3;

		$this->pagination->initialize($config);

		$data['tabelpelatihan'] = $this->model_pelatihan->getdatapaging($offset,3);
		$this->load->view("view_paging_pelatihan",$data);
	}

	public function add(){

		$this->load->view("view_add_pelatihan2");

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
		$arrpelatihan=array(
			"kode"=>$this->input->post('kode'),
			"judul"=>$this->input->post('judul'),
			"materi"=>$this->input->post('materi'),
			"mulai"=>$this->input->post('mulai'),
			"harga"=>$this->input->post('harga'),
			"foto"=>$foto
			);
		$this->load->model("model_pelatihan");
		$this->model_pelatihan->insertdata($arrpelatihan);
		redirect("pelatihan");
	
	
	}
	public function del(){
		$kode=$this->uri->segment(3);
		$this->load->model("model_pelatihan");
		$this->model_pelatihan->deldata($kode);
		redirect("pelatihan");
	}
	public function edit()
	{
		$kode=$this->uri->segment(3);
		$this->load->model("model_pelatihan");
		$data['barispelatihan']=$this->model_pelatihan->selectdata($kode);
		$this->load->view("view_edit_pelatihan2",$data);
	}
	public function update (){
		$kode=$this->uri->segment(3);
		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 10000;
        $config['max_width']            = 10240;
        $config['max_height']           = 7680;

        $this->load->library('upload', $config);
		$arrpelatihan=array(
			"kode"=>$this->input->post('kode'),
			"judul"=>$this->input->post('judul'),
			"materi"=>$this->input->post('materi'),
			"mulai"=>$this->input->post('mulai'),
			"harga"=>$this->input->post('harga')
			);
        if ( ! $this->upload->do_upload('foto'))
        {
                // $error = array('error' => $this->upload->display_errors());

                // $this->load->view('upload_form', $error);
        	//$arrpelatihan['foto']="";
        }
        else
        {
                // $data = array('upload_data' => $this->upload->data());

                // $this->load->view('upload_success', $data);
        	$arrpelatihan['foto']=$this->upload->data('file_name');  
        }
		
		$this->load->model("model_pelatihan");
		$this->model_pelatihan->updatedata($arrpelatihan,$kode);
		redirect("pelatihan");
	}
	
		

}		

