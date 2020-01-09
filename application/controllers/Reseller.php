<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reseller extends CI_Controller {

	public function index()
	{
		$data = array(	'title'		=> 'Halaman Reseller',
						'isi'		=> 'reseller/list'
					);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

}

/* End of file Reseller.php */
/* Location: ./application/controllers/Reseller.php */