<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends CI_Controller {

	// Load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pelanggan_model');
		$this->load->model('konfigurasi_model');
	}

	// Halaman registrasi
	public function index()
	{
		// Validasi input
		$valid = $this->form_validation;

		$valid->set_rules('nama_pelanggan','Nama lengkap','required|max_length[50]',
			array(	'required'		=> '%s harus diisi',
					'max_length'	=> '%s terlalu panjang'));

		$valid->set_rules('email','Email','required|valid_email|is_unique[pelanggan.email]',
			array(	'required'		=> '%s harus diisi',
					'valid_email'	=> '%s tidak valid',
					'is_unique'		=> '%s sudah digunakan. Gunakan email lain.'));

		$valid->set_rules('password','Password','required|min_length[6]',
			array(	'required'		=> '%s harus diisi',
					'min_length'	=> '%s minimal 6 karakter'));

		$valid->set_rules('cfpassword','Konfirmasi Password','required|matches[password]',
			array(	'required'		=> '%s harus diisi',
					'matches'		=> '%s harus sama dengan password'));

		if($valid->run()===FALSE) {
		// End validasi

			$site = $this->konfigurasi_model->listing();
			$data = array(	'title'		=> 'Registrasi Pelanggan', 
							'site'		=> $site,
							'isi'		=> 'registrasi/list_new'
						);
			$this->load->view('layout/wrapper_login_page', $data, FALSE);
		// Masuk database
		} else {
			$i = $this->input;
			$nama_pelanggan = $this->security->xss_clean($i->post('nama_pelanggan'));  
			$email_pendaftar = $this->security->xss_clean($i->post('email'));  
			$data = array(	'status_pelanggan'	=> 'Pending',
							'nama_pelanggan'	=> $nama_pelanggan,
							'email'				=> $email_pendaftar,
							'password'			=> SHA1($i->post('password')),
							'status_reseller'	=> $i->post('status_reseller'),
							'tanggal_daftar'	=> date('Y-m-d H:i:s')
						);
			$id = $this->pelanggan_model->tambah($data);

			//Enkripsi id
			$encrypted_id = md5($id);

			$kirim_email = $this->kirim_email($encrypted_id, $email_pendaftar);
			
			// $this->email->send()
		    if ( $kirim_email ) {
		    	$this->session->set_flashdata('sukses', 'Registrasi berhasil, silahkan cek email kamu untuk melakukan verifikasi');
		    	redirect(base_url('masuk'),'refresh');
		    } else {
		    	$this->session->set_flashdata('sukses', 'Registrasi berhasil, namun gagal mengirim verifikasi email');
		       	redirect(base_url('masuk'),'refresh');
		    }
		}
		// End masuk database
	}

	// Verifikasi email
	public function verifikasi($key)
	{
		$this->pelanggan_model->ganti_status($key);
		$this->session->set_flashdata('sukses', 'Selamat kamu berhasil memverifikasi akun kamu');
		redirect(base_url('registrasi/sukses'),'refresh');
	}

	// Sukses
	public function sukses()
	{
		$data = array(	'title'		=> 'Registrasi berhasil',
						'isi'		=> 'registrasi/sukses'
					);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Kirim Email
	private function kirim_email($encrypted_id, $subject)
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
	    $this->email->to($subject);
	    $this->email->subject("Verifikasi Akun");
	    $this->email->message(
	     "Terimakasih telah melakukan registrasi di website WEW COKLAT, untuk memverifikasi silahkan klik tautan dibawah ini<br><br>".
	      base_url("registrasi/verifikasi/$encrypted_id")
	    );
	    if($this->email->send()){
	    	return true;
	    }else{
	    	echo $this->email->print_debugger();
	    	die;
	    }
	    return $this->email->send();
	}

	public function kirim(){
		if( $this->session->userdata('email') == '' ){
			redirect(base_url('masuk'),'refresh');
		}
		// Ambil data login id_pelanggan dari SESSION
		$id_pelanggan		= $this->session->userdata('id_pelanggan');
		$email_pelanggan	= $this->session->userdata('email');

		//Enkripsi id
		$encrypted_id 		= md5($id_pelanggan);
		$kirim_email 		= $this->kirim_email($encrypted_id, $email_pelanggan);

		if ( $kirim_email ) {
		    $this->session->set_flashdata('sukses', 'Email Verifikasi berhasil dikirim, silahkan cek email kamu untuk melakukan verifikasi');
		    	redirect(base_url('dasbor'),'refresh');
		} else {
		    	$this->session->set_flashdata('sukses', 'Gagal mengirim verifikasi email coba lagi nanti');
		       	redirect(base_url('dasbor'),'refresh');
		}
	}
}

/* End of file Registrasi.php */
/* Location: ./application/controllers/Registrasi.php */