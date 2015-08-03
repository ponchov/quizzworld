<?php 

class Category_model extends CI_Model {

	

	public function __construct()

    {

        parent::__construct();

		

    }

    

	function get_categories($lang_code)

	{

		$this->db->select('*');

		$this->db->where('lang_code',$lang_code);

		$this->db->from('categories');

		$query=$this->db->get();

		$res=$query->result();

		return $res;

	}

	

	function get_category($id)

	{

		$this->db->select('*');

		$this->db->where('category_id',$id);

		$this->db->from('categories');

		$query=$this->db->get();

		$res=$query->row();

		return $res;

	}

		

	function add_category($data)

	{

		$this->db->insert('categories',$data);

		return $this->db->insert_id();

	}

	

	function edit_category($data,$id)

	{

		$this->db->where('category_id',$id);

		$this->db->update('categories',$data);

	}

	

	function delete_category($id)

	{

		$this->db->where('category_id',$id);

		$this->db->delete('categories');

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

	

	function get_languages()

	{

		$this->db->select('*');

		$this->db->where('status',1);

		$this->db->from('languages');

		$query=$this->db->get();

		$res=$query->result();

		return $res;

	}

	

	function get_category_content($categoryid,$lang_code)

	{

		$this->db->select('*');

		$this->db->where('categoryid',$categoryid);

		$this->db->where('lang_code',$lang_code);

		$this->db->from('categories');

		$query=$this->db->get();

		$res=$query->row();

		return $res;

	}

	

	function update_category_content($data,$categoryid,$lang_code)

	{

		$this->db->where('categoryid',$categoryid);

		$this->db->where('lang_code',$lang_code);

		$this->db->update('categories',$data);

		

	}

	

 

}

?>

