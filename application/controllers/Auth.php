<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_m');
	}

	public function index()
	{
		$this->cekLogin();
		$data['title'] = 'Halaman Login';
		$this->form_validation->set_rules('username', 'Username', 'required|trim', ['required' => 'Username wajib di isi!.']);
		$this->form_validation->set_rules('password', 'Password', 'required|trim', ['required' => 'Password wajib di isi!.']);
		if($this->form_validation->run() == FALSE) {
			$this->load->view('auth/login', $data);
		} else {
			$this->_login();
		}
	}

	private function _login()
	{
		$username = $this->input->post('username', true);
		$password = $this->input->post('password', true);

		$user = $this->Auth_m->get_where('users', ['username' => $username])->row_array();
		if($user != null) {
			if(sha1($password) == $user['password']) {
				$data = [
					'username' => $user['username'],
					'id_user' => $user['id_user']
				];
				$this->session->set_userdata($data);
				redirect('admin/dashboard');
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password Salah!.</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Akun Belum Terdaftar!.</div>');
			redirect('auth');
		}
	}

	public function cekLogin()
	{
		if($this->session->userdata('username')) {
			redirect('admin/dashboard');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil Logout.</div>');
		redirect('auth');

	}

}