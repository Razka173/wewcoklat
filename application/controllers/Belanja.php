<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Belanja extends CI_Controller {

	// Load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('produk_model');
		$this->load->model('kategori_model');
		$this->load->model('konfigurasi_model');
		$this->load->model('pelanggan_model');
		$this->load->model('header_transaksi_model');
		$this->load->model('transaksi_model');
		$this->load->model('alamat_pelanggan_model');
		// load helper random string
		$this->load->helper('string');
	}

	// Halaman belanja
	public function index()
	{
		$keranjang	= $this->cart->contents();
		
		if(empty($keranjang)){
			$this->session->set_flashdata('sukses','Keranjang Belanja Kosong');
		}

		$data = array(	'title'		=> 'Keranjang Belanja',
						'keranjang' => $keranjang,
						'isi'		=> 'belanja/list'
					);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Sukses belanja
	public function sukses()
	{

		$data = array(	'title'		=> 'Belanja Berhasil',
						'isi'		=> 'belanja/sukses'
					);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Checkout
	public function checkout()
	{
		// check pelanggan sudah login atau belum? Jika belum maka nanti harus registrasi
		// dan juga sekaligus login. Mengecek dengan session email
		
		// Kondisi sudah login
		if($this->session->userdata('email')) {
			$email 				= $this->session->userdata('email');
			$nama_pelanggan		= $this->session->userdata('nama_pelanggan');
			$pelanggan 			= $this->pelanggan_model->sudah_login($email, $nama_pelanggan);
			$alamat_pelanggan 	= $this->alamat_pelanggan_model->pelanggan($pelanggan->id_pelanggan);

			$keranjang	= $this->cart->contents();
			if(empty($keranjang)){
				$this->session->set_flashdata('sukses','Keranjang Belanja Kosong');
				redirect(base_url('belanja'),'refresh');
			}

			// Cek apakah pelanggan sudah verifikasi email
			if($pelanggan->status_pelanggan=='Pending'){
				$this->session->set_flashdata('sukses','Anda Belum Memverifikasi Email Anda! Silahkan Verifikasi Email Anda Terlebih Dahulu');
				redirect(base_url('belanja'),'refresh');
			}

			// Validasi input
			$valid = $this->form_validation;

			$valid->set_rules('nama_pelanggan','Nama lengkap','required',
				array(	'required'		=> '%s harus diisi'));

			$valid->set_rules('telepon','Nomor telepon','required',
				array(	'required'		=> '%s harus diisi'));

			$valid->set_rules('email','Email','required|valid_email',
				array(	'required'		=> '%s harus diisi',
						'valid_email'	=> '%s tidak valid'));

		if($valid->run()===FALSE) {
		// End validasi

			$data = array(	'title'				=> 'Checkout',
							'keranjang' 		=> $keranjang,
							'pelanggan'			=> $pelanggan,
							'alamat_pelanggan'	=> $alamat_pelanggan,
							'isi'				=> 'belanja/checkout'
						);
			$this->load->view('layout/wrapper', $data, FALSE);
			// Masuk database
			}else{
				$i = $this->input;
				if($i->post('metode_pengiriman')=='COD'){
					$alamat = "COD " . $i->post('cod');				
				}
				if($i->post('metode_pengiriman')=='JNE'){
					$id_alamat = $i->post('alamat');
					$data_alamat = $this->alamat_pelanggan_model->detail($id_alamat);
					$alamat = $data_alamat->alamat_detail;
				}
				$data = array(	'id_pelanggan'		=> $pelanggan->id_pelanggan,
								'nama_pelanggan'	=> $i->post('nama_pelanggan'),
								'email'				=> $i->post('email'),
								'telepon'			=> $i->post('telepon'),
								'alamat'			=> $alamat,
								'kode_transaksi'	=> $i->post('kode_transaksi'),
								'tanggal_transaksi'	=> $i->post('tanggal_transaksi'),
								'jumlah_transaksi'	=> $i->post('jumlah_transaksi'),
								'status_bayar'		=> 'Belum Bayar',
								'status_pesanan'	=> 'Menunggu Pembayaran',
								'tanggal_post'		=> date('Y-m-d H:i:s')
							);
				// Proses masuk ke header transaksi
				$this->header_transaksi_model->tambah($data);
				// Proses masuk ke tabel transaksi
				foreach($keranjang as $keranjang) {
					$sub_total = $keranjang['price'] * $keranjang['qty'];

					$data = array(	'id_pelanggan'		=> $pelanggan->id_pelanggan,
									'kode_transaksi'	=> $i->post('kode_transaksi'),
									'id_produk'			=> $keranjang['id'],
									'harga'				=> $keranjang['price'],
									'jumlah'			=> $keranjang['qty'],
									'total_harga'		=> $sub_total,
									'tanggal_transaksi'	=> $i->post('tanggal_transaksi')
								);
					$this->transaksi_model->tambah($data);
				}
				// End proses masuk ke tabel transaksi
				// Setelah masuk ke tabel transaksi, maka keranjang dikosongkan lagi
				$this->cart->destroy();
				// End pengosongan keranjang
				$this->session->set_flashdata('sukses', 'Check out berhasil');
				redirect(base_url('belanja/sukses'),'refresh');
		}
			// End masuk database
		}else{
			// Kalau belum, maka harus registrasi
			$this->session->set_flashdata('sukses', 'Silahkan login atau registrasi terlebih dahulu');
			redirect(base_url('masuk'),'refresh');
		}
	}

	// Tambahkan ke keranjang belanja
	public function add()
	{
		// Ambil data dari form
		$id 			= $this->input->post('id');
		$qty 			= $this->input->post('qty');
		$price 			= $this->input->post('price');

		if($this->session->userdata('email')) {
			$email 				= $this->session->userdata('email');
			$nama_pelanggan		= $this->session->userdata('nama_pelanggan');
			$pelanggan 			= $this->pelanggan_model->sudah_login($email, $nama_pelanggan);
			if($pelanggan->status_pelanggan=='Reseller'){
				$price 	= $this->input->post('price')-4000;
			}
		}

		$name 			= $this->input->post('name');
		$redirect_page 	= $this->input->post('redirect_page');
		// Proses memasukkan ke keranjang belanja
		$data = array(	'id'		=> $id,
						'qty'		=> $qty,
						'price'		=> $price,
						'name'		=> $name
					);
		$this->cart->insert($data);
		// Redirect page
		redirect($redirect_page,'refresh');
	}

	// Update cart
	public function update_cart($rowid)
	{
		// Jika ada data rowid
		if($rowid) {
			$jumlah_produk = $this->input->post('qty');
			if($jumlah_produk>120){
				$this->session->set_flashdata('sukses', 'Silahkan menghubungi CS untuk pembelian dalam jumlah yang banyak.');
				redirect(base_url('belanja'),'refresh');
			}
			$data = array(	'rowid'		=> $rowid,
							'qty'		=> $this->input->post('qty')
						);
			$this->cart->update($data);
			$this->session->set_flashdata('sukses', 'Data keranjang telah diupdate');
			redirect(base_url('belanja'),'refresh');
		}else{
			// Jika ga ada row id
			redirect(base_url('belanja'),'refresh');
		}
	}

	// Hapus semua isi keranjang belanja
	public function hapus($rowid='')
	{
		if($rowid){
			// Hapus per item
			$this->cart->remove($rowid);
			$this->session->set_flashdata('sukses', 'Data keranjang belanja telah dihapus');
			redirect(base_url('belanja'),'refresh');
		}else{
			// Hapus all
			$this->cart->destroy();
			$this->session->set_flashdata('sukses', 'Data keranjang belanja telah dihapus');
			redirect(base_url('belanja'),'refresh');
		}
	}
}

/* End of file Belanja.php */
/* Location: ./application/controllers/Belanja.php */
