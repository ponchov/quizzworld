<?php 

class Site_config_model extends CI_Model {

	

	public function __construct()

    {

        parent::__construct();

		

    }

    

	/*function get_config($config_type='personal')
	{
		$this->db->select('*');
		$this->db->where('config_type',$config_type);
		$this->db->from('site_config');
		$query=$this->db->get();
		$res=$query->row();
		return $res;
	}*/
	
	function get_config($config_type='personal',$language='en')
	{
		$this->db->select('*');
		$this->db->where('config_type',$config_type);
		$this->db->where('language',$language);
		$this->db->from('site_config');
		$query=$this->db->get();
		$res=$query->row();
		if(!$res)
		{ 
			$res=new stdClass;
			$res->site_config_id=0;
			$res->config_type='';
			$res->language='';
			$res->site_title='';
			$res->page_description='';
			$res->facebook_url='';
			$res->facebook_appid='';
			$res->share_des='';
			$res->google_analytics='';
			$res->meta_img='';
			$res->logo='';
			$res->favicon='';
		}
		return $res;
	}
	
	
	
	function get_jsconfig()
	{
		$this->db->select('*');
		$this->db->from('js_configs');
		$query=$this->db->get();
		$res=$query->row();
		if(!$res)
		{ 
			$res=new stdClass;
			$res->id=0;
			$res->google_analytics='';
			$res->fb_pixel='';
			$res->quantcast='';
			$res->google_remarking='';
			$res->taboola_head='';
			$res->taboola_body='';
			$res->google_survey='';
			$res->google_plus='';
		}
		return $res;
	}
	
	function save_jsconfig($data,$id)
	{
		if($id == 0)
		{
			$this->db->insert('js_configs',$data);
		}
		else
		{
			$this->db->where('id',$id);
			$this->db->update('js_configs',$data);
		}
	}
	

	

	function edit_config($data,$config_type='personal',$language='en')
	{
		
		$has_config=$this->has_config($config_type,$language); 
		if($has_config)
		{
			//echo "update"; exit;
			$this->db->where('config_type ',$config_type);
			$this->db->where('language ',$language);
			$this->db->update('site_config',$data);
		}
		else
		{
			//echo "inser"; exit;
			$this->db->insert('site_config',$data);
		}

	}
	
	function has_config($config_type,$language)
	{
		$this->db->select('count(*) as num');
		$this->db->where('config_type ',$config_type);
		$this->db->where('language ',$language);
		$this->db->from('site_config');
		$query=$this->db->get();
		$res=$query->row();
		if($res->num > 0) return true;
		else return false;
	}

	function get_templates()
	{

		$this->db->select('*');
		$this->db->from('templates');
		$query=$this->db->get();
		$res=$query->result();
		return $res;
	}
	
	function active_template($data,$id)
	{
		$this->db->where('template_id',$id);
		$this->db->update('templates',$data);
	}
	
	function update_template($data,$id)
	{
		$this->db->where('template_id !=',$id);
		$this->db->update('templates',$data);
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
	
	function get_en_language($language_id)
	{
		$this->db->select('*');
		$this->db->where('language_id',$language_id);
		$this->db->from('languages');
		$query=$this->db->get();
		$res=$query->row();
		return $res->language_name;
	}
	
	function get_language($lang_id,$lang_code)
	{
		$this->db->select('*');
		$this->db->where('language_id',$lang_id);
		$this->db->where('lang_code',$lang_code);
		$this->db->from('languages_name');		
		$query=$this->db->get();
		$res=$query->row();
		return $res;
	}
	
	function save_language($data)
	{
		$this->db->insert('languages_name',$data);	
	}
	
	function update_language($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('languages_name',$data);	
	}
	
 

}

?>

