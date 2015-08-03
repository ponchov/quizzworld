<?php 
class Contact_user_model extends CI_Model {
	
	public function __construct()
    {
        parent::__construct();
		
    }
    
	function get_contact_users()
	{
		$this->db->select('*');
		$this->db->from('contact_us_users');
		$query=$this->db->get();
		$res=$query->result();
		return $res;
	}
	
	function get_contact_user($id)
	{
		$this->db->select('*');
		$this->db->where('contact_us_user_id',$id);
		$this->db->from('contact_us_users');
		$query=$this->db->get();
		$res=$query->row();
		return $res;
	}
		
	
	function edit_contact_user($data,$id)
	{
		$this->db->where('contact_us_user_id',$id);
		$this->db->update('contact_us_users',$data);
	}
	
	function delete_contact_user($id)
	{
		$this->db->where('contact_us_user_id',$id);
		$this->db->delete('contact_us_users');
	}
	
 
}
?>
