<?php 
class Language_model extends CI_Model {
	
	public function __construct()
    {
        parent::__construct();
		
    }
    
	function get_languages()
	{
		$this->db->select('*');
		$this->db->from('languages');
		$query=$this->db->get();
		$res=$query->result();
		return $res;
	}
	
	function get_language($id)
	{
		$this->db->select('*');
		$this->db->where('language_id',$id);
		$this->db->from('languages');
		$query=$this->db->get();
		$res=$query->row();
		return $res;
	}
		
	function add($data)
	{
		$this->db->insert('languages',$data);
		//return $this->db->insert_id();
	}
	
	function edit($data,$id)
	{
		$this->db->where('language_id',$id);
		$this->db->update('languages',$data);
	}
	
	function delete($id)
	{
		$this->db->where('language_id',$id);
		$this->db->delete('languages');
	}
	
 
}
?>
