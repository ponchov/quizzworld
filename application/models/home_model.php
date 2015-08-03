<?php 

class Home_model extends CI_Model {

	

	public function __construct()

    {

        parent::__construct();

		

    }

    

	function get_games($page,$limit,$post_type='',$cat_id='',$game_type='')

	{
		
		$cur_day=date('Y-m-d');

		$this->db->select('*');

		if($cat_id) $this->db->where('category_id',$cat_id);
		if($post_type) $this->db->where('post_type',$post_type);
		if($game_type=="quiz")
		{
			$this->db->where("(is_real_test='0' OR is_real_test='1')", NULL, FALSE);
		}
		$this->db->where('status',1);
		//$this->db->where('is_real_test !=',6);
		//$this->db->where('is_real_test !=',3);
		$this->db->where('is_real_test !=',2);

		$this->db->where('lang_code',$this->session->userdata('lang_code'));

		//$this->db->where('date(activated_date) <=',$cur_day);

		$this->db->from('tests');

		$this->db->order_by('activated_date','desc');

		$this->db->order_by('tests_id','desc'); 

		$this->db->limit($limit,$page);

		$query=$this->db->get();

		$res=$query->result();

		//echo $this->db->last_query();

		return $res;

	}
	
	
	
	function get_featured_post()
	{
		$this->db->select('*');
		$this->db->where('is_real_test !=',2);
		$this->db->where('is_real_test !=',3);
		$this->db->where('status',1);
		$this->db->where('featured',1);
		$this->db->where('lang_code',$this->session->userdata('lang_code'));
		$this->db->from('tests');
		$this->db->order_by('tests_id', 'RANDOM');	
		$query=$this->db->get();
		$res=$query->result();
		return $res;
	
	}

	

	

	function get_all_games()

	{

		$this->db->select('*');
		//$this->db->where('is_real_test !=',2);
		$this->db->where('is_real_test !=',3);
		$this->db->where('status',1);

		$this->db->where('lang_code',$this->session->userdata('lang_code'));

		$this->db->from('tests');

		$query=$this->db->get();

		$res=$query->result();

		return $res;

	}	

	

	function get_total_games($post_type='',$cat_id='',$game_type='')
	{
		$this->db->select('count(*) as num');
		if($post_type) $this->db->where('post_type',$post_type);
		if($cat_id) $this->db->where('category_id',$cat_id);
		if($game_type=="quiz")
		{
			$this->db->where("(is_real_test='0' OR is_real_test='1')", NULL, FALSE);
		}
		$this->db->where('status',1);
		//$this->db->where('is_real_test !=',6);
		//$this->db->where('is_real_test !=',3);
		$this->db->where('is_real_test !=',2);
		$this->db->where('lang_code',$this->session->userdata('lang_code'));
		$this->db->from('tests');
		$query=$this->db->get();
		$res=$query->row();
		return $res->num;

	}

	function get_game_by_id($tests_id)
	{
		$this->db->select('t.*,ta.*');
		$this->db->where('t.tests_id',$tests_id);	
		
		$this->db->from('tests as t');
		$this->db->join('tests_ad_config as ta','ta.test_id=t.tests_id','left');
		$query=$this->db->get();
		$res=$query->row();
		return $res;
	}
	function get_game_by_testid($testid,$lang_code='en')
	{
		$this->db->select('t.*');
		$this->db->where('t.testid',$testid);
		$this->db->where('lang_code',$lang_code);	
		$this->db->from('tests as t');
		$query=$this->db->get();
		$res=$query->row();
		return $res;
	} 

    function get_game($tests_alias)
	{
		$this->db->select('t.*,ta.*');
		$this->db->where('t.lang_code',$this->session->userdata('lang_code'));
		$this->db->where('t.alias',$tests_alias);		
		if(!$this->session->userdata('user_id')) $this->db->where('t.status',1);
		$this->db->from('tests as t');
		$this->db->join('tests_ad_config as ta','ta.test_id=t.tests_id','left');
		$query=$this->db->get();
		$res=$query->row();
		if($res) return $res;
		else return $this->get_en_game($tests_alias);
	} 
	
