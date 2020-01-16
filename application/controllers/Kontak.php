<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('kontak_model');
	}

	public function index()
	{
		// Validasi input
		$valid = $this->form_validation;

		$valid->set_rules('nama','Nama','required',
			array(	'required'		=> '%s harus diisi'));

		$valid->set_rules('email','Email','required',
			array(	'required'		=> '%s harus diisi'));

		$valid->set_rules('pesan','Pesan','required',
			array(	'required'		=> '%s harus diisi'));

		if($valid->run()===FALSE) {
			// End validasi
			$data = array(	'title'		=> 'Kontak kami',
							'isi'		=> 'kontak/list'
						);
			$this->load->view('layout/wrapper', $data, FALSE);
		
		}else{
			// Masuk database
			$i = $this->input;
			$data = array(	'nama'		=> $i->post('nama'),
							'email'		=> $i->post('email'),
							'pesan'		=> $i->post('pesan')
						);
			$this->kontak_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Pesan Anda Telah Dikirim, Terima Kasih Sudah Menghubungi Kami');
			redirect(base_url('kontak'),'refresh');
		}
		// End masuk database
	}

	public function kebijakan_privasi()
	{
		$data = array(	'title'		=> 'Kontak kami',
						'isi'		=> 'kontak/kebijakan_privasi'
						);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

}

/* End of file Kontak.php */
/* Location: ./application/controllers/Kontak.php */