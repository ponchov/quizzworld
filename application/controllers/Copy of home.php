<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//echo "I am here"; exit;

require_once('main_site.php');

class Home extends main_site {

	/**

	 * Index Page for this controller.

	 *

	 * Maps to the following URL

	 * 		http://example.com/index.php/welcome

	 *	- or -  

	 * 		http://example.com/index.php/welcome/index

	 *	- or -

	 * Since this controller is set as the default controller in 

	 * config/routes.php, it's displayed at http://example.com/ 

	 *

	 * So any other public methods not prefixed with an underscore will

	 * map to /index.php/welcome/<method_name>

	 * @see http://codeigniter.com/user_guide/general/urls.html

	 */

	function __construct() 

	{

		parent::__construct();

		

		$this->load->model('home_model');		

           

	}

	

	function index($page=0)
	{	
		//echo $this->template; exit;
        $total_rows = $this->home_model->get_total_games();	
		if($total_rows == 0)
		{
			redirect("http://survley.com/");
		} 
		$limit=18;
		if($page == 0) $start=$page * $limit;
		else $start=($page -1) * $limit;
		$this->load->library('pagination');
		//echo $start;
		$config['use_page_numbers'] =TRUE;
		$config['uri_segment'] = 2;
		$config['num_links'] = 7;
        $config['base_url'] = site_url('page');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $limit;
        $this->pagination->initialize($config);
		$db_data['pagination']=$this->pagination->create_links();
		//------- this is for mobile pagination
		$config['prev_link'] = 'Pre';
		$config['next_link'] = 'Next';
		$config['num_links'] = 1;
		 $this->pagination->initialize($config);
		$db_data['pagination2']=$this->pagination->create_links();
		//-------- end mobile pagination
		$db_data['total_record']=$total_rows;
		$db_data['page']=$page;
		$db_data['limit']=$limit;
		$db_data['config_info']=$this->home_model->get_config();
		$game_list=$this->home_model->get_games($start,$limit);
		
		
		
		
		if(!$game_list) redirect('');
		$db_data['game_list']=$game_list;
		$db_data['featured_posts']=$this->home_model->get_featured_post();
		$db_data['top_games']=$this->home_model->get_topgames();
		$data['config_info'] = $db_data['config_info'];
		$db_data['quiz_type']='';
		$data['content'] = $this->load->view($this->template.'/home/home',$db_data,true);
		$data['page_title'] = $db_data['config_info']->site_title;
		$data['page_description'] = $db_data['config_info']->page_description;
		$data['meta_url'] = site_url();
		$data['meta_img'] = base_url()."assets/img/meta_img/".$db_data['config_info']->meta_img;
		$data['fb_meta_description'] = $db_data['config_info']->share_des;
		
		//---------
		$id="";
		if(isset($_GET['r'])) $id=$_GET['r'];
		if($id)
		{
			$res=$this->home_model->get_agechecker_result($id);
			
			if($res)
			{
				$data['meta_img'] = site_url().$res->image_name;
				$data['meta_title'] ="Let us guess your age using your photo";
				$data['fb_meta_description'] = "Let us guess your age using your photo";
				$data['meta_url'] = base_url()."?r=".$id;
				
				list($meta_img_width,$meta_img_height)=getimagesize($res->image_name);
				$data['meta_img_width']=$meta_img_width;
				$data['meta_img_height']=$meta_img_height;
			}
		}
		$data['cur_page'] ="home";
		$data['active_menu']='home';
		$this->load->view($this->template.'/layout/home_default',$data);   

	}
	
	function games($page=0)
	{	
		//echo $this->template; exit;
        $total_rows = $this->home_model->get_total_games('games');	
		if($total_rows == 0)
		{
			redirect("http://survley.com/");
		} 
		$limit=18;
		if($page == 0) $start=$page * $limit;
		else $start=($page -1) * $limit;
		$this->load->library('pagination');
		//echo $start;
		$config['use_page_numbers'] =TRUE;
		$config['uri_segment'] = 2;
		$config['num_links'] = 7;
        $config['base_url'] = site_url()."personality_quizz.html";
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $limit;
        $this->pagination->initialize($config);
		$db_data['pagination']=$this->pagination->create_links();
		//------- this is for mobile pagination
		$config['prev_link'] = 'Pre';
		$config['next_link'] = 'Next';
		$config['num_links'] = 1;
		 $this->pagination->initialize($config);
		$db_data['pagination2']=$this->pagination->create_links();
		//-------- end mobile pagination
		$db_data['total_record']=$total_rows;
		$db_data['page']=$page;
		$db_data['limit']=$limit;
		$db_data['config_info']=$this->home_model->get_config();
		$game_list=$this->home_model->get_games($start,$limit,'games');

		$db_data['game_list']=$game_list;
		$db_data['featured_posts']=$this->home_model->get_featured_post();
		$db_data['top_games']=$this->home_model->get_topgames();
		$data['config_info'] = $db_data['config_info'];
		$db_data['quiz_type']='PERSONALITY QUIZ';
		$data['content'] = $this->load->view($this->template.'/home/home',$db_data,true);
		$data['page_title'] = $db_data['config_info']->site_title;
		$data['page_description'] = $db_data['config_info']->page_description;
		$data['meta_url'] = $db_data['config_info']->facebook_url;
		$data['meta_img'] = base_url()."assets/img/meta_img/".$db_data['config_info']->meta_img;
		$data['fb_meta_description'] = $db_data['config_info']->share_des;
		$data['cur_page'] ="games";
		$data['active_menu']='home';
		$this->load->view($this->template.'/layout/home_default',$data);   

	}

	
	function lists($page=0)
	{	
		//echo $this->template; exit;
        $total_rows = $this->home_model->get_total_games('lists');	
		if($total_rows == 0)
		{
			redirect("");
		} 
		$limit=18;
		if($page == 0) $start=$page * $limit;
		else $start=($page -1) * $limit;
		$this->load->library('pagination');
		//echo $start;
		$config['use_page_numbers'] =TRUE;
		$config['uri_segment'] = 2;
		$config['num_links'] = 7;
        $config['base_url'] = site_url()."personality_quizz.html";
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $limit;
        $this->pagination->initialize($config);
		$db_data['pagination']=$this->pagination->create_links();
		//------- this is for mobile pagination
		$config['prev_link'] = 'Pre';
		$config['next_link'] = 'Next';
		$config['num_links'] = 1;
		 $this->pagination->initialize($config);
		$db_data['pagination2']=$this->pagination->create_links();
		//-------- end mobile pagination
		$db_data['total_record']=$total_rows;
		$db_data['page']=$page;
		$db_data['limit']=$limit;
		$db_data['config_info']=$this->home_model->get_config();
		$game_list=$this->home_model->get_games($start,$limit,'lists');

		$db_data['game_list']=$game_list;
		$db_data['featured_posts']=$this->home_model->get_featured_post();
		$db_data['top_games']=$this->home_model->get_topgames();
		$data['config_info'] = $db_data['config_info'];
		$db_data['quiz_type']='LIST';
		$data['content'] = $this->load->view($this->template.'/home/home',$db_data,true);
		$data['page_title'] = $db_data['config_info']->site_title;
		$data['page_description'] = $db_data['config_info']->page_description;
		$data['meta_url'] = $db_data['config_info']->facebook_url;
		$data['meta_img'] = base_url()."assets/img/meta_img/".$db_data['config_info']->meta_img;
		$data['fb_meta_description'] = $db_data['config_info']->share_des;
		$data['cur_page'] ="lists";
		$data['active_menu']='home';
		$this->load->view($this->template.'/layout/home_default',$data);   

	}


function articles($page=0)
	{	
		//echo $this->template; exit;
        $total_rows = $this->home_model->get_total_games('articles');	
		if($total_rows == 0)
		{
			redirect("");
		} 
		$limit=18;
		if($page == 0) $start=$page * $limit;
		else $start=($page -1) * $limit;
		$this->load->library('pagination');
		//echo $start;
		$config['use_page_numbers'] =TRUE;
		$config['uri_segment'] = 2;
		$config['num_links'] = 7;
        $config['base_url'] = site_url()."personality_quizz.html";
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $limit;
        $this->pagination->initialize($config);
		$db_data['pagination']=$this->pagination->create_links();
		//------- this is for mobile pagination
		$config['prev_link'] = 'Pre';
		$config['next_link'] = 'Next';
		$config['num_links'] = 1;
		 $this->pagination->initialize($config);
		$db_data['pagination2']=$this->pagination->create_links();
		//-------- end mobile pagination
		$db_data['total_record']=$total_rows;
		$db_data['page']=$page;
		$db_data['limit']=$limit;
		$db_data['config_info']=$this->home_model->get_config();
		$game_list=$this->home_model->get_games($start,$limit,'articles');

		$db_data['game_list']=$game_list;
		$db_data['featured_posts']=$this->home_model->get_featured_post();
		$db_data['top_games']=$this->home_model->get_topgames();
		$data['config_info'] = $db_data['config_info'];
		$db_data['quiz_type']='ARTICLE';
		$data['content'] = $this->load->view($this->template.'/home/home',$db_data,true);
		$data['page_title'] = $db_data['config_info']->site_title;
		$data['page_description'] = $db_data['config_info']->page_description;
		$data['meta_url'] = $db_data['config_info']->facebook_url;
		$data['meta_img'] = base_url()."assets/img/meta_img/".$db_data['config_info']->meta_img;
		$data['fb_meta_description'] = $db_data['config_info']->share_des;
		$data['cur_page'] ="articles";
		$data['active_menu']='home';
		$this->load->view($this->template.'/layout/home_default',$data);   

	}

	function videos($page=0)
	{	
		//echo $this->template; exit;
        $total_rows = $this->home_model->get_total_games('videos');	
		if($total_rows == 0)
		{
			redirect("");
		} 
		$limit=18;
		if($page == 0) $start=$page * $limit;
		else $start=($page -1) * $limit;
		$this->load->library('pagination');
		//echo $start;
		$config['use_page_numbers'] =TRUE;
		$config['uri_segment'] = 2;
		$config['num_links'] = 7;
        $config['base_url'] = site_url()."personality_quizz.html";
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $limit;
        $this->pagination->initialize($config);
		$db_data['pagination']=$this->pagination->create_links();
		//------- this is for mobile pagination
		$config['prev_link'] = 'Pre';
		$config['next_link'] = 'Next';
		$config['num_links'] = 1;
		 $this->pagination->initialize($config);
		$db_data['pagination2']=$this->pagination->create_links();
		//-------- end mobile pagination
		$db_data['total_record']=$total_rows;
		$db_data['page']=$page;
		$db_data['limit']=$limit;
		$db_data['config_info']=$this->home_model->get_config();
		$game_list=$this->home_model->get_games($start,$limit,'videos');

		$db_data['game_list']=$game_list;
		$db_data['featured_posts']=$this->home_model->get_featured_post();
		$db_data['top_games']=$this->home_model->get_topgames();
		$data['config_info'] = $db_data['config_info'];
		$db_data['quiz_type']='VIDEO';
		$data['content'] = $this->load->view($this->template.'/home/home',$db_data,true);
		$data['page_title'] = $db_data['config_info']->site_title;
		$data['page_description'] = $db_data['config_info']->page_description;
		$data['meta_url'] = $db_data['config_info']->facebook_url;
		$data['meta_img'] = base_url()."assets/img/meta_img/".$db_data['config_info']->meta_img;
		$data['fb_meta_description'] = $db_data['config_info']->share_des;
		$data['cur_page'] ="videos";
		$data['active_menu']='home';
		$this->load->view($this->template.'/layout/home_default',$data);   

	}


