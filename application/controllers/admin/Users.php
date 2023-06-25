<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_m');
		$this->load->model('User_m');
		cekSession();
	}
	
	public function index()
	{
		$data['title'] = 'User Admin';
		$data['user'] = $this->Auth_m->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$data['users'] = $this->User_m->get('users')->result_array();
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[4]|max_length[12]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|max_length[12]');
		if($this->form_validation->run() == FALSE) {
			$this->load->view('layout/header', $data);
			$this->load->view('admin/users/index', $data);
			$this->load->view('layout/footer');
		} else {
			$data = [
				'username' => html_escape($this->input->post('username', true)),
				'password' => html_escape(sha1($this->input->post('password', true))),
				'nama_lengkap' => html_escape($this->input->post('nama', true))
			];
			$this->User_m->insert('users', $data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data User Berhasil Ditambahkan.</div>');
			redirect('admin/users');
		}
	}

	public function ubahUser($id)
	{
		$data['user'] = $this->Auth_m->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$where = ['id_user' => $id];
		$data['users'] = $this->User_m->get_where('users', $where)->row_array();
		$data['title'] = 'Ubah Data User ' . $data['users']['username'];

		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[4]|max_length[12]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|max_length[12]');

		if($this->form_validation->run() == FALSE) {
			$this->load->view('layout/header', $data);
			$this->load->view('admin/users/ubah', $data);
			$this->load->view('layout/footer');
		} else {
			$this->ubahDataUser();
		}

	}

	public function ubahDataUser()
	{
		$idUser = $this->input->post('id_user');
		$data = [
			'username' => html_escape($this->input->post('username', true)),
			'password' => html_escape(sha1($this->input->post('password', true))),
			'nama_lengkap' => html_escape($this->input->post('nama', true))
		];
		$this->db->where('id_user', $idUser);
		$this->User_m->update('users', $data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data User Berhasil Diubah.</div>');
		redirect('admin/users');
	}

	public function hapus($id)
	{
		$this->db->delete('users', ['id_user' => $id]);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-trash"></i> Data User Berhasil Dihapus.</div>');
		redirect('admin/users');
	}

}