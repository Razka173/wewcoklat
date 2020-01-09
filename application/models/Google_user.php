<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Google_user extends CI_Model {
    
    function __construct() {
        $this->tableName = 'pelanggan';
        $this->primaryKey = 'id_pelanggan';
    }
    
    public function checkUser($data = array()){
        $this->db->select($this->primaryKey);
        $this->db->from($this->tableName);
        
        $con = array(
            'oauth_provider' => $data['oauth_provider'],
            'oauth_uid' => $data['oauth_uid']
        );
        $this->db->where($con);
        
        $query = $this->db->get();
        
        $check = $query->num_rows();
        
        if($check > 0){
            // Get prev user data
            $result = $query->row_array();
            
            // Update user data
            $data['tanggal_update'] = date("Y-m-d H:i:s");
            $update = $this->db->update($this->tableName, $data, array('id_pelanggan'=>$result['id_pelanggan']));
            
            // user id
            $userID = $result['id_pelanggan'];
        }else{
            // Insert user data
            $data['tanggal_daftar'] = date("Y-m-d H:i:s");
            $data['tanggal_update'] = date("Y-m-d H:i:s");
            $insert = $this->db->insert($this->tableName, $data);
            
            // user id
            $userID = $this->db->insert_id();
        }
        
        // Return user id
        return $userID?$userID:false;
    }

}