	function get_thumb($testid)
	{
		$this->db->select('t.image_thumb');
		$this->db->where('t.tests_id',$testid);		
		$this->db->from('tests as t');
		$query=$this->db->get();
		$res=$query->row();
		return $res->image_thumb;
	}
	
	function get_test_image($testid)
	{
		$this->db->select('t.image');
		$this->db->where('t.tests_id',$testid);		
		$this->db->from('tests as t');
		$query=$this->db->get();
		$res=$query->row();
		return $res->image;
	} 
	
	 function get_en_game($tests_alias)
	{
		$this->db->select('t.*,ta.*');
		$this->db->where('t.lang_code','en');
		$this->db->where('t.alias',$tests_alias);		
		if(!$this->session->userdata('user_id')) $this->db->where('t.status',1);
		$this->db->from('tests as t');
		$this->db->join('tests_ad_config as ta','ta.test_id=t.tests_id','left');
		$query=$this->db->get();
		$res=$query->row();
		return $res;
	} 
	
	
	
	function get_total_trivia()
	{
		$this->db->select('count(*) as num');
		$this->db->where('status',1);
		$this->db->where('is_real_test',2);
		$this->db->where('lang_code',$this->session->userdata('lang_code'));
		$this->db->from('tests');
		$query=$this->db->get();
		$res=$query->row();
		return $res->num;
	}

	function get_trivis($page,$limit)
	{
		$cur_day=date('Y-m-d');
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->where('is_real_test',2);
		$this->db->where('lang_code',$this->session->userdata('lang_code'));
		//$this->db->where('date(activated_date) <=',$cur_day);
		$this->db->from('tests');
		$this->db->order_by('activated_date','desc');
		$this->db->order_by('tests_id','desc'); 
		$this->db->limit($limit,$page);
		$query=$this->db->get();
		$res=$query->result();
		//echo $this->db->last_query();
		return $res;
	}
	
	function get_total_apps()
	{
		$this->db->select('count(*) as num');
		$this->db->where('status',1);
		$this->db->where('is_real_test',6);
		$this->db->where('lang_code',$this->session->userdata('lang_code'));
		$this->db->from('tests');
		$query=$this->db->get();
		$res=$query->row();
		return $res->num;
	}

	function get_apps($page,$limit)
	{
		$cur_day=date('Y-m-d');
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->where('is_real_test',6);
		$this->db->where('lang_code',$this->session->userdata('lang_code'));
		//$this->db->where('date(activated_date) <=',$cur_day);
		$this->db->from('tests');
		$this->db->order_by('activated_date','desc');
		$this->db->order_by('tests_id','desc'); 
		$this->db->limit($limit,$page);
		$query=$this->db->get();
		$res=$query->result();
		//echo $this->db->last_query();
		return $res;
	}
	
	function get_total_names()
	{
		$this->db->select('count(*) as num');
		$this->db->where('status',1);
		$this->db->where('is_real_test',3);
		$this->db->where('lang_code',$this->session->userdata('lang_code'));
		$this->db->from('tests');
		$query=$this->db->get();
		$res=$query->row();
		return $res->num;
	}

	function get_names($page,$limit)
	{
		$cur_day=date('Y-m-d');
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->where('is_real_test',3);
		$this->db->where('lang_code',$this->session->userdata('lang_code'));
		//$this->db->where('date(activated_date) <=',$cur_day);
		$this->db->from('tests');
		$this->db->order_by('activated_date','desc');
		$this->db->order_by('tests_id','desc'); 
		$this->db->limit($limit,$page);
		$query=$this->db->get();
		$res=$query->result();
		//echo $this->db->last_query();
		return $res;
	}
	

	function get_top_game($tests_alias)

	{

		$this->db->select('*');

		$this->db->where('alias',$tests_alias);

		$this->db->where('lang_code',$this->session->userdata('lang_code'));

		$this->db->from('tests');

		$query=$this->db->get();

		$res=$query->result();

		return $res;

	}

	