	function top_backup($page=0)

	{

	

		$this->home_model->create_temp_test_table();

		$games=$this->home_model->get_all_games();

		$arr=array();

		foreach($games as $game)

		{

			$source_url =base_url().$game->alias.".html";

			//$source_url ="http://www.survley.com".$game->alias.".html";

			//echo "<br/>";

			$total=0;

			$url = "http://api.facebook.com/restserver.php?method=links.getStats&urls=".urlencode($source_url);

			$xml = file_get_contents($url);

			$xml = simplexml_load_string($xml);

			$shares = $xml->link_stat->share_count;

			$likes = $xml->link_stat->like_count;

			$comments = $xml->link_stat->comment_count;

			$total = $xml->link_stat->total_count;

			$max = max($shares,$likes,$comments);

			

			//echo $source_url." like ".$total;

			//echo "<br>";

			$arr[$game->alias]=$total;

			$test_info=array();

			$test_info['tests_id']=$game->tests_id;

			$test_info['category_id']=$game->category_id;

			$test_info['title']=$game->title;

			$test_info['page_title']=$game->page_title;

			$test_info['alias']=$game->alias;

			$test_info['description']=$game->description;

			$test_info['result_text']=$game->result_text;

			$test_info['start_point']=$game->start_point;

			$test_info['fbshare_des']=$game->fbshare_des;

			$test_info['add_sense_top']=$game->add_sense_top;

			$test_info['add_sense_bottom']=$game->add_sense_bottom;

			$test_info['adsense_result_page']=$game->adsense_result_page;

			$test_info['question']=$game->question;

			$test_info['answer']=$game->answer;

			$test_info['fun']=$game->fun;

			$test_info['enjoy_and_share']=$game->enjoy_and_share;

			$test_info['direct_start']=$game->direct_start;

			$test_info['status']=$game->status;

			$test_info['created']=$game->created;

			$test_info['image']=$game->image;

			$test_info['google_analytics']=$game->google_analytics;

			$test_info['popup_box_text']=$game->popup_box_text;			

			$test_info['fb_like']=$total;

			

			$this->home_model->add_test_into_temp_tbl($test_info);

		}

		

		/*$max_like = max($arr);

		$tests_alias="";

		foreach ($arr as $key => $val)

		{

			if($val == $max_like) $tests_alias=$key;

			

		}*/

		

		//echo $tests_alias;

		//----- display top ranking test

		

		$total_rows = $this->home_model->get_total_topgames();

		$limit=12;

		if($page == 0) $start=$page * $limit;

		else $start=($page -1) * $limit;

		$this->load->library('pagination');

		//echo $start;

		$config['use_page_numbers'] =TRUE;

		$config['uri_segment'] = 3;

		$config['num_links'] = 7;

        $config['base_url'] = site_url()."top/page";

        $config['total_rows'] = $total_rows;

        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

		$db_data['pagination']=$this->pagination->create_links();

		$db_data['total_record']=$total_rows;

		$db_data['page']=$page;

		$db_data['limit']=$limit;

		

		$db_data['config_info']=$this->home_model->get_config();

		$game_list=$this->home_model->get_top_games($start,$limit);

		if(!$game_list) redirect('');

		$db_data['game_list']=$game_list;

		

		$data['config_info'] = $db_data['config_info'];

		$data['content'] = $this->load->view('home/home',$db_data,true);

		$data['page_title'] = $db_data['config_info']->site_title;
		$data['page_description'] = $db_data['page_description']->site_title;

		$data['meta_url'] = $db_data['config_info']->facebook_url;

		$data['fb_meta_description'] = $db_data['config_info']->share_des;

		$data['cur_page'] ="";

		$data['active_menu']='top';

		$this->load->view('layout/default',$data); 

		

		/*$db_data['config_info']=$this->home_model->get_config();

		$db_data['game_list']=$this->home_model->get_top_game($tests_alias);

		

		$data['config_info'] = $db_data['config_info'];

		$data['content'] = $this->load->view('home/top_test',$db_data,true);

		$data['page_title'] = $db_data['config_info']->site_title;

		$data['meta_url'] = $db_data['config_info']->facebook_url;

		$data['fb_meta_description'] = $db_data['config_info']->share_des;

		

		$data['active_menu']='top';

		$this->load->view('layout/default',$data); */

		

	}

	

	function top($page=0)

	{

	

		$total_rows = $this->home_model->get_total_games();

		$limit=12;

		if($page == 0) $start=$page * $limit;

		else $start=($page -1) * $limit;

		$this->load->library('pagination');

		//echo $start;

		$config['use_page_numbers'] =TRUE;

		$config['uri_segment'] = 3;

		$config['num_links'] = 7;

        $config['base_url'] = site_url()."top/page";

        $config['total_rows'] = $total_rows;

        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

		

		$db_data['pagination']=$this->pagination->create_links();

		

		//------- this is for mobile pagination

		$config['prev_link'] = 'Pre';

		$config['next_link'] = 'Next';

		$config['num_links'] = 1;

		 $this->pagination->initialize($config);

		$db_data['pagination2']=$this->pagination->create_links();

		//-------- end mobile pagination

		$db_data['total_record']=$total_rows;

		$db_data['page']=$page;

		$db_data['limit']=$limit;

		

		$db_data['config_info']=$this->home_model->get_config();

		$game_list=$this->home_model->get_games_ranking($start,$limit);

		if(!$game_list) redirect('');

		$db_data['game_list']=$game_list;

		$db_data['ref_page']="top";

		$data['config_info'] = $db_data['config_info'];

		
		$db_data['quiz_type']='TOP';
		$data['content'] = $this->load->view('home/home',$db_data,true);

		$data['page_title'] = $db_data['config_info']->site_title;
		$data['page_description'] = $db_data['page_description']->site_title;

		$data['meta_url'] = $db_data['config_info']->facebook_url;

		$data['meta_img'] = base_url()."assets/img/meta_img/".$db_data['config_info']->meta_img;

		$data['fb_meta_description'] = $db_data['config_info']->share_des;

		$data['cur_page'] ="top";

		$data['active_menu']='top';

		$this->load->view('layout/home_default',$data); 

		

	}

	

	function genarate_fb_test_ranking()

	{

	

		

		$games=$this->home_model->get_all_games();

		

		foreach($games as $game)

		{

			$source_url =base_url().$game->alias.".html";

			//$source_url ="http://www.survley.com".$game->alias.".html";

			//echo "<br/>";

			$total=0;

			$url = "http://api.facebook.com/restserver.php?method=links.getStats&urls=".urlencode($source_url);

			$xml = file_get_contents($url);

			$xml = simplexml_load_string($xml);

			$shares = $xml->link_stat->share_count;

			$likes = $xml->link_stat->like_count;

			$comments = $xml->link_stat->comment_count;

			$total = $xml->link_stat->total_count;

			

			

			//echo $source_url." like ".$total;

			//echo "<br>";

			

			$test_info=array();

			

			$test_info['fb_like']=$total;

			

			$this->home_model->fb_test_save($test_info,$game->tests_id);

		}



		

		



		

	}

	

	function category($category,$page=0)

	{	



		

		$cat_id=$this->home_model->get_cat_id($category);

        $total_rows = $this->home_model->get_total_games($cat_id);

		$limit=6;

		$this->load->library('pagination');

		$config['uri_segment'] = 2;

		$config['num_links'] = 7;

        $config['base_url'] = site_url().'page';

        $config['total_rows'] = $total_rows;

        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

		$db_data['pagination']=$this->pagination->create_links();

		$db_data['total_record']=$total_rows;

		$db_data['page']=$page;

		$db_data['limit']=$limit;

		

		$db_data['config_info']=$this->home_model->get_config();

		$db_data['game_list']=$this->home_model->get_games($page,$limit,$cat_id);

		

		$data['config_info'] = $db_data['config_info'];

		$data['content'] = $this->load->view('home/home',$db_data,true);

		$data['page_title'] = $db_data['config_info']->site_title;
		$data['page_description'] = $db_data['page_description']->site_title;

		$data['meta_url'] = $db_data['config_info']->facebook_url;

		$data['fb_meta_description'] = $db_data['config_info']->share_des;

		

		$data['cur_page'] ="category";

		$data['active_menu']='category';

		$data['active_sub_menu']=$category;

		$this->load->view('layout/default',$data);   

	}

	

	function random()

	{

		$sql="SELECT 		*  FROM 	tests  where status=1 and lang_code='".$this->session->userdata('lang_code')."' ORDER BY RAND( )  LIMIT 1"; 

		//exit;

		$query=$this->db->query($sql);

		$res=$query->row();

		

		$url=site_url().$res->alias.".html";
		//echo $url; exit;
		//redirect($url);

		$this->view($res->alias,'random');

	}

	

	

	function view($tests_alias,$active_menu='')

