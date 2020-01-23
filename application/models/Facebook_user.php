<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facebook_user extends CI_Model {

    function __construct() {
        $this->tableName = 'pelanggan';
        $this->primaryKey = 'id_pelanggan';
    }
    
    public function checkUser($userData = array()){
        if(!empty($userData)){
            //check whether user data already exists in database with same oauth info
            $this->db->select($this->primaryKey);
            $this->db->from($this->tableName);
            
            $this->db->where(array('oauth_provider'=>$userData['oauth_provider'], 'oauth_uid'=>$userData['oauth_uid']));
            $prevQuery = $this->db->get();
            $prevCheck = $prevQuery->num_rows();
            
            if($prevCheck > 0){
                $prevResult = $prevQuery->row_array();
                
                //update user data
                $userData['tanggal_update'] = date("Y-m-d H:i:s");
                $update = $this->db->update($this->tableName, $userData, array('id_pelanggan' => $prevResult['id_pelanggan']));
                
                //get user ID
                $userID = $prevResult['id_pelanggan'];
            }else{
                // Jika pelanggan sudah daftar di website tanpa menggunakan google login
                if($this->checkEmail($userData['email']) == true){
                    return false;
                }

                //insert user data
                $userData['status_pelanggan']   = 'Member';
                $userData['status_reseller']    = 'Tidak';
                $userData['tanggal_daftar']  = date("Y-m-d H:i:s");
                $userData['tanggal_update'] = date("Y-m-d H:i:s");
                $insert = $this->db->insert($this->tableName, $userData);
                
                //get user ID
                $userID = $this->db->insert_id();
            }
        }
        
        //return user ID
        return $userID?$userID:FALSE;
    }

    // Check If Email Exist
    public function checkEmail($email){
        $this->db->select('*');
        $this->db->from('pelanggan');
        $this->db->where('email', $email);
        $this->db->order_by('id_pelanggan', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
}