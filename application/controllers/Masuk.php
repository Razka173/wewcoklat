<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masuk extends CI_Controller {

	// load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pelanggan_model');
		$this->load->model('konfigurasi_model');
		$this->load->model('token_model');
	}

	// Login pelanggan
	public function index()
	{
		// Validasi
		$this->form_validation->set_rules('email','Email','required',
			array(	'required'	=>	'%s harus diisi'));
		$this->form_validation->set_rules('password','Password','required',
			array(	'required'	=>	'%s harus diisi'));

		if($this->form_validation->run()) {
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

	// Lupa password
	public function lupa()
	{
		// Validasi
		$valid = $this->form_validation;

		$this->form_validation->set_rules('email','Email','required|valid_email|trim',
			array(	'required'		=>	'%s harus diisi',
					'valid_email'	=>	'%s tidak valid'));

		if( $valid->run()===FALSE ) {
			// End validasi
			$site = $this->konfigurasi_model->listing();
			$data = array(	'title'		=> 'Lupa Password?',
							'site'		=> $site,
							'isi'		=> 'masuk/lupa_password'
						);
			$this->load->view('layout/wrapper_login_page', $data, FALSE);
		} else {
			$email 			= $this->input->post('email');
			$clean_email 	= $this->security->xss_clean($email); 
			$user 			= $this->pelanggan_model->cek_email($clean_email, 'Member');
			$user_reseller 	= $this->pelanggan_model->cek_email($clean_email, 'Reseller');

			if($user or $user_reseller){
				$token 		= base64_encode(random_bytes(32));
				$user_token	= array(	'email'		=> $clean_email,
										'token'		=> $token,
									);
				$this->token_model->tambah($user_token);
				$kirim_email = $this->kirim_email($token, $clean_email);
				if ( $kirim_email ) {
		    	$this->session->set_flashdata('sukses', 'Silahkan buka email anda untuk reset password!');
		    	redirect(base_url('masuk/lupa'),'refresh');
			    } else {
			    	$this->session->set_flashdata('sukses', 'Gagal mengirim email untuk reset password, coba lagi nanti.');
			       	redirect(base_url('masuk/lupa'),'refresh');
			    }
			} else {
				$this->session->set_flashdata('warning', 'Email tidak terdaftar atau tidak aktif!');
		       	redirect(base_url('masuk/lupa'));
			}
		}
	}

	// Reset password
	public function reset()
	{	
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->pelanggan_model->is_email_set($email);
		// kalau ada
		if ( $user ) {
			$user_token = $this->token_model->detail($token);

			if ( $user_token and $user_token->email == $email) {
				// Reset password
				$this->session->set_userdata('reset_email', $email);
				$this->ganti_password();
			} else {
				$this->session->set_flashdata('warning', 'Salah Token! Reset Password Gagal!');
		    	redirect(base_url('masuk'));
			}
		} else {
			$this->session->set_flashdata('warning', 'Salah Email! Reset Password Gagal!');
		    redirect(base_url('masuk'));
		}
	}

	public function ganti_password()
	{
		if(!$this->session->userdata('reset_email')) {
			redirect(base_url('masuk'));
		}
		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules('password','Password','trim|required|min_length[6]',
			array(	'required'		=> '%s harus diisi',
					'min_length'	=> '%s minimal 6 karakter'));

		$valid->set_rules('cfpassword','Konfirmasi Password','required|matches[password]',
			array(	'required'		=> '%s harus diisi',
					'matches'		=> '%s harus sama dengan password'));

		// End validasi
		if($valid->run()===FALSE) {
		
			$site = $this->konfigurasi_model->listing();
			$data = array(	'title'		=> 'Ganti Password',
							'site'		=> $site,
							'isi'		=> 'masuk/ganti_password'
						);
			$this->load->view('layout/wrapper_login_page', $data, FALSE);
		} else {
			// Masuk Database
			$i = $this->input;
			$password = SHA1($i->post('password'));
			$email = $this->session->userdata('reset_email');
			$data = array(	'email'				=> $email,
							'password'			=> $password
						);
			$this->pelanggan_model->edit_by_email($data);

			$this->session->unset_userdata('reset_email');

			$this->session->set_flashdata('sukses', 'Ganti Password berhasil. Silahkan Masuk!');
		    redirect(base_url('masuk'));
		}
	}

	// Kirim Email
	private function kirim_email($token, $email_destination)
	{
		$this->config->load('wew_email', TRUE);
		$smtp_host = $this->config->item('smtp_host', 'wew_email');
		$smtp_user = $this->config->item('smtp_user', 'wew_email');
		$smtp_pass = $this->config->item('smtp_pass', 'wew_email');

		// Verifikasi Email Pelanggan
		$this->load->library('email');
	    $config = array();
	    $config['smtp_host']	= $smtp_host; // Pengaturan SMTP
	    $config['smtp_user']	= $smtp_user; // isi dengan email kamu
	    $config['smtp_pass']	= $smtp_pass; // isi dengan password kamu
	    $config['charset'] 		= 'utf-8';
	    $config['useragent'] 	= 'Codeigniter';
	    $config['protocol']		= "smtp";
	    $config['mailtype']		= "html";
	    $config['smtp_port']	= "465";
	    $config['smtp_timeout']	= "400";
	    $config['crlf']			="\r\n"; 
	    $config['newline']		="\r\n"; 
	    $config['wordwrap'] 	= TRUE;
	    // memanggil library email dan set konfigurasi untuk pengiriman email
	   
	    $this->email->initialize($config);
	    //konfigurasi pengiriman
	    $this->email->from($config['smtp_user']);
	    $this->email->to($email_destination);
	    $this->email->subject("Reset Password");
	    $this->email->message(
	     'Klik link di bawah ini untuk reset password akun anda
	     <br><br><a href="'.base_url('masuk/reset').'?email='.$email_destination.'&token='.urlencode($token).'">Reset Password</a>'
	    );
	    if($this->email->send()){
	    	return true;
	    }else{
	    	echo $this->email->print_debugger();
	    	die;
	    }
	    return $this->email->send();
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