<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simple_pelanggan
{
	protected $CI;

	public function __construct()
	{
        $this->CI =& get_instance();
        // Load data model user
        $this->CI->load->model('pelanggan_model');
	}

	// Fungsi login
	public function login($email, $password="")
	{
		$check = $this->CI->pelanggan_model->login($email, $password);
		$second_check = $this->CI->pelanggan_model->login_google($email);
		$third_check = $this->CI->pelanggan_model->login_facebook($email);
		// Jika ada data user, maka create session login
		if($check) {
			$id_pelanggan		= $check->id_pelanggan;
			$nama_pelanggan		= $check->nama_pelanggan;
			$status_pelanggan	= $check->status_pelanggan;
			$status_reseller	= $check->status_reseller;
			// Create session
			$this->CI->session->set_userdata('id_pelanggan',$id_pelanggan);
			$this->CI->session->set_userdata('nama_pelanggan',$nama_pelanggan);
			$this->CI->session->set_userdata('email',$email);
			$this->CI->session->set_userdata('status_pelanggan',$status_pelanggan);
			$this->CI->session->set_userdata('status_reseller',$status_reseller);
			// redirect ke halaman yang diproteksi
			redirect(base_url('dasbor'),'refresh');
		} elseif($second_check) {
			$id_pelanggan		= $second_check->id_pelanggan;
			$nama_pelanggan		= $second_check->nama_pelanggan;
			$status_pelanggan	= $second_check->status_pelanggan;
			$status_reseller	= $second_check->status_reseller;
			// Create session
			$this->CI->session->set_userdata('id_pelanggan',$id_pelanggan);
			$this->CI->session->set_userdata('nama_pelanggan',$nama_pelanggan);
			$this->CI->session->set_userdata('email',$email);
			$this->CI->session->set_userdata('status_pelanggan',$status_pelanggan);
			$this->CI->session->set_userdata('status_pelanggan',$status_reseller);
			// redirect ke halaman yang diproteksi
			redirect(base_url('dasbor'),'refresh');
		} elseif($third_check){
			$id_pelanggan		= $third_check->id_pelanggan;
			$nama_pelanggan		= $third_check->nama_pelanggan;
			$status_pelanggan	= $third_check->status_pelanggan;
			$status_reseller	= $third_check->status_reseller;
			// Create session
			$this->CI->session->set_userdata('id_pelanggan',$id_pelanggan);
			$this->CI->session->set_userdata('nama_pelanggan',$nama_pelanggan);
			$this->CI->session->set_userdata('email',$email);
			$this->CI->session->set_userdata('status_pelanggan',$status_pelanggan);
			$this->CI->session->set_userdata('status_pelanggan',$status_reseller);
			// redirect ke halaman yang diproteksi
			redirect(base_url('dasbor'),'refresh');
		} else {
			// Kalau tidak ada (username password salah), maka suruh login lagi
			$this->CI->session->set_flashdata('warning', 'Email atau password salah.');
			redirect(base_url('masuk'),'refresh');
		}
	}

	// Fungsi cek login
	public function cek_login()
	{
		// Memeriksa apakah session sudah atau belum, jika belum alihkan ke halaman login
		if($this->CI->session->userdata('email') == "") {
			$this->CI->session->set_flashdata('warning', 'Anda belum login');
			redirect(base_url('masuk'),'refresh');
		}
	}

	// Fungsi cek login di halaman login
	public function done_login()
	{
		// Memeriksa apakah session sudah atau belum, jika sudah alihkan ke halaman dasbor
		if( !($this->CI->session->userdata('email') == '') ) {
			redirect(base_url('dasbor'),'refresh');
		}
	}

	// Fungsi logout
	public function logout()
	{
		// Membuang semua session yang telah diset pada saat login
		$this->CI->session->unset_userdata('id_pelanggan');
		$this->CI->session->unset_userdata('nama_pelanggan');
		$this->CI->session->unset_userdata('email');
		// Setelah session dibuang, makaa redirect ke login
		$this->CI->session->set_flashdata('logout', 'Anda berhasil logout');
		redirect(base_url('masuk'),'refresh');
	}

	// Fungsi logout ketika menghapus diri sendiri
	public function logout_self_destroy()
	{
		// Membuang semua session yang telah diset pada saat login
		$this->CI->session->unset_userdata('id_pelanggan');
		$this->CI->session->unset_userdata('nama_pelanggan');
		$this->CI->session->unset_userdata('email');
		// Setelah session dibuang, makaa redirect ke login
		$this->CI->session->set_flashdata('sukses', 'Data anda berhasil dihapus. Anda dipaksa logout dari sistem');
		redirect(base_url('masuk'),'refresh');
	}

}

/* End of file Simple_pelanggan.php */
/* Location: ./application/libraries/Simple_pelanggan.php */
