<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facebook extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load facebook library
        $this->load->library('facebook_login');
        
        //Load user model
        $this->load->model('facebook_user');
        $this->load->model('pelanggan_model');

        // Load Library
        $this->load->library('simple_pelanggan');
    }
    
    public function index()
    {
        // Redirect to profile page if the user already logged in
        if( $this->session->userdata('email') ){
            redirect(base_url('dasbor'));
        }

        $userData = array();
        
        // Check if user is logged in
        if ( $this->facebook_login->is_authenticated() ){
            // Get user facebook profile details
            $fbUser = $this->facebook_login->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture');

            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid']      = !empty($fbUser['id'])?$fbUser['id']:'';;
            $userData['nama_pelanggan'] = !empty($fbUser['first_name'])?$fbUser['first_name']:'';
            $userData['nama_pelanggan'] .= !empty($fbUser['last_name'])?$fbUser['last_name']:'';
            $userData['email']          = !empty($fbUser['email'])?$fbUser['email']:'';
            $userData['gender']         = !empty($fbUser['gender'])?$fbUser['gender']:'';
            $userData['foto']           = !empty($fbUser['picture']['data']['url'])?$fbUser['picture']['data']['url']:'';
            $userData['alamat']         = !empty($fbUser['link'])?$fbUser['link']:'';
            
            // Insert or update user data
            $userID = $this->facebook_user->checkUser($userData);
            if($userID==false){
                $this->session->set_flashdata('warning', 'Email sudah terdaftar.');
                redirect(base_url('masuk'),'refresh');
            }
            
            // Check user data insert or update status
            if( !empty($userID) ){
                $data['userData'] = $userData;
                // $this->session->set_userdata('userData', $userData);
                $this->simple_pelanggan->login($fbUser['email']);
            }else{
               $data['userData'] = array();
            }
            
            // Get logout URL
            $data['logoutURL'] = $this->facebook_login->logout_url();
        } else {
            // Get login URL
            $data['authURL'] =  $this->facebook_login->login_url();
        }
        
        // Load login & profile view
        $this->load->view('facebook/list',$data);
        // redirect(base_url('facebook'),'refresh');
    }

    public function logout() {
        // Remove local Facebook session
        $this->facebook->destroy_session();
        // Remove user data from session
        $this->session->unset_userdata('userData');
        // Redirect to login page
        redirect(base_url('masuk'),'refresh');
    }
}