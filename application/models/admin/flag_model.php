<?php 
class Flag_model extends CI_Model {
	
	public function __construct()
    {
        parent::__construct();
		
    }
    
	function get_flags()
	{
		$this->db->select('*');
		$this->db->from('flags');
		$query=$this->db->get();
		$res=$query->result();
		return $res;
	}
	
	function get_flag($id)
	{
		$this->db->select('*');
		$this->db->where('flag_id',$id);
		$this->db->from('flags');
		$query=$this->db->get();
		$res=$query->row();
		return $res;
	}
		
	function add($data)
	{
		$this->db->insert('flags',$data);
		return $this->db->insert_id();
	}
	
	function edit($data,$id)
	{
		$this->db->where('flag_id',$id);
		$this->db->update('flags',$data);
	}
	
	function delete($id)
	{
		$this->db->where('flag_id',$id);
		$this->db->delete('flags');
	}
	
	function is_unique_alia($alias)
	{
		$this->db->select('count(*) as num');
		$this->db->where('alias',trim($alias));
		$this->db->from('categories');
		$query=$this->db->get();
		$res=$query->row();
		if($res->num > 0) return false;
		else return true;
	}
 
}
?>
