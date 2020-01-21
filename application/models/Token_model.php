<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Token_model extends CI_Model {

	// Get Detail token dengan parameter token
	public function detail($token)
	{
		$this->db->select('*');
		$this->db->from('token');
		$this->db->where('token', $token);
		$this->db->order_by('id_token', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	// Tambah
	public function tambah($data)
	{
		$this->db->insert('token', $data);
		return $this->db->insert_id();
		// return mysql_insert_id();
	}

	// Edit
	public function edit($data)
	{
		$this->db->where('id_token', $data['id_token']);
		$this->db->update('token',$data);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id_token', $data['id_token']);
		$this->db->delete('token',$data);
	}
	

}

/* End of file Token_model.php */
/* Location: ./application/models/Token_model.php */