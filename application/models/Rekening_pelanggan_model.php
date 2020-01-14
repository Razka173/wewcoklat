<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening_pelanggan_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Listing all rekening
	public function listing()
	{
		$this->db->select('*');
		$this->db->from('rekening_pelanggan');
		$this->db->order_by('id_rekening', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing all rekening berdasarkan pelanggan
	public function pelanggan($id_pelanggan)
	{
		$this->db->select('*');
		$this->db->from('rekening_pelanggan');
		$this->db->where('id_pelanggan', $id_pelanggan);
		$this->db->order_by('id_rekening', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	// Detail rekening
	public function detail($id_rekening)
	{
		$this->db->select('*');
		$this->db->from('rekening_pelanggan');
		$this->db->where('id_rekening', $id_rekening);
		$this->db->order_by('id_rekening', 'asc');
		$query = $this->db->get();
		return $query->row();
	}

	// Tambah
	public function tambah($data)
	{
		$this->db->insert('rekening_pelanggan', $data);
	}

	// Edit
	public function edit($data)
	{
		$this->db->where('id_rekening', $data['id_rekening']);
		$this->db->update('rekening_pelanggan',$data);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id_rekening', $data['id_rekening']);
		$this->db->delete('rekening_pelanggan',$data);
	}
}

/* End of file Rekening_pelanggan_model.php */
/* Location: ./application/models/Rekening_pelanggan_model.php */