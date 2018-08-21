<?php

class Employee_model extends CI_Model{

    function __construct(){
        
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }
    
    //insert registration details to registration table
    public function insertregistration($data){
        
        return $this->db->insert('registration',$data);
      
    }
	
	public function insertuserid()
	{
		
		$query1 = $this->db->get('registration');
		$query2 = $this->db->get('subjectmaster');
		//print_r($query1);
		//print_r($query2);
		$res1=$query1->result();
        foreach  ($res1 as $user_id) 
		{
         	$data1=array('user_Id'=>$user_id->user_id);  //'user_Id'-colname(inserting data)=>variablename->user_id-col()
      
        }
		//$this->db->insert('user_grade_subject',$data );
			 $data1_s = implode($data1);
			$res2=$query2->result();
			foreach ($res2 as $subid)
			{
				$data2=array('subid'=>$subid->subid);
				 $data2_s = implode($data2);
			   // $this->db->insert('user_grade_subject' , $data);
			   $this->db->query('INSERT INTO user_grade_subject (user_Id,subid) VALUES ('.$data1_s.','.$data2_s.')');
			}
		
	}
	public function insert_apidata_usergrade()
		{
			$query1 = $this->db->get('users');
			$query2 = $this->db->get('subjectmaster');
			//print_r($query1);
			//print_r($query2);
			$res1=$query1->result();
			foreach($res1 as $user_id) 
			{
				$data1=array('user_Id'=>$user_id->oauth_uid);  //'user_Id'-colname(inserting data)=>variablename->user_id-col()
		  
			}
			//$this->db->insert('user_grade_subject',$data );
				 $data1_s = implode($data1);
			  $res2=$query2->result();
			  foreach ($res2 as $subid)
			  {
				$data2=array('subid'=>$subid->subid);
				 $data2_s = implode($data2);
			   // $this->db->insert('user_grade_subject' , $data);
			   $this->db->query('INSERT INTO user_grade_subject (user_Id,subid) VALUES ('.$data1_s.','.$data2_s.')');
				
				}
		}
 
		public function loginUser($email, $password){
        //$this->db->where(array('username' = >$username, 'password' => $password));
        $query = $this->db->get_where('registration', array('email' => $email, 'password' => $password,'status'=> 1));   //status sholud be 1
        
        if($query->num_rows() == 1){
            
			
            $userArr = array();
            foreach($query->result() as $row){
                $userArr[0] = $row->user_id;
                $userArr[1] = $row->email;
                
            }
            $userData = array(
                'user_id' => $userArr[0],
                'logged_in'=> TRUE
            );
            $this->session->set_userdata($userData);
            
            return $query->result();
        }else{
            return false;
        }
    }
    
    
	 //check existing email
	public function check_exist_email($email)
	{
		
		$query = $this->db->get_where('registration', array('email' => $email,'status'=> 1));
		if($query->num_rows() == 1)
		{
			//echo $email;
			return true;
        }else{
            return false;
        }
	}
	public function reset_pass($email,$ram_pass)
	{
		$this->db->set('password',md5($ram_pass)); //value that used to update column  
		$this->db->where('email',$email); //which row want to upgrade  
		if($this->db->update('registration'))
		{
			return true;
		}
		else{
			return false;
		}
		
	}
	//send new password
	public function send_Pass_Email($receiver,$password)
	{
		
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From:quiz-no-reply@sarvashikshan.com'. "\r\n";
		//Multiple CC can be added, if we need (comma separated);
		//$headers .= 'Cc: shaileshmourya1995@gmail.com' . "\r\n";
		
		$subject = 'New Password';  //email subject
        $message = 'Your New Password is: '.$password;
		//echo $password;
		//$headers = "From: quiz-no-reply@sarvashikshan.com";
		
		 //config email settings
        /*$config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = $from;
        $config['smtp_pass'] = 'ecommercewebsite';  //sender's password
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = 'TRUE';
        $config['newline'] = "\r\n"; 
        
        $this->load->library('email', $config);
		$this->email->initialize($config);
        //send email
        $this->email->from($from);
        $this->email->to($receiver);
        $this->email->subject($subject);
        $this->email->message($message);
        
        if($this->email->send()){
			//for testing
            echo "Check your email";
            return true;
        }else{
            echo "email send failed";
            return false;
        }
		
		
		/* $from = "ecomwebv1@gmail.com";    //senders email address
        $subject = 'Verify email address';  //email subject*/
        if(mail($receiver,$subject,$message,$headers))
		{
			//for testing
           // echo "Check your email";
		   //echo $message;
            return true;
        }else{
            echo "email send failed";
            return false;
		}
		
	}
	//pmp access by admin
	//send new password
	
	
	
    //send confirm mail
    public function sendEmail($receiver){
       // $from = "ecomwebv1@gmail.com";    //senders email address
	   $headers = "From: quiz-no-reply@sarvashikshan.com";
        $subject = 'Verify email address';  //email subject
		
		$message = 'Dear User, Please click on the below activation link to verify your email address 
        http://www.sarvashikshan.com/quiz/index.php/Signup_Controller/confirmEmail/'. md5($receiver);
        if(mail($receiver,$subject,$message,$headers)){
			
            return true;
        }else{
           
            return false;
		}
        
       
        
    }
	
    
    //activate account
    function verifyEmail($key){
		
        $data = array('status' => 1);
        $this->db->where('md5(email)',$key);
        $this->db->update('registration', $data);
		return $data;
		//update status as 1 to make active user
    }
    
}

?>