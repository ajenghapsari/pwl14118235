<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	public function index()
	{
		
		$this->load->view("view_home2");
	}

	public function login()
	{
		
		$this->load->view("view_login2");
	}

	public function ceklogin()
	{
		$this->load->model("model_login");
		$row= $this->model_login->cekdata(
			$this->input->post("username"),
			$this->input->post("password"));
		if ($row){
			$this->session->set_userdata("username",$row->username);
			redirect("admin/index");
		}else{
			redirect("home/login");
		}
	}

}	
