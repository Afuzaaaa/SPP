<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_m');
		cekSession();
	}
	
	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['user'] = $this->Auth_m->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$this->load->view('layout/header', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('layout/footer');
	}

}