<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	// Load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaksi_model');
		$this->load->model('rekening_model');
		$this->load->model('header_transaksi_model');
		$this->load->model('konfigurasi_model');
	}

	// Load data transaksi
	public function index()
	{
		$header_transaksi = $this->header_transaksi_model->listing();
		$data = array(	'title'				=> 'Data Transaksi',
						'header_transaksi'	=> $header_transaksi,
						'isi'				=> 'admin/transaksi/list'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Detail
	public function detail($kode_transaksi)
	{
		$header_transaksi 	= $this->header_transaksi_model->kode_transaksi($kode_transaksi);
		$transaksi 			= $this->transaksi_model->kode_transaksi($kode_transaksi);

		$data = array(	'title'				=> 'Riwayat Belanja',
						'header_transaksi'	=> $header_transaksi,
						'transaksi'			=> $transaksi,
						'isi'				=> 'admin/transaksi/detail'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);	
	}

	// Update Status
	public function status($kode_transaksi)
	{
		$header_transaksi 	= $this->header_transaksi_model->kode_transaksi($kode_transaksi);
		$transaksi 			= $this->transaksi_model->kode_transaksi($kode_transaksi);

		// Validasi Input
		$valid = $this->form_validation;

		$valid->set_rules('status_bayar','Status Bayar','required',
			array(	'required'	=> '%s harus diisi'));

		$valid->set_rules('status_pesanan','Status Pesanan','required',
			array(	'required'	=> '%s harus diisi'));

		if($valid->run()===FALSE){
			// End Validasi
			$data = array(	'title'				=> 'Update Status Transaksi',
							'header_transaksi'	=> $header_transaksi,
							'transaksi'			=> $transaksi,
							'isi'				=> 'admin/transaksi/status'
					);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			// Masuk database
			$i = $this->input;
			$data = array(	'id_header_transaksi'	=> $header_transaksi->id_header_transaksi,
							'status_bayar'			=> $i->post('status_bayar'),
							'status_pesanan'		=> $i->post('status_pesanan')
						);
			$this->header_transaksi_model->edit($data);
			// KIRIM EMAIL DISINI
			$this->kirim_email($data, $header_transaksi->email);
			$this->session->set_flashdata('sukses', 'Status bayar telah di update');
			redirect(base_url('admin/transaksi'),'refresh');
		}
		// End masuk database	
	}

	// KIRIM EMAIL KETIKA ADMIN UPDATE STATUS
	private function kirim_email($data, $email_penerima)
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
	    $detail_transaksi = $this->header_transaksi_model->detail($data['id_header_transaksi']);
	    
    	$this->email->from($config['smtp_user']);
	    $this->email->to($email_penerima);
	    $this->email->subject("Pemberitahuan Transaksi");
	    $this->email->message(
	     'Status pesanan anda '.$data['status_pesanan'].'
	     <br><a href="'.base_url('dasbor/detail/').$detail_transaksi->kode_transaksi.'">Detail Pesanan</a>'
	    );
	    if($this->email->send()){
    		return true;
	    }else{
	    	return false;
	    }
	    return $this->email->send();
	}

	// Cetak
	public function cetak($kode_transaksi)
	{
		$header_transaksi 	= $this->header_transaksi_model->kode_transaksi($kode_transaksi);
		$transaksi 			= $this->transaksi_model->kode_transaksi($kode_transaksi);
		$site 				= $this->konfigurasi_model->listing();

		$data = array(	'title'				=> 'Riwayat Belanja',
						'header_transaksi'	=> $header_transaksi,
						'transaksi'			=> $transaksi,
						'site'				=> $site
					);
		$this->load->view('admin/transaksi/cetak', $data, FALSE);	
	}

	// Cetak pdf
	public function pdf($kode_transaksi)
	{
		$header_transaksi 	= $this->header_transaksi_model->kode_transaksi($kode_transaksi);
		$transaksi 			= $this->transaksi_model->kode_transaksi($kode_transaksi);
		$site 				= $this->konfigurasi_model->listing();

		$data = array(	'title'				=> 'Riwayat Belanja',
						'header_transaksi'	=> $header_transaksi,
						'transaksi'			=> $transaksi,
						'site'				=> $site
					);
		// $this->load->view('admin/transaksi/cetak', $data, FALSE);
		$html 	= $this->load->view('admin/transaksi/cetak', $data, true);
		$mpdf = new \Mpdf\Mpdf();
		// Write some HTML code:
		$mpdf->writeHTML($html);
		// Output a PDF file directly to the browser	
		$mpdf->output();
	}

	// Pengiriman
	public function kirim($kode_transaksi)
	{
		$header_transaksi 	= $this->header_transaksi_model->kode_transaksi($kode_transaksi);
		$transaksi 			= $this->transaksi_model->kode_transaksi($kode_transaksi);
		$site 				= $this->konfigurasi_model->listing();

		$data = array(	'title'				=> 'Riwayat Belanja',
						'header_transaksi'	=> $header_transaksi,
						'transaksi'			=> $transaksi,
						'site'				=> $site
					);
		// $this->load->view('admin/transaksi/kirim', $data, FALSE);
		$html 	= $this->load->view('admin/transaksi/kirim', $data, true);
		// load fungsi mdpf
		$mpdf = new \Mpdf\Mpdf();
		// SETTING HEADER DAN FOOTER
		$mpdf->SetHTMLHeader('
		<div style="text-align: left; font-weight: bold;">
			<img src="'.base_url('assets/upload/image/'.$site->logo).'" style="height: 50px; width=auto;">
		</div>');
		$mpdf->SetHTMLFooter('
			<div style="padding: 10px 20px; background-color: black; color: white; font-size: 12px;">
				Alamat: '.$site->namaweb.' ('.$site->alamat.')<br>
				Telepon: '.$site->telepon.'
			</div>
		');
		// END SETTING HEADER DAN FOOTER
		// Write some HTML code:
		$mpdf->writeHTML($html);
		// Output tampil dengan nama baru
		$nama_file_pdf = url_title($site->namaweb,'dash','true').'-'.$kode_transaksi.'.pdf';	
		$mpdf->output($nama_file_pdf,'I');
	}

	// Word
	public function word($kode_transaksi)
	{
		$header_transaksi 	= $this->header_transaksi_model->kode_transaksi($kode_transaksi);
		$transaksi 			= $this->transaksi_model->kode_transaksi($kode_transaksi);
		$site 				= $this->konfigurasi_model->listing();

		$data = array(	'title'				=> 'Riwayat Belanja',
						'header_transaksi'	=> $header_transaksi,
						'transaksi'			=> $transaksi,
						'site'				=> $site
					);
		// $this->load->view('admin/transaksi/cetak', $data, FALSE);
		$html 	= $this->load->view('admin/transaksi/word', $data, true);
		$mpdf = new \Mpdf\Mpdf();
		// Write some HTML code:
		$mpdf->writeHTML($html);
		// Output a PDF file directly to the browser	
		$mpdf->output();
	}
}

/* End of file Transaksi.php */
/* Location: ./application/controllers/admin/Transaksi.php */