	{	
		$this->session->set_userdata('question_answers',array());
		$this->session->set_userdata('test_result','');
		$tests_alias=urldecode($tests_alias); 
		//echo $this->template; exit;
		//echo $tests_alias; exit;

        $db_data=array();

		$db_data['config_info']=$this->home_model->get_config();
		

		$tests_info=$this->home_model->get_game($tests_alias);

		if(!$tests_info) redirect(site_url().'not-found.html'); 

		$db_data['tests_info']=$tests_info;

		if($db_data['tests_info']->direct_start == 1) redirect(site_url()."start/".$tests_alias.".html");

		$db_data['question_num']=1;
		$db_data['questions']=$this->home_model->get_questions($db_data['tests_info']->testid);

		if(!empty($_GET['ref_page']) && $_GET['ref_page'] == 'top') $db_data['ref_page']="top";
		
		
		if($tests_info->is_real_test == 2)
		{
			$db_data['ads_info']=$this->home_model->get_ads_unique('twist');
			$data['content'] = $this->load->view($this->template.'/home/twist_tests_view',$db_data,true);
		}
		else if($tests_info->is_real_test == 3)
		{
			$db_data['ads_info']=$this->home_model->get_ads_unique('3apps');
			$db_data['more_games']=$this->home_model->get_randon_lists('games',13,$tests_info->tests_id,3);
			$data['content'] = $this->load->view($this->template.'/home/3apps_tests_view',$db_data,true);
		}
		
		else if($tests_info->is_real_test == 4)
		{
			$db_data['ads_info']=$this->home_model->get_ads_unique('how_old');
			$data['content'] = $this->load->view($this->template.'/home/how_old_view',$db_data,true);
		}
		else if($tests_info->is_real_test == 5)
		{
			$db_data['ads_info']=$this->home_model->get_ads_unique('face_test');
			$data['content'] = $this->load->view($this->template.'/home/face_test_view',$db_data,true);
		}
		
		else if($tests_info->is_real_test == 6)
		{
			$db_data['ads_info']=$this->home_model->get_ads_unique('facebook_apps');
			$data['content'] = $this->load->view($this->template.'/home/facebook_apps_test_view',$db_data,true);
		}
		
		else
		{
			$data['content'] = $this->load->view($this->template.'/home/tests_view',$db_data,true);
		}
		

		$data['config_info'] = $db_data['config_info'];
		$data['page_description'] = $db_data['config_info']->page_description;

		//----- this is for breadcrumbs

		/*$breadcrumbs['breadcrumbs'][]=array('text'=>'Dashboard','href'=>site_url());

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Overview','href'=>'');

		$data['breadcrumbs']=$this->load->view('layout/breadcrumbs',$breadcrumbs,true);*/	

		//------- end breadcrumbs

		

		$data['page_title'] = $db_data['tests_info']->page_title;

		$data['meta_img'] = base_url()."assets/img/image/".$db_data['tests_info']->image;

		$data['meta_url'] = base_url().$db_data['tests_info']->alias.".html";

		$data['fb_meta_description'] = $db_data['tests_info']->description;
		$result_id="";
		if(isset($_GET['r'])) $result_id=$_REQUEST['r'];
		if($result_id)
		{
			$visitor_result=$this->home_model->get_visitor_result($result_id);
			$data['meta_title'] ="I Got ".$visitor_result." ".$db_data['tests_info']->title;
			$data['fb_meta_description'] = "Well done! We got you on a few, but you really know your skylines.";
			$data['meta_url'] = base_url().$db_data['tests_info']->alias.".html?r=".$result_id;
		}
		//$data['page_title'] ="Testing.......";

		if(!empty($_GET['ref_page']) && $_GET['ref_page'] == 'top') $data['active_menu']='top';

		else $data['active_menu']='';

		$data['cur_page'] ="view";

		if($active_menu) $data['active_menu']=$active_menu;

		$this->load->view($this->template.'/layout/default',$data);   

	}

	

	function view_3apps_result($tests_alias,$result_id='',$active_menu='')
	{	
		if($result_id)
		{
			$tests_alias=urldecode($tests_alias); 
			$db_data=array();
			$db_data['config_info']=$this->home_model->get_config();
			$tests_info=$this->home_model->get_game($tests_alias);
			if(!$tests_info) redirect(site_url().'not-found.html'); 
			$db_data['tests_info']=$tests_info;
			
			$db_data['more_games']=$this->home_model->get_randon_lists($post_type='games',13,$tests_info->tests_id,3);
			$db_data['top_games']=$this->home_model->get_topgames();
			
			
		
			$res_arr=explode("_",$result_id);
			$offsets=count($res_arr);
			if($offsets == 3)
			{
				$name=$res_arr[0]."_".$res_arr[1];
				$res_id=$res_arr[2];
			}
			else
			{
				$name=$res_arr[0];
				$res_id=$res_arr[1];
			}
			
				
			$db_data['name']=$name;
			$db_data['result_id']=$res_id;
			
			
			if(!empty($_GET['ref_page']) && $_GET['ref_page'] == 'top') $db_data['ref_page']="top";
			if($this->session->userdata('result_page') && $this->session->userdata('result_page') == 'yes')
			{
				$data['content'] = $this->load->view($this->template.'/home/3apps_result_view',$db_data,true);
				$this->session->set_userdata('result_page', '');
			}
			else
			{
				$data['content'] = $this->load->view($this->template.'/home/3apps_tests_view',$db_data,true);
			}
			
			$data['config_info'] = $db_data['config_info'];
			$data['page_description'] = $db_data['config_info']->page_description;
			
			$data['meta_img_width']="742";
			$data['meta_img_height']="389";
			$data['meta_img'] = site_url()."home/create_image/".$name."/".$res_id."/".$tests_info->alias;
			$data['meta_title'] ="Find out now ".strtolower(str_replace("?","!",$db_data['tests_info']->title));
			$data['fb_meta_description'] = $db_data['tests_info']->title;
			$data['meta_url'] = base_url().$db_data['tests_info']->alias."/".$result_id.".html";
			
			//$data['page_title'] ="Testing.......";
			if(!empty($_GET['ref_page']) && $_GET['ref_page'] == 'top') $data['active_menu']='top';
			else $data['active_menu']='';
			$data['cur_page'] ="view";
			if($active_menu) $data['active_menu']=$active_menu;
			$this->load->view($this->template.'/layout/default',$data); 
		}  
	}

	

	function start($tests_alias)

	{	//echo $tests_alias;exit;
		$tests_alias=urldecode($tests_alias);
		$this->session->set_userdata('question_answers',array());
		$this->session->set_userdata('test_result','');

        $db_data=array();

		$db_data['config_info']=$this->home_model->get_config();

		$tests_info=$this->home_model->get_game($tests_alias);

		if(!$tests_info) redirect(site_url().'not-found.html'); 

		$db_data['tests_info']=$tests_info;

		//print_r($tests_info);

		$db_data['question_num']=1;

		$db_data['questions']=$this->home_model->get_questions($db_data['tests_info']->testid);

		

		/*echo "<pre>";

		print_r($db_data['questions']); exit;*/

		

		if(!empty($_GET['ref_page']) && $_GET['ref_page'] == 'top') $db_data['ref_page']="top";

		$data['content'] = $this->load->view($this->template.'/home/test_start',$db_data,true);

		

		$data['page_title'] = $db_data['tests_info']->page_title;

		$data['meta_img'] = base_url()."assets/img/image/".$db_data['tests_info']->image;

		$data['meta_url'] = site_url()."start/".$db_data['tests_info']->alias.".html";

		$data['fb_meta_description'] = $db_data['tests_info']->description;

		if(!empty($_GET['ref_page']) && $_GET['ref_page'] == 'top') $data['active_menu']='top';

		else $data['active_menu']='';

		$data['config_info'] = $db_data['config_info'];

		$data['cur_page'] ="questions";

		//echo "I am here";

		$this->load->view($this->template.'/layout/default',$data);   

	}

	

	function question($alias='',$question='')

	{

		if($alias) $alias=urldecode($alias);
		$db_data=array();
		$question=(int)$question;

		//$this->session->set_userdata('question_answers',array());
		//$this->session->set_userdata('test_result','');

		if($this->input->post('test_alias')) $tests_alias=$this->input->post('test_alias');
		else if($alias)  $tests_alias=$alias;
		else redirect(site_url().'not-found.html'); 	

		if($this->input->post('next_question_num')) $question_num=$this->input->post('next_question_num');
		else if($question) $question_num=$question;
		else redirect(site_url().'not-found.html');      

	   //echo $question_num;

		$db_data['config_info']=$this->home_model->get_config();
		$tests_info=$this->home_model->get_game($tests_alias);
		if(!$tests_info) redirect(site_url().'not-found.html'); 

		$db_data['tests_info']=$tests_info;
		$db_data['question_num']=$question_num;
		$db_data['questions']=$this->home_model->get_questions($db_data['tests_info']->testid);
		$total_question=count($db_data['questions']); 
		//echo $total_question; exit;

		//-------- record answer

		if($this->input->post('test_id'))
		{ 
			$this->record_answer();
		} 

		if($total_question < $question_num) 
		{ 
			redirect(site_url().'result/'.$tests_alias.".html");
			
		}

		$data['content'] = $this->load->view($this->template.'/home/test_start',$db_data,true);		
		$data['page_title'] = $db_data['tests_info']->page_title;
		$data['meta_img'] = base_url()."assets/img/image/".$db_data['tests_info']->image;
		$data['meta_url'] = site_url()."start/".$db_data['tests_info']->alias.".html";
		$data['fb_meta_description'] = $db_data['tests_info']->description;
		$data['active_menu']='';
		$data['config_info'] = $db_data['config_info'];
		$data['cur_page'] ="questions";
		$this->load->view($this->template.'/layout/default',$data); 

	}

	

	function result($tests_alias)

	{	
		$tests_alias=urldecode($tests_alias);
		//echo $this->session->userdata('test_result'); exit;		

		//if( $this->session->userdata('test_result') =='') redirect($tests_alias.'.html');

		

		if($this->session->userdata('test_result') || $this->session->userdata('test_result') =='0' ) 

		{

			$db_data['config_info']=$this->home_model->get_config();

			$db_data['config_info']=$this->home_model->get_config();

			$tests_info=$this->home_model->get_game($tests_alias);

			if(!$tests_info) redirect(site_url().'not-found.html'); 

			$db_data['tests_info']=$tests_info;

			//echo $db_data['tests_info']->testid; exit;

			$db_data['result_options']=$this->home_model->get_result_options($db_data['tests_info']->testid);		

			

			if(!empty($_GET['ref_page']) && $_GET['ref_page'] == 'top') $db_data['ref_page']="top";

			

			if($tests_info->is_real_test == 1)

			{

				$db_data['questions']=$this->home_model->get_questions($tests_info->testid);

				$data['content'] = $this->load->view($this->template.'/home/test_result_new',$db_data,true);

			}
			
			else

			{

				$data['content'] = $this->load->view($this->template.'/home/test_result',$db_data,true);

			}

			

			

			

			

			$data['page_title'] = $db_data['tests_info']->page_title;

			$data['meta_img'] = base_url()."assets/img/image/".$db_data['tests_info']->image;

			$data['meta_url'] = site_url().$db_data['tests_info']->alias.".html";

			$data['fb_meta_description'] = $db_data['tests_info']->description;

			if(!empty($_GET['ref_page']) && $_GET['ref_page'] == 'top') $data['active_menu']='top';

			else $data['active_menu']='';

			$data['cur_page'] ="result";

			$data['config_info'] = $db_data['config_info'];

			$this->load->view($this->template.'/layout/default',$data); 

		}

		else

		{

			redirect(site_url().$tests_alias.'.html');

		}  

	}

