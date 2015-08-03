<?php 

class Banner_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

	function get_banners()
	{
		$this->db->select('*');
		$this->db->from('banners');
		$query=$this->db->get();
		$res=$query->result();
		return $res;
	}

	

	function get_banner($id)
	{
		$this->db->select('*');
		$this->db->where('banner_id',$id);
		$this->db->from('banners');
		$query=$this->db->get();
		$res=$query->row();
		return $res;

	}

		

	function add_banner($data)

	{
		$this->db->insert('banners',$data);
	}

	

	

	function edit_banner($data,$id)
	{
		$this->db->where('banner_id',$id);
		$this->db->update('banners',$data);
	}

	

	function delete_banner($id)
	{
		$this->db->where('banner_id',$id);
		$this->db->delete('banners');
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

