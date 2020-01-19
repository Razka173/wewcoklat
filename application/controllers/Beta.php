<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beta extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('rajaongkir');
	}

	public function index()
	{
		//Mendapatkan semua propinsi
		$provinces = $this->rajaongkir->province();

		//Mendapatkan semua kota
		$cities = $this->rajaongkir->city();

		//Mendapatkan data ongkos kirim
		$cost = $this->rajaongkir->cost(501, 114, 1000, "jne");

		echo var_dump($provinces);

		echo var_dump($cost);

		print_r($provinces);

		// $data = array(	'title'		=> 'Beta tester',
		// 				'provinces'	=> $provinces,
		// 				'isi'		=> 'beta/modal'
		// 			);
		// $this->load->view('beta/modal', $data, FALSE);
	}

}

/* End of file Beta.php */
/* Location: ./application/controllers/Beta.php */