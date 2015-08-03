<?php 

class User_model extends CI_Model {

	

	public function __construct()

    {

        parent::__construct();

		

    }

    

	

	function get_users()

	{

		$this->db->select('*');

		$this->db->from('users');

		$this->db->order_by('userid','desc');

		$query=$this->db->get();

		$res=$query->result();

		return $res;

	}

	

	function get_user($id)

	{

		$this->db->select('*');

		$this->db->where('userid',$id);

		$this->db->from('users');

		$query=$this->db->get();

		$res=$query->row();

		return $res;

	}

		

	function add_user($data)

	{

		$this->db->insert('users',$data);

		

	}

	

	

	function edit_user($data,$id)

	{

		$this->db->where('userid',$id);

		$this->db->update('users',$data);

	}

	

	function delete_user($id)

	{

		$this->db->where('userid',$id);

		$this->db->delete('users');

	}
	
	function get_languages()
	{
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->from('languages');
		$query=$this->db->get();
		$res=$query->result();
		return $res;
	}

	

 

}

?>