	function ajax_twist_result($tests_alias)
	{	
			$db_data['config_info']=$this->home_model->get_config();
			$tests_info=$this->home_model->get_game($tests_alias);
			if(!$tests_info) redirect(site_url().'not-found.html'); 
			$db_data['tests_info']=$tests_info;
			$db_data['result_options']=$this->home_model->get_result_options($db_data['tests_info']->testid);		


			//------------- insert result into db
				$final_score=($this->session->userdata('test_result')) + ($tests_info->start_point);
				$final_score=($this->session->userdata('test_result')) + ($tests_info->start_point);
				$resut_des="";	
				$result_img="";	
				$grad="";
				$result="";
				if($db_data['result_options'])
				{
					foreach($db_data['result_options'] as $result_option)
					{
						if($final_score >= $result_option->interval_from && $final_score <= $result_option->interval_to)
						{
							$result=$result_option->result;
							$resut_des=$result_option->result_description;
							$result_img=$result_option->test_result_img;
						}

					}

				}
				
				if($final_score <= 2)
				{
					$grad="C+";
				}
				elseif($final_score <= 5)
				{
					$grad="B+";
				}
				elseif($final_score >= 6)
				{
					$grad="A+";
				}
				
				$res_info['result_id']=$this->session->userdata('session_id').'q'.$tests_info->tests_id;
				$res_info['result']=$grad.", ".$result;
				$this->db->insert('visitor_results',$res_info);
				$data['res_id'] =$res_info['result_id'];
			//----
			$db_data['questions']=$this->home_model->get_questions($tests_info->testid);
			$content = $this->load->view($this->template.'/home/ajax_twist_result',$db_data,true);

			$data['res']=$content;
			echo json_encode($data);
		
 

	}
	function ajax_3apps_result()
	{	
		if($this->input->post('generate_result'))
		{
			$name=$this->input->post('name');
			$test_alias=$this->input->post('test_alias');
			$slug=$this->input->post('slug');

			
			$res_id=$this->input->post('res_id');
			$test_id=$this->input->post('test_id');
			
			$result_info=$this->home_model->get_result_option($res_id);
			
			$slug_info=$this->home_model->generate_slug($test_alias,$slug);
			//------------ insert db
			$res_info['slug']=$slug_info['slug'];
			$res_info['slug_stat']=$slug_info['slug_stat'];
			$res_info['result']=$name;
			$res_info['added']=date('Y-m-d');
			$this->db->insert('3apps_visitor_result',$res_info);
			//----------------- end db
			$db_data['name']=$name;
			$db_data['result_id']=$result_info->result_option_id;
			

			$data['res_id'] =$slug_info['slug']."_".$result_info->result_option_id.".html";
			// --------
			
			//$data['res']=$this->load->view($this->template.'/home/ajax_result',$db_data,true);
			$this->session->set_userdata('result_page','yes');
			echo json_encode($data);
		}
		 

	}
	function record_answer()

	{

		$question_id=$this->input->post('question_id');

		$answer_id=$this->input->post('answer_id');

		$marks=$this->input->post('marks');

		$answer=new stdClass;

		$answer->question_id=$question_id;

		$answer->answer_id=$answer_id;

		$answer->marks=$marks;

		$total_marks=0;

		//echo "I am here";exit;

		if($this->session->userdata('question_answers'))

		{

			$old_answers=array();

			foreach($this->session->userdata('question_answers') as $row)

			{

				$old_answers[]=$row;	

				$total_marks+=$row->marks;

			}

			$old_answers[]=$answer;

		}

		else

		{

			$old_answers=array();

			$old_answers[]=$answer;

		}

		$total_marks+=$marks;

		$this->session->set_userdata('question_answers',$old_answers);

		$this->session->set_userdata('test_result',$total_marks);

		

		//echo $question_id; 

		//$arr

	}

	

	function privacy_policy()

	{

		

		$db_data=array();

		$db_data['config_info']=$this->home_model->get_config();

		$data['content'] = $this->load->view($this->template.'/home/privacy_policy',$db_data,true);

		$data['config_info'] = $db_data['config_info'];

		$data['page_title'] = $db_data['config_info']->site_title;
		$data['page_description'] = $db_data['config_info']->page_description;

		$data['meta_url'] = $db_data['config_info']->facebook_url;

		$data['fb_meta_description'] = $db_data['config_info']->share_des;

		

		$data['active_menu']='';

		$data['cur_page'] ="privacy";

		$data['config_info'] = $db_data['config_info'];

		$this->load->view($this->template.'/layout/default',$data); 

	}

	

	function not_found()

	{ 	

		$db_data=array();

		$db_data['config_info']=$this->home_model->get_config();		

		$data['content'] = $this->load->view($this->template.'/home/not_found',$db_data,true);

		$data['active_menu']='';

		$data['cur_page'] ="notfound";

		$data['config_info'] = $db_data['config_info'];

		$this->load->view($this->template.'/layout/default',$data); 

	}
	
	function list_view($tests_alias,$active_menu='')
	{
		$tests_alias=urldecode($tests_alias);
		$db_data=array();
		$db_data['config_info']=$this->home_model->get_config();
		
		$tests_info=$this->home_model->get_game($tests_alias);
		if(!$tests_info) redirect(site_url().'not-found.html'); 
		$db_data['tests_info']=$tests_info;
		
		$is_slider=get_testMeta($tests_info->tests_id,'is_slider');
		if($is_slider == 1)
		{
			$data['content'] = $this->load->view($this->template.'/home/list_slider_view',$db_data,true);
		}
		else
		{
			$data['content'] = $this->load->view($this->template.'/home/list_view',$db_data,true);
		}
		
		
		$data['config_info'] = $db_data['config_info'];
		$data['page_title'] = $db_data['tests_info']->page_title;
		$data['page_description'] = $db_data['config_info']->page_description;
		$data['meta_img'] = base_url()."assets/img/image/".$db_data['tests_info']->image;
		$data['meta_url'] = base_url()."list/".$db_data['tests_info']->alias.".html";
		$data['fb_meta_description'] = $db_data['tests_info']->fbshare_des;
		//$data['page_title'] ="Testing.......";

		if(!empty($_GET['ref_page']) && $_GET['ref_page'] == 'top') $data['active_menu']='top';
		else $data['active_menu']='';
		$data['cur_page'] ="list view";
		if($active_menu) $data['active_menu']=$active_menu;
		$this->load->view($this->template.'/layout/list_default',$data); 
	}

	

	function article($tests_alias,$active_menu='')
	{
		$tests_alias=urldecode($tests_alias); 
		$db_data=array();
		$db_data['config_info']=$this->home_model->get_config();
		
		
		$tests_info=$this->home_model->get_game($tests_alias);
		if(!$tests_info) redirect(site_url().'not-found.html'); 
		$db_data['tests_info']=$tests_info;
		

		
		$data['content'] = $this->load->view($this->template.'/home/article_view',$db_data,true);
		$data['config_info'] = $db_data['config_info'];
		$data['page_title'] = $db_data['tests_info']->page_title;
		$data['page_description'] = $db_data['config_info']->page_description;
		$data['meta_img'] = base_url()."assets/img/image/".$db_data['tests_info']->image;
		$data['meta_url'] = base_url()."article/".$db_data['tests_info']->alias.".html";
		$data['fb_meta_description'] = $db_data['tests_info']->fbshare_des;
		//$data['page_title'] ="Testing.......";

		if(!empty($_GET['ref_page']) && $_GET['ref_page'] == 'top') $data['active_menu']='top';
		else $data['active_menu']='';
		$data['cur_page'] ="article view";
		if($active_menu) $data['active_menu']=$active_menu;
		$this->load->view($this->template.'/layout/list_default',$data); 
	}

	function video($tests_alias,$active_menu='')
	{
		$tests_alias=urldecode($tests_alias);
		$db_data=array();
		$db_data['config_info']=$this->home_model->get_config();
		$tests_info=$this->home_model->get_game($tests_alias);
		if(!$tests_info) redirect(site_url().'not-found.html'); 
		$db_data['tests_info']=$tests_info;
		

		
		$data['content'] = $this->load->view($this->template.'/home/video_view',$db_data,true);
		$data['config_info'] = $db_data['config_info'];
		$data['page_title'] = $db_data['tests_info']->page_title;
		$data['page_description'] = $db_data['config_info']->page_description;
		$data['meta_img'] = base_url()."assets/img/image/".$db_data['tests_info']->image;
		$data['meta_url'] = base_url()."videos/".$db_data['tests_info']->alias.".html"; 
		$data['fb_meta_description'] =$db_data['tests_info']->fbshare_des;
		//$data['page_title'] ="Testing.......";

		if(!empty($_GET['ref_page']) && $_GET['ref_page'] == 'top') $data['active_menu']='top';
		else $data['active_menu']='';
		$data['cur_page'] ="video view";
		if($active_menu) $data['active_menu']=$active_menu;
		$this->load->view($this->template.'/layout/list_default',$data); 
	}
	
	
	
	function ajax_load()
	{
		$limit=6;
		$page=$this->input->post('page_no');
		if($page == 0) $start=$page * $limit;
		else $start=($page -1) * $limit;
		
		
		$game_list=$this->home_model->get_games($start,$limit);
		//echo $this->db->last_query();
		$db_data['game_list']=$game_list;
		$data = $this->load->view($this->template.'/home/ajax_load',$db_data,true);
		echo $data;
	}
	
	function create_image($name='',$result_id=0,$test_alias)
	{
		

		//$name=strtoupper(str_replace("-"," ",$name));
		
		$name=$this->home_model->get_3apps_visitor_result($test_alias."/".$name);
		$name=strtoupper($name);
		$result_info=$this->home_model->get_result_option($result_id);
		
		$im =  imagecreatefrompng("assets/img/test_result_img/".$result_info->test_result_img);
		$white = imagecolorallocate($im, 255, 255, 255);
		
		$black = imagecolorallocatealpha($im, 0, 0, 0, 95);

		$string =$name;
		// try changing this as well
		$font_size = 30;
		$font = 'assets/fonts/Arial Regular.ttf';
		if($result_info->font_name)
		{
			$font = 'assets/fonts/google/'.$result_info->font_name;
		}
		
		//------- title
		
		$text_box=$this->calculateTextBox($name,$font,$font_size,0); 
		$text_width  = $text_box['width'];
		$text_height  = $text_box['height'];
		//echo $text_height; exit;
		$title_box_height=$text_height+24;
		imagefilledrectangle($im, 4, 4, 735, $title_box_height+5, $black);
		imagefilledrectangle($im, 4, 4, 735, $title_box_height, $white);
		
		// end title
	   list($o_width, $o_height) = getimagesize("assets/img/test_result_img/".$result_info->test_result_img);
	 	$x = floor(($o_width  - $text_width)/2); 
		$y = ($title_box_height) / 2 + $text_height/2;
		//$y-=6;
		//$y = ($title_box_height - $text_height)/2;
		
		//echo $y; exit;
		$color = imagecolorallocate ($im, 000, 000, 000);
		imagettftext($im, $font_size, 0, $x, $y, $color, $font, $string);
		
		$titel_y=$y+ ($text_height/2) + 30; 
		
		//------------ add result
		$result=$result_info->result;
		$font_size = 22;
		$text_box=$this->calculateTextBox($result,$font,$font_size,0); 
		$text_width  = $text_box['width'];
		$text_height  = $text_box['height'];
		$box_width=$text_width + 30;
		$x= floor(($o_width  - $box_width)/2); 
		$y = 98 + $text_height/2;
		$y = $titel_y + $text_height/2;
		$color = imagecolorallocate ($im, 255, 255, 255);
		$black = imagecolorallocate($im, 000, 000, 000);
		
		$result_box_y1=$title_box_height + 15;
		$result_box_height=$text_height + 20;
		$result_box_y2=$result_box_y1 + $result_box_height;
		
		imagefilledrectangle($im, $x, $result_box_y1, $x + $box_width, $result_box_y2, $black);
		imagettftext($im, $font_size, 0, $x+15, $y, $color, $font, $result);
		//-------- end resut
		
		//--------- result description
		$res_arr=explode(" ",$result_info->result_description);
		
		
		
		if(count($res_arr) > 0)
		{
			$font_size = 22;
			$color = imagecolorallocate ($im, 000, 000, 000);
			
			if($result_info->font_color)
			{

				$rgb=rtrim(substr(trim($result_info->font_color),4),')');
				list($r, $g, $b)=explode(",",$rgb);
				$color_code=1099;
				$color = imagecolorallocate ($im, trim($r), trim($g), trim($b));
			}
			$y=160;
			$x=10;
			$content_area= $o_width - 30;
			$line_str="";
			foreach($res_arr as $word)
			{
				$text_box=$this->calculateTextBox($word." ",$font,$font_size,0); 
				$text_width  = $text_box['width'];
				$text_height  = $text_box['height'];
				$line_str+=$word." ";
				if($x + $text_width >= $content_area)
				{ 
					$line_box=$this->calculateTextBox($line_str." ",$font,$font_size,0); 
					$text_height  = $line_box['height'];
					$y+=$text_height + 10;
					$x=10;
					$line_str="";
					
				}
				imagettftext($im, $font_size, 0, $x+15, $y, $color, $font, $word);
				$x+=$text_width;
				
			}
			
		}

		
		// Using imagepng() results in clearer text compared with imagejpeg()
		header('Content-Type: image/png');
		
		
		
		
		/*header("Content-Disposition: filename=bg2.png");
		header("Content-Type: image/png");
		header('Content-Transfer-Encoding: binary');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s', time()).' GMT');*/
		imagepng($im);
		imagedestroy($im);
	}
	
	
	
