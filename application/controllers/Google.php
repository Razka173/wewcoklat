<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Google extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// Load google oauth library
        $this->load->library('googleplus');
        
        // Load user model
        $this->load->model('google_user');
        $this->load->model('pelanggan_model');

        // Load Library
        $this->load->library('simple_pelanggan');
	}

	public function index()
	{
		// Redirect to profile page if the user already logged in
        if($this->session->userdata('email')){
            redirect(base_url('dasbor'));
        }
        
        if(isset($_GET['code'])){
            
            // Authenticate user with google
            if($this->googleplus->getAuthenticate()){
            
                // Get user info from google
                $gpInfo = $this->googleplus->getUserInfo();
                
                // Preparing data for database insertion
                $userData['oauth_provider']     = 'google';
                $userData['oauth_uid']          = $gpInfo['id'];
                $userData['nama_pelanggan']     = $gpInfo['given_name'];
                // $userData['last_name']      = !empty($gpInfo['family_name'])?$gpInfo['family_name']:$gpInfo['given_name'];
                $userData['email']              = $gpInfo['email'];
                $userData['gender']             = !empty($gpInfo['gender'])?$gpInfo['gender']:'';
                // $userData['locale']         = !empty($gpInfo['locale'])?$gpInfo['locale']:'';
                // $userData['link']           = !empty($gpInfo['link'])?$gpInfo['link']:'';
                $userData['foto']               = !empty($gpInfo['picture'])?$gpInfo['picture']:'';
                
                // Insert or update user data to the database
                $userID = $this->google_user->checkUser($userData);
                
                // Store the status and user profile info into session
                // $this->session->set_userdata('loggedIn', true);
                // $this->session->set_userdata('userData', $userData);
                $password="";
                $this->simple_pelanggan->login($gpInfo['email'], $password);
                
                // Redirect to profile page
                redirect(base_url());
            }
		} 
        
        // Google authentication url
        $data['loginURL'] = $this->googleplus->loginURL();
        
        // Load google login view
        $this->load->view('google/list',$data);
	}

    public function profile(){
        // Redirect to login page if the user not logged in
        if(!$this->session->userdata('loggedIn')){
            redirect(base_url('google/'));
        }
        
        // Get user info from session
        $data['userData'] = $this->session->userdata('userData');
        
        // Load user profile view
        $this->load->view('google/profile',$data);
    }
    
    public function logout(){
        // Reset OAuth access token
        $this->googleplus->revokeToken();
        
        // Remove token and user data from the session
        $this->session->unset_userdata('loggedIn');
        $this->session->unset_userdata('userData');
        
        // Destroy entire session data
        $this->session->sess_destroy();
        
        // Redirect to login page
        redirect(base_url('google'));
    }

}

/* End of file Google.php */
/* Location: ./application/controllers/Google.php */