<?php 

class Test_model extends CI_Model {

	

	public function __construct()

    {

        parent::__construct();

		

    }

    

	function get_categories($lang='',$post_type='games')

	{
		//echo $lang; exit;
		$this->db->select('*');
		$this->db->where('lang_code',$lang);
		$this->db->where('post_type',$post_type);
		$this->db->from('categories');
		$query=$this->db->get();
		$res=$query->result();
		return $res;
	}

	

	function get_tests($lang_code='',$page,$limit,$post_type='games')

	{
		$this->db->select('t.*,c.category_name,u.first_name,u.last_name,u.username');
		$this->db->where('t.post_type',$post_type);
		
		
		if($this->session->userdata('search_realtest'))
		{
			$this->db->where('t.is_real_test',$this->session->userdata('search_realtest')); 
		}
		else if($this->session->userdata('search_realtest')== 0)
		{
			//$this->db->where('t.is_real_test',0);
		}
		
		if($this->session->userdata('search'))
		{
			$this->db->like('LOWER(t.title)', strtolower($this->session->userdata('search')), 'both'); 
		}
		if($this->session->userdata('user_type')==2)

		{

			$this->db->where('t.status',2);

			$this->db->where('t.created_by',$this->session->userdata('user_id'));

		}

		if($this->session->userdata('user_type')==3)

		{

			$this->db->where('t.editor_control',1);

		}

		

		if($this->session->userdata('user_type')==4)

		{

			$this->db->where('t.graphic_control',1);

		}
		
		if($this->session->userdata('search_user_id'))
		{
			$this->db->where('t.created_by',$this->session->userdata('search_user_id'));
		}
		
		if($this->session->userdata('search_status'))
		{
			$this->db->where('t.status',$this->session->userdata('search_status'));
		}

		//if(!empty($_GET['user_id'])) $this->db->where('t.created_by',$_GET['user_id']);
		

		//if(!empty($_GET['status'])) $this->db->where('t.status',$_GET['status']);
		
		if($lang_code)
		{		
			$this->db->where('t.lang_code',$lang_code);
		}
		else
		{
			//$this->db->where('t.lang_code',$this->session->userdata('lang_code'));
			$this->db->where('t.lang_code','en');
		}

		$this->db->from('tests as t');

		$this->db->join('categories as c','c.category_id=t.category_id','left');

		$this->db->join('users as u','u.userid=t.created_by','left');

		

		if($this->input->post('sort_by')) $this->db->order_by('t.fb_like',$this->input->post('sort_by'));

		else 

		{
			//$this->db->order_by('t.modify_date','desc');

			//$this->db->order_by('t.status','desc');

			$this->db->order_by('t.tests_id','desc');

			$this->db->order_by('activated_date','desc');

		}

		
		$this->db->limit($limit,$page);
		$query=$this->db->get();

		$res=$query->result();
		//echo $this->db->last_query();
		return $res;

	}
	