	function calculateTextBox($text,$fontFile,$fontSize,$fontAngle) 
	{
		/************
		simple function that calculates the *exact* bounding box (single pixel precision).
		The function returns an associative array with these keys:
		left, top:  coordinates you will pass to imagettftext
		width, height: dimension of the image you have to create
		*************/
		$rect = imagettfbbox($fontSize,$fontAngle,$fontFile,$text);
		$minX = min(array($rect[0],$rect[2],$rect[4],$rect[6]));
		$maxX = max(array($rect[0],$rect[2],$rect[4],$rect[6]));
		$minY = min(array($rect[1],$rect[3],$rect[5],$rect[7]));
		$maxY = max(array($rect[1],$rect[3],$rect[5],$rect[7]));
	   
		return array(
		 "left"   => abs($minX) - 1,
		 "top"    => abs($minY) - 1,
		 "width"  => $maxX - $minX,
		 "height" => $maxY - $minY
		);
	}
	
	function bing_image_search()
	{
		$acctKey = 'EBJ1A2QM/DiVyIewIdzhBIhlnmEhAiL5vb9NFLwYGmg';
		$rootUri = 'https://api.datamarket.azure.com/Bing/Search';
		
		if ($this->input->post('query'))
		{
			$query = "%27".urlencode($_POST['query'])."%27";
			// Get the selected service operation (Web or Image).
			$serviceOp = "Image";
			// Construct the full URI for the query.
			$requestUri = "$rootUri/Image?\$format=json&Query=$query"; 
			//$requestUri="https://api.datamarket.azure.com/Bing/Search/Web?\$format=json&Query=%27Xbox%27 ";
			//$requestUri="https://api.datamarket.azure.com/Bing/Search/Image?\$format=json&Query=%27saiful%27";
			
			
			//-------------------------
			// Encode the credentials and create the stream context.
		
			$auth = base64_encode("$acctKey:$acctKey");
			$data = array(
			'http' => array(
			'request_fulluri' => true,
			// ignore_errors can help debug – remove for production. This option added in PHP 5.2.10
			'ignore_errors' => true,
			'header' => "Authorization: Basic $auth")
			);
			
			$context = stream_context_create($data);
			
			// Get the response from Bing.
			
			$response = file_get_contents($requestUri, 0, $context); 
			$result = json_decode($response);		
			
			
			$db_data['result']=$result;			
			echo $data['content'] = $this->load->view($this->template.'/home/ajax_bing_image',$db_data,true);			
		
		}
	}
	
	function custom_resize($file_name)
	{
		@$img_info=getimagesize($file_name);
		/*echo "<pre>";
		print_r($file_name);
		exit;*/
		$orginal_image_width=$img_info[0];
		$orginal_image_height=$img_info[1];
		//print_r($img_info);
		if($orginal_image_width > 900)
		{
			$new_width=900;
			$new_height= ($orginal_image_height * $new_width)/$orginal_image_width;
			$settings['image_library'] = 'gd2';
			$settings['source_image']	= $file_name;
			$settings['create_thumb'] = true;
			$settings['thumb_marker'] = '';
			$settings['maintain_ratio'] = true;
			$settings['new_image'] = $file_name;
			$settings['width']	 = $new_width;
			$settings['height']	 = $orginal_image_height;	

			$this->load->library('image_lib');
			$this->image_lib->initialize($settings); 			
			if(!$this->image_lib->resize())
			{
				echo $this->image_lib->display_errors();
				//exit;
			}
			
			
		}
	}
	
	function photoreconize()
	{
		//-------------- delete previous item
		$current_time = time() - (60*60);
		$pre_result_list=$this->home_model->get_pre_result($current_time);
		foreach($pre_result_list as $row)
		{
			unlink($row->image_name);
		}
		$this->home_model->delete_pre_result($current_time);
		//---------------
		$img_str=$this->input->post('img_str');
		$is_binary=$this->input->post('is_binary');
		$data_source=$this->input->post('data_source');
		
		$file=time();
		if($is_binary == 'binary')
		{
			$p=strpos($img_str,'/'); 
			$p2=strpos($img_str,';');
			$image_type=strtolower(substr($img_str,$p+1,($p2-$p - 1)));
			
			$p=strpos($img_str,',');
			$extra_text=substr($img_str,0,$p+1); 
			
			$img_str=str_replace($extra_text,"",$img_str);
			
			$data = base64_decode($img_str);
			$im = imagecreatefromstring($data);
			
			if($image_type == 'jpeg' || $image_type == 'jpg')
			{
				$file_name="assets/templates/agechecker/temp_face/$file.".$image_type;
				$this->custom_resize($file_name);
				imagejpeg($im,$file_name);
			}
			else if($image_type == 'png')
			{
				$file_name="assets/templates/agechecker/temp_face/$file.".$image_type;
				$this->custom_resize($file_name);
				imagepng($im,$file_name);
			}
			else if($image_type == 'gif')
			{
				$file_name="assets/templates/agechecker/temp_face/$file.".$image_type;
				$this->custom_resize($file_name);
				imagegif($im,$file_name);
			}
			
			
		}
		else if($is_binary == 'url' && $data_source == 'static')
		{
			$img_info=pathinfo($img_str);
			$image_type=strtolower($img_info['extension']);
			if($image_type == 'jpeg' || $image_type == 'jpg')
			{
				$im=imagecreatefromjpeg($img_str);
			}
			else if($image_type == 'png')
			{
				$im=imagecreatefrompng($img_str);
			}
			else if($image_type == 'gif')
			{
				$im=imagecreatefromgif($img_str);
			}
			//print_r($img_info); exit;
			$file_name=$img_str;
			
		}
		else if($data_source == 'bing')
		{
			$headers = get_headers($img_str, 1);
			$type = $headers["Content-Type"];
			$types = array('image/gif' => 'gif', 'image/jpeg' => 'jpg', 'image/jpg' => 'jpg', 'image/png' => 'png');
			
			$file_name="assets/templates/agechecker/temp_face/$file.".$types[$type];
			@copy($img_str, $file_name);
			
			$this->custom_resize($file_name);
			
			$img_str=$file_name;
			
			$img_info=pathinfo($img_str);
			$image_type=strtolower($img_info['extension']);
			if($image_type == 'jpeg' || $image_type == 'jpg')
			{
				$im=imagecreatefromjpeg($img_str);
			}
			else if($image_type == 'png')
			{
				$im=imagecreatefrompng($img_str);
			}
			else if($image_type == 'gif')
			{
				$im=imagecreatefromgif($img_str);
			}
			//print_r($img_info); exit;
			$file_name=$img_str;
			
		}
		
		
		
		//------------ call face api
		/*$query_params = array(
			'url' => site_url().$file_name,

		);                                                                   
		$data_string = json_encode($query_params);                                                                                   
		 
		$ch = curl_init('https://api.projectoxford.ai/face/v0/detections?subscription-key=604d94e06475460e8daf6fe3f3658fd8&nalyzesFaceLandmarks=true&analyzesAge=true&analyzesGender=true&analyzesHeadPose=true');                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");    
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);                                                                 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			'Content-Type: application/json',                                                                                
			'Content-Length: ' . strlen($data_string))                                                                       
		);                                                                                                                   
		 
		$result = curl_exec($ch);
		//echo "<pre>";
		$response=json_decode($result);*/
		
		
		$image_url=site_url().$file_name;
		$query_params = array(
			'url' => $image_url,
			'api_key'=>"49aeae70681800884dd177d48522bc44",
			'api_secret'=>"pPWHJJAKMyywFTDMf4zo9Iu3XSx-gbBK",
			'attribute'=>"glass,pose,gender,age,race,smiling"
		
		);                                                                   
		$data_string = $query_params;                                                                                   
		
		$url="https://apius.faceplusplus.com/v2/detection/detect";
		
		$ch = curl_init($url);                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");    
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);                                                                 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		/*curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			'Content-Type: application/json',                                                                                
			'Content-Length: ' . strlen($data_string))                                                                       
		);  */                                                                                                                 
		 
		$result = curl_exec($ch);
		curl_close($ch);
		//echo "<pre>";
		$response=json_decode($result);
		
		//----------- end call face api
		
		
		
		
		
		
		
