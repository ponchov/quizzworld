<?php 

class Auth_model extends CI_Model {

	

	public function __construct()

    {

        parent::__construct();

		

    }

    

        

   function signin($data)

	{

		

		

		$username=$data['username'];

		$password=$data['password'];

		

		$this->db->select('*');

		$this->db->where('username',$username);

		$this->db->where('password',$password);

		$this->db->from('users');

		$query=$this->db->get();

		$res=$query->row();

		

		//print_r($res); exit;

		

		if($res)

		{

			

			$userdata['user_id']=$res->userid;

			$userdata['email']=$res->email;

			$userdata['username']=$res->username;

			$userdata['user_type']=$res->user_type;
			$userdata['access_language']=$res->access_language;

			$userdata['name']=$res->first_name." ".$res->last_name;

			

			$this->session->set_userdata($userdata);

			return true;



			

		}

		else

		{

			return false;

		}

	}

	

	

	

 

}

?>