	function get_total_tests($lang_code,$post_type='games')
	{
		$this->db->where('t.post_type',$post_type);
		$this->db->select('count(*) as num');
		
		if($this->session->userdata('search_realtest'))
		{
			$this->db->where('t.is_real_test',$this->session->userdata('search_realtest')); 
		}
		else if($this->session->userdata('search_realtest')== 0)
		{
			//$this->db->where('t.is_real_test',0);
		}
		
		if($this->session->userdata('search'))
		{
			$this->db->like('LOWER(t.title)', strtolower($this->session->userdata('search')), 'both'); 
		}
		if($this->session->userdata('user_type')==2)
		{
			$this->db->where('t.status',2);
			$this->db->where('t.created_by',$this->session->userdata('user_id'));
		}

		if($this->session->userdata('user_type')==3)
		{
			$this->db->where('t.editor_control',1);
		}

		

		if($this->session->userdata('user_type')==4)
		{
			$this->db->where('t.graphic_control',1);
		}
		
		if($this->session->userdata('search_user_id'))
		{
			$this->db->where('t.created_by',$this->session->userdata('search_user_id'));
		}
		//if(!empty($_GET['user_id'])) $this->db->where('t.created_by',$_GET['user_id']);
		//if(!empty($_GET['status'])) $this->db->where('t.status',$_GET['status']);		
		if($lang_code)
		{		
			$this->db->where('t.lang_code',$lang_code);
		}
		else
		{
			$this->db->where('t.lang_code','en');
		}

		$this->db->from('tests as t');
		$this->db->join('categories as c','c.category_id=t.category_id','left');
		$this->db->join('users as u','u.userid=t.created_by','left');	

		if($this->input->post('sort_by')) $this->db->order_by('t.fb_like',$this->input->post('sort_by'));

		else 

		{
			$this->db->order_by('t.tests_id','desc');
			$this->db->order_by('activated_date','desc');
		}

		$query=$this->db->get();
		$res=$query->row();
		return $res->num;
	}

	
	function get_search_tests($lang_code='',$page,$limit,$post_type='games')
	{
		$this->db->where('t.post_type',$post_type);
		//echo $this->session->userdata('search'); exit;
		$this->db->select('t.*,c.category_name,u.first_name,u.last_name,u.username');
		
		
		if($this->session->userdata('search_realtest') != '')
		{
			$this->db->where('t.is_real_test',$this->session->userdata('search_realtest')); 
		}
		
		
		if($this->session->userdata('search')  && $post_type == 'games')
		{
			$this->db->like('LOWER(t.title)', strtolower($this->session->userdata('search')), 'both'); 
		}
		if($this->session->userdata('article_search')  && $post_type == 'articles')
		{
			$this->db->like('LOWER(t.title)', strtolower($this->session->userdata('article_search')), 'both'); 
		}	
		if($this->session->userdata('video_search')  && $post_type == 'videos')
		{
			$this->db->like('LOWER(t.title)', strtolower($this->session->userdata('video_search')), 'both'); 
		}
		if($this->session->userdata('list_search')  && $post_type == 'lists')
		{
			$this->db->like('LOWER(t.title)', strtolower($this->session->userdata('list_search')), 'both'); 
		}
		
		
		if($this->session->userdata('search_status') && $post_type == 'games')
		{
			$this->db->where('t.status',$this->session->userdata('search_status'));
		}
		else if($this->session->userdata('search_status') && $post_type == 'articles')
		{
			$this->db->where('t.status',$this->session->userdata('search_status'));
		}
		else if($this->session->userdata('search_status') && $post_type == 'videos')
		{
			$this->db->where('t.status',$this->session->userdata('search_status'));
		}
		else if($this->session->userdata('search_status') && $post_type == 'lists')
		{
			$this->db->where('t.status',$this->session->userdata('search_status'));
		}
		
		
		if($this->session->userdata('user_type')==2)
		{
			$this->db->where('t.status',2);
			$this->db->where('t.created_by',$this->session->userdata('user_id'));
		}

		if($this->session->userdata('user_type')==3)
		{
			$this->db->where('t.editor_control',1);
		}		

		if($this->session->userdata('user_type')==4)
		{
			$this->db->where('t.graphic_control',1);
		}
		
		if($this->session->userdata('search_user_id'))
		{
			$this->db->where('t.created_by',$this->session->userdata('search_user_id'));
		}
		//if(!empty($_GET['user_id'])) $this->db->where('t.created_by',$_GET['user_id']);
		//if(!empty($_GET['status'])) $this->db->where('t.status',$_GET['status']);
		
		if($lang_code)
		{		
			$this->db->where('t.lang_code',$lang_code);
		}
		else
		{
			$this->db->where('t.lang_code','en');
		}

		$this->db->from('tests as t');
		$this->db->join('categories as c','c.category_id=t.category_id','left');
		$this->db->join('users as u','u.userid=t.created_by','left');		

		if($this->input->post('sort_by')) $this->db->order_by('t.fb_like',$this->input->post('sort_by'));
		else 

		{
			$this->db->order_by('t.tests_id','desc');
			$this->db->order_by('activated_date','desc');

		}
		
		$this->db->limit($limit,$page);
		$query=$this->db->get();
		$res=$query->result();
		//echo $this->db->last_query();
		return $res;

	}
	