		//-----------
		$white = imagecolorallocate($im, 37, 168, 222);
		$font = 'assets/fonts/Arial Regular.ttf';
		//echo "This is under construction"; exit;
		$img_width=$response->img_width; 
		$img_height=$response->img_height; 
		foreach($response->face as $face)
		{
			//echo "<pre>";
			//print_r($face); exit;
			$face_width=($face->position->width * $img_width)/100;
			$face_height=($face->position->height * $img_height)/100;
			
			$center_x=($face->position->center->x * $img_width)/100;
			$center_y=($face->position->center->y * $img_height)/100;
			
			$x1=$center_x - ($face_width / 2);
			$x2=$x1 + $face_width;
			$y1=$center_y - ($face_height / 2);
			$y2=$y1 + $face_height;
			imagerectangle($im,$x1,$y1,$x2,$y2,$white);
			imagerectangle($im,$x1-1,$y1-1,$x2+1,$y2+1,$white);
			imagerectangle($im,$x1-2,$y1-2,$x2+2,$y2+2,$white);
			
			
			if($face->attribute->age->value > 9)
			{
				if(strtolower($face->attribute->gender->value) == 'male')
				{
					$w=90;
					$h=83;
					$text_y=50;
					if($y1 < $h)
					{
						$indicator=imagecreatefrompng("assets/templates/agechecker/faces/male_down2.png");
						$text_y=62;
					}
					else
					{
						$indicator=imagecreatefrompng("assets/templates/agechecker/faces/male2.png");
					}
					
					$color = imagecolorallocate($indicator, 221, 111, 48);
					imagettftext($indicator, 30, 0, 38, $text_y, $color, $font, $face->attribute->age->value);
					
				}
				else
				{
					$w=90;
					$h=83;
					$text_y=50;
					if($y1 < $h)
					{
						$indicator=imagecreatefrompng("assets/templates/agechecker/faces/female_down2.png");
						$text_y=62;
					}
					else
					{
						$indicator=imagecreatefrompng("assets/templates/agechecker/faces/female2.png");
					}
					
					$color = imagecolorallocate($indicator, 221, 111, 48);
					imagettftext($indicator, 30, 0, 38, $text_y, $color, $font, $face->attribute->age->value);
					
				}
			}
			else
			{
				if(strtolower($face->attribute->gender->value) == 'male')
				{
					$w=77;
					$h=83;
					$text_y=50;
					if($y1 < $h)
					{
						$indicator=imagecreatefrompng("assets/templates/agechecker/faces/male_down1.png");
						$text_y=62;
					}
					else
					{
						$indicator=imagecreatefrompng("assets/templates/agechecker/faces/male1.png");
					}
					
					$color = imagecolorallocate($indicator, 221, 111, 48);
					imagettftext($indicator, 30, 0, 44, $text_y, $color, $font, $face->attribute->age->value);
					
				}
				else
				{
					$w=77;
					$h=83;
					$text_y=50;
					if($y1 < $h)
					{
						$indicator=imagecreatefrompng("assets/templates/agechecker/faces/female_down.png");
						$text_y=62;
					}
					else
					{
						$indicator=imagecreatefrompng("assets/templates/agechecker/faces/female.png");
					}
					
					
					$color = imagecolorallocate($indicator, 221, 111, 48);
					imagettftext($indicator, 30, 0, 44, $text_y, $color, $font, $face->attribute->age->value);
					
				}
			}
			
			
			
			$left_offset=0;
			$xx1=$x1;
			
			if($w > $face_width)
			{
				$offset=$w-$face_width;
				$left_offset=$offset/2;
				$xx1=$x1-$left_offset;
				
			}
			if($w < $face_width)
			{
				$offset=$face_width - $w;
				$left_offset=$offset/2;
				$xx1=$x1+$left_offset;
			}
			//echo "x1:".$x1;
			//echo "ssss".$xx1;
			//imagecopymerge($im, $indicator, $x1, $y1-83, 0, 0, 90, 83, 100);
			
			if($y1 < $h)
			{
				$y1=$y2+$h;
			}
			imagecopyresampled($im, $indicator, $xx1,$y1-$h,0,0,$w,$h,$w, 83);
		}
		
