<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alamat_pelanggan_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Listing all alamat
	public function listing()
	{
		$this->db->select('*');
		$this->db->from('alamat_pelanggan');
		$this->db->order_by('id_alamat', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing all alamat berdasarkan pelanggan
	public function pelanggan($id_pelanggan)
	{
		$this->db->select('*');
		$this->db->from('alamat_pelanggan');
		$this->db->where('id_pelanggan', $id_pelanggan);
		$this->db->order_by('id_alamat', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	// Detail alamat
	public function detail($id_alamat)
	{
		$this->db->select('*');
		$this->db->from('alamat_pelanggan');
		$this->db->where('id_alamat', $id_alamat);
		$this->db->order_by('id_alamat', 'asc');
		$query = $this->db->get();
		return $query->row();
	}

	// Tambah
	public function tambah($data)
	{
		$this->db->insert('alamat_pelanggan', $data);
	}

	// Edit
	public function edit($data)
	{
		$this->db->where('id_alamat', $data['id_alamat']);
		$this->db->update('alamat_pelanggan',$data);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id_alamat', $data['id_alamat']);
		$this->db->delete('alamat_pelanggan',$data);
	}

}

/* End of file Alamat_pelanggan_model.php */
/* Location: ./application/models/Alamat_pelanggan_model.php */