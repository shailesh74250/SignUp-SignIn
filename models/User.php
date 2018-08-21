<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Model{
	function __construct() {
		$this->tableName = 'users';
		$this->primaryKey = 'id';
	}
	public function checkUser($data = array()){
		$this->db->select($this->primaryKey);
		$this->db->from($this->tableName);
		$this->db->where(array('oauth_provider'=>$data['oauth_provider'],'oauth_uid'=>$data['oauth_uid']));
		$prevQuery = $this->db->get();
		$prevCheck = $prevQuery->num_rows();
		
		if($prevCheck > 0){
			$prevResult = $prevQuery->row_array();
			$data['modified'] = date("Y-m-d H:i:s");
			$update = $this->db->update($this->tableName,$data,array('id'=>$prevResult['id']));
			$userID = $prevResult['id'];
		}else{
			$data['created'] = date("Y-m-d H:i:s");
			$data['modified'] = date("Y-m-d H:i:s");
			$insert = $this->db->insert($this->tableName,$data);
			$userID = $this->db->insert_id();
			
			echo "inser again";
			
			//insert into user_grade_subject
			$query1 = $this->db->get('users');
			
			//print_r($query1);
			//print_r($query2);
			$res1=$query1->result();
			foreach($res1 as $user_id) 
			{
				$data1=array('user_Id'=>$user_id->oauth_uid);  //'user_Id'-colname(inserting data)=>variablename->user_id-col()
		  
			}
			print_r($data1);
			//$this->db->insert('user_grade_subject',$data );
			 $data1_s = implode($data1);
			 echo $data1_s;
			  $res2=$query2->result();
			  foreach ($res2 as $subid)
			  {
				$data2=array('subid'=>$subid->subid);
				 $data2_s = implode($data2);
			   // $this->db->insert('user_grade_subject' , $data);
			   $this->db->query('INSERT INTO user_grade_subject (user_Id,subid) VALUES ('.$data1_s.','.$data2_s.')');
				
				}
		}

		return $userID?$userID:FALSE;
    }
}
