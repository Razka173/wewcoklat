<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('rekening_pelanggan_model');
		// Halaman ini diproteksi dengan Simple_pelanggan => Check login
		$this->simple_pelanggan->cek_login();
	}

	public function index()
	{

	}

	// Delete Rekening
	public function delete($id_rekening){
		// Ambil data login id_pelanggan dari SESSION
		$id_pelanggan = $this->session->userdata('id_pelanggan');
		$rekening_pelanggan = $this->rekening_pelanggan_model->detail($id_rekening);
		
		// Pastikan bahwa pelanggan hanya mengakses data transaksinya
		if($rekening_pelanggan->id_pelanggan != $id_pelanggan) {
			$this->session->set_flashdata('warning', 'Anda mencoba mengakses data rekening orang lain');
			redirect(base_url('dasbor'));
		}

		// Proses hapus data rekening
		$data = array(	'id_rekening'	=> $id_rekening
					);

		// $this->rekening_pelanggan_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data Rekening berhasil dihapus');
		redirect(base_url('dasbor/rekening'), 'refresh');
	}
}

/* End of file Rekening.php */
/* Location: ./application/controllers/Rekening.php */