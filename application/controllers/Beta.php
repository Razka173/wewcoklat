<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beta extends CI_Controller {

	public function index()
	{
		$data = array(	'title'		=> 'Beta tester',
						'isi'		=> 'beta/modal'
					);
		$this->load->view('beta/modal', $data, FALSE);
	}

}

/* End of file Beta.php */
/* Location: ./application/controllers/Beta.php */