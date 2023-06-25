<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_m');
		$this->load->model('Transaksi_m');
		cekSession();
	}
	
	public function index()
	{
		$data['title'] = 'Transaksi';
		$data['user'] = $this->Auth_m->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('nis', 'NIS', 'required|trim', ['required' => 'NIS wajib di isi!.']);
		if($this->form_validation->run() == FALSE) {
			$this->load->view('layout/header', $data);
			$this->load->view('admin/transaksi/index', $data);
			$this->load->view('layout/footer');
		} else {
			$this->cariTransaksi();
		}
	}

	public function cariTransaksi()
	{
		$data['title'] = 'Transaksi';
		$data['user'] = $this->Auth_m->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$nis = $this->input->post('nis', true);
		$where = ['nis' => $nis];
		$data['siswa'] = $this->Transaksi_m->get_where('siswa', $where)->row_array();
		$idSiswa = $data['siswa']['id_siswa'];

		if($data['siswa'] == null) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert"><i class="fas fa-info-circle"></i> NIS Siswa <strong>'. $nis .'</strong> Tidak Terdaftar.</div>');
			redirect('admin/transaksi');
		}

		$where = ['id_siswa' => $idSiswa];
		$data['spp'] = $this->Transaksi_m->get_where('spp', $where)->result_array();
		$this->load->view('layout/header', $data);
		$this->load->view('admin/transaksi/index', $data);
		$this->load->view('layout/footer');
	}

	public function bayar($nis, $id)
	{
		$hariIini = date('Y-m-d');
		$today = date('ymd');

		// membuat no bayar acak
		$query = "SELECT max(no_bayar) AS NoBayar FROM spp WHERE no_bayar LIKE '$today%'";
		$data = $this->db->query($query)->result_array();
		$lastNoBayar = $data['NoBayar'];
		$lastNoUrut = substr($lastNoBayar, 6, 4);
		$nextNoUrut = $lastNoUrut + 1;
		$nextNoBayar = $today.sprintf('%04s', $nextNoUrut);

		$where = ['id_spp' => $id];
		$data = [
			'no_bayar' => $nextNoBayar,
			'tgl_bayar' => $hariIini,
			'ket' => 'Lunas'
		];
		$this->Transaksi_m->update_where('spp', $data, $where);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> NIM <strong>'. $nis .'</strong> SPP <strong>'. $noUrutBayarSelanjutnya .'</strong> Berhasil Di Bayar.</div>');
		redirect('admin/transaksi');
	}

	public function batal($nis, $idSpp)
	{
		$where = ['id_spp' => $idSpp];
		$data = [
			'no_bayar' => null,
			'tgl_bayar' => null,
			'ket' => 'Belum Lunas'
		];
		$this->Transaksi_m->update_where('spp', $data, $where);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> NIM <strong>'. $nis .'</strong> SPP Berhasil Di Bayar.</div>');
		redirect('admin/transaksi');
	}

	public function cetak($nis, $idSpp)
	{
		$where = ['nis' => $nis];
		$data['siswa'] = $this->Transaksi_m->get_where('siswa', $where)->row_array();
		$data['title'] = 'Laporan ' . $data['siswa']['nama_siswa'];
		$where = ['id_spp' => $idSpp];
		$data['bayar'] = $this->Transaksi_m->get_join_where('spp', $where)->result_array();
		$this->load->view('layout/header', $data);
		$this->load->view('admin/laporan/laporan_pembayaran_cetak', $data);
		$this->load->view('layout/footer');
	}


}