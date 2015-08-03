<?php 
class Contact_us_model extends CI_Model {
	
	public function __construct()
    {
        parent::__construct();
		
    }
    
	function save_contact_info($data)
	{
		$this->db->insert('contact_us_users',$data);
	}
    
}
?>