	function get_total_search_tests($lang_code,$post_type='games')
	{
		
		$this->db->select('count(*) as num');
		$this->db->where('t.post_type',$post_type);	
		
		if($this->session->userdata('search_realtest') != '')
		{
			$this->db->where('t.is_real_test',$this->session->userdata('search_realtest')); 
		}
		
		
		if($this->session->userdata('search')  && $post_type == 'games')
		{
			$this->db->like('LOWER(t.title)', strtolower($this->session->userdata('search')), 'both'); 
		}
		if($this->session->userdata('article_search')  && $post_type == 'articles')
		{
			$this->db->like('LOWER(t.title)', strtolower($this->session->userdata('article_search')), 'both'); 
		}	
		if($this->session->userdata('video_search')  && $post_type == 'videos')
		{
			$this->db->like('LOWER(t.title)', strtolower($this->session->userdata('video_search')), 'both'); 
		}
		if($this->session->userdata('list_search')  && $post_type == 'lists')
		{
			$this->db->like('LOWER(t.title)', strtolower($this->session->userdata('list_search')), 'both'); 
		}
		
		
		if($this->session->userdata('search_status') && $post_type == 'games')
		{
			$this->db->where('t.status',$this->session->userdata('search_status'));
		}
		else if($this->session->userdata('search_status') && $post_type == 'articles')
		{
			$this->db->where('t.status',$this->session->userdata('search_status'));
		}
		else if($this->session->userdata('search_status') && $post_type == 'videos')
		{
			$this->db->where('t.status',$this->session->userdata('search_status'));
		}
		else if($this->session->userdata('search_status') && $post_type == 'lists')
		{
			$this->db->where('t.status',$this->session->userdata('search_status'));
		}
		
		
		
		if($this->session->userdata('user_type')==2)
		{
			$this->db->where('t.status',2);
			$this->db->where('t.created_by',$this->session->userdata('user_id'));
		}

		if($this->session->userdata('user_type')==3)
		{
			$this->db->where('t.editor_control',1);
		}		

		if($this->session->userdata('user_type')==4)
		{
			$this->db->where('t.graphic_control',1);
		}

		//if(!empty($_GET['user_id'])) $this->db->where('t.created_by',$_GET['user_id']);
		if($this->session->userdata('search_user_id'))
		{
			$this->db->where('t.created_by',$this->session->userdata('search_user_id'));
		}
		//if(!empty($_GET['status'])) $this->db->where('t.status',$_GET['status']);		
		if($lang_code)
		{		
			$this->db->where('t.lang_code',$lang_code);
		}
		else
		{
			$this->db->where('t.lang_code','en');
		}

		$this->db->from('tests as t');
		$this->db->join('categories as c','c.category_id=t.category_id','left');
		$this->db->join('users as u','u.userid=t.created_by','left');	

		if($this->input->post('sort_by')) $this->db->order_by('t.fb_like',$this->input->post('sort_by'));

		else 

		{
			$this->db->order_by('t.tests_id','desc');
			$this->db->order_by('activated_date','desc');
		}

		$query=$this->db->get();
		$res=$query->row();
		return $res->num;
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

	

	

	function get_simple_tests($lang_code='en',$page,$limit)

	{

		$this->db->select('t.*,c.category_name,u.first_name,u.last_name,u.username');

		if(!empty($_GET['user_id'])) $this->db->where('t.created_by',$_GET['user_id']);

		if($this->session->userdata('search_status'))
		{
			$this->db->where('t.status',$this->session->userdata('search_status'));
		}
		
		if($this->session->userdata('search_template'))
		{
			
			if($this->session->userdata('search_template') =="personal")
			{
				$this->db->where("(t.is_real_test='0' OR t.is_real_test='1')", NULL, FALSE);
			}
			else
			{
				$this->db->where('t.is_real_test',$this->session->userdata('search_template')); 
			}
		}
		
		if($this->session->userdata('search'))
		{
			$this->db->like('LOWER(t.title)', strtolower($this->session->userdata('search')), 'both'); 
		}		

		$this->db->from('tests as t');

		$this->db->join('categories as c','c.category_id=t.category_id','left');

		$this->db->join('users as u','u.userid=t.created_by','left');

				
		if($this->session->userdata('search_sort_by'))
		{
			$this->db->order_by('t.fb_like',$this->session->userdata('search_sort_by'));
		}
		else
		{
			$this->db->order_by('t.activated_date','desc');
		}
		/*if($this->input->post('sort_by')) 
		{
			$this->db->order_by('t.fb_like',$this->input->post('sort_by'));
		}
		else 

		{
			//$this->db->order_by('t.modify_date','desc');
			//$this->db->order_by('t.tests_id','desc');
			$this->db->order_by('t.activated_date','desc');
		}*/
		
		$this->db->where('t.lang_code',$lang_code);
			

		
		$this->db->limit($limit,$page);
		$query=$this->db->get();
		//echo $this->db->last_query(); 
		$res=$query->result();

		return $res;

	}
	
	function get_total_simple_list($lang_code)
	{
		$this->db->select('count(*) as num');

		if(!empty($_GET['user_id'])) $this->db->where('t.created_by',$_GET['user_id']);
		$this->db->where('t.lang_code',$lang_code);
		if($this->session->userdata('search_status'))
		{
			$this->db->where('t.status',$this->session->userdata('search_status'));
		}
		
		if($this->session->userdata('search_template'))
		{
			
			if($this->session->userdata('search_template') =="personal")
			{
				$this->db->where("(t.is_real_test='0' OR t.is_real_test='1')", NULL, FALSE);
			}
			else
			{
				$this->db->where('t.is_real_test',$this->session->userdata('search_template')); 
			}
		}
		
		if($this->session->userdata('search'))
		{
			$this->db->like('LOWER(t.title)', strtolower($this->session->userdata('search')), 'both'); 
		}
		
		$this->db->from('tests as t');

		$this->db->join('categories as c','c.category_id=t.category_id','left');

		$this->db->join('users as u','u.userid=t.created_by','left');

		$query=$this->db->get();
		//echo $this->db->last_query(); 
		$res=$query->row();

		return $res->num;
	}

	

	

	

	function get_test($id,$lang_code='')

	{
		/*echo $id." <br/>"; 
		echo $lang_code; exit;*/
		$this->db->select('*');
		$this->db->where('testid',$id);
		if($lang_code=="all" || $lang_code=='')
		{
			$this->db->where('lang_code','en');
		}
		else
		{
			
			$this->db->where('lang_code',$lang_code);
		}
		$this->db->from('tests');
		//echo $this->db->last_query();
		$query=$this->db->get();
		$res=$query->row();
		return $res;

	}
	
	

	

	function get_test_content($testid,$lang_code)

	{

		$this->db->select('*');

		$this->db->where('testid',$testid);

		$this->db->where('lang_code',$lang_code);

		$this->db->from('tests');

		$query=$this->db->get();

		$res=$query->row();

		return $res;

	}

		

	function add_test($data)

	{

		$this->db->insert('tests',$data);
		//return $this->db->insert_id();
		$test_id=$this->db->insert_id();
		
		
		
		//-------- set ad config

		$config_info['test_id']=$test_id;
		$config_info['test_top']=1;

		$config_info['test_middle']=0;

		$config_info['test_bottom']=1;

		$config_info['test_left']=0;

		$config_info['test_right']=0;

		$config_info['question_top']=1;

		$config_info['question_middle']=0;

		$config_info['question_bottom']=1;

		$config_info['question_left']=0;

		$config_info['question_right']=0;

		$config_info['result_top']=1;

		$config_info['result_middle']=0;

		$config_info['result_middle2']=0;

		$config_info['result_bottom']=1;

		$config_info['result_left']=0;

		$config_info['result_right']=0;
		
		$test_info=$this->get_tw_test($test_id);
		
		if($test_info->is_real_test == 2)
		{
			$config_info['test_top']=1;
			$config_info['test_middle']=1;
			$config_info['test_bottom']=1;
		}
		
		$this->db->insert('tests_ad_config',$config_info);
		//echo $this->db->last_query(); exit;
		return $test_id;
		
		

	}
	
	function get_tw_test($id)

	{
		$this->db->select('*');
		$this->db->where('tests_id',$id);
		$this->db->from('tests');
		$query=$this->db->get();
		$res=$query->row();
		return $res;

	}

	

	

	function edit_test($data,$id,$lan='')

	{

		$this->db->where('testid',$id);
		if($lan)
		{
			$this->db->where('lang_code',$lan);
		}
		else
		{
			$this->db->where('lang_code','en');
		}

		$this->db->update('tests',$data);

		//echo $this->db->last_query();

	}
	
	function update_test($data,$id)

	{

		$this->db->where('tests_id',$id);
		$this->db->update('tests',$data);

		//echo $this->db->last_query();

	}

	

	function delete_test($id)

	{

		$this->db->where('tests_id',$id);

		$this->db->delete('tests');

	}

	

	function get_answers($test_question_id,$lang='')

	{

		$this->db->select('ta.*,tq.question');

		$this->db->where('ta.test_question_id',$test_question_id);

		if($lang)

		{

			$this->db->where('ta.lang_code',$lang);

			$this->db->where('tq.lang_code',$lang);

		}

		else

		{

			$this->db->where('ta.lang_code',$this->session->userdata('lang_code'));

			$this->db->where('tq.lang_code',$this->session->userdata('lang_code'));

		}

		$this->db->from('tests_answers as ta');		

		$this->db->join('tests_questions as tq','tq.test_questionid=ta.test_question_id','left');
		$this->db->order_by('answere_id','asc');
		$query=$this->db->get();
		

		$res=$query->result();

		return $res;

	}

	function get_questions($test_id,$lang='')

	{

		$this->db->select('q.*,t.title');

		$this->db->where('q.test_id',$test_id);

		if($lang == '')

		{

			$this->db->where('q.lang_code','en');

			$this->db->where('t.lang_code','en');

		}

		else

		{

			$this->db->where('q.lang_code',$lang);

			$this->db->where('t.lang_code',$lang);

		}

		$this->db->from('tests_questions as q');

		$this->db->join('tests as t','t.testid=q.test_id','left');

		$query=$this->db->get();

		$res=$query->result();

		//echo $this->db->last_query();
		

		return $res;

	}

	

	function get_queston_content($test_questionid,$lang_code)

	{

		$this->db->select('*');

		$this->db->where('test_questionid',$test_questionid);

		$this->db->where('lang_code',$lang_code);

		$this->db->from('tests_questions');

		$query=$this->db->get();

		//echo $this->db->last_query();

		$res=$query->row();		

		return $res;

	}

	

	function get_question($test_question_id,$lang_code='')

	{

		//echo $lang_code; exit;

		$this->db->select('q.*,t.title');

		$this->db->where('q.test_questionid',$test_question_id);
		if($lang_code == "all" || $lang_code == "")

		{
			$this->db->where('q.lang_code','en');
		}
		else
		{
			$this->db->where('q.lang_code',$lang_code);
		}
		

		$this->db->from('tests_questions as q');

		$this->db->join('tests as t','t.tests_id=q.test_id','left');

		$query=$this->db->get();

		$res=$query->row();

		//echo $this->db->last_query();

		return $res;

	}
	
	function get_question_by_pk_id($test_question_id)
	{

		
		$this->db->select('*');
		$this->db->where('test_question_id',$test_question_id);
		$this->db->from('tests_questions');
		$query=$this->db->get();
		$res=$query->row();
		return $res;

	}

	function add_question($data)

	{

		$this->db->insert('tests_questions',$data);

		$question_id=$this->db->insert_id();

		return $question_id;

	}

	function question_edit($data,$id)
	{
		$this->db->where('test_question_id',$id);
		$this->db->update('tests_questions',$data);
	}

	function question_delete($id)

	{

		$this->db->where('test_question_id',$id);

		$this->db->delete('tests_questions');

	}

	

	

	

	

	function get_answer($id,$lang_code='')

	{

		

		$this->db->select('*');

		$this->db->where('answereid',$id);

		if($lang_code == "" || $lang_code == "all" )
		{
			$this->db->where('lang_code','en');

		}
		else
		{
			$this->db->where('lang_code',$lang_code);
		}

		$this->db->from('tests_answers');

		$query=$this->db->get();

		$res=$query->row();

		return $res;

	}

	

	function get_answer_content($answereid,$lang_code)

	{

		$this->db->select('*');

		$this->db->where('answereid',$answereid);		

		$this->db->where('lang_code',$lang_code);

		$this->db->from('tests_answers');

		$query=$this->db->get();

		$res=$query->row();

		//echo $this->db->last_query();

		return $res;

	}

	

	function add_answer($data)

	{

		$this->db->insert('tests_answers',$data);

		return $this->db->insert_id();

	}

	

	function add_batch_answer($data)

	{

		$this->db->insert_batch('tests_answers',$data);
		return $this->db->insert_id();
	}

	

	function edit_answer($data,$id,$lang_code='')

	{

		$this->db->where('answereid',$id);

		if($lang_code)

		{

			$this->db->where('lang_code',$lang_code);

		}

		else

		{

			$this->db->where('lang_code','en');

		}
		

		$this->db->update('tests_answers',$data);

	}

	

	function update_answer_lang($data,$id)

	{

		$this->db->where('answere_id',$id);

		$this->db->update('tests_answers',$data);

	}

	

	function answer_delete($id)

	{

		$this->db->where('answere_id',$id);

		$this->db->delete('tests_answers');

	}

	function is_unique_alia($alias)

	{

		$this->db->select('count(*) as num');

		$this->db->where('alias',trim($alias));

		$this->db->from('tests');

		$query=$this->db->get();

		$res=$query->row();

		if($res->num > 0) return false;

		else return true;

	}

	

	function get_result_options($id,$lang='')

	{

		$this->db->select('*');

		$this->db->where('test_id',$id);

		if($lang)

		{

			$this->db->where('lang_code',$lang);

		}

		else

		{

			$this->db->where('lang_code',$this->session->userdata('lang_code'));

		}

		$this->db->from('result_options');

		$query=$this->db->get();

		$res=$query->result();

		return $res;

	}

	function get_result_option($result_optionid,$lang_code='')

	{
		//echo $lang_code;
		$this->db->select('*');

		$this->db->where('result_optionid',$result_optionid);

		if($lang_code=="" ||$lang_code=="all" )

		{
			$this->db->where('lang_code','en');
		}

		else

		{

			$this->db->where('lang_code',$lang_code);

		}

		$this->db->from('result_options');

		$query=$this->db->get();

		$res=$query->row();

		return $res;

	}

	

	function add_result_option($data)

	{

		$this->db->insert('result_options',$data);

		return $this->db->insert_id();

	}

	
	function save_resultOption($data,$result_option_id)
	{
		$this->db->where('result_option_id',$result_option_id);
		$this->db->update('result_options',$data);
	}
	function save_result_option($data,$result_option_id,$lang='')

	{

		$this->db->where('result_optionid',$result_option_id);
		if($lang == "")
		{
			$this->db->where('lang_code','en');
		}
		else
		{
			$this->db->where('lang_code',$lang);
		}
		
		$this->db->update('result_options',$data);

	}

	

	function update_result_option($data,$result_optionid,$lang_code)

	{

		$this->db->where('result_optionid',$result_optionid);

		$this->db->where('lang_code',$lang_code);

		$this->db->update('result_options',$data);

	}

	function update_wizard_result($data,$result_optionid)
	{

		$this->db->where('result_option_id',$result_optionid);

		$this->db->where('lang_code','en');

		$this->db->update('result_options',$data);

	}

	function delete_result_option($result_option_id)

	{

		$this->db->where('result_option_id',$result_option_id);

		$this->db->delete('result_options');

	}

	

	

	

	

	

	function get_tests_ads($page,$limit)

	{
		$this->db->select('t.*,ta.*');
		if($this->session->userdata('search_test_ads'))
		{
			$this->db->like('LOWER(t.title)', strtolower($this->session->userdata('search_test_ads')), 'both'); 
		}
		
		if($this->session->userdata('test_type'))
		{
			
			if($this->session->userdata('test_type') =="personal")
			{
				$this->db->where("(t.is_real_test='0' OR t.is_real_test='1')", NULL, FALSE);
			}
			else
			{
				$this->db->where('t.is_real_test',$this->session->userdata('test_type')); 
			}
		}
		
		$this->db->from('tests as t');
		$this->db->join('tests_ad_config as ta','ta.test_id=t.tests_id','left');
		$this->db->order_by('t.tests_id','desc');
		$this->db->limit($limit,$page);
		$query=$this->db->get();
		//echo $this->db->last_query();	
		$res=$query->result();
		return $res;

	}
	
	function get_total_tests_ads()

	{

		$this->db->select('count(*) as num');
		if($this->session->userdata('search_test_ads'))
		{
			$this->db->like('LOWER(t.title)', strtolower($this->session->userdata('search_test_ads')), 'both'); 
		}
		if($this->session->userdata('test_type'))
		{
			$this->db->where('t.is_real_test',$this->session->userdata('test_type')); 
		}
		//$this->db->where('t.status',1);
		$this->db->from('tests as t');
		$this->db->join('tests_ad_config as ta','ta.test_id=t.tests_id','left');
		$this->db->order_by('t.tests_id','desc');
		$query=$this->db->get();		
		$res=$query->row();
		return $res->num;
	}

	

	

	function save_test_ad_config($data,$test_id=0)
	{
		/*if(is_array($test_id))
		{
			$this->db->where_in('test_id',$test_id);
		}*/
	    if($test_id > 0) 
		{
			$this->db->where('test_id',$test_id);
		}

		$this->db->update('tests_ad_config',$data);

	}
	
	function have_test_ad_config($test_id)
	{
		$this->db->select('count(*) as num');
		$this->db->where('test_id',$test_id);
		$this->db->from('tests_ad_config');
		$query=$this->db->get();
		$res=$query->row();
		if($res->num > 0) return true;
		else return false;
	}
	
	function add_test_ad_config($test_id)
	{
		$config_info['test_id']=$test_id;

		$config_info['test_top']=1;

		$config_info['test_middle']=0;

		$config_info['test_bottom']=1;

		$config_info['test_left']=0;

		$config_info['test_right']=0;

		$config_info['question_top']=1;

		$config_info['question_middle']=0;

		$config_info['question_bottom']=1;

		$config_info['question_left']=0;

		$config_info['question_right']=0;

		$config_info['result_top']=1;

		$config_info['result_middle']=0;

		$config_info['result_middle2']=0;

		$config_info['result_bottom']=1;

		$config_info['result_left']=0;

		$config_info['result_right']=0;
		

		$this->db->insert('tests_ad_config',$config_info);
	}

	

	function addOrdinalNumberSuffix($num) {

    if (!in_array(($num % 100),array(11,12,13))){

      switch ($num % 10) {

        // Handle 1st, 2nd, 3rd

        case 1:  return $num.'st';

        case 2:  return $num.'nd';

        case 3:  return $num.'rd';

      }

    }

    return $num.'th';

  }

  

  

  function get_flags()

  {

  		$this->db->select('*');

		$this->db->from('flags');

		$query=$this->db->get();

		$res=$query->result();

		return $res;

  }

  

  function gerenate_flag_icon($flags)

  {

  	 $flags=unserialize($flags);

	 $this->db->select('*');

	 $this->db->where_in('flag_id',$flags);

	 $this->db->from('flags');

	 $query=$this->db->get();

	 $res=$query->result();

	 $icons="";

	 if($res)

	 {

	 	foreach($res as $row)

		{

			if($row->flag == 'Posted on Facebook') $icons='&nbsp;<i class="fa fa-facebook"></i> ';

		}

	 }

	 return $icons;

  }

	

	function update_all_image_added($data,$id)

	{

		$this->db->where('tests_id',$id);

		$this->db->update('tests',$data);

		//echo $this->db->last_query();exit;

	}

	function update_all_content_ready($data,$id)

	{

		$this->db->where('tests_id',$id);

		$this->db->update('tests',$data);

	}

	

	function save_test_content($data)

	{

		$this->db->insert('tests',$data);
		//return $this->db->insert_id();
		$test_id=$this->db->insert_id();
		
		//-------- set ad config

		$config_info['test_id']=$test_id;

		$config_info['test_top']=1;

		$config_info['test_middle']=0;

		$config_info['test_bottom']=1;

		$config_info['test_left']=0;

		$config_info['test_right']=0;

		$config_info['question_top']=1;

		$config_info['question_middle']=0;

		$config_info['question_bottom']=1;

		$config_info['question_left']=0;

		$config_info['question_right']=0;

		$config_info['result_top']=1;

		$config_info['result_middle']=0;

		$config_info['result_middle2']=0;

		$config_info['result_bottom']=1;

		$config_info['result_left']=0;

		$config_info['result_right']=0;
		
		
		
		$this->db->insert('tests_ad_config',$config_info);
		
		return $test_id;
		

	}

	

	function update_test_content($data,$testid,$lang_code)

	{

		$this->db->where('testid',$testid);

		$this->db->where('lang_code',$lang_code);

		$this->db->update('tests',$data);

	}

	

	function update_question_content($data,$test_questionid,$lang_code)

	{

		$this->db->where('test_questionid',$test_questionid);

		$this->db->where('lang_code',$lang_code);

		$this->db->update('tests_questions',$data);

	}

	

	function get_result_content($result_optionid,$lang_code)

	{

		$this->db->select('*');

		$this->db->where('result_optionid',$result_optionid);

		$this->db->where('lang_code',$lang_code);

		$this->db->from('result_options');

		$query=$this->db->get();

		$res=$query->row();		

		return $res;

	}
	
	
	
	function get_tests_languages($test_id)
	{
		$this->db->select('lang_code');
		$this->db->where('testid',$test_id);
		$this->db->from('tests');
		$query=$this->db->get();
		$res=$query->result();
		
		$langs=array();
		if($res)
		{
			foreach($res as $row)
			{
				$langs[]=$row->lang_code;
			}
		}
		
		return $langs;
	}
	
	function get_question_languages($test_questionid)
	{
		$this->db->select('lang_code');
		$this->db->where('test_questionid',$test_questionid);
		$this->db->from('tests_questions');
		$query=$this->db->get();
		$res=$query->result();
		
		$langs=array();
		if($res)
		{
			foreach($res as $row)
			{
				$langs[]=$row->lang_code;
			}
		}
		
		return $langs;
	}
	
	function test_delete($id,$lan)
	{
		$this->db->where('testid',$id);
		$this->db->where('lang_code',$lan);
		$this->db->delete('tests');
	}

 	function test_qestions($testid,$lan)
	{
		$this->db->where('test_id',$testid);
		$this->db->where('lang_code',$lan);
		$this->db->delete('tests_questions');
	}
	
	function test_answers($questionid,$lan)
	{
		
		$this->db->where_in('test_question_id', $questionid );
		$this->db->where('lang_code',$lan);
		$this->db->delete('tests_answers');
	}
	
	function get_tests_id($testid,$lan)
	{
		$this->db->select('*');
		$this->db->where('testid',$testid);
		$this->db->where('lang_code',$lan);
		$this->db->from('tests');
		$query=$this->db->get();
		$res=$query->row();
		return $res->tests_id;
	}
	
	
	function delete_test_add_config($tests_id)
	{
		$this->db->where('test_id',$tests_id);
		$this->db->delete('tests_ad_config');
	}
	
	function have_test($test_id)
	{
		$this->db->select('count(*) as num');
		$this->db->where('tests_id',$test_id);
		$this->db->from('tests');
		$query=$this->db->get();
		$res=$query->row();
		if($res->num > 0) return true;
		else return false;
	}
	
	function delete_test_ads_config($id)
	{
		$this->db->where('id',$id);		
		$this->db->delete('tests_ad_config');
	}
	
	function add_test_metas($data)
	{
		$this->db->insert_batch('test_meta',$data);
	}
	function add_meta($data)
	{
		$this->db->insert('test_meta',$data);
	}
	function has_meta($test_id, $meta_key)
	{
		$this->db->select('count(*) as num');
		$this->db->where('test_id',$test_id);
		$this->db->where('meta_key',$meta_key);
		$this->db->from('test_meta');
		$query=$this->db->get();
		$res=$query->row();
		if($res->num > 0) return true;
		else return false;
		
	}
	function edit_testMeta($data,$test_id,$meta_key)
	{
		if($this->has_meta($test_id,$meta_key))
		{
			$this->db->where('test_id',$test_id);
			$this->db->where('meta_key',$meta_key);
			$this->db->update('test_meta',$data);
		}
		else
		{
			$meta_info['meta_value']=$data['meta_value'];
			$meta_info['meta_key']=$meta_key;
			$meta_info['test_id']=$test_id;
			
			$this->add_meta($meta_info);
		}
	}
	
	function delete_postmeta($id)
	{
		$this->db->where('test_id',$id);
		$this->db->delete('test_meta');
	}
	
	
	function get_items($test_id,$lang='')
	{
		$this->db->select('i.*,t.title');
		$this->db->where('i.test_id',$test_id);
		if($lang == '')
		{
			$this->db->where('i.lang_code','en');
			//$this->db->where('t.lang_code','en');
		}
		else
		{
			$this->db->where('i.lang_code',$lang);
			//$this->db->where('t.lang_code',$lang);
		}
		$this->db->from('list_items as i');
		$this->db->join('tests as t',"t.testid=i.test_id and t.lang_code='en'",'left');
		$query=$this->db->get();
		$res=$query->result();
		//echo $this->db->last_query();
		return $res;
	}
	
	function add_item($data)
	{
		$this->db->insert('list_items',$data);
		return $this->db->insert_id();
	}
	
	function item_edit($data,$id)
	{
		$this->db->where('list_item_id',$id);
		$this->db->update('list_items',$data);
	}
	
	function item_delete($id)
	{
		$this->db->where('list_item_id',$id);
		$this->db->delete('list_items');
	}
	
	function get_item_content($list_itemid,$lang_code)
	{
		$this->db->select('*');
		$this->db->where('list_itemid',$list_itemid);
		$this->db->where('lang_code',$lang_code);
		$this->db->from('list_items');
		$query=$this->db->get();
		//echo $this->db->last_query();
		$res=$query->row();		
		return $res;
	}
	
	function update_item_content($data,$list_itemid,$lang_code)
	{
		$this->db->where('list_itemid',$list_itemid);
		$this->db->where('lang_code',$lang_code);
		$this->db->update('list_items',$data);
	}
	
	function get_test_ids($test_type)
	{
		$this->db->select('tests_id');
		if($test_type=="personal")
		{
			$this->db->where("(is_real_test='0' OR is_real_test='1')", NULL, FALSE);
		}
		else if($test_type !="all")
		{
			$this->db->where('is_real_test',$test_type);
		}
		
		$this->db->from('tests');
		$query=$this->db->get();
		$res=$query->result();
		$ids=array();
		if($res)
		{
			foreach($res as $row)
			{
				$ids[]=$row->tests_id;
			}
		}
		return $ids;
	}
	
	function save_test_adConfig($data,$test_ids=array())
	{
		if(is_array($test_ids))
		{
			$this->db->where_in('test_id',$test_ids);
		}
	    

		$this->db->update('tests_ad_config',$data);

	}
	
	function get_banners($template)
	{
		$this->db->select('*');
		$this->db->where('template',$template);
		$this->db->from('banners');
		$query=$this->db->get();
		$res=$query->result();
		//echo $this->db->last_query();
		return $res;
	}
	
	function delete_test_banners($test_id)
	{
		$this->db->where('test_id',$test_id);
		$this->db->delete('test_banners');
	}
	function add_test_banner($data)
	{
		$this->db->insert('test_banners',$data);
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
	
	
	function default_question($testid,$questionid='',$lang='en',$start=0,$limit)
	{ 
		$start=$start-1;
		$this->db->select('*');
		$this->db->where('test_id',$testid);
		$this->db->where('lang_code',$lang);
		//if($questionid) $this->db->where('test_questionid',$questionid);
		//if(!$questionid)
		//{
			$this->db->order_by('test_question_id','asc');
			$this->db->limit($limit,$start);
		//}
		$this->db->from('tests_questions');
		$query=$this->db->get();
		$res=$query->row();
		//echo $this->db->last_query();
		return $res;
	}
	
	function default_result($testid,$lang,$start=0,$limit)
	{
		$start=$start-1;
		$this->db->select('*');
		$this->db->where('test_id',$testid);
		$this->db->where('lang_code',$lang); 
		$this->db->order_by('result_option_id','asc');
		$this->db->limit($limit,$start);
		$this->db->from('result_options');
		$query=$this->db->get();
		$res=$query->row();
		//echo $this->db->last_query();
		return $res;
	}
	
	function add_checkings($data)
	{
		$this->db->insert('test_checkings',$data);
	}
	function remove_checking($testid,$lang_code)
	{
		$this->db->where('testid',$testid);
		$this->db->where('lang_code',$lang_code);
		$this->db->delete('test_checkings');
	}
	function has_checked($testid,$lang_code)
	{
		$this->db->select('*');
		$this->db->where('testid',$testid);
		$this->db->where('lang_code',$lang_code);
		$this->db->from('test_checkings');
		$query=$this->db->get();
		$res=$query->row();
		return $res;
	}

}

?>

