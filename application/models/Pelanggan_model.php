<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Listing all pelanggan
	public function listing()
	{
		$this->db->select('*');
		$this->db->from('pelanggan');
		$this->db->order_by('id_pelanggan', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	// Cek Email di dalam database dengan rinci
	public function cek_email($email, $status_pelanggan)
	{
		$this->db->select('email');
		$this->db->from('pelanggan');
		$this->db->where(array( 'email'	=> $email,
								'status_pelanggan' => $status_pelanggan));
		$this->db->order_by('id_pelanggan', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	// Cek Email di dalam database
	public function is_email_set($email)
	{
		$this->db->select('email');
		$this->db->from('pelanggan');
		$this->db->where(array( 'email'	=> $email));
		$this->db->order_by('id_pelanggan', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	// Login pelanggan
	public function login($email, $password)
	{
		$this->db->select('*');
		$this->db->from('pelanggan');
		$this->db->where(array( 'email' 	=> $email,
								'password'	=> SHA1($password)
							));
		$this->db->order_by('id_pelanggan', 'asc');
		$query = $this->db->get();
		return $query->row();
	}

	// Login pelanggan via google
	public function login_google($email)
	{
		$this->db->select('*');
		$this->db->from('pelanggan');
		$this->db->where(array( 'email' 			=> $email,
								'oauth_provider'	=> 'google'	
							));
		$this->db->order_by('id_pelanggan', 'asc');
		$query = $this->db->get();
		return $query->row();
	}

	// Login pelanggan via facebook
	public function login_facebook($email)
	{
		$this->db->select('*');
		$this->db->from('pelanggan');
		$this->db->where(array( 'email' 			=> $email,
								'oauth_provider'	=> 'facebook'	
							));
		$this->db->order_by('id_pelanggan', 'asc');
		$query = $this->db->get();
		return $query->row();
	}

	// Get Detail pelanggan by ID_PELANGGAN
	public function detail($id_pelanggan)
	{
		$this->db->select('*');
		$this->db->from('pelanggan');
		$this->db->where('id_pelanggan', $id_pelanggan);
		$this->db->order_by('id_pelanggan', 'asc');
		$query = $this->db->get();
		return $query->row();
	}

	// Pelanggan sudah login
	public function sudah_login($email, $nama_pelanggan)
	{
		$this->db->select('*');
		$this->db->from('pelanggan');
		$this->db->where('email', $email);
		$this->db->where('nama_pelanggan', $nama_pelanggan);
		$this->db->order_by('id_pelanggan', 'asc');
		$query = $this->db->get();
		return $query->row();
	}

	// Tambah
	public function tambah($data)
	{
		$this->db->insert('pelanggan', $data);
		return $this->db->insert_id();
		// return mysql_insert_id();
	}

	// Edit
	public function edit($data)
	{
		$this->db->where('id_pelanggan', $data['id_pelanggan']);
		$this->db->update('pelanggan',$data);
	}

	// Edit
	public function edit_by_email($data)
	{
		$this->db->where('email', $data['email']);
		$this->db->update('pelanggan',$data);
	}


	// Delete
	public function delete($data)
	{
		$this->db->where('id_pelanggan', $data['id_pelanggan']);
		$this->db->delete('pelanggan',$data);
	}

	// Ganti status pelanggan
	public function ganti_status($key)
	{
		$data = array(
						'status_pelanggan'	=> 'Member'
					);

		$this->db->where('md5(id_pelanggan)', $key);
		$this->db->update('pelanggan', $data);
	}
}

/* End of file Pelanggan_model.php */
/* Location: ./application/models/Pelanggan_model.php */