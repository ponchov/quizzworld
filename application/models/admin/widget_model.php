<?php 

class Widget_model extends CI_Model {

	

	public function __construct()

    {

        parent::__construct();

		

    }

    

	function get_widgets($lang='en')
	{
		$this->db->select('*');
		$this->db->where('lang_code',$lang);
		$this->db->from('widgets');
		$query=$this->db->get();
		$res=$query->result();
		return $res;
	}
	
	
	
	function get_widget($widget_id)
	{
		$this->db->select('*');
		$this->db->where('widget_id',$widget_id);
		$this->db->from('widgets');
		$query=$this->db->get();
		$res=$query->row();
		return $res;
	}
	
	function widget_content($widgetid,$lang_code)
	{
		$this->db->select('*');
		$this->db->where('widgetid',$widgetid);
		$this->db->where('lang_code',$lang_code);
		$this->db->from('widgets');
		$query=$this->db->get();
		$res=$query->row();
		if(!$res)
		{
			$res=new stdClass();
			$res->widget_id=0;
			$res->widgetid=0;
			$res->title='';
			$res->lang_code=$lang_code;
			$res->columns='0';
			$res->rows='0';
			$res->items='';
			$res->test_ids='';
			$res->is_override='0';
			$res->include_templates='0';
			$res->have_external_links='0';
			$res->have_direct_link='0';
			$res->status='1';
			
		}
		return $res;
	}
	
	function purple_widget_content($purple_widgetid,$lang_code)
	{
		$this->db->select('*');
		$this->db->where('purple_widgetid',$purple_widgetid);
		$this->db->where('lang_code',$lang_code);
		$this->db->from('purple_widgets');
		$query=$this->db->get();
		$res=$query->row();
		if(!$res)
		{
			$res=new stdClass();
			$res->purple_widget_id=0;
			$res->purple_widgetid=0;			
			$res->lang_code=$lang_code;
			$res->test_type='';
			$res->title='';
			$res->template='';
			$res->specific_test_id='';
			$res->url='';
			$res->title='';
			$res->image='';
			$res->status='';
			
			
		}
		return $res;
	}
	
	
	function save($data,$widget_id)
	{
		$this->db->where('widget_id',$widget_id);
		$this->db->update('widgets',$data);
	}
	
	function update_widget($data,$widgetid,$lang)
	{
		if($this->has_widget($widgetid,$lang))
		{
			$this->db->where('widgetid',$widgetid);
			$this->db->where('lang_code',$lang);
			$this->db->update('widgets',$data);
		}
		else
		{
			$this->db->insert('widgets',$data);
		}
	}
	
	function has_widget($widgetid,$lang)
	{
		$this->db->select('*');
		$this->db->where('widgetid',$widgetid);
		$this->db->where('lang_code',$lang);
		$this->db->from('widgets');
		$query=$this->db->get();
		$res=$query->row();
		if($res) return true;
		else return false;
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
	
	
	function save_widget_links($data,$widgetid,$lang_code,$type)
	{
		
		$this->db->insert('widget_links',$data);
		
	}
	
	function delete_widget_links($widgetid,$lang_code,$type)
	{
		$res=$this->get_widget_links($widgetid,$lang_code,$type);
		if($res)
		{
			foreach($res as $row)
			{
				//@unlink("assets/img/thumbs/".$row->image);
			}
			$this->db->where('widgetid',$widgetid);
			$this->db->where('lang_code',$lang_code);
			$this->db->where('type',$type);
			$this->db->delete('widget_links');
		}
		
	}
	
	function get_widget_links($widgetid,$lang_code,$type)
	{
		$this->db->select('*');
		$this->db->where('widgetid',$widgetid);
		$this->db->where('lang_code',$lang_code);
		$this->db->where('type',$type);
		$this->db->from('widget_links');
		$query=$this->db->get();
		$res=$query->result();
		return $res;
	}
	
	
	function get_purple_widgets($lang='en')
	{
		$this->db->select('*');
		$this->db->where('lang_code',$lang);
		$this->db->from('purple_widgets');
		$query=$this->db->get();
		$res=$query->result();
		return $res;
	}
	
	function get_purple_widget($purple_widget_id)
	{
		$this->db->select('*');
		$this->db->where('purple_widget_id',$purple_widget_id);
		$this->db->from('purple_widgets');
		$query=$this->db->get();
		$res=$query->row();
		return $res;
	}
	
	function save_purple_widget($data,$purple_widget_id)
	{
		$this->db->where('purple_widget_id',$purple_widget_id);
		$this->db->update('purple_widgets',$data);
	}
	
	function update_purple_widget($data,$purple_widgetid,$lang)
	{
		if($this->has_purple_widget($purple_widgetid,$lang))
		{
			$this->db->where('purple_widgetid',$purple_widgetid);
			$this->db->where('lang_code',$lang);
			$this->db->update('purple_widgets',$data);
		}
		else
		{
			$this->db->insert('purple_widgets',$data);
		}
	}
	
	function has_purple_widget($purple_widgetid,$lang)
	{
		$this->db->select('*');
		$this->db->where('purple_widgetid',$purple_widgetid);
		$this->db->where('lang_code',$lang);
		$this->db->from('purple_widgets');
		$query=$this->db->get();
		$res=$query->row();
		if($res) return true;
		else return false;
	}
 

}

?>

