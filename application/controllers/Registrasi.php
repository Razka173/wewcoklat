<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends CI_Controller {

	// Load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pelanggan_model');
	}

	// Halaman registrasi
	public function index()
	{
		// Validasi input
		$valid = $this->form_validation;

		$valid->set_rules('nama_pelanggan','Nama lengkap','required',
			array(	'required'		=> '%s harus diisi'));

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

		$data = array(	'title'		=> 'Registrasi Pelanggan', 
						'isi'		=> 'registrasi/list'
					);
		$this->load->view('layout/wrapper', $data, FALSE);
		// Masuk database
		}else{
			$i = $this->input;
			$data = array(	'status_pelanggan'	=> 'Pending',
							'nama_pelanggan'	=> $i->post('nama_pelanggan'),
							'email'				=> $i->post('email'),
							'password'			=> SHA1($i->post('password')),
							'telepon'			=> $i->post('telepon'),
							'alamat'			=> $i->post('alamat'),
							'status_reseller'	=> $i->post('status_reseller'),
							'tanggal_daftar'	=> date('Y-m-d H:i:s')
						);
			$id = $this->pelanggan_model->tambah($data);

			//Enkripsi id
			$encrypted_id = md5($id);

			$email_pendaftar = $i->post('email');
			$kirim_email = $this->kirim_email($encrypted_id, $email_pendaftar);
			
			// $this->email->send()
		    if ( $kirim_email ) {
		    	$this->session->set_flashdata('sukses', 'Registrasi berhasil, silahkan cek email kamu untuk melakukan verifikasi');
		    	redirect(base_url('registrasi/sukses'),'refresh');
		    } else {
		    	$this->session->set_flashdata('sukses', 'Registrasi berhasil, namun gagal mengirim verifikasi email');
		       	redirect(base_url('registrasi/sukses'),'refresh');
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
	public function kirim_email($encrypted_id, $subject)
	{
		$email_sender 	= "wewcokelat@gmail.com";
		$email_password	= "!bismillah";

		// Verifikasi Email Pelanggan
		$this->load->library('email');
	    $config = array();
	    $config['charset'] = 'utf-8';
	    $config['useragent'] = 'Codeigniter';
	    $config['protocol']= "smtp";
	    $config['mailtype']= "html";
	    $config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
	    $config['smtp_port']= "465";
	    $config['smtp_timeout']= "400";
	    $config['smtp_user']= $email_sender; // isi dengan email kamu
	    $config['smtp_pass']= $email_password; // isi dengan password kamu
	    $config['crlf']="\r\n"; 
	    $config['newline']="\r\n"; 
	    $config['wordwrap'] = TRUE;
	    //memanggil library email dan set konfigurasi untuk pengiriman email
	   
	    $this->email->initialize($config);
	    //konfigurasi pengiriman
	    $this->email->from($config['smtp_user']);
	    $this->email->to($subject);
	    $this->email->subject("Verifikasi Akun");
	    $this->email->message(
	     "Terimakasih telah melakukan registrasi di website WEW COKLAT, untuk memverifikasi silahkan klik tautan dibawah ini<br><br>".
	      base_url("registrasi/verifikasi/$encrypted_id")
	    );
	    return $this->email->send();
	}
}

/* End of file Registrasi.php */
/* Location: ./application/controllers/Registrasi.php */