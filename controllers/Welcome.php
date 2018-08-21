<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//by default welcome class going to be execute by index.php
class Welcome extends CI_Controller {

	//$cookie_name = "user";
	//	$cookie_value = "Ganesh_Watve";
 public function __construct(){
        parent::__construct();
        //load helper
        $this->load->helper('form');
		//load library 
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Employee_model'); 
	    //login linkedin and facebook librabry
		$this->load->config('linkedin');
		$this->load->library('facebook');
		//Load user model
		$this->load->model('User');
		$this->load->library('email');
		
       
	}
	//bydefault index function trigger
    public function index()
	{
		$this->load->view('signin-signup');
	}
   	
	public function Fb_Login()
	{
		//fb
		
		// Check if user is logged in
		if($this->facebook->getUser()){
			// Get user facebook profile details
			$userProfile = $this->facebook->request('get','/me?fields=id,first_name,last_name,email,gender,locale,picture');

            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid'] = $userProfile['id'];
            $userData['first_name'] = $userProfile['first_name'];
            $userData['last_name'] = $userProfile['last_name'];
            //$userData['email'] = $userProfile['email'];
			$userData['email']=isset($userProfile['email']) ? $userProfile['email']: null;
          //  $userData['gender'] = $userProfile['gender'];
           // $userData['locale'] = $userProfile['locale'];
           // $userData['profile_url'] = 'https://www.facebook.com/'.$userProfile['id'];
           // $userData['picture_url'] = $userProfile['picture']['data']['url'];
			
            // Insert or update user data
            $userID = $this->User->checkUser($userData);
			
			// Check user data insert or update status
            if(!empty($userID)){
                $data['userData'] = $userData;
                $this->session->set_userdata('userData',$userData);
            } else {
               $data['userData'] = array();
            }
			
			// Get logout URL
			$data['logoutUrl'] = $this->facebook->getLogoutUrl();
		}else{
            $fbuser = '';
			
			// Get login URL
            $data['authUrlab'] =  $this->facebook->getLoginUrl();
			redirect($data['authUrlab']);
			
        }
      
        if(!empty($userData))
			{
				$_SESSION['u_name'] = $userData['first_name'];
				$_SESSION['u_id'] = $userData['oauth_uid'];
				
				$data['id_value'] = "Welcome: ".$userData['first_name']." ".$userData['last_name'];
				$data['msg'] = "You have login Successfully through facebook!";
				$this->load->view('show-user-data-after-singin.php', $data); 
			}
			else 
			{
				$this->load->view('signin-signup'); 
			}
	}	
	//signup
	public function Signup(){
        
        $this->form_validation->set_rules('txt_email','Email','trim|required|valid_email|is_unique[registration.email]');
      
        $this->form_validation->set_rules('txt_password','Password', 'required|min_length[6]|max_length[25]');
        
        
        if($this->form_validation->run() == false){
            $this->index();
            
        }else{
            //call db
            $data = array(
               
                'email' => $this->input->post('txt_email'),
                'password' => md5($this->input->post('txt_password')),
                'status' => '1'
            );
            if($this->Employee_model->insertregistration($data)){
            	 
            	 $this->session->set_flashdata('registration_success', '<div class="alert alert-success text-center">Successfully registered. Now you can login</div>');
            	 $this->index();
               
            }
        }
    }
	
	
	//signin logic	
    public function Signin(){
        
		$this->form_validation->set_rules('username','Username', 'trim|required');
        $this->form_validation->set_rules('password','Password', 'trim|required');
        if($this->form_validation->run() == false){
            $this->index();
        }else{
           
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            
            if($this->Employee_model->loginUser($username, $password)){
                
                $userInfo = $this->Employee_model->loginUser($username, $password);
                
                foreach($userInfo as $udata){
					$userId=$udata->user_id;
					$email = $udata->email; 	
				}
				$_SESSION['u_id']=$userId;
				$data['msg'] = "Login Successfully";
				$data['id_value'] = 'Welcome:  '.$email;
                $this->session->set_flashdata('login_successs', '<div class="alert alert-success text-center">Successfully logged in</div>');
				$this->load->view('show-user-data-after-singin', $data); 
			}else{
                $this->session->set_flashdata('login_failed', '<div class="alert alert-danger text-center">Login Failed!! Please try again.</div>');
  				$this->load->view('signin-signup');
				
		    }
        }
    }
   
	
	//logout button
	public function Logout() {
		//Unset token and user data from session
		$this->session->unset_userdata('oauth_status');
		$this->session->unset_userdata('token');
		$this->session->unset_userdata('userData');
		$this->facebook->destroy_session();
		//Destroy entire session
		$this->session->sess_destroy();
		// Redirect to login page
        $this->index();
    }
}

