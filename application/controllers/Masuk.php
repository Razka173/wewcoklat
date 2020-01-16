<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masuk extends CI_Controller {

	// load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pelanggan_model');
		$this->load->model('konfigurasi_model');
	}

	// Login pelanggan
	public function index()
	{
		// Validasi
		$this->form_validation->set_rules('email','Email/username','required',
			array(	'required'	=>	'%s harus diisi'));
		$this->form_validation->set_rules('password','Password','required',
			array(	'required'	=>	'%s harus diisi'));

		if($this->form_validation->run())
		{
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			// proses ke simple login
			$this->simple_pelanggan->login($email, $password);
		}
		// End validasi
		$site = $this->konfigurasi_model->listing();
		$data = array(	'title'		=> 'Halaman Masuk',
						'site'		=> $site,
						'isi'		=> 'masuk/list_alt'
					);
		$this->load->view('layout/wrapper_login_page', $data, FALSE);
	}

	// Logout
	public function logout()
	{
		// ambil fungsi logout di Simple_pelanggan yang sudah diset di autoload libraries
		$this->simple_pelanggan->logout();
	}

}

/* End of file Masuk.php */
/* Location: ./application/controllers/Masuk.php */