	function get_questions($test_id)

	{

		//echo $test_id; exit;

		$this->db->select('q.*,t.title,t.lang_code,t.testid');
		$this->db->where('t.tests_id',$test_id);
		//$this->db->where('t.lang_code',$this->session->userdata('lang_code'));
		$this->db->where('q.lang_code','t.lang_code',FALSE);
		$this->db->from('tests_questions as q');
		$this->db->join('tests as t','t.testid=q.test_id','left');
		$query=$this->db->get();
		$res=$query->result();
		//echo $this->db->last_query();
		return $res;

	}

	

	function get_answers($test_question_id,$lang='en')

	{
		$this->db->select('ta.*');
		$this->db->where('ta.test_question_id',$test_question_id);
		$this->db->where('ta.lang_code',$lang);
		$this->db->from('tests_answers as ta');
		$query=$this->db->get();
		$res=$query->result();
		return $res;
	}  

	

	function get_config($config_type='config',$lang='en')
	{
		$this->db->select('*');
		$this->db->where('config_type',$config_type);
		$this->db->where('language',$lang);
		$this->db->from('site_config');
		$query=$this->db->get();
		$res=$query->row();
		if($res) return $res;
		else return $this->get_en_config();
		
	}
	
	function get_en_config()
	{
		$this->db->select('*');
		$this->db->where('config_type','config');
		$this->db->where('language','en');
		$this->db->from('site_config');
		$query=$this->db->get();
		$res=$query->row();
		return $res;
	}

	

	function get_result_options($id,$lang_code='en')

	{
		$this->db->select('*');
		$this->db->where('test_id',$id);
		$this->db->where('lang_code',$lang_code);
		$this->db->from('result_options');
		$query=$this->db->get();
		$res=$query->result();
		//echo $this->db->last_query();
		return $res;

	}
	function get_result_option($result_option_id)
	{
		$this->db->select('*');
		$this->db->where('result_option_id',$result_option_id);
		$this->db->from('result_options');
		$query=$this->db->get();
		$res=$query->row();
		return $res;
	}
	function get_default_result_option($result_optionid,$lang_code='en')
	{
		$this->db->select('*');
		$this->db->where('result_optionid',$result_optionid);
		$this->db->where('lang_code',$lang_code);
		$this->db->from('result_options');
		$query=$this->db->get();
		$res=$query->row();
		return $res;
	}

	function get_result_ids($id)
	{
		$this->db->select('*');
		$this->db->where('test_id',$id);
		$this->db->where('lang_code',$this->session->userdata('lang_code'));
		$this->db->from('result_options');
		//$this->db->limit(1);
		//$this->db->order_by('result_option_id', 'RANDOM');
		$query=$this->db->get();
		$res=$query->result();
		$ids="";
		if($res)
		{
			foreach($res as $row)
			{
				$ids.=$row->result_option_id.",";
			}
			$ids=rtrim($ids,",");
		}
		return $ids;
	}

	function get_cat_id($category)

	{

		$this->db->select('*');

		$this->db->where('alias',$category);

		$this->db->from('categories');

		$query=$this->db->get();

		$res=$query->row();

		if($res) return $res->category_id;

		else "0";

		

	}

	

	function create_temp_test_table()

	{

		$sql="DROP TABLE IF EXISTS `temp_tests`";

		$this->db->query($sql);

		$sql="CREATE TEMPORARY TABLE  `temp_tests` (

		  `tests_id` int(11) NOT NULL ,

		  `category_id` int(11) NOT NULL,

		  `title` varchar(255) NOT NULL,

		  `page_title` varchar(255) NOT NULL,

		  `alias` varchar(255) NOT NULL,

		  `description` text NOT NULL,

		  `result_text` text NOT NULL,

		  `start_point` int(11) NOT NULL DEFAULT '0' COMMENT 'This will use in result page',

		  `fbshare_des` text NOT NULL,

		  `add_sense_top` text NOT NULL,

		  `add_sense_bottom` text NOT NULL,

		  `adsense_result_page` text NOT NULL,

		  `question` text NOT NULL,

		  `answer` text NOT NULL,

		  `fun` text NOT NULL,

		  `enjoy_and_share` text NOT NULL,

		  `direct_start` tinyint(1) NOT NULL COMMENT '1:Check ; 2: Uncheck',

		  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:active, 2:inactive',

		  `created` date NOT NULL,

		  `image` varchar(255) NOT NULL,

		  `google_analytics` text NOT NULL,

		  `popup_box_text` text NOT NULL,

		  `fb_like` int(11) NOT NULL DEFAULT '0'

		)";

		

