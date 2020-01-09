<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi extends CI_Controller {

	// LOAD MODEL
	public function __construct()
	{
		parent::__construct();
		$this->load->model('konfigurasi_model');
	}

	// Konfigurasi Umum
	public function index()
	{
		$konfigurasi 	= $this->konfigurasi_model->listing();

		// Validasi input
		$valid = $this->form_validation;

		$valid->set_rules('namaweb','Nama website','required',
			array(	'required'		=> '%s harus diisi'));

		if($valid->run()===FALSE) {
		// End validasi

		$data = array(	'title' 		=> 'Konfigurasi Website',
						'konfigurasi'	=>	$konfigurasi,
						'isi'			=> 'admin/konfigurasi/list'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		// Masuk database
		}else{
			$i 				= $this->input;
			$data = array(	'id_konfigurasi'		=> $konfigurasi->id_konfigurasi,
							'namaweb'				=> $i->post('namaweb'),
							'tagline'				=> $i->post('tagline'),
							'email'					=> $i->post('email'),
							'website'				=> $i->post('website'),
							'keywords'				=> $i->post('keywords'),
							'metatext'				=> $i->post('metatext'),
							'telepon'				=> $i->post('telepon'),
							'alamat'				=> $i->post('alamat'),
							'facebook'				=> $i->post('facebook'),
							'instagram'				=> $i->post('instagram'),
							'deskripsi'				=> $i->post('deskripsi'),
							'rekening_pembayaran'	=> $i->post('rekening_pembayaran')
						);
			$this->konfigurasi_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diupdate');
			redirect(base_url('admin/konfigurasi'),'refresh');
		}
		// End masuk database
	}

	// Konfigurasi Logo Website
	public function Logo()
	{
		$konfigurasi = $this->konfigurasi_model->listing();
		// Validasi input
		$valid 		= $this->form_validation;

		$valid->set_rules('namaweb','Nama Website','required',
			array(	'required'		=> '%s harus diisi'));
		
		if($valid->run()) {
			// Check jika gambar diganti
			if(!empty($_FILES['logo']['name'])) {
			$config['upload_path'] 		= './assets/upload/image/';
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config['max_size']  		= '2400';//Dalam KB
			$config['max_width']  		= '2024';
			$config['max_height']  		= '2024';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('logo')){
				
		// End validasi

		$data = array(	'title' 		=> 'Konfigurasi Logo Website',
						'konfigurasi'	=> $konfigurasi,
						'error'			=> $this->upload->display_errors(),
						'isi'			=> 'admin/konfigurasi/logo'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		// Masuk database
		}else{
			$upload_gambar = array('upload_data' => $this->upload->data());

			// Create thumbnail gambar
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
			// lokasi folder thumbnail
			$config['new_image']		= './assets/upload/image/thumbs/';
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 250;//Pixel
			$config['height']       	= 250;//Pixel
			$config['thumb_marker']		= '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			// End create thumbnail

			$i = $this->input;

			$data = array(	'id_konfigurasi'	=> $konfigurasi->id_konfigurasi,
							'namaweb'			=> $i->post('namaweb'),
							// Disimpan nama file gambar
							'logo'			=> $upload_gambar['upload_data']['file_name'],
						);
			$this->konfigurasi_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diupdate');
			redirect(base_url('admin/konfigurasi/logo'),'refresh');
		}}else{
			// Edit produk tanpa ganti gambar
			$i = $this->input;

			$data = array(	'id_konfigurasi'	=> $konfigurasi->id_konfigurasi,
							'namaweb'			=> $i->post('namaweb'),
							// Disimpan nama file gambar
							// 'logo'			=> $upload_gambar['upload_data']['file_name'],
						);
			$this->konfigurasi_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diupdate');
			redirect(base_url('admin/konfigurasi/logo'),'refresh');
		}}
		// End masuk database
		$data = array(	'title' 		=> 'Konfigurasi Logo Website',
						'konfigurasi'	=> $konfigurasi,
						'isi'			=> 'admin/konfigurasi/logo'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Konfigurasi Icon Website
	public function icon()
	{
		$konfigurasi = $this->konfigurasi_model->listing();
		// Validasi input
		$valid 		= $this->form_validation;

		$valid->set_rules('namaweb','Nama Website','required',
			array(	'required'		=> '%s harus diisi'));
		
		if($valid->run()) {
			// Check jika gambar diganti
			if(!empty($_FILES['icon']['name'])) {
			$config['upload_path'] 		= './assets/upload/image/';
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config['max_size']  		= '2400';//Dalam KB
			$config['max_width']  		= '2024';
			$config['max_height']  		= '2024';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('icon')){
				
		// End validasi

		$data = array(	'title' 		=> 'Konfigurasi Icon Website',
						'konfigurasi'	=> $konfigurasi,
						'error'			=> $this->upload->display_errors(),
						'isi'			=> 'admin/konfigurasi/icon'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		// Masuk database
		}else{
			$upload_gambar = array('upload_data' => $this->upload->data());

			// Create thumbnail gambar
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
			// lokasi folder thumbnail
			$config['new_image']		= './assets/upload/image/thumbs/';
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 250;//Pixel
			$config['height']       	= 250;//Pixel
			$config['thumb_marker']		= '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			// End create thumbnail

			$i = $this->input;

			$data = array(	'id_konfigurasi'	=> $konfigurasi->id_konfigurasi,
							'namaweb'			=> $i->post('namaweb'),
							// Disimpan nama file gambar
							'icon'			=> $upload_gambar['upload_data']['file_name'],
						);
			$this->konfigurasi_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diupdate');
			redirect(base_url('admin/konfigurasi/icon'),'refresh');
		}}else{
			// Edit produk tanpa ganti gambar
			$i = $this->input;

			$data = array(	'id_konfigurasi'	=> $konfigurasi->id_konfigurasi,
							'namaweb'			=> $i->post('namaweb'),
							// Disimpan nama file gambar
							// 'logo'			=> $upload_gambar['upload_data']['file_name'],
						);
			$this->konfigurasi_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diupdate');
			redirect(base_url('admin/konfigurasi/icon'),'refresh');
		}}
		// End masuk database
		$data = array(	'title' 		=> 'Konfigurasi Icon Website',
						'konfigurasi'	=> $konfigurasi,
						'isi'			=> 'admin/konfigurasi/icon'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Konfigurasi Slider Primary Website
	public function slider_primary()
	{
		$konfigurasi = $this->konfigurasi_model->listing();
		// Validasi input
		$valid 		= $this->form_validation;

		$valid->set_rules('slider_primary_header','Judul Slider','required',
			array(	'required'		=> '%s harus diisi'));
		
		if($valid->run()) {
			// Check jika gambar diganti
			if( ! empty($_FILES['slider_primary_gambar']['name']) ) {
			$config['upload_path'] 		= './assets/upload/image/';
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config['max_size']  		= '5000';//Dalam KB
			$config['max_width']  		= '5000';
			$config['max_height']  		= '5000';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('slider_primary_gambar')){
				
		// End validasi

		$data = array(	'title' 		=> 'Konfigurasi Slider 1 Website',
						'konfigurasi'	=> $konfigurasi,
						'error'			=> $this->upload->display_errors(),
						'isi'			=> 'admin/konfigurasi/slider_primary'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		// Masuk database
		}else{
			$upload_gambar = array('upload_data' => $this->upload->data());

			// Create thumbnail gambar
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
			// lokasi folder thumbnail
			$config['new_image']		= './assets/upload/image/thumbs/';
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 1250;//Pixel
			$config['height']       	= 1250;//Pixel
			$config['thumb_marker']		= '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			// End create thumbnail

			$i = $this->input;

			$data = array(	'id_konfigurasi'			=> $konfigurasi->id_konfigurasi,
							'slider_primary_header'		=> $i->post('slider_primary_header'),
							'slider_primary_deskripsi'	=> $i->post('slider_primary_deskripsi'),
							// Disimpan nama file gambar
							'slider_primary_gambar'		=> $upload_gambar['upload_data']['file_name'],
						);
			$this->konfigurasi_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diupdate');
			redirect(base_url('admin/konfigurasi/slider_primary'),'refresh');
		}}else{
			// Edit produk tanpa ganti gambar
			$i = $this->input;

			$data = array(	'id_konfigurasi'				=> $konfigurasi->id_konfigurasi,
							'slider_primary_header'			=> $i->post('slider_primary_header'),
							'slider_primary_deskripsi'		=> $i->post('slider_primary_deskripsi'),
							// Disimpan nama file gambar
							// 'logo'			=> $upload_gambar['upload_data']['file_name'],
						);
			$this->konfigurasi_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diupdate');
			redirect(base_url('admin/konfigurasi/slider_primary'),'refresh');
		}}
		// End masuk database
		$data = array(	'title' 		=> 'Konfigurasi Slider Website',
						'konfigurasi'	=> $konfigurasi,
						'isi'			=> 'admin/konfigurasi/slider_primary'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Konfigurasi Slider Other Website
	public function slider_other()
	{
		$konfigurasi = $this->konfigurasi_model->listing();
		// Validasi input
		$valid 		= $this->form_validation;

		$valid->set_rules('slider_other_header','Judul Slider','required',
			array(	'required'		=> '%s harus diisi'));
		
		if($valid->run()) {
			// Check jika gambar diganti
			if( ! empty($_FILES['slider_other_gambar']['name']) ) {
			$config['upload_path'] 		= './assets/upload/image/';
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config['max_size']  		= '5000';//Dalam KB
			$config['max_width']  		= '5000';
			$config['max_height']  		= '5000';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('slider_other_gambar')){
				
		// End validasi

		$data = array(	'title' 		=> 'Konfigurasi Slider 3 Website',
						'konfigurasi'	=> $konfigurasi,
						'error'			=> $this->upload->display_errors(),
						'isi'			=> 'admin/konfigurasi/slider_other'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		// Masuk database
		}else{
			$upload_gambar = array('upload_data' => $this->upload->data());

			// Create thumbnail gambar
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
			// lokasi folder thumbnail
			$config['new_image']		= './assets/upload/image/thumbs/';
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 1250;//Pixel
			$config['height']       	= 1250;//Pixel
			$config['thumb_marker']		= '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			// End create thumbnail

			$i = $this->input;

			$data = array(	'id_konfigurasi'			=> $konfigurasi->id_konfigurasi,
							'slider_other_header'		=> $i->post('slider_other_header'),
							'slider_other_deskripsi'	=> $i->post('slider_other_deskripsi'),
							// Disimpan nama file gambar
							'slider_other_gambar'		=> $upload_gambar['upload_data']['file_name'],
						);
			$this->konfigurasi_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diupdate');
			redirect(base_url('admin/konfigurasi/slider_other'),'refresh');
		}}else{
			// Edit produk tanpa ganti gambar
			$i = $this->input;

			$data = array(	'id_konfigurasi'				=> $konfigurasi->id_konfigurasi,
							'slider_other_header'			=> $i->post('slider_other_header'),
							'slider_other_deskripsi'		=> $i->post('slider_other_deskripsi'),
							// Disimpan nama file gambar
							// 'logo'			=> $upload_gambar['upload_data']['file_name'],
						);
			$this->konfigurasi_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diupdate');
			redirect(base_url('admin/konfigurasi/slider_other'),'refresh');
		}}
		// End masuk database
		$data = array(	'title' 		=> 'Konfigurasi Slider Website',
						'konfigurasi'	=> $konfigurasi,
						'isi'			=> 'admin/konfigurasi/slider_other'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Konfigurasi Slider Secondary Website
	public function slider_secondary()
	{
		$konfigurasi = $this->konfigurasi_model->listing();
		// Validasi input
		$valid 		= $this->form_validation;

		$valid->set_rules('slider_secondary_header','Judul Slider','required',
			array(	'required'		=> '%s harus diisi'));
		
		if($valid->run()) {
			// Check jika gambar diganti
			if( ! empty($_FILES['slider_secondary_gambar']['name']) ) {
			$config['upload_path'] 		= './assets/upload/image/';
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config['max_size']  		= '5000';//Dalam KB
			$config['max_width']  		= '5000';
			$config['max_height']  		= '5000';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('slider_secondary_gambar')){
				
		// End validasi

		$data = array(	'title' 		=> 'Konfigurasi Slider 2 Website',
						'konfigurasi'	=> $konfigurasi,
						'error'			=> $this->upload->display_errors(),
						'isi'			=> 'admin/konfigurasi/slider_secondary'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		// Masuk database
		}else{
			$upload_gambar = array('upload_data' => $this->upload->data());

			// Create thumbnail gambar
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
			// lokasi folder thumbnail
			$config['new_image']		= './assets/upload/image/thumbs/';
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 1250;//Pixel
			$config['height']       	= 1250;//Pixel
			$config['thumb_marker']		= '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			// End create thumbnail

			$i = $this->input;

			$data = array(	'id_konfigurasi'			=> $konfigurasi->id_konfigurasi,
							'slider_secondary_header'		=> $i->post('slider_secondary_header'),
							'slider_secondary_deskripsi'	=> $i->post('slider_secondary_deskripsi'),
							// Disimpan nama file gambar
							'slider_secondary_gambar'		=> $upload_gambar['upload_data']['file_name'],
						);
			$this->konfigurasi_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diupdate');
			redirect(base_url('admin/konfigurasi/slider_secondary'),'refresh');
		}}else{
			// Edit produk tanpa ganti gambar
			$i = $this->input;

			$data = array(	'id_konfigurasi'				=> $konfigurasi->id_konfigurasi,
							'slider_secondary_header'		=> $i->post('slider_secondary_header'),
							'slider_secondary_deskripsi'	=> $i->post('slider_secondary_deskripsi'),
							// Disimpan nama file gambar
							// 'logo'			=> $upload_gambar['upload_data']['file_name'],
						);
			$this->konfigurasi_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diupdate');
			redirect(base_url('admin/konfigurasi/slider_secondary'),'refresh');
		}}
		// End masuk database
		$data = array(	'title' 		=> 'Konfigurasi Slider Website',
						'konfigurasi'	=> $konfigurasi,
						'isi'			=> 'admin/konfigurasi/slider_secondary'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

}

/* End of file Konfigurasi.php */
/* Location: ./application/controllers/admin/Konfigurasi.php */