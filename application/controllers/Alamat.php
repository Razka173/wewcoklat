<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alamat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('alamat_pelanggan_model');
		$this->load->model('pelanggan_model');
		// Halaman ini diproteksi dengan Simple_pelanggan => Check login
		$this->simple_pelanggan->cek_login();
	}

	private $api_key = 'b5a0ab01b23414040960f09cda563f55';

	public function index(){
		$data = array(	'title'		=> 'Keranjang Belanja',
						'isi'		=> 'alamat/list'
					);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Tambah Alamat
	public function tambah(){
		// Ambil data login id_pelanggan dari SESSION
		$id_pelanggan	= $this->session->userdata('id_pelanggan');
		$pelanggan 		= $this->pelanggan_model->detail($id_pelanggan);

		// Validasi input
		$valid = $this->form_validation;

		$valid->set_rules('id_province','Provinsi','required',
			array(	'required'		=> '%s harus diisi'));

		$valid->set_rules('id_kota','Kota / Kabupaten','required',
			array(	'required'		=> '%s harus diisi'));

		$valid->set_rules('alamat_detail','Detail Alamat','required',
			array(	'required'		=> '%s harus diisi'));

		$valid->set_rules('rt','RT','required',
			array(	'required'		=> '%s harus diisi'));

		$valid->set_rules('rw','RW','required',
			array(	'required'		=> '%s harus diisi'));

		$valid->set_rules('kode_pos','Kode Pos','required',
			array(	'required'		=> '%s harus diisi'));
		
		$valid->set_rules('alamat_label','Label Alamat','required',
			array(	'required'		=> '%s harus diisi'));

		$valid->set_rules('telepon','Telepon','required',
			array(	'required'		=> '%s harus diisi'));

		if($valid->run()===FALSE) {
			// End validasi
			$data = array(	'title' 	=> 'Tambah Data Alamat',
							'pelanggan'	=> $pelanggan,
							'isi'		=> 'dasbor/tambah_alamat'
						);
			$this->load->view('layout/wrapper', $data, FALSE);
		
		}else{
			// Masuk database
			$i = $this->input;
			$nama_provinsi 	= $this->detail_provinsi($i->post('id_province'));
			$nama_kota		= $this->detail_kota($i->post('id_kota'));
			$alamat_detail 	= $i->post('alamat_detail').' RT.'.$i->post('rt').' RW.'.$i->post('rw').' '.$nama_kota.', '.$nama_provinsi;
			$data = array(	'id_pelanggan'		=> $id_pelanggan,
							'id_provinsi'		=> $i->post('id_province'),
							'id_kota'			=> $i->post('id_kota'),
							'provinsi'			=> $nama_provinsi,
							'kota'				=> $nama_kota,
							'alamat_detail'		=> $alamat_detail,
							'alamat_label'		=> $i->post('alamat_label'),
							'telepon'			=> $i->post('telepon')
						);
			$this->alamat_pelanggan_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data alamat berhasil ditambah');
			redirect(base_url('dasbor/alamat'),'refresh');
		}
		// End masuk database
	}

	// Delete Alamat
	public function delete($id_alamat){
		// Ambil data login id_pelanggan dari SESSION
		$id_pelanggan		= $this->session->userdata('id_pelanggan');
		$alamat_pelanggan 	= $this->alamat_pelanggan_model->detail($id_alamat);
		
		// Pastikan bahwa pelanggan hanya mengakses data transaksinya
		if($alamat_pelanggan->id_pelanggan != $id_pelanggan) {
			$this->session->set_flashdata('warning', 'Anda mencoba mengakses data alamat orang lain');
			redirect(base_url('dasbor/alamat'));
		}
		// Proses hapus data rekening
		$data = array(	'id_alamat'	=> $id_alamat
					);
		$this->alamat_pelanggan_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data Alamat berhasil dihapus');
		redirect(base_url('dasbor/alamat'), 'refresh');
	}

	public function rajaongkir_get_provinsi($id=6)
	{	
		$curl = curl_init();
		curl_setopt_array($curl, array (
			CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array (
			"key: $this->api_key"
			),
			)
		);
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			// echo $response;
		}
		$obj = json_decode($response, true);
		// var_dump($obj);
        $select_prov = '<option value=0>- Pilih Provinsi -</option>';
        for($i=0; $i < count($obj['rajaongkir']['results']); $i++){
             $select_prov .= "<option value='".$obj['rajaongkir']['results'][$i]['province_id']."'>".$obj['rajaongkir']['results'][$i]['province']."</option>";
        }
        
        echo $select_prov;
	}

    function rajaongkir_get_kota($id=6){
        $id_province = $this->input->post('id_province',TRUE);
        if(!$id_province){
        	$id_province=$id; // 6 = DKI JAKARTA
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/city?&province=$id_province",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: $this->api_key"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          //echo $response;
        }
        $obj = json_decode($response, true);
        // var_dump($obj);
        $select_kotkab = '<option value=0>- Pilih Kota / Kabupaten -</option>';
        for($i=0; $i < count($obj['rajaongkir']['results']); $i++){
             $select_kotkab .= "<option value='".$obj['rajaongkir']['results'][$i]['city_id']."'>".$obj['rajaongkir']['results'][$i]['city_name']."</option>";
        }
        echo $select_kotkab;
    }
    
    function rajaongkir_get_cost(){
        $kota_asal      = 154;	// Jakarta Timur
        $tujuan 		= $this->input->post('kota_tujuan',TRUE);
        $berat          = '1000';
        $kurir 			= $this->input->post('kurir_pengiriman',TRUE);;

        //&courier=jne
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$kota_asal&originType=city&destination=$tujuan&destinationType=city&weight=$berat&courier=$kurir",
            CURLOPT_HTTPHEADER => array(
              "content-type: application/x-www-form-urlencoded",
              "key: $this->api_key"
            ),
          ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          //echo $response;
        }
        
        $obj = json_decode($response, true);
        
        $datas="";
        for($i=0; $i < count($obj['rajaongkir']['results']); $i++){
            $datas .= $obj['rajaongkir']['results'][$i]['name'];
            
            for($j=0; $j < count($obj['rajaongkir']['results'][$i]['costs']); $j++){
                
                $nama_pengiriman = $obj['rajaongkir']['results'][$i]['name'];
                $service         = $obj['rajaongkir']['results'][$i]['costs'][$j]['service'];
                $biaya           = $obj['rajaongkir']['results'][$i]['costs'][$j]['cost'][0]['value'];
                $biaya_format    = number_format($obj['rajaongkir']['results'][$i]['costs'][$j]['cost'][0]['value']);
            
                $datas .='<li id="serv-'.$service.'" onclick="klikongkir(\''.$nama_pengiriman.'\',\''.$service.'\',\''.$biaya.'\',\''.$biaya_format.'\')" class="list-group-item clearall-kurir" style="cursor:pointer;margin:1px;"><span style="color:black;font-weight:bold">'.$obj['rajaongkir']['results'][$i]['name'].' - '.$service.'</span> <br> <small><b style="color:red">Rp. '.number_format($obj['rajaongkir']['results'][$i]['costs'][$j]['cost'][0]['value']).'</b></small> / <small>Pengiriman : '.$obj['rajaongkir']['results'][$i]['costs'][$j]['cost'][0]['etd'].' hari</small></li>';

            }   
        }
        echo $datas;
    }

	function detail_provinsi($id_provinsi)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.rajaongkir.com/starter/province?id=$id_provinsi",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "key: $this->api_key"
		  ),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			// echo $response;
		}

		$obj = json_decode($response, true);
        $nama = $obj['rajaongkir']['results']['province'];
       	if($nama){
       		// echo $nama;
       		return $nama;
       	} else {
       		return '';
       	}
	}

	function detail_kota($id_kota)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=$id_kota",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "key: $this->api_key"
		  ),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  // echo $response;
		}
		$obj = json_decode($response, true);
        $nama = $obj['rajaongkir']['results']['city_name'];
        if($nama){
       		// echo $nama;
       		return $nama;
       	} else {
       		return '';
       	}
	}

}

/* End of file Pengiriman.php */
/* Location: ./application/controllers/Pengiriman.php */