<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

function __construct() {
        parent::__construct();

        if($this->session->userdata("username")==""){
				redirect("home/login");
				exit;
			}
		}	
	public function index()
	{
		$this->load->model("model_jadwal");
		if ($this->input->post("keyword")==""){
			$data['tabeljadwal'] = $this->model_jadwal->getdata();
		}else{
			$data['tabeljadwal']= $this->model_jadwal->caridata($this->input->post("keyword"));
		}
		$this->load->view("view_jadwal",$data);
	}
}	