		if ($im !== false) {
			//header('Content-Type: image/png');
			//$file=time();
			$file_name="assets/templates/agechecker/temp_face/".$file.".png";
			
			
			if($image_type == 'jpeg' || $image_type == 'jpg')
			{
				$file_name="assets/templates/agechecker/temp_face/$file.".$image_type;
				imagejpeg($im,$file_name);
			}
			else if($image_type == 'png')
			{
				$file_name="assets/templates/agechecker/temp_face/$file.".$image_type;
				imagepng($im,$file_name);
			}
			else if($image_type == 'gif')
			{
				$file_name="assets/templates/agechecker/temp_face/$file.".$image_type;
				imagegif($im,$file_name);
			}
			
			imagedestroy($im);
			//echo $file.".png";
			
			$db_data['file_name']=$file_name;
			$db_data['id']=$file;
			$db_data['config_info']=$this->home_model->get_config();
			
			
			//----------- insert into db
			$this->session->set_userdata('res_id',$file);
			$res_info['id']=$file;
			$res_info['image_name']=$file_name;
			$res_info['added']=date('Y-m-d H:i:s');
			$this->db->insert('agechecker_result',$res_info);
			
			//------- end 
			$this->load->view($this->template.'/home/ajax_result_page',$db_data,false);
			
		}
		else {
			echo 'An error occurred.';
		}
			
	}
	
	function photoreconize_how_old()
	{
	
		//-------------- delete previous item
		$current_time = time() - (60*60);
		$pre_result_list=$this->home_model->get_pre_result($current_time);
		foreach($pre_result_list as $row)
		{
			unlink($row->image_name);
		}
		$this->home_model->delete_pre_result($current_time);
		//---------------
		$img_str=$this->input->post('img_str');
		$is_binary=$this->input->post('is_binary');
		$data_source=$this->input->post('data_source');
		$test_id=$this->input->post('test_id');
		$alias=$this->input->post('alias');
		
		
		$file=time();
		if($is_binary == 'binary')
		{
			$p=strpos($img_str,'/'); 
			$p2=strpos($img_str,';');
			$image_type=strtolower(substr($img_str,$p+1,($p2-$p - 1)));
			
			$p=strpos($img_str,',');
			$extra_text=substr($img_str,0,$p+1); 
			
			$img_str=str_replace($extra_text,"",$img_str);
			
			$data = base64_decode($img_str);
			$im = imagecreatefromstring($data);
			
			if($image_type == 'jpeg' || $image_type == 'jpg')
			{
				$file_name="assets/templates/".$this->template."/temp_face/$file.".$image_type;
				
				imagejpeg($im,$file_name);
				$this->custom_resize($file_name);
				$im=imagecreatefromjpeg($file_name);
			}
			else if($image_type == 'png')
			{
				$file_name="assets/templates/".$this->template."/temp_face/$file.".$image_type;
				
				imagepng($im,$file_name);
				$this->custom_resize($file_name);
				$im=imagecreatefromjpeg($file_name);
			}
			else if($image_type == 'gif')
			{
				$file_name="assets/templates/".$this->template."/temp_face/$file.".$image_type;
				
				imagegif($im,$file_name);
				$this->custom_resize($file_name);
				$im=imagecreatefromjpeg($file_name);
			}
			//------ this is for auto rotate
			$exif = exif_read_data($img_str);
			if(!empty($exif['Orientation'])) {
				switch($exif['Orientation']) {
					case 8:
						$im = imagerotate($im,90,0);
						break;
					case 3:
						$im = imagerotate($im,180,0);
						break;
					case 6:
						$im = imagerotate($im,-90,0);
						break;
				}
			}
			
			
		}
		else if($is_binary == 'url' && $data_source == 'static')
		{
			$img_info=pathinfo($img_str);
			$image_type=strtolower($img_info['extension']);
			
			
			if($image_type == 'jpeg' || $image_type == 'jpg')
			{
				$im=imagecreatefromjpeg($img_str);
			}
			else if($image_type == 'png')
			{
				$im=imagecreatefrompng($img_str);
			}
			else if($image_type == 'gif')
			{
				$im=imagecreatefromgif($img_str);
			}
			//print_r($img_info); exit;
			$file_name=$img_str;
			
		}
		else if($data_source == 'bing')
		{
			$headers = get_headers($img_str, 1);
			/*echo "<pre>";
			print_r($headers); exit;*/
			if(is_array($headers["Content-Type"]))
			{
				$type = $headers["Content-Type"][1];
			}
			else
			{
				$type = $headers["Content-Type"];
			}
			$types = array('image/gif' => 'gif', 'image/jpeg' => 'jpg', 'image/jpg' => 'jpg', 'image/png' => 'png');
			
			$file_name="assets/templates/".$this->template."/temp_face/$file.".$types[$type];
			@copy($img_str, $file_name);
			
			$this->custom_resize($file_name);
			
			$img_str=$file_name;
			
			$img_info=pathinfo($img_str);
			$image_type=strtolower($img_info['extension']);
			if($image_type == 'jpeg' || $image_type == 'jpg')
			{
				$im=imagecreatefromjpeg($img_str);
			}
			else if($image_type == 'png')
			{
				$im=imagecreatefrompng($img_str);
			}
			else if($image_type == 'gif')
			{
				$im=imagecreatefromgif($img_str);
			}
			//print_r($img_info); exit;
			$file_name=$img_str;
			
		}
		
		
		
		//------------ call face api
		/*$query_params = array(
			'url' => site_url().$file_name,

		);                                                                   
		$data_string = json_encode($query_params);                                                                                   
		 
		$ch = curl_init('https://api.projectoxford.ai/face/v0/detections?subscription-key=604d94e06475460e8daf6fe3f3658fd8&nalyzesFaceLandmarks=true&analyzesAge=true&analyzesGender=true&analyzesHeadPose=true');                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");    
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);                                                                 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			'Content-Type: application/json',                                                                                
			'Content-Length: ' . strlen($data_string))                                                                       
		);                                                                                                                   
		 
		$result = curl_exec($ch);
		//echo "<pre>";
		$response=json_decode($result);*/
		
		
		$image_url=site_url().$file_name;
		$query_params = array(
			'url' => $image_url,
			'api_key'=>"49aeae70681800884dd177d48522bc44",
			'api_secret'=>"pPWHJJAKMyywFTDMf4zo9Iu3XSx-gbBK",
			'attribute'=>"glass,pose,gender,age,race,smiling"
		
		);                                                                   
		$data_string = $query_params;                                                                                   
		
		$url="https://apius.faceplusplus.com/v2/detection/detect";
		
		$ch = curl_init($url);                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");    
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);                                                                 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		/*curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			'Content-Type: application/json',                                                                                
			'Content-Length: ' . strlen($data_string))                                                                       
		);  */                                                                                                                 
		 
		$result = curl_exec($ch);
		curl_close($ch);
		//echo "<pre>";
		$response=json_decode($result);
		
		//----------- end call face api
		
		
		
		
		
		
		
		//-----------
		$white = imagecolorallocate($im, 37, 168, 222);
		$white = imagecolorallocate($im, 255, 255, 255);
		$font = 'assets/fonts/arial_bold.ttf';
		//echo "This is under construction"; exit;
		$img_width=$response->img_width; 
		$img_height=$response->img_height; 
		$result_set=array();
		foreach($response->face as $face)
		{
			//echo "<pre>";
			//print_r($face); 
			
			$age=$face->attribute->age->value;
			$gender=strtolower($face->attribute->gender->value);
			$smile=$face->attribute->smiling->value;
			
			$point=0;
			if($gender == "male") $point+=3;
			else if($gender == "female") $point+=0;
			
			if($age < 10) $point+= 2;
			else if($age < 20) $point+= 0;
			else if($age < 30) $point+= 8;
			else if($age < 40) $point+= 5;
			else if($age < 50) $point+= 8;
			else if($age < 60) $point+= 1;
			else if($age > 60) $point+= 10;
			
			
			if($smile < 20 ) $point =0;
			else if($smile < 40) $point+=3;
			else if($smile < 50) $point+=6;
			else $point+=$smile/10;
			$point=(int)$point;
			if($point > 18) $point=18;
			/*echo $gender;
			echo "<br>";
			echo $point;
			echo "<br>";*/
			//echo $point;
			$result_options=$this->home_model->get_result_options($test_id);	
			
			
			$result="";
			
			if($result_options)
				{
					foreach($result_options as $result_option)
					{
						if($point >= $result_option->interval_from && $point <= $result_option->interval_to)
						{
							$result=$result_option->result;
							$result_description=$result_option->result_description;
							$result_set[]=$result_option;
						}
					}
				}
			
			$face_width=($face->position->width * $img_width)/100;
			$face_height=($face->position->height * $img_height)/100;
			
			$center_x=($face->position->center->x * $img_width)/100;
			$center_y=($face->position->center->y * $img_height)/100;
			
			$x1=$center_x - ($face_width / 2);
			$x2=$x1 + $face_width;
			$y1=$center_y - ($face_height / 2);
			$y2=$y1 + $face_height;
			imagerectangle($im,$x1,$y1,$x2,$y2,$white);
			imagerectangle($im,$x1-1,$y1-1,$x2+1,$y2+1,$white);
			imagerectangle($im,$x1-2,$y1-2,$x2+2,$y2+2,$white);
			
			
			$w=77;
			$h=41;
			$text_y=50;
			if($y1 < $h)
			{
				$indicator=imagecreatefrompng("assets/templates/".$this->template."/faces/result_indicator.png");
				$text_y=62;
			}
			else
			{
				$indicator=imagecreatefrompng("assets/templates/".$this->template."/faces/result_indicator.png");
			}
			
			$color = imagecolorallocate($indicator, 208, 100, 34);
			
			
			
			
			
			$left_offset=0;
			$xx1=$x1;
			
			if($w > $face_width)
			{
				$offset=$w-$face_width;
				$left_offset=$offset/2;
				$xx1=$x1-$left_offset;
				
			}
			if($w < $face_width)
			{
				$offset=$face_width - $w;
				$left_offset=$offset/2;
				$xx1=$x1+$left_offset;
			}
			//echo "x1:".$x1;
			//echo "ssss".$xx1;
			//imagecopymerge($im, $indicator, $x1, $y1-83, 0, 0, 90, 83, 100);
			
			if($y1 < $h)
			{
				$y1=$y2+$h;
			}
			imagecopyresampled($im, $indicator, $xx1,$y1-$h,0,0,$w,$h,$w, $h);
			
			//$result="SAIFUL";
			$text_box=$this->calculateTextBox($result,$font,20,0); 
			$text_width  = $text_box['width'];
			$text_height  = $text_box['height'];
			$text_height+=20;
			if($text_height > 28)
			{
				$y1=$y1-($text_height - 29);
			}
			$bg_color=imagecolorallocate($im, 236, 208, 18);
			$box_width=$text_width+40;
			if($box_width > $w)
			{
				$xx1=$xx1 - (($box_width - $w)/2);
			}
			imagefilledrectangle($im, $xx1, $y1 - $h, $xx1 + $box_width, $y1-$h + $text_height, $bg_color);
			
			imagettftext($im, 20, 0, $xx1 +20 , $y1 - 10, $color, $font, $result); 
			
		}
		
		
		
		if ($im !== false) {
			//header('Content-Type: image/png');
			//$file=time();
			$file_name="assets/templates/".$this->template."/temp_face/".$file.".png";
			
			
			if($image_type == 'jpeg' || $image_type == 'jpg')
			{
				$file_name="assets/templates/".$this->template."/temp_face/$file.".$image_type;
				imagejpeg($im,$file_name);
			}
			else if($image_type == 'png')
			{
				$file_name="assets/templates/".$this->template."/temp_face/$file.".$image_type;
				imagepng($im,$file_name);
			}
			else if($image_type == 'gif')
			{
				$file_name="assets/templates/".$this->template."/temp_face/$file.".$image_type;
				imagegif($im,$file_name);
			}
			
			imagedestroy($im);
			//echo $file.".png";
			$db_data['error_message']="";
			if(!$response->face)
			{
				$db_data['error_message']="Couldn't detect any faces.";
			}
			$db_data['file_name']=$file_name;
			$db_data['id']=$file;
			$db_data['config_info']=$this->home_model->get_config();
			$db_data['test_info']=$this->home_model->get_game($alias);
			$db_data['result_set']=$result_set;
			
			
			//----------- insert into db
			$this->session->set_userdata('res_id',$file);
			$res_info['id']=$file;
			$res_info['image_name']=$file_name;
			$res_info['added']=date('Y-m-d H:i:s');
			$this->db->insert('agechecker_result',$res_info);
			
			//------- end 
			$this->load->view($this->template.'/home/ajax_how_old_result',$db_data,false);
			
		}
		else {
			echo 'An error occurred.';
		}
			
	}
	
	
	function image_rotation()
	{
				
		$image=new Imagick("assets/img/image1.JPG");
		
		//print_r($image);
		//$height=$image->getImageOrientation();
		$this->autoRotateImage($image);
		$image->writeImage('assets/img/image022.jpg');
	}
	
	function autoRotateImage($image) {
	
		$orientation = $image->getImageOrientation();
		$image_properties=$image->getImageProperties('*', FALSE);
		/*echo "<pre>";
		print_r($image_properties);*/
		echo $orientation;
		//exit;
		switch($orientation) {
			case imagick::ORIENTATION_BOTTOMRIGHT:
				$image->rotateimage("#000", 180); // rotate 180 degrees
				echo "BOTTOMRIGHT";
			break;
	
			case imagick::ORIENTATION_RIGHTTOP:
				$image->rotateimage("#000", 90); // rotate 90 degrees CW
				echo "RIGHTTOP";
			break;
	
			case imagick::ORIENTATION_LEFTBOTTOM:
				$image->rotateimage("#000", -90); // rotate 90 degrees CCW
				echo "LEFTBOTTOM";
			break;
			
			case imagick::ORIENTATION_TOPLEFT:
				$image->rotateimage("#000", 90); // rotate 90 degrees CCW
				echo "TOPLEFT";
			break;
			
			case imagick::ORIENTATION_TOPRIGHT:
				$image->rotateimage("#000", -90); // rotate 90 degrees CCW
				echo "TOPRIGHT";
			break;
			
		}
	
		// Now that it's auto-rotated, make sure the EXIF data is correct in case the EXIF gets saved with the image!
		$image->setImageOrientation(imagick::ORIENTATION_TOPLEFT);
	}
	
	
	
	
	function photoreconize_face()
	{
		//-------------- delete previous item
		$current_time = time() - (60*60);
		$pre_result_list=$this->home_model->get_pre_result($current_time);
		foreach($pre_result_list as $row)
		{
			unlink($row->image_name);
		}
		$this->home_model->delete_pre_result($current_time);
		//---------------
		$img_str=$this->input->post('img_str');
		$is_binary=$this->input->post('is_binary');
		$data_source=$this->input->post('data_source');
		$test_id=$this->input->post('test_id');
		$alias=$this->input->post('alias');
		
		
		$file=time();
		if($is_binary == 'binary')
		{
			$p=strpos($img_str,'/'); 
			$p2=strpos($img_str,';');
			$image_type=strtolower(substr($img_str,$p+1,($p2-$p - 1)));
			
			$p=strpos($img_str,',');
			$extra_text=substr($img_str,0,$p+1); 
			
			$img_str=str_replace($extra_text,"",$img_str);
			
			$data = base64_decode($img_str);
			$im = imagecreatefromstring($data);
			
			if($image_type == 'jpeg' || $image_type == 'jpg')
			{
				$file_name="assets/templates/".$this->template."/temp_face/$file.".$image_type;
				
				imagejpeg($im,$file_name);
				$this->custom_resize($file_name);
				$im=imagecreatefromjpeg($file_name);
			}
			else if($image_type == 'png')
			{
				$file_name="assets/templates/".$this->template."/temp_face/$file.".$image_type;
				
				imagepng($im,$file_name);
				$this->custom_resize($file_name);
				$im=imagecreatefromjpeg($file_name);
			}
			else if($image_type == 'gif')
			{
				$file_name="assets/templates/".$this->template."/temp_face/$file.".$image_type;
				
				imagegif($im,$file_name);
				$this->custom_resize($file_name);
				$im=imagecreatefromjpeg($file_name);
			}
			//------ this is for auto rotate
			/*$exif = exif_read_data($img_str);
			if(!empty($exif['Orientation'])) {
				switch($exif['Orientation']) {
					case 8:
						$im = imagerotate($im,90,0);
						break;
					case 3:
						$im = imagerotate($im,180,0);
						break;
					case 6:
						$im = imagerotate($im,-90,0);
						break;
				}
			}*/
			
			
		}
		else if($is_binary == 'url' && $data_source == 'static')
		{
			$img_info=pathinfo($img_str);
			$image_type=strtolower($img_info['extension']);
			
			
			if($image_type == 'jpeg' || $image_type == 'jpg')
			{
				$im=imagecreatefromjpeg($img_str);
			}
			else if($image_type == 'png')
			{
				$im=imagecreatefrompng($img_str);
			}
			else if($image_type == 'gif')
			{
				$im=imagecreatefromgif($img_str);
			}
			//print_r($img_info); exit;
			$file_name=$img_str;
			
		}
		else if($data_source == 'bing')
		{
			$headers = get_headers($img_str, 1);
			/*echo "<pre>";
			print_r($headers); exit;*/
			if(is_array($headers["Content-Type"]))
			{
				$type = $headers["Content-Type"][1];
			}
			else
			{
				$type = $headers["Content-Type"];
			}
			$types = array('image/gif' => 'gif', 'image/jpeg' => 'jpg', 'image/jpg' => 'jpg', 'image/png' => 'png');
			
			$file_name="assets/templates/".$this->template."/temp_face/$file.".$types[$type];
			@copy($img_str, $file_name);
			
			$this->custom_resize($file_name);
			
			$img_str=$file_name;
			
			$img_info=pathinfo($img_str);
			$image_type=strtolower($img_info['extension']);
			if($image_type == 'jpeg' || $image_type == 'jpg')
			{
				$im=imagecreatefromjpeg($img_str);
			}
			else if($image_type == 'png')
			{
				$im=imagecreatefrompng($img_str);
			}
			else if($image_type == 'gif')
			{
				$im=imagecreatefromgif($img_str);
			}
			//print_r($img_info); exit;
			$file_name=$img_str;
			
		}
		
		
		
		//------------ call face api
		/*$query_params = array(
			'url' => site_url().$file_name,

		);                                                                   
		$data_string = json_encode($query_params);                                                                                   
		 
		$ch = curl_init('https://api.projectoxford.ai/face/v0/detections?subscription-key=604d94e06475460e8daf6fe3f3658fd8&nalyzesFaceLandmarks=true&analyzesAge=true&analyzesGender=true&analyzesHeadPose=true');                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");    
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);                                                                 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			'Content-Type: application/json',                                                                                
			'Content-Length: ' . strlen($data_string))                                                                       
		);                                                                                                                   
		 
		$result = curl_exec($ch);
		//echo "<pre>";
		$response=json_decode($result);*/
		
		
		$image_url=site_url().$file_name;
		$query_params = array(
			'url' => $image_url,
			'api_key'=>"49aeae70681800884dd177d48522bc44",
			'api_secret'=>"pPWHJJAKMyywFTDMf4zo9Iu3XSx-gbBK",
			'attribute'=>"glass,pose,gender,age,race,smiling"
		
		);                                                                   
		$data_string = $query_params;                                                                                   
		
		$url="https://apius.faceplusplus.com/v2/detection/detect";
		
		$ch = curl_init($url);                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");    
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);                                                                 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		/*curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			'Content-Type: application/json',                                                                                
			'Content-Length: ' . strlen($data_string))                                                                       
		);  */                                                                                                                 
		 
		$result = curl_exec($ch);
		curl_close($ch);
		//echo "<pre>";
		$response=json_decode($result);
		
		//----------- end call face api
		
		
		
		
		
		
		
		//-----------
		$white = imagecolorallocate($im, 37, 168, 222);
		$white = imagecolorallocate($im, 255, 255, 255);
		$font = 'assets/fonts/arial_bold.ttf';
		//echo "This is under construction"; exit;
		$img_width=$response->img_width; 
		$img_height=$response->img_height; 
		$result_set=array();
		foreach($response->face as $face)
		{
			//echo "<pre>";
			//print_r($face); 
			
			$age=$face->attribute->age->value;
			$gender=strtolower($face->attribute->gender->value);
			$smile=$face->attribute->smiling->value;
			
			$point=0;
			if($gender == "male") $point+=3;
			else if($gender == "female") $point+=0;
			
			if($age < 10) $point+= 2;
			else if($age < 20) $point+= 0;
			else if($age < 30) $point+= 8;
			else if($age < 40) $point+= 5;
			else if($age < 50) $point+= 8;
			else if($age < 60) $point+= 1;
			else if($age > 60) $point+= 10;
			
			
			if($smile < 20 ) $point =0;
			else if($smile < 40) $point+=3;
			else if($smile < 50) $point+=6;
			else $point+=$smile/10;
			$point=(int)$point;
			if($point > 18) $point=18;
			/*echo $gender;
			echo "<br>";
			echo $point;
			echo "<br>";*/
			//echo $point;
			$result_options=$this->home_model->get_result_options($test_id);	
			
			
			$result="";
			
			if($result_options)
				{
					foreach($result_options as $result_option)
					{
						if($point >= $result_option->interval_from && $point <= $result_option->interval_to)
						{
							$result=$result_option->result;
							$result_description=$result_option->result_description;
							$result_set[]=$result_option;
						}
					}
				}
			
			$face_width=($face->position->width * $img_width)/100;
			$face_height=($face->position->height * $img_height)/100;
			
			$center_x=($face->position->center->x * $img_width)/100;
			$center_y=($face->position->center->y * $img_height)/100;
			
			$x1=$center_x - ($face_width / 2);
			$x2=$x1 + $face_width;
			$y1=$center_y - ($face_height / 2);
			$y2=$y1 + $face_height;
			imagerectangle($im,$x1,$y1,$x2,$y2,$white);
			imagerectangle($im,$x1-1,$y1-1,$x2+1,$y2+1,$white);
			imagerectangle($im,$x1-2,$y1-2,$x2+2,$y2+2,$white);
			
			
			$w=77;
			$h=41;
			$text_y=50;
			if($y1 < $h)
			{
				$indicator=imagecreatefrompng("assets/templates/".$this->template."/faces/result_indicator.png");
				$text_y=62;
			}
			else
			{
				$indicator=imagecreatefrompng("assets/templates/".$this->template."/faces/result_indicator.png");
			}
			
			$color = imagecolorallocate($indicator, 208, 100, 34);
			
			
			
			
			
			$left_offset=0;
			$xx1=$x1;
			
			if($w > $face_width)
			{
				$offset=$w-$face_width;
				$left_offset=$offset/2;
				$xx1=$x1-$left_offset;
				
			}
			if($w < $face_width)
			{
				$offset=$face_width - $w;
				$left_offset=$offset/2;
				$xx1=$x1+$left_offset;
			}
			//echo "x1:".$x1;
			//echo "ssss".$xx1;
			//imagecopymerge($im, $indicator, $x1, $y1-83, 0, 0, 90, 83, 100);
			
			if($y1 < $h)
			{
				$y1=$y2+$h;
			}
			imagecopyresampled($im, $indicator, $xx1,$y1-$h,0,0,$w,$h,$w, $h);
			
			//$result="SAIFUL";
			$text_box=$this->calculateTextBox($result,$font,20,0); 
			$text_width  = $text_box['width'];
			$text_height  = $text_box['height'];
			$text_height+=20;
			if($text_height > 28)
			{
				$y1=$y1-($text_height - 29);
			}
			$bg_color=imagecolorallocate($im, 236, 208, 18);
			$box_width=$text_width+40;
			if($box_width > $w)
			{
				$xx1=$xx1 - (($box_width - $w)/2);
			}
			imagefilledrectangle($im, $xx1, $y1 - $h, $xx1 + $box_width, $y1-$h + $text_height, $bg_color);
			
			imagettftext($im, 20, 0, $xx1 +20 , $y1 - 10, $color, $font, $result); 
			
		}
		
		
		
		if ($im !== false) {
			//header('Content-Type: image/png');
			//$file=time();
			$file_name="assets/templates/".$this->template."/temp_face/".$file.".png";
			
			
			if($image_type == 'jpeg' || $image_type == 'jpg')
			{
				$file_name="assets/templates/".$this->template."/temp_face/$file.".$image_type;
				imagejpeg($im,$file_name);
			}
			else if($image_type == 'png')
			{
				$file_name="assets/templates/".$this->template."/temp_face/$file.".$image_type;
				imagepng($im,$file_name);
			}
			else if($image_type == 'gif')
			{
				$file_name="assets/templates/".$this->template."/temp_face/$file.".$image_type;
				imagegif($im,$file_name);
			}
			
			imagedestroy($im);
			//echo $file.".png";
			$db_data['error_message']="";
			if(!$response->face)
			{
				$db_data['error_message']="Couldn't detect any faces.";
			}
			$db_data['file_name']=$file_name;
			$db_data['id']=$file;
			$db_data['config_info']=$this->home_model->get_config();
			$db_data['test_info']=$this->home_model->get_game($alias);
			$db_data['result_set']=$result_set;
			$db_data['banner_list']=$this->home_model->get_banners();
			
			
			//----------- insert into db
			$this->session->set_userdata('res_id',$file);
			$res_info['id']=$file;
			$res_info['image_name']=$file_name;
			$res_info['added']=date('Y-m-d H:i:s');
			$this->db->insert('agechecker_result',$res_info);
			
			//------- end 
			$this->load->view($this->template.'/home/ajax_face_result',$db_data,false);
			
		}
		else {
			echo 'An error occurred.';
		}
	}

	
	
	function facebook_apps()
	{
		
		//-------------- delete previous item
		$current_time = time() - (60*60);
		$pre_fb_apps_result_list=$this->home_model->get_pre_fbapps_result($current_time);
		foreach($pre_fb_apps_result_list as $row)
		{
			unlink($row->image_name);
		}
		$this->home_model->delete_pre_fbapps_result($current_time);
		//---------------
			
		$friend_name=$this->input->post('friend_name');
		$friend_pic=$this->input->post('friend_pic');
		$friend_id=$this->input->post('friend_id');
		$user_pic=$this->input->post('user_pic');
		$user_id=$this->input->post('user_id');
		
		$alias=$this->input->post('alias');
		$tests_info=$this->home_model->get_game($alias);	
		//$test_bg_image=$tests_info->image;
		
		
		
		
		$font = 'assets/fonts/Arial Regular.ttf';
		
		$font_size = 20;
		$text_box=$this->calculateTextBox($friend_name,$font,$font_size,0); 
		$text_width  = $text_box['width'];
		$text_height  = $text_box['height'];
		
		$x = floor((630  - $text_width)/2); 
		$y = 40;
		
		
		$types = array('image/gif' => 'gif', 'image/jpeg' => 'jpg', 'image/jpg' => 'jpg', 'image/png' => 'png');
		
		$headers1 = get_headers($user_pic, 1);
		if(is_array($headers1["Content-Type"]))
		{
			$type1 = $headers1["Content-Type"][1];
		}
		else
		{
			$type1 = $headers1["Content-Type"];
		}
		$file_name1="assets/fb_apps/$user_id.".$types[$type1];
		@copy($user_pic, $file_name1);
		
		$headers2 = get_headers($friend_pic, 1);
		if(is_array($headers2["Content-Type"]))
		{
			$type2 = $headers2["Content-Type"][1];
		}
		else
		{
			$type2 = $headers2["Content-Type"];
		}
		$file_name2="assets/fb_apps/$friend_id.".$types[$type2];
		@copy($friend_pic, $file_name2);
		
		
		$img_info=pathinfo($file_name1);
		$image_type1=strtolower($img_info['extension']);
		
		$img_info=pathinfo($file_name2);
		$image_type2=strtolower($img_info['extension']);
		
		
		if($image_type1 == 'jpeg' || $image_type1 == 'jpg')
		{
			$user_img=imagecreatefromjpeg($file_name1);
		}
		else if($image_type1 == 'png')
		{
			$user_img=imagecreatefrompng($file_name1);
		}
		else if($image_type1 == 'gif')
		{
			$user_img=imagecreatefromgif($file_name1);
		}
		
		
		
		if($image_type2 == 'jpeg' || $image_type2 == 'jpg')
		{
			$friend_img=imagecreatefromjpeg($file_name2);
		}
		else if($image_type2 == 'png')
		{
			$friend_img=imagecreatefrompng($file_name2);
		}
		else if($image_type2 == 'gif')
		{
			$friend_img=imagecreatefromgif($file_name2);
		}
		
		
		$im=imagecreatefrompng("assets/img/true_friend.png");
		$font_color = imagecolorallocate($im, 000, 000, 000);
		
		imagecopyresampled($im, $user_img,90,70,0,0,191,191,191,191);
		
		imagecopyresampled($im, $friend_img, 319,70,0,0,191,191,191,191); 
		imagedestroy($user_img);
		imagedestroy($friend_img);
		
		imagettftext($im, $font_size, 0, $x, $y, $font_color, $font, $friend_name);
		@unlink($user_img);
		@unlink($friend_img);
		$time=time();
		$file_name="assets/fb_apps/$time".".png";
		imagepng($im,$file_name);
		imagedestroy($im);
		$db_data['test_bg_image']=site_url()."$file_name";
		$db_data['friend_name']=$friend_name;
		$db_data['id']=$time;
		$db_data['tests_info']=$tests_info;
		
		//----------- insert into db
		$res_info['id']=$time;
		$res_info['image_name']=$file_name;
		$res_info['added']=date('Y-m-d H:i:s');
		$this->db->insert('fb_apps_result',$res_info);
		//------- end 
		$this->load->view($this->template.'/home/ajax_facebook_apps_result',$db_data,false);
		
		
	
	}
	
	function facebook_app_privacy_policy()
	{
	
		$db_data=array();
		$db_data['config_info']=$this->home_model->get_config();
		$data['content'] = $this->load->view($this->template.'/home/facebook_app_privacy_policy',$db_data,true);
		$data['config_info'] = $db_data['config_info'];
		$data['page_title'] = $db_data['config_info']->site_title;
		$data['page_description'] = $db_data['config_info']->page_description;	
		$data['meta_url'] = $db_data['config_info']->facebook_url;
		$data['fb_meta_description'] = $db_data['config_info']->share_des;
		$data['active_menu']='';
		$data['cur_page'] ="privacy";
		$data['config_info'] = $db_data['config_info'];
		$this->load->view($this->template.'/layout/default',$data); 
	}
	

}



/* End of file home.php */

/* Location: ./application/controllers/home.php */