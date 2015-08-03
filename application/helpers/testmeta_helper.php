<?php  if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );




    function get_testMeta($test_id,$meta_key)
    {
        $ci =& get_instance();
        $ci->db->select('*');
		$ci->db->where('test_id',$test_id);
		$ci->db->where('meta_key',$meta_key);
		$ci->db->from('test_meta');
		$query=$ci->db->get();
		$res=$query->row();
		if($res) return $res->meta_value;
		else return "";
    }
	
	/*function get_templateName()
	{
		$ci =& get_instance();
        $ci->db->select('*');
		$ci->db->from('site_config');
		$query=$ci->db->get();
		$res=$query->row();
		return $res->template_name;
	}*/

	function get_templateName()
	{
		$ci =& get_instance();
        $ci->db->select('*');
		$ci->db->where('status',1);
		$ci->db->from('templates');
		$query=$ci->db->get();
		$res=$query->row();
		return $res->template_name;
	}
	
	function get_jsconfig()
	{
		$ci =& get_instance();
		$ci->db->select('*');
		$ci->db->from('js_configs');
		$query=$ci->db->get();
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

