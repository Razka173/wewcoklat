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

	// Tambah Rekening
	public function tambah(){
		// Ambil data login id_pelanggan dari SESSION
		$id_pelanggan	= $this->session->userdata('id_pelanggan');

		// Validasi input
		$valid = $this->form_validation;

		$valid->set_rules('nama_bank','Nama Bank','required',
			array(	'required'		=> '%s harus diisi'));

		$valid->set_rules('nomor_rekening','Nomor rekening','required|is_unique[rekening_pelanggan.nomor_rekening]',
			array(	'required'		=> '%s harus diisi',
					'is_unique'		=> '%s sudah ada'));
		
		$valid->set_rules('nama_pemilik','Nama pemilik','required',
			array(	'required'		=> '%s harus diisi'));

		if($valid->run()===FALSE) {
			// End validasi
			$data = array(	'title' 	=> 'Tambah Data Rekening Pelanggan',
							'isi'		=> 'dasbor/tambah_rekening'
						);
			$this->load->view('layout/wrapper', $data, FALSE);
		
		}else{
			// Masuk database
			$i = $this->input;
			$data = array(	'id_pelanggan'		=> $id_pelanggan,
							'nama_bank'			=> $i->post('nama_bank'),
							'nama_pemilik'		=> $i->post('nama_pemilik'),
							'nomor_rekening'	=> $i->post('nomor_rekening')
						);
			$this->rekening_pelanggan_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data rekening berhasil ditambah');
			redirect(base_url('dasbor/rekening'),'refresh');
		}
		// End masuk database
	}
	
	// Delete Rekening
	public function delete($id_rekening){
		// Ambil data login id_pelanggan dari SESSION
		$id_pelanggan 		= $this->session->userdata('id_pelanggan');
		$rekening_pelanggan = $this->rekening_pelanggan_model->detail($id_rekening);
		
		// Pastikan bahwa pelanggan hanya mengakses data transaksinya
		if($rekening_pelanggan->id_pelanggan != $id_pelanggan) {
			$this->session->set_flashdata('warning', 'Anda mencoba mengakses data rekening orang lain');
			redirect(base_url('dasbor'));
		}
		// Proses hapus data rekening
		$data = array(	'id_rekening'	=> $id_rekening
					);
		$this->rekening_pelanggan_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data Rekening berhasil dihapus');
		redirect(base_url('dasbor/rekening'), 'refresh');
	}

}

/* End of file Rekening.php */
/* Location: ./application/controllers/Rekening.php */