		$this->db->query($sql);

	}

	

	function add_test_into_temp_tbl($data)

	{

		$this->db->insert('temp_tests',$data);

	}

	

	function fb_test_save($data,$test_id)

	{



		$this->db->where('tests_id',$test_id);

		$this->db->update('tests',$data);			



	}

	

	

	

	

	

	

	function get_total_topgames($cat_id='')

	{

		$this->db->select('count(*) as num');

		if($cat_id) $this->db->where('category_id',$cat_id);

		$this->db->where('status',1);

		$this->db->from('temp_tests');

		$query=$this->db->get();

		$res=$query->row();

		return $res->num;

	}

	

	function get_top_games($page,$limit,$cat_id='')

	{

		$this->db->select('*');

		if($cat_id) $this->db->where('category_id',$cat_id);

		$this->db->where('status',1);

		$this->db->from('temp_tests');

		$this->db->order_by('fb_like','desc');

		$this->db->limit($limit,$page);

		$query=$this->db->get();

		$res=$query->result();

		//echo $this->db->last_query();

		return $res;

	}
	
	function get_topgames()
	{
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->from('tests');
		$this->db->order_by('fb_like','desc');
		$this->db->limit('4');
		$query=$this->db->get();
		$res=$query->result();
		return $res;
	}
	
	function get_topbanners($limit)

	{
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->from('banners');
		$this->db->order_by('banner_id', 'RANDOM');
		$this->db->limit($limit);
		$query=$this->db->get();
		$res=$query->result();
		return $res;
	}
	
	/*function get_previous_test_url($test_id)

	{

		$this->db->select('*');

		$this->db->where('testid >',$test_id);

		$this->db->where('status',1);

		$this->db->where('lang_code',$this->session->userdata('lang_code'));

		$this->db->from('tests');

		$this->db->limit(1);

		$this->db->order_by('tests_id','asc');

		$query=$this->db->get();

		$res=$query->row();

		if($res) return site_url().$res->alias.".html";

		else return false;

	}*/
	function get_previous_test_url($test_id,$activated_date='',$is_real_test="personal")
	{

		$this->db->select('*');

		if(!$activated_date) $this->db->where('testid >',$test_id);
		if($activated_date) $this->db->where('activated_date >',$activated_date);
		
		/*if($is_real_test == "personal")
		{
			$this->db->where("(is_real_test='0' OR is_real_test='1')", NULL, FALSE);
		}
		else
		{
			$this->db->where('is_real_test',$is_real_test);
		}*/
		$this->db->where('status',1);
		$this->db->where('post_type',"games");
		$this->db->where('lang_code',$this->session->userdata('lang_code'));

		$this->db->from('tests');

		$this->db->limit(1);
		$this->db->order_by('activated_date','asc');
		$this->db->order_by('tests_id','asc');

		$query=$this->db->get();

		$res=$query->row();
		//echo $test_id;
		//echo $this->db->last_query();

		if($res)
		{
			if($res->testid != $test_id)
			{
				return site_url().$res->alias.".html";
			}
			else return false;
			
		} 

		else return false;

	}

	function get_previous_test($test_id,$activated_date='',$is_real_test=3)
	{
		$this->db->select('*');

		if(!$activated_date) $this->db->where('testid >',$test_id);
		if($activated_date) $this->db->where('activated_date >',$activated_date);
		
		$this->db->where('is_real_test',$is_real_test);
		$this->db->where('status',1);
		$this->db->where('post_type',"games");
		$this->db->where('lang_code',$this->session->userdata('lang_code'));

		$this->db->from('tests');

		$this->db->limit(1);
		$this->db->order_by('activated_date','asc');
		$this->db->order_by('tests_id','asc');

		$query=$this->db->get();

		$res=$query->row();
		//echo $test_id;
		//echo $this->db->last_query();

		if($res)
		{
			if($res->testid != $test_id)
			{
				return $res;
			}
			else return false;
			
		} 

		else return false;

	}
	
	function get_next_test($test_id,$activated_date='',$is_real_test=3)
	{

		$this->db->select('*');

		//$this->db->where('tests_id !=',$test_id);
		
		if(!$activated_date) $this->db->where('tests_id <',$test_id);
		if($activated_date) $this->db->where('activated_date <',$activated_date);
		
		$this->db->where('is_real_test',$is_real_test);
		$this->db->where('status',1);
		$this->db->where('post_type',"games");
		$this->db->where('lang_code',$this->session->userdata('lang_code'));

		$this->db->from('tests');

		$this->db->limit(1);
		
		$this->db->order_by('activated_date','desc');
		$this->db->order_by('tests_id','desc');

		$query=$this->db->get();

		$res=$query->row();
		
		//echo $this->db->last_query();
		//echo $test_id;
		//print_r($res);
		if($res)
		{
			if($res->testid != $test_id)
			{
				return $res;
			}
			else return false;
			
		}

		else return false;

	}
	
	function get_promoted_test($test_id,$game_type='3')
	{
		$this->db->select('*');
		$this->db->where('post_type',"games");
		$this->db->where('is_real_test',$game_type);
		$this->db->where('featured',3);
		$this->db->where('tests_id !=',$test_id);
		$this->db->from('tests');
		$query=$this->db->get();
		//echo $this->db->last_query();
		$res=$query->row();
		//print_r($res);
		if($res) return $res;
		else 
		{
			
			
			$res=$this->get_next_test($test_id,'',$game_type);
			if($res)
			{
				//echo 'pre';
				return $res;
			} 
			else
			{ 
				$res=$this->get_previous_test($test_id,'',$game_type);
				return $res;
			}
		}
	}

	function get_next_test_url($test_id,$activated_date='',$is_real_test="personal")

	{

		$this->db->select('*');

		/*if($is_real_test == "personal")
		{
			$this->db->where("(is_real_test='0' OR is_real_test='1')", NULL, FALSE);
		}
		else
		{
			$this->db->where('is_real_test',$is_real_test);
		}*/
		
		if(!$activated_date) $this->db->where('testid <',$test_id);
		if($activated_date) $this->db->where('activated_date <',$activated_date);
		
		$this->db->where('status',1);
		$this->db->where('post_type',"games");
		$this->db->where('lang_code',$this->session->userdata('lang_code'));

		$this->db->from('tests');

		$this->db->limit(1);
		
		$this->db->order_by('activated_date','desc');
		$this->db->order_by('tests_id','desc');

		$query=$this->db->get();

		$res=$query->row();
		//echo $this->db->last_query();
		if($res)
		{
			if($res->testid != $test_id)
			{
				return site_url().$res->alias.".html";
			}
			else return false;
			
		}

		else return false;

	}

	

	function get_previous_test_url_by_ranking($fb_like,$test_id)

	{

		$this->db->select('*');

		$this->db->where('fb_like >=',$fb_like);

		$this->db->where('tests_id !=',$test_id);

		$this->db->where('status',1);
		$this->db->where('lang_code',$this->session->userdata('lang_code'));

		$this->db->from('tests');

		$this->db->limit(1);

		$this->db->order_by('fb_like','asc');

		$query=$this->db->get();

		$res=$query->row();

		if($res) return site_url().$res->alias.".html?ref_page=top";

		else return false;

	}

	

	function get_next_test_url_by_ranking($fb_like,$test_id)

	{

		$this->db->select('*');

		$this->db->where('fb_like <=',$fb_like);

		$this->db->where('tests_id !=',$test_id);

		$this->db->where('status',1);	
		$this->db->where('lang_code',$this->session->userdata('lang_code'));	

		$this->db->from('tests');

		$this->db->limit(1);

		$this->db->order_by('fb_like','desc');

		$query=$this->db->get();

		$res=$query->row();

		if($res) return site_url().$res->alias.".html?ref_page=top";

		else return false;

	}
	
	function get_lists($testid)
	{
		$this->db->select('*');
		$this->db->where('lang_code',$this->session->userdata('lang_code'));
		$this->db->where('test_id',$testid);
		$this->db->order_by('list_item_id','DESC');		
		$this->db->from('list_items');
		$query=$this->db->get();
		$res=$query->result();
		return $res;
	} 
	
	
	function get_randon_lists($post_type='games',$limit,$test_id='',$is_real_test='')
	{
		$this->db->select('*');
		$this->db->where('lang_code',$this->session->userdata('lang_code'));
		$this->db->where('status',1);
		$this->db->where('featured !=',3);
		if($test_id) $this->db->where('tests_id !=',$test_id);
		if($is_real_test != '') $this->db->where('is_real_test',$is_real_test);
		//$this->db->where('post_type',$post_type);
		$this->db->from('tests');
		$this->db->limit($limit);
		$this->db->order_by('tests_id', 'RANDOM');
		$query=$this->db->get();
		$res=$query->result();
		return $res;
	}
	
	function get_tags($id)
	{
		
		$this->db->select('*');
		$this->db->where('test_id',$id);
		$this->db->from('tags');
		$query=$this->db->get();
		$res=$query->result();
		
		return $res;
	}
	
	function get_visitor_result($result_id)
	{
		$this->db->select('*');
		$this->db->where('result_id',$result_id);
		$this->db->from('visitor_results');
		$query=$this->db->get();
		$res=$query->row();
		if($res) return $res->result;
		else return '';
	}
	
	function get_3apps_visitor_result($slug)
	{
		$this->db->select('*');
		$this->db->where('slug',$slug);
		$this->db->from('3apps_visitor_result');
		$query=$this->db->get();
		$res=$query->row();
		if($res) return $res->result;
		else return '';
	}
	
	function generate_slug($alias,$str)
	{
		$this->delete_slugs();
		$str=$alias."/".$str;
		$this->db->select('*');
		$this->db->where('slug',$str);
		$this->db->from('3apps_visitor_result');
		$this->db->limit(1);
		$this->db->order_by('slug_stat', 'DESC');
		$query=$this->db->get();
		$res=$query->row();
		$slug=$str;
		$arr['slug']=$slug;
		$arr['slug_stat']=0;
		if($res)
		{
			$new_stat=$res->slug_stat + 1;
			$slug=$str."_s".$new_stat;
			$arr['slug']=$slug;
			$arr['slug_stat']=$new_stat;
		}
		
		return $arr;
		
	}
	
	function delete_slugs()
	{
		$date = date('Y-m-d');
		$date = strtotime($date);
		$date = strtotime("-9 day", $date);
		$date=date('Y-m-d', $date);
		$this->db->where('added <', $date);
		$this->db->delete('3apps_visitor_result');
	}
	
	function get_agechecker_result($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$this->db->from('agechecker_result');
		$query=$this->db->get();
		$res=$query->row();		
		return $res;
	}
	
	function get_pre_result($id)
	{
		$this->db->select('*');
		$this->db->where('id <',$id);
		$this->db->from('agechecker_result');
		$query=$this->db->get();
		$res=$query->result();		
		return $res;
	}
	
	function delete_pre_result($id)
	{
		$this->db->where('id <',$id);
		$this->db->delete('agechecker_result');
	}
	
	
	function get_ads_unique($type='')
	{
		//echo $type; exit;
		$this->db->select('*');
		$this->db->where('config_type',$type);
		$this->db->from('site_config');
		$query=$this->db->get();
		$res=$query->row();
		return $res;
	}
	
	function get_pre_fbapps_result3333($id)
	{
		$this->db->select('*');
		$this->db->where('id <',$id);
		$this->db->from('fb_apps_result');
		$query=$this->db->get();
		$res=$query->result();		
		return $res;
	}
	function get_pre_fbapps_result($id)
	{
		$this->db->select('*');
		$this->db->where('added <',$id);
		$this->db->from('fb_apps_result');
		$this->db->order_by('added','desc');
		$query=$this->db->get();
		$res=$query->result();		
		return $res;
	}
	
	function delete_pre_fbapps_result($id)
	{
		$this->db->where('added <',$id);
		$this->db->delete('fb_apps_result');
	}
	
	function get_banners($template='',$limit=6)
	{
		$this->db->select('*');
		if($template) $this->db->where('template',$template);
		$this->db->where('status',1);
		$this->db->from('banners');
		$this->db->limit($limit);
		$this->db->order_by('banner_id', 'RANDOM');
		$query=$this->db->get();
		$res=$query->result();		
		return $res;
	}
	
	function get_fb_soulmate_result($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$this->db->from('fb_apps_result');
		$query=$this->db->get();
		$res=$query->row();		
		return $res;
	}
	
	
	function get_test_banner_ids($test_id)
	{
		$this->db->select('*');
		$this->db->where('test_id',$test_id);
		$this->db->from('test_banners');
		$query=$this->db->get();
		$res=$query->result();
		
		$ids=array();
		if($res)
		{
			foreach($res as $row)
			{
				$ids[]=$row->banner_id;
			}
		}
		return $ids;
	}
	
	function get_test_banners($banner_ids)
	{
		$this->db->select('*');
		$this->db->where_in('banner_id',$banner_ids);
		$this->db->where('status',1);
		$this->db->from('banners');
		$query=$this->db->get();
		$res=$query->result();		
		return $res;
	}
	
	
	function get_languages()
	{
		$this->db->select('l.*,ln.label');
		$this->db->where('l.status',1);
		
		$this->db->from('languages as l');
		$this->db->join('languages_name as ln',"l.language_id=ln.language_id and ln.lang_code='".$this->session->userdata('lang_code')."'",'left');
		$query=$this->db->get();
		$res=$query->result();
		//echo $this->db->last_query();		
		return $res;
	}
	
	function get_default_widget($widget_code)
	{
		$this->db->select('*');
		$this->db->where('widget_code',$widget_code);
		$this->db->where('lang_code','en');
		$this->db->where('status',1);
		$this->db->from('widgets');
		$query=$this->db->get();
		$res=$query->row();
		return $res;
	}
	
	function get_widget($widget_code,$lang_code,$test_id='')
	{
		$this->db->select('*');
		$this->db->where('widget_code',$widget_code);
		$this->db->where('lang_code',$lang_code);
		$this->db->where('status',1);
		$this->db->from('widgets');
		$query=$this->db->get();
		$res=$query->row();
		if(!$res)
		{
			$res=$this->get_default_widget($widget_code);
		}
		
		if(!$res)
		{
			$result=new stdClass();
			$result->columns=0;
			$result->rows=0;
			$result->external_items=array();
			$result->direct_items=array();
			$result->items=array();
			return $result;
		}
		
		$result=new stdClass();
		$result->columns=$res->columns;
		$result->rows=$res->rows;
		
		$total_item=$res->columns * $res->rows;
		
		
		//echo $this->db->last_query();
		//--------------- manage direct and extranal links
		//print_r($res);
		if($res->have_external_links == 1)
		{ 
			$result->external_items=$this->get_widget_links($res->widgetid,$res->lang_code,2);
		}
		else
		{
			$result->external_items=array();
		}
		
		if($res->have_direct_link == 1)
		{
			$result->direct_items=$this->get_widget_links($res->widgetid,$res->lang_code,1);
		}
		else
		{
			$result->direct_items=array();
		}
		
		$tests=array();
		
		
		
		
		if($res->is_override == 1)
		{
			$ids=explode(",",$res->test_ids);
			if($ids)
			{
				foreach($ids as $id)
				{
					if($id != $test_id)
					{
						$new_items=$this->get_widget_test($id,$lang_code);
						if($new_items) $tests[]=$new_items;
					}
					
				}
			}
		}
		
		$j=count($tests);
		//if($j > 0) $j=$j-1;
		$template_tests=array();
		if($res->include_templates == 1)
		{
			if($res->items)
			{
				$items=json_decode($res->items,true);
				foreach($items as $key=>$value)
				{ 
					
					$arr=$this->get_widget_items($key,$value,$lang_code,$test_id);
					if($arr)
					{
						foreach($arr as $row)
						{
							$template_tests[]=$row;
							
						}
						
					}
					//$j++;
				}
			}
		}
		if($template_tests)
		{
			shuffle($template_tests);
			
			foreach($template_tests as $template_test)
			{
				$tests[]=$template_test;
			}
		}
		
		
		
		
		
		//$tests=array_merge($tests,$template_tests);
		$result->items=$tests;
		//echo "<pre>";
		//print_r($result); exit;
		return $result;
		
	}
	
	function get_widget_items($is_real_test,$limit,$lang_code='en',$test_id='')
	{
		$this->db->select('*');
		$this->db->where('lang_code',$lang_code);
		$this->db->where('status',1);
		$this->db->where('post_type','games');
		if($test_id != '') $this->db->where('tests_id !=',$test_id);
		if($is_real_test != '') $this->db->where('is_real_test',$is_real_test);
		$this->db->from('tests');
		$this->db->limit($limit);
		$this->db->order_by('tests_id', 'RANDOM');
		$query=$this->db->get();
		$res=$query->result();
		return $res;
	}
	function get_widget_test($id,$lang_code='en')
	{
		$this->db->select('*');
		$this->db->where('lang_code',$lang_code);
		$this->db->where('status',1);
		$this->db->where('testid',$id);
		$this->db->from('tests');
		$query=$this->db->get();
		$res=$query->row();
		return $res;
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
	
	function get_default_purple_widget()
	{
		$this->db->select('*');
		$this->db->where('lang_code','en');
		$this->db->from('purple_widgets');
		$query=$this->db->get();
		$res=$query->row();
		return $res;
	}
	function get_purple_widget($tests_id,$lang_code)
	{
		$this->db->select('*');
		$this->db->where('lang_code',$lang_code);
		$this->db->from('purple_widgets');
		$query=$this->db->get();
		$res=$query->row();
		if(!$res) $res=$this->get_default_purple_widget();
		
		if($res->status == 0) return false;
		
		
		
		
		
		if($res->test_type == "external_link")
		{
			$result=new stdClass ;
			$result->post_type="external";
			$result->url=$res->url;
			$result->image=$res->image;
			$result->title=$res->title;
			
		}		
		else if($res->test_type == "latest_test_category")
		{
			$result=$this->get_template_purple($res->template,$res->lang_code,$tests_id);
			
			
		}
		else if($res->test_type == "specific_test")
		{
			$result=$this->get_game_by_testid($res->specific_test_id,$lang_code);
			
		}
		else if($res->test_type == "recent_test")
		{
			$result=$this->get_template_purple(0,$res->lang_code,$tests_id);
			
		}
		
		return $result;
		
	
	}
	
	
	function get_template_purple($is_real_test,$lang_code,$tests_id='')
	{
		$this->db->select('*');
		$this->db->where('lang_code',$lang_code);
		$this->db->where('post_type','games');
		if($tests_id) $this->db->where('tests_id !=',$tests_id);
		if($is_real_test == 'personal')
		{
			$this->db->where("(is_real_test='0' OR is_real_test='1')", NULL, FALSE);
		}
		else if($is_real_test != 0)
		{
			$this->db->where('is_real_test',$is_real_test);
		}
		$this->db->from('tests');
		$this->db->order_by('activated_date','desc');
		$this->db->limit(1);
		$query=$this->db->get();
		$res=$query->row();
		return $res;
	}
	
	
	
	
	

}

?>