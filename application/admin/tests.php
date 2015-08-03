<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tests extends CI_Controller {      

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
	
	var $test_image_width=425;
	var $test_image_height=223;
	var $question_img_width=600;
	var $question_img_height=312;
	function __construct() 

	{

		parent::__construct();
		//site_url();
		if(!$this->session->userdata('user_id')) redirect('admin/auth');

		$this->load->model('admin/test_model');		
	
           

	}
	
	
	function delete_test_ads_config()
	{
		$this->db->select('*');
		$this->db->from('tests_ad_config');		
		$query=$this->db->get();
		$res=$query->result();
		//print_r($res);
		foreach($res as $row)
		{
			if(!$this->test_model->have_test($row->test_id))
			{
				$this->test_model->delete_test_ads_config($row->id);
			}
		}
		
	}
	
	/*function refresh_test_ads_config()
	{
		$this->db->select('*');
		$this->db->from('tests');
		$this->db->limit(100,"0");
		$query=$this->db->get();
		$res=$query->result();
		foreach($res as $row)
		{
			if(!$this->test_model->have_test_ad_config($row->tests_id))
			{
				$this->test_model->add_test_ad_config($row->tests_id);
			}
		}
	}*/
	
	
	
	
	/*function resizing_img()
	{
		
		$this->db->select('*');
		//$this->db->where('image_thumb', '');
		$this->db->where('image !=', '');
		$this->db->from('tests');
		$this->db->order_by('tests_id','asc');
		$this->db->limit(1000,"0");
		$query=$this->db->get();
		$res=$query->result();
		
		
		if(count($res) > 0)
		{ 
			foreach($res as $row)
			{
				if($row->image != '')
				{	
					
					$this->load->library('image_lib');
					$settings['image_library'] = 'gd2';
					$settings['source_image']	= 'assets/img/image/'.$row->image;
					$settings['create_thumb'] = true;
					$settings['thumb_marker'] = '';
					$settings['maintain_ratio'] = false;
					$settings['new_image'] = 'assets/img/thumbs/'.$row->image;
					$settings['width']	 = 425;
					$settings['height']	 = 223;
					$this->load->library('image_lib');
					$this->image_lib->initialize($settings); 
					$this->image_lib->resize();
					
					$data['image_thumb']=$row->image;
					$this->test_model->update_test($data,$row->tests_id);
				}
			}
		}
		else
		{
			echo "completed"; exit;
		}

	}*/

	function index($lang_code='en',$page=0)

	{	
		
		$this->session->set_userdata('search','');
		$this->session->set_userdata('search_status','');
		$this->session->set_userdata('search_user_id','');
		$this->session->set_userdata('search_realtest','');
		
		
		
		$total_rows = $this->test_model->get_total_tests($lang_code);
		
		$limit=30;
		$this->load->library('pagination');
	
		$config['base_url'] = site_url().'admin/tests/index/'.$lang_code;
		$config['uri_segment'] = 5;
		$config['num_links'] = 10;
		$config['prev_link'] = 'Pre';
		$config['next_link'] = 'Next';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		$this->pagination->initialize($config);
		$db_data['pagination']=$this->pagination->create_links();
		$db_data['total_record']=$total_rows;
		
		$db_data['page_number']=$page;
		
		
		
        $db_data['test_list']=$this->test_model->get_tests($lang_code,$page,$limit);	
		$db_data['lang']=$lang_code;
		$db_data['language_list']=$this->test_model->get_languages();	

		$data['content'] = $this->load->view('admin/test/test_list',$db_data,true);

		//----- this is for breadcrumbs

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Dashboard','href'=>site_url().'admin');

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Test List','href'=>'');

		$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

		$data['page_header']="Tests";

		//------- end breadcrumbs

		$data['active_menu']='';

		$this->load->view('admin/layout/default',$data);   

	}
	
	function search_tests($lang_code='en',$page=0)
	{
		
		if($this->input->post('search'))
		{
			$this->session->set_userdata('search',$this->input->post('search'));
		}
		
		if(isset($_GET['status']))
		{
			$this->session->set_userdata('search_status',$_GET['status']);
		}
		
		
		if(isset($_GET['user_id']))
		{
			$this->session->set_userdata('search_user_id',$_GET['user_id']);
		}
				
		if(isset($_GET['realtest']))
		{ 
			$this->session->set_userdata('search_realtest',$_GET['realtest']);
		}
		
		$total_rows = $this->test_model->get_total_search_tests($lang_code);
		
		$limit=30;
		$this->load->library('pagination');
	
		$config['base_url'] = site_url().'admin/tests/search_tests/'.$lang_code;
		$config['uri_segment'] = 5;
		$config['num_links'] = 10;
		$config['prev_link'] = 'Pre';
		$config['next_link'] = 'Next';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		$this->pagination->initialize($config);
		$db_data['pagination']=$this->pagination->create_links();
		$db_data['total_record']=$total_rows;
		
		$db_data['page_number']=$page;
		
		
		
        $db_data['test_list']=$this->test_model->get_search_tests($lang_code,$page,$limit);	
		$db_data['lang']=$lang_code;
		$db_data['language_list']=$this->test_model->get_languages();	

		$data['content'] = $this->load->view('admin/test/test_list',$db_data,true);

		//----- this is for breadcrumbs

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Dashboard','href'=>site_url().'admin');

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Test List','href'=>'');

		$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

		$data['page_header']="Tests";

		//------- end breadcrumbs

		$data['active_menu']='';

		$this->load->view('admin/layout/default',$data);
		

		
	}

	

	function simple_list($lang_code='en',$page=0)
	{	

		$this->session->set_userdata('search_sort_by','');
		$this->session->set_userdata('search_language','');	
		$total_rows = $this->test_model->get_total_simple_list($lang_code);
		
		$limit=30;
		$this->load->library('pagination');
	
		$config['base_url'] = site_url().'admin/tests/simple_list_search/'.$lang_code;
		$config['uri_segment'] = 5;
		$config['num_links'] = 10;
		$config['prev_link'] = 'Pre';
		$config['next_link'] = 'Next';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		$this->pagination->initialize($config);
		$db_data['pagination']=$this->pagination->create_links();
		$db_data['total_record']=$total_rows;
		
		$db_data['page_number']=$page;

        $db_data['test_list']=$this->test_model->get_simple_tests($lang_code,$page,$limit);		
		$db_data['language_list']=$this->test_model->get_languages();
		$data['content'] = $this->load->view('admin/test/simple_test_list',$db_data,true);

		//----- this is for breadcrumbs

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Dashboard','href'=>site_url().'admin');

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Simple Test List','href'=>'');

		$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

		$data['page_header']="Tests";

		//------- end breadcrumbs

		$data['active_menu']='';

		$this->load->view('admin/layout/default',$data);   

	}
	
	function simple_list_search($lang_code='en',$page=0)
	{	
		if($this->session->userdata('search_language')) 
		{	
			$lang_code=$this->session->userdata('search_language');
		}
		if($this->input->post('sort_by')) 
		{	
			$this->session->set_userdata('search_sort_by',$this->input->post('sort_by'));			
		}
		if($this->input->post('sort_by_language')) 
		{	
			$this->session->set_userdata('search_language',$this->input->post('sort_by_language'));
			$lang_code=$this->session->userdata('search_language');
		}


		//echo $lang_code;
		$total_rows = $this->test_model->get_total_simple_list($lang_code);
		
		$limit=30;
		$this->load->library('pagination');
	
		$config['base_url'] = site_url().'admin/tests/simple_list_search/'.$lang_code;
		$config['uri_segment'] = 5;
		$config['num_links'] = 10;
		$config['prev_link'] = 'Pre';
		$config['next_link'] = 'Next';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		$this->pagination->initialize($config);
		$db_data['pagination']=$this->pagination->create_links();
		$db_data['total_record']=$total_rows;
		
		$db_data['page_number']=$page;

        $db_data['test_list']=$this->test_model->get_simple_tests($lang_code,$page,$limit);		
		$db_data['language_list']=$this->test_model->get_languages();
		$data['content'] = $this->load->view('admin/test/simple_test_list',$db_data,true);

		//----- this is for breadcrumbs

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Dashboard','href'=>site_url().'admin');

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Simple Test List','href'=>'');

		$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

		$data['page_header']="Tests";

		//------- end breadcrumbs

		$data['active_menu']='';

		$this->load->view('admin/layout/default',$data);   

	}

	

	

	

	
	function add($lan='en')
	{
		if($this->input->post('add'))
		{
			$add_type="test_add";
			$add_type=$this->input->post('add_type');
			redirect('admin/tests/'.$add_type."/".$lan);
		}
		else
		{
			$db_data['lan']=$lan;
			$data['content']=$this->load->view('admin/test/add_form',$db_data,true);
			//----- this is for breadcrumbs
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new",'href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Test Edit Form";
			//------- end breadcrumbs
			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data);
		}
	}
	function test_add($lan='')

	{

		if($this->input->post('add_test'))

		{

			$test['title']=$this->input->post('title');

			$test['page_title']=$this->input->post('page_title');
			//if(lan=='') $lancode='en'; else $lancode=$lan;
			$test['lang_code']='en';			

			$test['category_id']=$this->input->post('category_id');

			$test['created_by']=$this->session->userdata('user_id');

			$test['description']=$this->input->post('description');

			$test['start_point']=$this->input->post('start_point');

			$test['result_text']=$this->input->post('result_text');

			$test['is_real_test']=$this->input->post('is_real_test');



			

			$test['fbshare_des']="At the end of the quiz we will give you the result. It may surprise you a lot, so share with your friends to see what they got!.";

			$test['question']="You will see few questions describing you. Be honest, and find out what your result is at the end of the quiz.";

			$test['answer']="You cannot change your answers - keep this in mind, but do not think about them too long.";

			$test['fun']="This test is not based on any scientific study whatsoever. It is made for fun only so do not treat the result too seriously :)";

			$test['enjoy_and_share']="At the end of the quiz we will give you the result. It may surprise you a lot.";

			$test['popup_box_text']="Share your result with your friends and see what result they've got! That might surprise both of you!";

			

			$test['status']=2;

			if($this->input->post('direct_start'))

			{

			 $test['direct_start']=$this->input->post('direct_start'); 

			}

			else

			{

				$test['direct_start']=2; 

			}

			

			$test['created']=date('Y-m-d');

			$test['modify_date']=date('Y-m-d H:i:s');

			

			$config['upload_path'] = 'assets/img/image/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']  = '0';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			
			$this->load->library('upload');
		    $this->upload->initialize($config);
			$this->load->library('image_lib');			

			if($this->upload->do_upload('image'))
			{
				$file_info = $this->upload->data();
				$test['image']=$file_info['file_name'];				
			} 

			// Upload thumb image	
			$this->image_lib->clear();		
			$config['upload_path'] = 'assets/img/thumbs/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']  = '0';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			
			$this->load->library('upload');
		    $this->upload->initialize($config);
			$this->load->library('image_lib');			

			if($this->upload->do_upload('image_thumb'))
			{
				$file_info = $this->upload->data();
				
				$this->image_lib->clear();
				$settings['image_library'] = 'gd2';
				$settings['source_image']	= 'assets/img/thumbs/'.$file_info['file_name'];
				$settings['create_thumb'] = true;
				$settings['thumb_marker'] = '';
				$settings['maintain_ratio'] = false;
				$settings['new_image'] = 'assets/img/thumbs/'.$file_info['file_name'];
				$settings['width']	 = $this->test_image_width;
				$settings['height']	 = $this->test_image_height;	

				$this->load->library('image_lib');
				$this->image_lib->initialize($settings); 			
				$this->image_lib->resize();
				
				$test['image_thumb']=$file_info['file_name'];
			}
			// End upload thumb image

			

			$id=$this->test_model->add_test($test);
			
			//-------- meta insert -----
			$meta_info['test_id']=$id;
			$meta_info['meta_key']='sub_title';
			$meta_info['meta_value']=$this->input->post('sub_title');
			
			$this->test_model->add_meta($meta_info);			
			//--------end  meta insert -----
			
			//echo "skjfklsdf"; exit;

			//----------------------

			$input_alias=str_replace(" ",'-',strtolower(trim($this->input->post('title'))));

			$input_alias=str_replace(array("\r", "\n", "'",'"',",","?",":",";"), "", $input_alias);

			if($this->test_model->is_unique_alia($input_alias))

			{

				$alias=$input_alias;

			}

			else

			{

				$alias=$input_alias."-".$id;

			}

			

			$tests_update['alias']=$alias;

			$tests_update['testid']=$id;
			//print_r($tests_update); exit; 

			$this->test_model->update_test($tests_update,$id);

			//-------------------------

			$this->session->set_flashdata('success_message','test has been saved');
			
			redirect('admin/tests/index/'.$lan);

		}

		else

		{

			

			$db_data['category_list']=$this->test_model->get_categories('en');
			$db_data['lan']=$lan;
			$data['content']=$this->load->view('admin/test/test_add_form',$db_data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new",'href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Test Edit Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}

	

	

	

	function check_duplicate_alias($str)

	{

		

		$alias=$this->input->post('alias');

		$test_id=$this->input->post('tests_id');

		

		$this->db->select('count(*) as num');

		$this->db->where('alias',$alias);

		if($this->input->post('testid'))

		{

			$this->db->where('testid !=',$this->input->post('testid'));

		}

		else

		{

			$this->db->where('testid !=',$test_id);

		}

		

		$this->db->from('tests');

		$query=$this->db->get();

		$res=$query->row();	

		$res->num;

		if($res->num > 0)

		{

			$this->form_validation->set_message('check_duplicate_alias', 'This alias already used , please try with another.');

			return FALSE;

		} 

		else

		{

			

			return true;

		}  

	}

	

	function test_edit($id,$lan,$referance='default')
	{
		if($this->input->post('edit_test'))
		{
			$this->load->library( 'form_validation' );
			if($this->session->userdata('user_type') != 2) 
			{
				$this->form_validation->set_rules('alias', 'Alias', 'trim|required|callback_check_duplicate_alias');
			}
			else
			{
				$this->form_validation->set_rules('title', 'Title', 'trim|required');
			}
			if($this->form_validation->run()) 
			{
				$test['title']=$this->input->post('title');
				$test['result_text']=$this->input->post('result_text');
				$test['page_title']=$this->input->post('page_title');
				$test['description']=$this->input->post('description');
				
				if($this->session->userdata('user_type') != 2)
				{
					$test['alias']=$this->input->post('alias');
					
					$test['category_id']=$this->input->post('category_id');
					
					$test['start_point']=$this->input->post('start_point');
					
					$test['is_real_test']=$this->input->post('is_real_test');
					//if($this->input->post('featured')) $test['featured']=$this->input->post('featured');
					$test['featured']=$this->input->post('featured');
					/*echo "<pre>";
					print_r($test); exit;*/
					
					$test['fbshare_des']=$this->input->post('fbshare_des');
					$test['modify_date']=date('Y-m-d H:i:s');
					$test['activated_date']=date('Y-m-d H:i:s');
					//------- manage flags
					$flags='';
					if($this->input->post('flags'))
					{
						$flags=$this->input->post('flags');
						$flags=serialize($flags);
					} 
					$test['flags']=$flags;
					//--------- end flags 
					if($this->input->post('direct_start'))
					{
					 $test['direct_start']=$this->input->post('direct_start'); 
					}
					else
					{
						$test['direct_start']=2; 
					}

					$test['created']=date('Y-m-d');

					$config['upload_path'] = 'assets/img/image/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']  = '0';
					$config['max_width']  = '0';
					$config['max_height']  = '0';
					
					$this->load->library('upload');
					$this->upload->initialize($config);
					$this->load->library('image_lib');					
					
					
					if($this->upload->do_upload('image'))
					{
						$file_info = $this->upload->data();
						$test['image']=$file_info['file_name'];
				
						@unlink($this->input->post('pre_img_path'));
					}
					if($lan  == 'en')
					{
						// upload thumb image
						$this->image_lib->clear();
						$config['upload_path'] = 'assets/img/thumbs/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['max_size']  = '0';
						$config['max_width']  = '0';
						$config['max_height']  = '0';
						
						$this->load->library('upload');
						$this->upload->initialize($config);
						$this->load->library('image_lib');					
	
						if($this->upload->do_upload('image_thumb'))
						{
							$file_info = $this->upload->data();
							
							$this->image_lib->clear();
							$settings['image_library'] = 'gd2';
							$settings['source_image']	= 'assets/img/thumbs/'.$file_info['file_name'];
							$settings['create_thumb'] = true;
							$settings['thumb_marker'] = '';
							$settings['maintain_ratio'] = false;
							$settings['new_image'] = 'assets/img/thumbs/'.$file_info['file_name'];
							$settings['width']	 = $this->test_image_width;
							$settings['height']	 = $this->test_image_height;	
			
							$this->load->library('image_lib');
							$this->image_lib->initialize($settings); 			
							$this->image_lib->resize();
							
							$test['image_thumb']=$file_info['file_name'];
							@unlink($this->input->post('pre_img_path2'));
	
						}
					}
					// upload result_bg_image image
					$this->image_lib->clear();
					$config['upload_path'] = 'assets/img/test_result_img/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']  = '0';
					$config['max_width']  = '0';
					$config['max_height']  = '0';
					
					$this->load->library('upload');
					$this->upload->initialize($config);
					$this->load->library('image_lib');					

					if($this->upload->do_upload('result_bg_image'))
					{
						$file_info = $this->upload->data();	
										
						$tests_Id=$this->input->post('testId');
						$meta_info['meta_value']=$file_info['file_name'];				
						$this->test_model->edit_testMeta($meta_info,$tests_Id,'fb_apps_result_image');
						@unlink($this->input->post('pre_img_path3'));
						
						
					}
					
					// end upload result_bg_image image

				}
				
				
				
				
				if($this->input->post('is_real_test') == 6)
				{
					$meta_info=array();
					$meta_info['meta_value']=$this->input->post('button_text');
					$meta_info['test_id']=$this->input->post('testId');
					$meta_info['meta_key']="button_text";
					$this->test_model->edit_testMeta($meta_info,$this->input->post('testId'),'button_text');
					
					
					$meta_info=array();
					$meta_info['meta_value']=$this->input->post('number_of_posts');
					$meta_info['test_id']=$id;
					$meta_info['meta_key']="number_of_posts";
					$this->test_model->edit_testMeta($meta_info,$id,'number_of_posts');
					
					
					$meta_info=array();
					$meta_info['meta_value']=$this->input->post('number_of_photos');
					$meta_info['test_id']=$id;
					$meta_info['meta_key']="number_of_photos";
					$this->test_model->edit_testMeta($meta_info,$id,'number_of_photos');
					//echo $this->input->post('testId'); exit;
					
					$meta_info=array();
					$meta_info['meta_value']=$this->input->post('sub_title');
					$meta_info['test_id']=$this->input->post('testId');
					$meta_info['meta_key']="sub_title";
					$this->test_model->edit_testMeta($meta_info,$this->input->post('testId'),'sub_title');
					
					
					// 4th image 
					// upload result_bg_image image
					if($lan  == 'en')
					{
						$this->image_lib->clear();
						$config['upload_path'] = 'assets/img/image/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['max_size']  = '0';
						$config['max_width']  = '0';
						$config['max_height']  = '0';
						
						$this->load->library('upload');
						$this->upload->initialize($config);
						$this->load->library('image_lib');					
		
						if($this->upload->do_upload('test_view_img'))
						{
							$file_info = $this->upload->data();	
											
							
							
							
							$meta_info=array();
							$meta_info['meta_value']=$file_info['file_name'];
							$meta_info['test_id']=$this->input->post('testId');
							$meta_info['meta_key']="test_view_img";
							$this->test_model->edit_testMeta($meta_info,$this->input->post('testId'),'test_view_img');
						
						
							@unlink($this->input->post('pre_img_path4'));
							
							
						}
					}
				
				}
				

				//if($lan=="all") $lan='';
				$this->test_model->edit_test($test,$id,$lan);
				
				//---------------- add banners 
				$banner_ids=$this->input->post('banner_ids');
				if($banner_ids)
				{
					$this->test_model->delete_test_banners($this->input->post('testId'));
					foreach($banner_ids as $banner_id)
					{
						$banner_info=array();
						$banner_info['test_id']=$this->input->post('testId');
						$banner_info['banner_id']=$banner_id;
						$this->test_model->add_test_banner($banner_info);
						
					}
				}
				
				
				//print_r($banner_ids); exit;
				
				if($this->input->post('sub_title'))
				{
					$meta_info['meta_value']=$this->input->post('sub_title');					
					$this->test_model->edit_testMeta($meta_info,$id,'sub_title');
				}
				
				

				$this->session->set_flashdata('success_message','Test has been saved');

				

				if($referance && $referance == 'details') redirect('admin/tests/test_details/'.$id."/".$lan);
				
				else redirect('admin/tests/index/'.$lan);

			}

			else

			{ 

				$data['flags']=$this->test_model->get_flags();

				$data['test_info']=$this->test_model->get_test($id,$lan);

				$data['category_list']=$this->test_model->get_categories($lan);

				$data['referance']=$referance;
				$data['lan']=$lan;
				$data['content']=$this->load->view('admin/test/test_edit_form',$data,true);

				//----- this is for breadcrumbs

				$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

				$breadcrumbs['breadcrumbs'][]=array('text'=>$data['test_info']->title,'href'=>'');

				 if($this->session->userdata('user_type') == 1) $breadcrumbs['breadcrumbs'][]=array('text'=>"Preview",'href'=>site_url()."admin/tests/test_details/".$data['test_info']->testid."/".$lan);

				$breadcrumbs['breadcrumbs'][]=array('text'=>'Result Options','href'=>site_url().'admin/tests/result_option/'.$id."/".$lan);

				$breadcrumbs['breadcrumbs'][]=array('text'=>'Questions','href'=>site_url().'admin/tests/questions/'.$id."/".$lan);

				$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

				$data['page_header']="Test Edit Form";

				//------- end breadcrumbs

				$data['active_menu']='';

				$this->load->view('admin/layout/default',$data);

			}

		}

		else

		{

			
		
			$data['flags']=$this->test_model->get_flags();

			$data['referance']=$referance;
			$data['lan']=$lan;
			$data['test_info']=$this->test_model->get_test($id,$lan);

			$data['category_list']=$this->test_model->get_categories($lan);

			$data['content']=$this->load->view('admin/test/test_edit_form',$data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>$data['test_info']->title,'href'=>'');

			 if($this->session->userdata('user_type') == 1) $breadcrumbs['breadcrumbs'][]=array('text'=>"Preview",'href'=>site_url()."admin/tests/test_details/".$data['test_info']->testid."/".$lan);

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Result Options','href'=>site_url().'admin/tests/result_option/'.$id."/".$lan);

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Questions','href'=>site_url().'admin/tests/questions/'.$id."/".$lan);

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Test Edit Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

		

	}

	

	// Graphic design edit test images

	

	function graphic_edit($id,$lang_code,$referance='default')

	{

		if($this->input->post('edit_test'))

		{

			$config['upload_path'] = 'assets/img/image/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']  = '0';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			
			$this->load->library('upload');
		    $this->upload->initialize($config);
			$this->load->library('image_lib');			

			if($this->upload->do_upload('image'))

			{
				$file_info = $this->upload->data();
				$test['image']=$file_info['file_name'];	
				//@unlink($this->input->post('pre_img_path'));	
			
			}
			
			
			// upload thumb image
			$this->image_lib->clear();
			$config['upload_path'] = 'assets/img/thumbs/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']  = '0';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			
			$this->load->library('upload');
		    $this->upload->initialize($config);
			$this->load->library('image_lib');			

			if($this->upload->do_upload('image_thumb'))
			{
				$file_info = $this->upload->data();
				
				$this->image_lib->clear();
				$settings['image_library'] = 'gd2';
				$settings['source_image']	= 'assets/img/thumbs/'.$file_info['file_name'];
				$settings['create_thumb'] = true;
				$settings['thumb_marker'] = '';
				$settings['maintain_ratio'] = false;
				$settings['new_image'] = 'assets/img/thumbs/'.$file_info['file_name'];
				$settings['width']	 = $this->test_image_width;
				$settings['height']	 = $this->test_image_height;		

				$this->load->library('image_lib');
				$this->image_lib->initialize($settings); 			
				$this->image_lib->resize();
				
				$test['image_thumb']=$file_info['file_name'];
				//@unlink($this->input->post('pre_img_path2'));	
				
			}
			
			// upload thumb image

		

		

			$this->test_model->edit_test($test,$id);

			$this->session->set_flashdata('success_message','Test has been saved');

			

			if($referance && $referance == 'details') redirect('admin/tests/test_details/'.$id."/".$lang_code);

			else redirect('admin/tests');

		}

		else

		{

			

			$data['flags']=$this->test_model->get_flags();

			$data['referance']=$referance;
			$data['lang_code']=$lang_code;
			$data['test_info']=$this->test_model->get_test($id);

			$data['category_list']=$this->test_model->get_categories();

			$data['content']=$this->load->view('admin/test/test_graphic_edit_form',$data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>$data['test_info']->title,'href'=>'');

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Preview",'href'=>site_url()."admin/tests/test_details/".$data['test_info']->testid."/".$lang_code);

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Result Options','href'=>site_url().'admin/tests/result_option/'.$id."/".$lang_code);

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Questions','href'=>site_url().'admin/tests/questions/'.$id."/".$lang_code);

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Test Edit Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

		

	}

	// end graphic edit test images 

	

	

	function change_test_status($lang_code='en',$page=0)

	{
		//echo $lang_code; exit;
		if($this->session->userdata('user_type') == 3) redirect('admin/auth');

		$test_id=$this->input->post('test_id');

		$option=$this->input->post('option');

		

		/*$activated_date="0000-00-00 00:00:00";

		if($this->input->post('activated_date')) $activated_date=$this->input->post('activated_date');

		if($activated_date == "0000-00-00 00:00:00" && $option == 1) $test_info['activated_date']=date('Y-m-d H:i:s');*/

		

		$test_info['activated_date']=date('Y-m-d H:i:s');

		$test_info['status']=$option;

		

		$this->test_model->update_test($test_info,$test_id);
		//echo $this->db->last_query(); 
		$this->load_ajax_test_list($lang_code,$page);

	}

	

	function set_editor_control($lang_code,$page)

	{

		if($this->session->userdata('user_type') != 1) redirect('admin/auth');

		$test_id=$this->input->post('test_id');

		$option=$this->input->post('option');

		

		

		$test_info['editor_control']=$option;

		$this->test_model->update_test($test_info,$test_id);

		$this->load_ajax_test_list($lang_code,$page);

		//print_r($test_info);

	}
	
	function set_featured($lang_code,$page)
	{
		if($this->session->userdata('user_type') != 1) redirect('admin/auth');
		$test_id=$this->input->post('test_id');
		$option=$this->input->post('option');
		$test_info['featured']=$option;
		$this->test_model->update_test($test_info,$test_id);
		$this->load_ajax_test_list($lang_code,$page);
		//print_r($test_info);
	}

	

	function set_graphic_control($lang_code,$page)

	{

	

		if($this->session->userdata('user_type') != 1) redirect('admin/auth');

		$test_id=$this->input->post('test_id');

		$option=$this->input->post('option');	

		

		$test_info['graphic_control']=$option;

		$this->test_model->update_test($test_info,$test_id);

		$this->load_ajax_test_list($lang_code,$page);

	}

	

	function change_ads_settings($lang_code,$page)

	{

		if($this->session->userdata('user_type') == 3) redirect('admin/auth');

		$test_id=$this->input->post('test_id');

		$option=$this->input->post('option');

		

		$test_info['default_ads']=$option;

		$this->test_model->update_test($test_info,$test_id);

		$this->load_ajax_test_list($lang_code,$page);

		//print_r($test_info);

	}

	

	

	function test_delete($id,$lan)

	{ 
		
		if($this->session->userdata('user_type') == 3) redirect('admin/auth');
		$questions=$this->test_model->get_questions($id,$lan);
		/*echo "<pre>";
		print_r($questions); exit;*/
		
		$test_questionid=array();
		foreach($questions as $question)
		{
			$test_questionid[]=$question->test_questionid;
		}
		
		$tests_id=$this->test_model->get_tests_id($id,$lan);		
		
		$this->test_model->test_delete($id,$lan);
		$this->test_model->test_qestions($id,$lan);
		$this->test_model->test_answers($test_questionid,$lan);
		$this->test_model->delete_test_add_config($tests_id);
		
		$this->session->set_flashdata('success_message','Test has been Deleted');

		redirect('admin/tests/index/'.$lan);

	}

	

	function questions($test_id,$lang='')
	{	
		if($this->session->userdata('access_language')) $access_language=explode(',',$this->session->userdata('access_language'));
		else $access_language=array();		
		if(!(in_array($lang,$access_language))) redirect('admin/tests/');
		//echo $lang; exit;

		$test_info=$this->test_model->get_test($test_id);

		$db_data['language_list']=$this->test_model->get_languages();

        $db_data['question_list']=$this->test_model->get_questions($test_id,$lang);

		$db_data['test_id']	=$test_id;
		$db_data['test_title']	=$test_info->title;

		$db_data['lang']=$lang;	

		$data['content'] = $this->load->view('admin/test/question_list',$db_data,true);

		//----- this is for breadcrumbs

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

		$breadcrumbs['breadcrumbs'][]=array('text'=>$test_info->title,'href'=>site_url().'admin/tests/test_edit/'.$test_info->testid."/".$lang);

		$breadcrumbs['breadcrumbs'][]=array('text'=>"Question List",'href'=>'');

		

		$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

		$data['page_header']="Test Edit Form";

		//------- end breadcrumbs

		$data['active_menu']='';

		$this->load->view('admin/layout/default',$data);   

	}
	

	function add_question($test_id,$lan)

	{

		if($this->input->post('add_question'))

		{

			$question_info['question']=$this->input->post('question');
			if($lan=="all") $lang_code="en"; else $lang_code=$lan; 
			$question_info['lang_code']=$lang_code;

			$question_info['test_id']=$test_id;

			$question_info['status']=1;

			

			$config['upload_path'] = 'assets/img/image/';

			$config['allowed_types'] = 'gif|jpg|png|jpeg';

			$config['max_size']  = '0';

			$config['max_width']  = '0';

			$config['max_height']  = '0';

			$this->load->library('upload', $config);

			$this->load->library('image_lib');

			//print_r($_FILES);

			if($this->upload->do_upload('image'))

			{

				$file_info = $this->upload->data();

				$question_info['image']=$file_info['file_name'];

				

				

				$this->image_lib->clear();

				$settings['image_library'] = 'gd2';

				$settings['source_image']	= 'assets/img/image/'.$file_info['file_name'];

				$settings['create_thumb'] = true;

				$settings['thumb_marker'] = '';

				$settings['maintain_ratio'] = false;

				$settings['new_image'] = 'assets/img/image/thumb_'.$file_info['file_name'];

				$settings['width']	 = 500;

				$settings['height']	 = 200;

				

				$this->load->library('image_lib');

				$this->image_lib->initialize($settings); 

				

				$this->image_lib->resize();

				

				

			} 

			//print_r($question_info);exit;

			$question_insert_id=$this->test_model->add_question($question_info);

			

			// update test question 

			$update_question['test_questionid']=$question_insert_id;

			$this->test_model->question_edit($update_question,$question_insert_id);

			// end update test question 

			$this->session->set_flashdata('success_message','Question has been saved');

			

			

			//------update test table---------

			$test['modify_date']=date('Y-m-d H:i:s');

			$this->test_model->edit_test($test,$test_id);

			//------------- end -----------------
			if($lan=="all") $lan="";
			redirect('admin/tests/questions/'.$test_id."/".$lan);

		}

		else

		{

			

			$db_data['test_id']	=$test_id;	

			$db_data['lan']	=$lan;	

			$test_info=$this->test_model->get_test($test_id);

			$data['content']=$this->load->view('admin/test/question_add_form',$db_data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>$test_info->title,'href'=>site_url().'admin/tests/test_edit/'.$test_info->testid."/".$lan);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Question List",'href'=>site_url().'admin/tests/questions/'.$test_info->testid."/".$lan);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new",'href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Question Add Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}

	

	function question_edit($test_question_id,$test_id,$lang_code='',$referance='default')

	{

		if($this->input->post('edit_question'))

		{

			$question_info['question']=$this->input->post('question');

			$question_info['status']=$this->input->post('status');

			

			$config['upload_path'] = 'assets/img/image/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']  = '0';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			$this->load->library('upload', $config);
			$this->load->library('image_lib');
			

			if($this->upload->do_upload('image'))

			{

				$file_info = $this->upload->data();

				$question_info['image']=$file_info['file_name'];

				

				

				$this->image_lib->clear();

				$settings['image_library'] = 'gd2';

				$settings['source_image']	= 'assets/img/image/'.$file_info['file_name'];

				$settings['create_thumb'] = true;

				$settings['thumb_marker'] = '';

				$settings['maintain_ratio'] = false;

				$settings['new_image'] = 'assets/img/image/thumb_'.$file_info['file_name'];

				$settings['width']	 = 500;

				$settings['height']	 = 200;

				

				$this->load->library('image_lib');

				$this->image_lib->initialize($settings); 

				

				$this->image_lib->resize();

				

				@unlink("assets/img/image/".$this->input->post('pre_img_path'));

				@unlink("assets/img/image/thumb_".$this->input->post('pre_img_path'));

			}

					

			$this->test_model->question_edit($question_info,$test_question_id);

			$this->session->set_flashdata('success_message','Question has been saved');

			//------update test table---------

			$test['modify_date']=date('Y-m-d H:i:s');

			$this->test_model->edit_test($test,$test_id);

			//------------- end -----------------
			
			if($lang_code == "all") $lang_code='';
			if($referance && $referance == 'details') redirect('admin/tests/test_details/'.$test_id."/".$lang_code);

			else redirect('admin/tests/questions/'.$test_id."/".$lang_code);

		}

		else

		{

			

			$test_info=$this->test_model->get_test($test_id);

			//print_r($test_info); exit;

			$db_data['question_info']=$this->test_model->get_question($test_question_id,$lang_code);

			$db_data['test_id']	=$test_id;	

			$db_data['referance']	=$referance;	
			$db_data['lang_code']	=$lang_code;
			$data['content']=$this->load->view('admin/test/question_edit_form',$db_data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>$test_info->title,'href'=>site_url().'admin/tests/test_edit/'.$test_info->testid."/".$lang_code);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Question List",'href'=>site_url().'admin/tests/questions/'.$test_info->testid."/".$lang_code);

			$breadcrumbs['breadcrumbs'][]=array('text'=>$db_data['question_info']->question,'href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Test Edit Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

		

	}

	

	// edit graphic question image

	function graphic_question_edit($test_question_id,$test_id,$lang_code,$referance='default')

	{

		if($this->input->post('edit_question'))

		{

			$config['upload_path'] = 'assets/img/image/';

			$config['allowed_types'] = 'gif|jpg|png|jpeg';

			$config['max_size']  = '0';

			$config['max_width']  = '0';

			$config['max_height']  = '0';

			$this->load->library('upload', $config);

			$this->load->library('image_lib');

			

			if($this->upload->do_upload('image'))

			{

				$file_info = $this->upload->data();

				$question_info['image']=$file_info['file_name'];				

				

				$this->image_lib->clear();

				$settings['image_library'] = 'gd2';

				$settings['source_image']	= 'assets/img/image/'.$file_info['file_name'];

				$settings['create_thumb'] = true;

				$settings['thumb_marker'] = '';

				$settings['maintain_ratio'] = true;

				$settings['new_image'] = 'assets/img/image/thumb_'.$file_info['file_name'];

				$settings['width']	 = 500;

				$settings['height']	 = 200;

				

				$this->load->library('image_lib');

				$this->image_lib->initialize($settings); 

				

				$this->image_lib->resize();

				

				@unlink("assets/img/image/".$this->input->post('pre_img_path'));

				@unlink("assets/img/image/thumb_".$this->input->post('pre_img_path'));

			}

					

			$this->test_model->question_edit($question_info,$test_question_id);

			$this->session->set_flashdata('success_message','Question has been saved');

			//------update test table---------

			$test['modify_date']=date('Y-m-d H:i:s');

			$this->test_model->edit_test($test,$test_id);

			//------------- end -----------------
			//echo $test_id; exit;
			if($referance && $referance == 'details')
			{
			 redirect('admin/tests/test_details/'.$test_id."/".$lang_code);
			}
			else
			{
				redirect('admin/tests/questions/'.$test_id);
			}

		}

		else

		{

			

			$test_info=$this->test_model->get_test($test_id);

			$db_data['question_info']=$this->test_model->get_question($test_question_id);

			$db_data['test_id']	=$test_id;	
			$db_data['lang_code']	=$lang_code;	
			$db_data['referance']	=$referance;	

			$data['content']=$this->load->view('admin/test/graphic_question_edit_form',$db_data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>$test_info->title,'href'=>site_url().'admin/tests/test_edit/'.$test_info->testid."/".$lang_code);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Question List",'href'=>site_url().'admin/tests/questions/'.$test_info->testid."/".$lang_code);

			$breadcrumbs['breadcrumbs'][]=array('text'=>$db_data['question_info']->question,'href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Test Edit Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

		

	}

	// end graphic question image

	

	function question_delete($id,$test_id,$lang_code)

	{

		$this->test_model->question_delete($id);

		$this->session->set_flashdata('success_message','Question has been Deleted');
		if($lang_code == "all") $lang_code='';
		redirect('admin/tests/questions/'.$test_id."/".$lang_code);

	}

	

	function answers($test_question_id,$lang='')

	{	

		

		$question_info=$this->test_model->get_question($test_question_id);

		$db_data['language_list']=$this->test_model->get_languages();

		$test_info=$this->test_model->get_test($question_info->test_id);

        $db_data['answer_list']=$this->test_model->get_answers($test_question_id,$lang);

		$db_data['test_question_id']=$test_question_id;	
		$db_data['question']=$question_info->question;
		$db_data['lang']=$lang;	

		$data['content'] = $this->load->view('admin/test/answer_list',$db_data,true);

		

		

		//----- this is for breadcrumbs

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

		$breadcrumbs['breadcrumbs'][]=array('text'=>$test_info->title,'href'=>site_url().'admin/tests/test_edit/'.$test_info->testid."/".$lang);

		$breadcrumbs['breadcrumbs'][]=array('text'=>"Question List",'href'=>site_url().'admin/tests/questions/'.$test_info->testid."/".$lang);

		$breadcrumbs['breadcrumbs'][]=array('text'=>$question_info->question,'href'=>site_url().'admin/tests/question_edit/'.$test_question_id."/".$test_info->testid."/".$lang);

		$breadcrumbs['breadcrumbs'][]=array('text'=>"Answer List",'href'=>'');

		$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

		$data['page_header']="Test : ".$question_info->title." => Question : ".$question_info->question;

		//------- end breadcrumbs

			

		$data['active_menu']='';

		$this->load->view('admin/layout/default',$data);   

	}

	

	function add_answer($test_question_id,$lan)

	{

		if($this->input->post('add_answer'))

		{

			$answer_info['answere']=$this->input->post('answere');

			$answer_info['test_question_id']=$test_question_id;
			if($lan == "all") $langcode='en'; else $langcode=$lan;
			$answer_info['lang_code']=$langcode;

			$answer_info['marks']=$this->input->post('marks');

			$answer_info['status']=1;

			

			//print_r($answer_info); exit;

			

			$answer_insert_id=$this->test_model->add_answer($answer_info);

			

			// update test answere 

			$update_answere['answereid']=$answer_insert_id;

			$this->test_model->update_answer_lang($update_answere,$answer_insert_id);

			// end update test answere 

			

			

			$this->session->set_flashdata('success_message','Answer has been saved');
			if($lan == "all") $lan='';
			redirect('admin/tests/answers/'.$test_question_id."/".$lan);

		}

		else

		{

			

			$db_data['test_question_id']=$test_question_id;	

			$db_data['lan']=$lan;	

			$data['content']=$this->load->view('admin/test/answer_add_form',$db_data,true);

			$question_info=$this->test_model->get_question($test_question_id);

			$test_info=$this->test_model->get_test($question_info->test_id);

			//----- this is for breadcrumbs

			/*$breadcrumbs['breadcrumbs'][]=array('text'=>'Dashboard','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Answer List','href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Answer Add Form";*/

			//------- end breadcrumbs

			

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>$test_info->title,'href'=>site_url().'admin/tests/test_edit/'.$test_info->testid."/".$lan);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Question List",'href'=>site_url().'admin/tests/questions/'.$test_info->testid."/".$lan);

			$breadcrumbs['breadcrumbs'][]=array('text'=>$question_info->question,'href'=>site_url().'admin/tests/question_edit/'.$test_question_id."/".$test_info->testid."/".$lan);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Answer List",'href'=>site_url().'admin/tests/answers/'.$test_question_id."/".$lan);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new answer",'href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Test : ".$question_info->title." => Question : ".$question_info->question;

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}

	

	function answer_edit($answere_id,$test_question_id,$lang_code,$referance='default')

	{

		if($this->input->post('edit_answer'))

		{

			$answer_info['answere']=$this->input->post('answere');

			$answer_info['marks']=$this->input->post('marks');

			$answer_info['status']=$this->input->post('status');

			

			//print_r($answer_info); exit;

			

			$this->test_model->edit_answer($answer_info,$answere_id,$lang_code);

			$this->session->set_flashdata('success_message','answer has been saved');
			if($lang_code == "all") $lang_code='';
			
			if($referance == 'details') 
			{
				redirect('admin/tests/test_details/'.$this->input->post('testid')."/".$lang_code);
			}
			else
			{
				redirect('admin/tests/answers/'.$test_question_id."/".$lang_code);
			}
			

		}

		else

		{

			

			$question_info=$this->test_model->get_question($test_question_id);

			$db_data['answer_info']=$this->test_model->get_answer($answere_id,$lang_code);

			$db_data['test_question_id']=$test_question_id;
			$db_data['referance']=$referance;

			$db_data['lang_code']=$lang_code;	

			$test_info=$this->test_model->get_test($question_info->test_id);
			$db_data['testid']=$test_info->testid;	

			$data['content']=$this->load->view('admin/test/answer_edit_form',$db_data,true);



			

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>$test_info->title,'href'=>site_url().'admin/tests/test_edit/'.$test_info->testid."/".$lang_code);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Question List",'href'=>site_url().'admin/tests/questions/'.$test_info->testid."/".$lang_code);

			$breadcrumbs['breadcrumbs'][]=array('text'=>$question_info->question,'href'=>site_url().'admin/tests/question_edit/'.$test_question_id."/".$test_info->testid."/".$lang_code);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Answer List",'href'=>site_url().'admin/tests/answers/'.$test_question_id."/".$lang_code);

			$breadcrumbs['breadcrumbs'][]=array('text'=>$db_data['answer_info']->answere,'href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Test : ".$question_info->title." => Question : ".$question_info->question;

			//------- end breadcrumbs

		

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

		

	}

	

	function answer_delete($id,$test_question_id,$lang_code)

	{

		$this->test_model->answer_delete($id);

		$this->session->set_flashdata('success_message','Answer has been Deleted');
		if($lang_code == "all") $lang_code='';
		redirect('admin/tests/answers/'.$test_question_id ."/". $lang_code);
		

	}

	

	function result_option ($id,$lang='')
	{
		if($this->session->userdata('access_language')) $access_language=explode(',',$this->session->userdata('access_language'));
		else $access_language=array();		
		if(!(in_array($lang,$access_language))) redirect('admin/tests/');
		
		$data['test_info']=$this->test_model->get_test($id);

		$data['test_id']=$id;

		$data['lang']=$lang;

		$data['language_list']=$this->test_model->get_languages();

		$data['result_options']=$this->test_model->get_result_options($id,$lang);

		

		$data['content']=$this->load->view('admin/test/result_option',$data,true);

		

		$data['page_header']="Result Option : ".$data['test_info']->title;

		//----- this is for breadcrumbs

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

		$breadcrumbs['breadcrumbs'][]=array('text'=>$data['test_info']->title,'href'=>site_url().'admin/tests/test_edit/'.$data['test_info']->testid."/".$lang);

		$breadcrumbs['breadcrumbs'][]=array('text'=>"Result Option",'href'=>'');

		$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

		$data['page_header']="Test Edit Form";

		//------- end breadcrumbs

		$data['active_menu']='';

		$this->load->view('admin/layout/default',$data);

		

	}

	

	function add_result_option($id,$lang_code)
	{
		if($this->input->post('add_result_option'))
		{
			$test_info=$this->test_model->get_test($id);
			$result_options['interval_from']=$this->input->post('interval_from');
			$result_options['interval_to']=$this->input->post('interval_to');
			if($lang_code=="") $langcode='en'; else $langcode=$lang_code;
			$result_options['lang_code']=$langcode;
			$result_options['result']=$this->input->post('result');
			$result_options['result_description']=$this->input->post('result_description');
			$result_options['test_id']=$this->input->post('test_id');
			if($test_info->is_real_test == 3)
			{
				$result_options['font_name']=$this->input->post('font_name');
				$result_options['font_color']=$this->input->post('font_color');
			}
			//print_r($result_options); exit;
			$config['upload_path'] = 'assets/img/test_result_img/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']  = '0';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			$this->load->library('upload', $config);

			$this->load->library('image_lib');

			if($this->upload->do_upload('test_result_img'))
			{	
				//echo 'sadfasf dsfas'; exit;
				$file_info = $this->upload->data();
				$result_options['test_result_img']=$file_info['file_name'];
				if($test_info->is_real_test != 2)
				{
					$this->image_lib->clear();
					$config2['image_library'] = 'gd2';
					$config2['source_image'] = 'assets/img/test_result_img/'.$file_info['file_name'];
					$config2['new_image'] = 'assets/img/test_result_img/'.$file_info['file_name'];
					$config2['create_thumb'] = TRUE;
					$config2['thumb_marker'] ="";
					$config2['maintain_ratio'] = false;
					if($test_info->is_real_test == 3)
					{
						$config2['width'] = 742;
						$config2['height'] = 389;
					}
					else
					{
						$config2['width'] = 180;
						$config2['height'] = 180;
					}
					
	
					$this->load->library('image_lib', $config2);
					$this->image_lib->resize();
				}

			}

			

			//print_r($result_options); exit;

			

			$result_inseret_id=$this->test_model->add_result_option($result_options);
			// -----------------
				$update_result_options['result_optionid']=$result_inseret_id;
				$this->test_model->save_resultOption($update_result_options,$result_inseret_id);
			//--------------- 
			$this->session->set_flashdata('success_message','Result option has been saved');
			//-------------update test table
			$test['modify_date']=date('Y-m-d H:i:s');
			$this->test_model->edit_test($test,$this->input->post('test_id'));
			//------------- end ----------------
			if($lang_code=="all") $lang_code='';
			redirect('admin/tests/result_option/'.$id."/".$lang_code);

		}

		else

		{

			

			$data['test_info']=$this->test_model->get_test($id);
			$data['test_id']=$id;
			$data['lang_code']=$lang_code;
			$data['content']=$this->load->view('admin/test/add_result_option',$data,true);
			$data['page_header']="Result Option : ".$data['test_info']->title;

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>$data['test_info']->title,'href'=>site_url().'admin/tests/test_edit/'.$data['test_info']->testid."/".$lang_code);
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Result Option",'href'=>site_url().'admin/tests/result_option/'.$data['test_info']->testid."/".$lang_code);
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new",'href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Test Edit Form";
			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}

	

 function result_option_edit($result_option_id,$id,$lang_code='',$referance='default')

	{
		
		if($this->input->post('edit_result_option'))

		{

			$test_info=$this->test_model->get_test($id);
			$result_options['interval_from']=$this->input->post('interval_from');
			$result_options['interval_to']=$this->input->post('interval_to');
			$result_options['result']=$this->input->post('result');
			$result_options['result_description']=$this->input->post('result_description');
			
			if($test_info->is_real_test == 3)
			{
				$result_options['font_name']=$this->input->post('font_name');
				$result_options['font_color']=$this->input->post('font_color');
			}

			

			$config['upload_path'] = 'assets/img/test_result_img/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']  = '500';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			$this->load->library('upload', $config);
			//$this->load->library('image_lib');

			//unlink('assets/img/test_result_img/file.jpg');
			if($this->upload->do_upload('test_result_img'))
			{
				$file_info = $this->upload->data();
				$result_options['test_result_img']=$file_info['file_name'];
				if($test_info->is_real_test !=2 )
				{
					//---- resize image
					$config2['image_library'] = 'gd2';
					$config2['source_image'] = 'assets/img/test_result_img/'.$file_info['file_name'];
					$config2['new_image'] = 'assets/img/test_result_img/'.$file_info['file_name'];
					$config2['create_thumb'] = TRUE;
					$config2['thumb_marker'] ="";
					$config2['maintain_ratio'] = false;
					if($test_info->is_real_test == 3)
					{
						$config2['width'] = 742;
						$config2['height'] = 389;
					}
					else
					{
						$config2['width'] = 180;
						$config2['height'] = 180;
					}
					$this->load->library('image_lib', $config2);
					$this->image_lib->resize();

				}

				@unlink($this->input->post('pre_img_path'));

				//------ end image resize

			}

			$this->test_model->save_result_option($result_options,$result_option_id,$lang_code);
			$this->session->set_flashdata('success_message','Result option has been saved');
			//-------------update test table
			$test['modify_date']=date('Y-m-d H:i:s');
			$this->test_model->edit_test($test,$id);
			//------------- end ----------------
			if($lang_code=="all") $lang_code='';
			//echo "i m here"; exit;
			//redirect('admin/tests/result_option/'.$id."/".$lang_code);
			if($referance == 'details') 
			{
				redirect('admin/tests/test_details/'.$id."/".$lang_code);
			}
			else
			{
				redirect('admin/tests/result_option/'.$id."/".$lang_code);
			}

		}
		else
		{

			$data['test_info']=$this->test_model->get_test($id);
			$data['result_option']=$this->test_model->get_result_option($result_option_id,$lang_code);
			$data['test_id']=$id;
			$data['lang_code']=$lang_code;
			$data['result_optionid']=$result_option_id;
			$data['referance']=$referance;
			$data['content']=$this->load->view('admin/test/edit_result_option',$data,true);
			$data['page_header']="Result Option  : ".$data['test_info']->title;

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>$data['test_info']->title,'href'=>site_url().'admin/tests/test_edit/'.$data['test_info']->testid."/".$lang_code);
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Result Option",'href'=>site_url().'admin/tests/result_option/'.$data['test_info']->testid."/".$lang_code);
			$breadcrumbs['breadcrumbs'][]=array('text'=>$data['result_option']->result,'href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Test Edit Form";
			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}

	

	function result_option_delete($result_option_id,$id,$lang_code)

	{
		 
		$this->test_model->delete_result_option($result_option_id);

		$this->session->set_flashdata('success_message','Result option has been Deleted');
		if($lang_code == "all") $lang_code='';
		redirect('admin/tests/result_option/'.$id."/".$lang_code);

	}

	

	

	

	

	

	

	

	

	

	function ads_config($page=0)

	{	

		if(!($this->session->userdata('user_type') == 1)) redirect('admin/auth');
		$this->session->set_userdata('search_test_ads','');
		
		
		$this->session->set_userdata('test_type','');
		
		
		$total_rows = $this->test_model->get_total_tests_ads();
		//echo $total_rows; exit;
		$limit=30;
		$this->load->library('pagination');
		
		$config['base_url'] = site_url().'admin/tests/search_ads_config/';
		$config['uri_segment'] = 4;
		$config['num_links'] = 10;
		$config['prev_link'] = 'Pre';
		$config['next_link'] = 'Next';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		$this->pagination->initialize($config);
		$db_data['pagination']=$this->pagination->create_links();
		$db_data['total_record']=$total_rows;
		$db_data['page_number']=$page;
		$this->session->set_userdata('ads_config_page_number',$page);
        $db_data['test_list']=$this->test_model->get_tests_ads($page,$limit);		

		$data['content'] = $this->load->view('admin/test/ads_list/test_list_ads',$db_data,true);

		//----- this is for breadcrumbs

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Dashboard','href'=>site_url().'admin');

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Test Ads Config','href'=>'');

		$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

		$data['page_header']="Test Ads Config";

		//------- end breadcrumbs

		$data['active_menu']='';

		$this->load->view('admin/layout/default',$data);   

	}
	
	
	function search_ads_config($page=0)
	{
		if(!($this->session->userdata('user_type') == 1)) redirect('admin/auth');
		
		if($this->input->post('search_test_ads'))
		{
			$this->session->set_userdata('search_test_ads',$this->input->post('search_test_ads'));
		}
		
		if($this->input->post('test_type'))
		{
			$this->session->set_userdata('test_type',$this->input->post('test_type'));
		}
		
		$total_rows = $this->test_model->get_total_tests_ads();
		//echo $total_rows; exit;
		$limit=30;
		$this->load->library('pagination');
		
		$config['base_url'] = site_url().'admin/tests/search_ads_config/';
		$config['uri_segment'] = 4;
		$config['num_links'] = 10;
		$config['prev_link'] = 'Pre';
		$config['next_link'] = 'Next';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		$this->pagination->initialize($config);
		$db_data['pagination']=$this->pagination->create_links();
		$db_data['total_record']=$total_rows;
		$db_data['page_number']=$page;
		$this->session->set_userdata('ads_config_page_number',$page);

        $db_data['test_list']=$this->test_model->get_tests_ads($page,$limit);		
		if($this->session->userdata('test_type')==2)
		{
			$data['content'] = $this->load->view('admin/test/ads_list/twist_test_list_ads',$db_data,true);
		}
		else if($this->session->userdata('test_type')==3)
		{
			$data['content'] = $this->load->view('admin/test/ads_list/3apps_test_list_ads',$db_data,true);
		}
		else if($this->session->userdata('test_type')==5)
		{
			$data['content'] = $this->load->view('admin/test/ads_list/face_test_list_ads',$db_data,true);
		}
		else if($this->session->userdata('test_type')==6)
		{
			$data['content'] = $this->load->view('admin/test/ads_list/facebook_apps_test_list_ads',$db_data,true);
		}
		else if($this->session->userdata('test_type')=="personal")
		{
			$data['content'] = $this->load->view('admin/test/ads_list/personal_test_list_ads',$db_data,true);
		}
		else if($this->session->userdata('test_type')=="all")
		{
			$data['content'] = $this->load->view('admin/test/ads_list/test_list_ads',$db_data,true);
		}
		else
		{
			$data['content'] = $this->load->view('admin/test/ads_list/test_list_ads',$db_data,true);
		}
		//----- this is for breadcrumbs

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Dashboard','href'=>site_url().'admin');

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Test Ads Config','href'=>'');

		$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

		$data['page_header']="Test Ads Config";

		//------- end breadcrumbs

		$data['active_menu']='';

		$this->load->view('admin/layout/default',$data); 
	
	}
	
	

	function ads_config_ajax_load()

	{	
		$page=$this->session->userdata('ads_config_page_number');
        $total_rows = $this->test_model->get_total_tests_ads();		
		$limit=30;
		$this->load->library('pagination');
		
		$config['base_url'] = site_url().'admin/tests/search_ads_config/';
		$config['uri_segment'] = 4;
		$config['num_links'] = 10;
		$config['prev_link'] = 'Pre';
		$config['next_link'] = 'Next';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		$this->pagination->initialize($config);
		$db_data['pagination']=$this->pagination->create_links();
		$db_data['total_record']=$total_rows;
		$db_data['page_number']=$page;
		
        $db_data['test_list']=$this->test_model->get_tests_ads($page,$limit);	

		 $db_data['ele_id']=$this->input->post('ele_id');	
		if($this->session->userdata('test_type')==2)
		{
			echo $data['content'] = $this->load->view('admin/test/ads_list/ajax_twist_test_list_ads',$db_data,true);
		}
		else if($this->session->userdata('test_type')==3)
		{
			echo $data['content'] = $this->load->view('admin/test/ads_list/ajax_3apps_test_list_ads',$db_data,true);
		}
		else if($this->session->userdata('test_type')==5)
		{
			
			echo $data['content'] = $this->load->view('admin/test/ads_list/ajax_face_test_list_ads',$db_data,true);
		}
		else if($this->session->userdata('test_type')==6)
		{
			echo $data['content'] = $this->load->view('admin/test/ads_list/ajax_facebook_apps_test_list_ads',$db_data,true);
		}
		else if($this->session->userdata('test_type')=="personal")
		{
			echo $data['content'] = $this->load->view('admin/test/ads_list/ajax_personal_test_list_ads',$db_data,true);
		}
		else
		{
			echo $data['content'] = $this->load->view('admin/test/ads_list/test_list_ads_ajax',$db_data,true);
		}
   

	}

	function load_ajax_test_list($lang_code='en',$page=0)

	{	//echo $page; exit;
		//echo $lang_code; exit;
		$total_rows = $this->test_model->get_total_tests($lang_code);
		//echo $total_rows; exit;
		$limit=30;
		$this->load->library('pagination');
	
		$config['base_url'] = site_url().'admin/tests/search_tests/'.$lang_code;
		$config['uri_segment'] = 5;
		$config['num_links'] = 10;
		$config['prev_link'] = 'Pre';
		$config['next_link'] = 'Next';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		$this->pagination->initialize($config);
		$db_data['pagination']=$this->pagination->create_links();
		$db_data['total_record']=$total_rows;
		
		
		
        //$db_data['test_list']=$this->test_model->get_tests($lang_code,$page,$limit);
		
        $db_data['test_list']=$this->test_model->get_tests($lang_code,$page,$limit);	
		$db_data['lang']=$lang_code;
		$db_data['language_list']=$this->test_model->get_languages();
		$db_data['page_number']=$page;
		echo $data['content'] = $this->load->view('admin/test/test_list_ajax',$db_data,true);

   

	}

	function ads_congig_save_all()

	{
		//echo $this->input->post('page_number'); exit;
		if($this->input->post('tests'))

		{

			
			$test_ids=$this->session->userdata('ids');
			foreach($test_ids as $key=>$value)

			{
				//echo "Key :".$key;
				//echo "value :".$value; exit;
				$config_info=array();

				if($this->input->post('test_top_'.$value)) $config_info['test_top']=1;

				else $config_info['test_top']=0;

				if($this->input->post('test_middle_'.$value)) $config_info['test_middle']=1;

				else $config_info['test_middle']=0;

				if($this->input->post('test_middle2_'.$value)) $config_info['test_middle2']=1;

				else $config_info['test_middle2']=0;

				if($this->input->post('test_bottom_'.$value)) $config_info['test_bottom']=1;

				else $config_info['test_bottom']=0;

				if($this->input->post('test_left_'.$value)) $config_info['test_left']=1;

				else $config_info['test_left']=0;

				if($this->input->post('test_right_'.$value)) $config_info['test_right']=1;

				else $config_info['test_right']=0;
				
				
				

				

				if($this->input->post('question_top_'.$value)) $config_info['question_top']=1;

				else $config_info['question_top']=0;

				if($this->input->post('question_top2_'.$value)) $config_info['question_top2']=1;

				else $config_info['question_top2']=0;

				if($this->input->post('question_middle_'.$value)) $config_info['question_middle']=1;

				else $config_info['question_middle']=0;

				if($this->input->post('question_bottom_'.$value)) $config_info['question_bottom']=1;

				else $config_info['question_bottom']=0;

				if($this->input->post('question_bottom2_'.$value)) $config_info['question_bottom2']=1;

				else $config_info['question_bottom2']=0;

				if($this->input->post('question_left_'.$value)) $config_info['question_left']=1;

				else $config_info['question_left']=0;

				if($this->input->post('question_right_'.$value)) $config_info['question_right']=1;

				else $config_info['question_right']=0;

				

				if($this->input->post('result_top_'.$value)) $config_info['result_top']=1;

				else $config_info['result_top']=0;

				if($this->input->post('result_middle_'.$value)) $config_info['result_middle']=1;

				else $config_info['result_middle']=0;

				if($this->input->post('result_middle2_'.$value)) $config_info['result_middle2']=1;

				else $config_info['result_middle2']=0;

				if($this->input->post('result_bottom_'.$value)) $config_info['result_bottom']=1;
				else $config_info['result_bottom']=0;
				
				
				if($this->input->post('sidebar_1_'.$value)) $config_info['sidebar_1']=1;
				else $config_info['sidebar_1']=0;
				
				if($this->input->post('sidebar_2_'.$value)) $config_info['sidebar_2']=1;
				else $config_info['sidebar_2']=0;
				

				
				
				

				$this->test_model->save_test_ad_config($config_info,$value);
				//echo $this->db->last_query(); exit;

				



			}

			redirect('admin/tests/search_ads_config/'.$this->session->userdata('ads_config_page_number'));

		}

		else

		{ 

			//print_r($_POST);

			//echo " he is there";exit;

			redirect('admin/tests/ads_config/');
			

		}

	}

	function batch_test_ad_config()

	{

		$option=$this->input->post('option');

		$test_id=$this->input->post('test_id');

		$value=$this->input->post('value');

		if($option == 'all')

		{

			if($value == 'yes')

			{

				$config_info['test_top']=1;

				$config_info['test_middle']=1;

				$config_info['test_middle2']=1;

				$config_info['test_bottom']=1;

				$config_info['test_left']=1;

				$config_info['test_right']=1;

				$config_info['question_top']=1;

				$config_info['question_top2']=0;

				$config_info['question_middle']=1;

				$config_info['question_bottom']=1;

				$config_info['question_bottom2']=1;

				$config_info['question_left']=1;

				$config_info['question_right']=1;

				$config_info['result_top']=1;

				$config_info['result_middle']=1;

				$config_info['result_middle2']=1;

				$config_info['result_bottom']=1;

				$config_info['result_left']=1;

				$config_info['result_right']=1;

			}

			else if($value == 'no')

			{

				$config_info['test_top']=0;

				$config_info['test_middle']=0;

				$config_info['test_middle2']=0;

				$config_info['test_bottom']=0;

				$config_info['test_left']=0;

				$config_info['test_right']=0;

				$config_info['question_top']=0;

				$config_info['question_top2']=0;

				$config_info['question_middle']=0;

				$config_info['question_bottom']=0;

				$config_info['question_bottom2']=0;

				$config_info['question_left']=0;

				$config_info['question_right']=0;

				$config_info['result_top']=0;

				$config_info['result_middle']=0;

				$config_info['result_middle2']=0;

				$config_info['result_bottom']=0;

				$config_info['result_left']=0;

				$config_info['result_right']=0;

				//print_r($config_info);

			}

			$this->test_model->save_test_ad_config($config_info,$test_id);

			$this->ads_config_ajax_load();

		}

		

	}

	

	function test_ad_config_all_test()
	{
		
		$col_name=$this->input->post('col_name');
		$test_type=$this->input->post('test_type'); 
		$value=$this->input->post('value');
		if($value == 'yes')
		{
			$config_info["$col_name"]=1;
			if($col_name == 'question_top2')
			{
				$config_info['question_top']=0;
			}

			if($col_name == 'question_top')
			{
				$config_info['question_top2']=0;
			}
		}

		else if($value == 'no')
		{
			$config_info["$col_name"]=0;
			//print_r($config_info);
		}

		//print_r($config_info);
		$test_ids=$this->test_model->get_test_ids($test_type);
		//print_r($test_ids); exit;
		$this->test_model->save_test_adConfig($config_info,$test_ids);
		
		$this->ads_config_ajax_load();

		

	}

	

	function test_ad_config_single_col()

	{

		

		$col_name=$this->input->post('col_name');

		$value=$this->input->post('value');

		$test_id=$this->input->post('test_id');

		if($value == 'yes')

		{

			$config_info["$col_name"]=1;

			if($col_name == 'question_top2')

			{

				$config_info['question_top']=0;

			}

			if($col_name == 'question_top')

			{

				$config_info['question_top2']=0;

			}

		}

		else if($value == 'no')

		{

			$config_info["$col_name"]=0;

			//print_r($config_info);

		}

		$this->test_model->save_test_ad_config($config_info,$test_id);

		

		$this->ads_config_ajax_load();

		

	}

	

	function ads_edit($test_id,$lang)

	{

		if($this->session->userdata('user_type') == 3) redirect('admin/auth');

		if($this->input->post('edit_config'))
		{
			
			$config_info['test_top_adsense']=htmlspecialchars($this->input->post('test_top_adsense'));
			$config_info['test_middle_adsense']=htmlspecialchars($this->input->post('test_middle_adsense'));
			$config_info['test_bottom_adsense']=htmlspecialchars($this->input->post('test_bottom_adsense'));
		
			$config_info['test_top_adsense']=htmlspecialchars($this->input->post('test_top_adsense'));
			$config_info['test_middle_adsense']=htmlspecialchars($this->input->post('test_middle_adsense'));
			$config_info['test_middle_adsense2']=htmlspecialchars($this->input->post('test_middle_adsense2'));
			$config_info['test_bottom_adsense']=htmlspecialchars($this->input->post('test_bottom_adsense'));
			$config_info['test_sky_left_adsense']=htmlspecialchars($this->input->post('test_sky_left_adsense'));
			$config_info['test_sky_right_adsense']=htmlspecialchars($this->input->post('test_sky_right_adsense'));			
			
			$config_info['question_top_adsense']=htmlspecialchars($this->input->post('question_top_adsense'));
			$config_info['question_top_adsense2']=htmlspecialchars($this->input->post('question_top_adsense2'));
			$config_info['question_bottom_adsense']=htmlspecialchars($this->input->post('question_bottom_adsense'));
			$config_info['question_bottom_adsense2']=htmlspecialchars($this->input->post('question_bottom_adsense2'));
			$config_info['question_sky_left_adsense']=htmlspecialchars($this->input->post('question_sky_left_adsense'));
			$config_info['question_sky_right_adsense']=htmlspecialchars($this->input->post('question_sky_right_adsense'));
			

			

			$config_info['result_adsense']=htmlspecialchars($this->input->post('result_adsense'));
			$config_info['result_bottom_adsense']=htmlspecialchars($this->input->post('result_bottom_adsense'));
			$config_info['result_middle_adsense']=htmlspecialchars($this->input->post('result_middle_adsense'));
			$config_info['result_middle_adsense2']=htmlspecialchars($this->input->post('result_middle_adsense2'));
			$config_info['result_sky_left_adsense']=htmlspecialchars($this->input->post('result_sky_left_adsense'));
			$config_info['result_sky_right_adsense']=htmlspecialchars($this->input->post('result_sky_right_adsense'));
			
			


			$this->test_model->edit_test($config_info,$test_id,$lang);
			$this->session->set_flashdata('success_message',' Configuration has been Change');
			redirect('admin/tests/ads_edit/'.$test_id."/".$lang);

		}

		else

		{
			$test_info=$this->test_model->get_test($test_id,$lang);
			/*echo "<pre>";
			print_r($test_info);*/
			$db_data['lang']=$lang;
			$db_data['test_id']=$test_id;		
			$db_data['test_info']=$test_info;
			$db_data['config_info']=$test_info;
			if($test_info->is_real_test == 6)
			{
				$data['content'] = $this->load->view('admin/test/ad_config/fb_apps_ad_config_form',$db_data,true);
			}
			else
			{
				$data['content'] = $this->load->view('admin/test/ad_config/ad_config_form',$db_data,true);
			}
			//----- this is for breadcrumbs			

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>$db_data['config_info']->title,'href'=>'');
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Ads Configuration','href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			

			$data['page_header']="Configuration Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data); 

		}  

	}

	

	function test_details($id,$lang_code)

	{	

        $db_data['test_info']=$this->test_model->get_test($id,$lang_code);	
		$db_data['lang_code']=$lang_code;

		$data['content'] = $this->load->view('admin/test/test_details',$db_data,true);

		//----- this is for breadcrumbs

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Dashboard','href'=>site_url().'admin');

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Test List','href'=>site_url().'admin');

		$breadcrumbs['breadcrumbs'][]=array('text'=>$db_data['test_info']->title,'href'=>site_url().'admin/tests/test_edit/'.$db_data['test_info']->testid."/".$lang_code);

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Test Details','href'=>'');

		$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

		$data['page_header']="Test Details";

		//------- end breadcrumbs

		$data['active_menu']='';

		$this->load->view('admin/layout/default',$data);   

	}

	

	

	function test_add_wizard()

	{

		if($this->input->post('add_test'))

		{

			$test['title']=$this->input->post('title');
			$test['lang_code']='en';
			$test['description']=$this->input->post('description');

			$test['result_text']='<h2>'.$this->input->post('result_text').'</h2>
			<h1><RESULT></h1>
			<PRE_RESULT>
			<p class="result_des">
			<h2>Are you surprised? Leave a comment!</h2>
			</p>';



			$test['fbshare_des']=$this->input->post('description');

			$test['question']="You will see few questions describing you. Be honest, and find out what your result is at the end of the quiz.";

			$test['answer']="You cannot change your answers - keep this in mind, but do not think about them too long.";

			$test['fun']="This test is not based on any scientific study whatsoever. It is made for fun only so do not treat the result too seriously :)";

			$test['enjoy_and_share']="At the end of the quiz we will give you the result. It may surprise you a lot.";

			$test['popup_box_text']="Share your result with your friends and see what result they've got! That might surprise both of you!";

			

			

			

			if($this->session->userdata('user_type') == 2)

			{

				$test['page_title']=$this->input->post('title');

				$test['category_id']=1;

			}

			else

			{

				$test['page_title']=$this->input->post('page_title');

				$test['category_id']=$this->input->post('category_id');

			}

			

			$test['created_by']=$this->session->userdata('user_id');

			$test['start_point']=9;

			

			$test['status']=2;

			$test['created']=date('Y-m-d');

			$test['modify_date']=date('Y-m-d H:i:s');

			

			//print_r($test); exit;

			$id=$this->test_model->add_test($test);

			

			//----------------------

			$input_alias=str_replace(" ",'-',strtolower(trim($this->input->post('title'))));

			$input_alias=str_replace(array("\r", "\n", "'",'"',",","?",":",";"), "", $input_alias);

			if($this->test_model->is_unique_alia($input_alias))

			{

				$alias=$input_alias;

			}

			else

			{

				$alias=$input_alias."-".$id;

			}

			

			$tests_update['alias']=$alias;
			$tests_update['testid']=$id;
			$this->test_model->update_test($tests_update,$id);

			//-------------------------

			redirect('admin/tests/add_question_wizard/'.$id."/".$lang_code);

			//$this->session->set_flashdata('success_message','test has been saved');

			//redirect('admin/tests');

			



		}

		else

		{

			

			$db_data['category_list']=$this->test_model->get_categories();
			$data['content']=$this->load->view('admin/test/test_add_wizard_form',$db_data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new",'href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Test Edit Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}
	
	
	
	function face_test()

	{

		if($this->input->post('add_test'))

		{

			$test['title']=$this->input->post('title');
			$test['lang_code']='en';
			$test['description']=$this->input->post('description');

			$test['result_text']='<h2>'.$this->input->post('result_text').'</h2>
			<h1><RESULT></h1>
			<PRE_RESULT>
			<p class="result_des">
			<h2>Are you surprised? Leave a comment!</h2>
			</p>';



			$test['fbshare_des']=$this->input->post('description');

			$test['question']="You will see few questions describing you. Be honest, and find out what your result is at the end of the quiz.";

			$test['answer']="You cannot change your answers - keep this in mind, but do not think about them too long.";

			$test['fun']="This test is not based on any scientific study whatsoever. It is made for fun only so do not treat the result too seriously :)";

			$test['enjoy_and_share']="At the end of the quiz we will give you the result. It may surprise you a lot.";

			$test['popup_box_text']="Share your result with your friends and see what result they've got! That might surprise both of you!";
			
			$test['is_real_test']=5;
			

			

			

			if($this->session->userdata('user_type') == 2)

			{

				$test['page_title']=$this->input->post('title');

				$test['category_id']=1;

			}

			else

			{

				$test['page_title']=$this->input->post('page_title');

				$test['category_id']=$this->input->post('category_id');

			}

			

			$test['created_by']=$this->session->userdata('user_id');

			$test['start_point']=9;

			

			$test['status']=2;

			$test['created']=date('Y-m-d');

			$test['modify_date']=date('Y-m-d H:i:s');

			

			//print_r($test); exit;

			$id=$this->test_model->add_test($test);

			

			//----------------------

			$input_alias=str_replace(" ",'-',strtolower(trim($this->input->post('title'))));

			$input_alias=str_replace(array("\r", "\n", "'",'"',",","?",":",";"), "", $input_alias);

			if($this->test_model->is_unique_alia($input_alias))

			{

				$alias=$input_alias;

			}

			else

			{

				$alias=$input_alias."-".$id;

			}

			

			$tests_update['alias']=$alias;
			$tests_update['testid']=$id;
			$this->test_model->update_test($tests_update,$id);

			//-------------------------

			redirect('admin/tests/add_question_face/'.$id."/".$lang_code);

			//$this->session->set_flashdata('success_message','test has been saved');

			//redirect('admin/tests');

			



		}

		else

		{

			

			$db_data['category_list']=$this->test_model->get_categories();
			$data['content']=$this->load->view('admin/test/face_test_add_form',$db_data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new",'href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Test Edit Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}

	

	

	

	function real_test_add_wizard()

	{

		if($this->input->post('add_test'))

		{

			$test['title']=$this->input->post('title');
			$test['lang_code']='en';

			$test['description']=$this->input->post('description');

			$test['fbshare_des']=$this->input->post('description');

			$test['question']="You will see few questions describing you. Be honest, and find out what your result is at the end of the quiz.";

			$test['answer']="You cannot change your answers - keep this in mind, but do not think about them too long.";

			$test['fun']="This test is not based on any scientific study whatsoever. It is made for fun only so do not treat the result too seriously :)";

			$test['enjoy_and_share']="At the end of the quiz we will give you the result. It may surprise you a lot.";

			$test['popup_box_text']="Share your result with your friends and see what result they've got! That might surprise both of you!";

			



			$test['is_real_test']=1;



			

			if($this->session->userdata('user_type') == 2)

			{

				$test['page_title']=$this->input->post('title');

				$test['category_id']=1;

			}

			else

			{

				$test['page_title']=$this->input->post('page_title');

				$test['category_id']=$this->input->post('category_id');

			}

			

			$test['created_by']=$this->session->userdata('user_id');

			$test['start_point']=0;

			

			$test['status']=2;

			$test['created']=date('Y-m-d');

			$test['modify_date']=date('Y-m-d H:i:s');

			

			

			$id=$this->test_model->add_test($test);

			

			//----------------------

			$input_alias=str_replace(" ",'-',strtolower(trim($this->input->post('title'))));

			$input_alias=str_replace(array("\r", "\n", "'",'"',",","?",":",";"), "", $input_alias);

			if($this->test_model->is_unique_alia($input_alias))

			{

				$alias=$input_alias;

			}

			else

			{

				$alias=$input_alias."-".$id;

			}

			

			$tests_update['alias']=$alias;
			$tests_update['testid']=$id;

			$this->test_model->update_test($tests_update,$id);

			//-------------------------

			

			redirect('admin/tests/real_add_question_wizard/'.$id);

			

			

			//$this->session->set_flashdata('success_message','test has been saved');

			//redirect('admin/tests');

			



		}

		else

		{

			

			$db_data['category_list']=$this->test_model->get_categories();

			$data['content']=$this->load->view('admin/test/real/test_add_wizard_form',$db_data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new real test",'href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Test Edit Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}

	
	
	function facebook_apps()
	{
		if($this->input->post('add_test'))
		{
			$test['title']=$this->input->post('title');
			$test['lang_code']='en';
			$test['description']=$this->input->post('description');
			$test['result_text']=$this->input->post('result_text');
			$test['fbshare_des']=$this->input->post('description');
			$test['question']="You will see few questions describing you. Be honest, and find out what your result is at the end of the quiz.";
			$test['answer']="You cannot change your answers - keep this in mind, but do not think about them too long.";
			$test['fun']="This test is not based on any scientific study whatsoever. It is made for fun only so do not treat the result too seriously :)";
			$test['enjoy_and_share']="At the end of the quiz we will give you the result. It may surprise you a lot.";
			$test['popup_box_text']="Share your result with your friends and see what result they've got! That might surprise both of you!";
			$test['is_real_test']=6;

			if($this->session->userdata('user_type') == 2)
			{
				$test['page_title']=$this->input->post('title');
				$test['category_id']=1;
			}
			else
			{
				$test['page_title']=$this->input->post('page_title');
				$test['category_id']=$this->input->post('category_id');
			}
			$test['created_by']=$this->session->userdata('user_id');
			$test['start_point']=0;
			$test['status']=2;
			$test['created']=date('Y-m-d');
			$test['modify_date']=date('Y-m-d H:i:s');
			
			
			// Upload background image	
				
			$config['upload_path'] = 'assets/img/image/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']  = '0';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			
			$this->load->library('upload');
		    $this->upload->initialize($config);
			$this->load->library('image_lib');			

			if($this->upload->do_upload('image'))
			{
				$file_info = $this->upload->data();
				
				$this->image_lib->clear();
				$settings['image_library'] = 'gd2';
				$settings['source_image']	= 'assets/img/image/'.$file_info['file_name'];
				$settings['create_thumb'] = true;
				$settings['thumb_marker'] = '';
				$settings['maintain_ratio'] = false;
				$settings['new_image'] = 'assets/img/image/'.$file_info['file_name'];
				$settings['width']	 ='620';
				$settings['height']	 ='328';	

				$this->load->library('image_lib');
				$this->image_lib->initialize($settings); 			
				$this->image_lib->resize();
				
				$test['image']=$file_info['file_name'];
			}
			// End background  image
			
			
			// Upload thumb image	
			$this->image_lib->clear();		
			$config['upload_path'] = 'assets/img/thumbs/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']  = '0';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			
			$this->load->library('upload');
		    $this->upload->initialize($config);
			$this->load->library('image_lib');			

			if($this->upload->do_upload('image_thumb'))
			{
				$file_info = $this->upload->data();
				
				$this->image_lib->clear();
				$settings['image_library'] = 'gd2';
				$settings['source_image']	= 'assets/img/thumbs/'.$file_info['file_name'];
				$settings['create_thumb'] = true;
				$settings['thumb_marker'] = '';
				$settings['maintain_ratio'] = false;
				$settings['new_image'] = 'assets/img/thumbs/'.$file_info['file_name'];
				$settings['width']	 = $this->test_image_width;
				$settings['height']	 = $this->test_image_height;	

				$this->load->library('image_lib');
				$this->image_lib->initialize($settings); 			
				$this->image_lib->resize();
				
				$test['image_thumb']=$file_info['file_name'];
			}
			// End upload thumb image
			
			// Upload result image	
			$this->image_lib->clear();		
			$config['upload_path'] = 'assets/img/test_result_img/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']  = '0';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			
			$this->load->library('upload');
		    $this->upload->initialize($config);
			$this->load->library('image_lib');			

			if($this->upload->do_upload('result_image'))
			{
				$file_info = $this->upload->data();
				$meta_info['meta_value']=$file_info['file_name'];
			}
			// End upload result image
			
			
			
			$id=$this->test_model->add_test($test);
			//----------------------
			
			//-------- meta insert -----
			$meta_info['test_id']=$id;
			$meta_info['meta_key']='fb_apps_result_image';			
			$this->test_model->add_meta($meta_info);
			
			$meta_info=array();
			$meta_info['test_id']=$id;
			$meta_info['meta_key']='button_text';	
			$meta_info['meta_value']=$this->input->post('button_text');	
			$this->test_model->add_meta($meta_info);
			
			$meta_info=array();
			$meta_info['test_id']=$id;
			$meta_info['meta_key']='number_of_posts';	
			$meta_info['meta_value']=$this->input->post('number_of_posts');	
			$this->test_model->add_meta($meta_info);
			
			$meta_info=array();
			$meta_info['test_id']=$id;
			$meta_info['meta_key']='number_of_photos';	
			$meta_info['meta_value']=$this->input->post('number_of_photos');	
			$this->test_model->add_meta($meta_info);
			
			$meta_info=array();
			$meta_info['test_id']=$id;
			$meta_info['meta_key']='sub_title';	
			$meta_info['meta_value']=$this->input->post('sub_title');	
			$this->test_model->add_meta($meta_info);

			//--------end  meta insert -----

			$input_alias=str_replace(" ",'-',strtolower(trim($this->input->post('title'))));

			$input_alias=str_replace(array("\r", "\n", "'",'"',",","?",":",";"), "", $input_alias);

			if($this->test_model->is_unique_alia($input_alias))
			{
				$alias=$input_alias;
			}
			else
			{
				$alias=$input_alias."-".$id;
			}
			$tests_update['alias']=$alias;
			$tests_update['testid']=$id;
			$this->test_model->update_test($tests_update,$id);
			//-------------------------

			redirect('admin/tests');
		}
		else
		{
			$db_data['category_list']=$this->test_model->get_categories();
			$data['content']=$this->load->view('admin/test/test_facebook_apps_form',$db_data,true);
			//----- this is for breadcrumbs
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add Facebook Apps test",'href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Test Edit Form";
			//------- end breadcrumbs
			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data);
		}

	}

	

	

	function add_question_wizard($test_id,$question_num=1)
	{ 

		if($this->input->post('add_question'))

		{

			$question_info['question']=$this->input->post('question');

			$question_info['test_id']=$test_id;
			$question_info['lang_code']='en';
			$question_info['status']=1;

			

			$question_id=$this->test_model->add_question($question_info);
			
			//-----------------
				$update_ques_info['test_questionid']=$question_id;
				$this->test_model->question_edit($update_ques_info,$question_id);
			// --------------

			$this->session->set_flashdata('success_message','Question has been saved');

			redirect('admin/tests/add_answer_wizard/'.$test_id.'/'.$question_num.'/'.$question_id);

		}

		else

		{

			

			$db_data['test_id']	=$test_id;	
			$db_data['question_num']	=$question_num;	

			$test_info=$this->test_model->get_test($test_id);

			$data['content']=$this->load->view('admin/test/question_add_wizard_form',$db_data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>$test_info->title,'href'=>site_url().'admin/tests/test_edit/'.$test_info->tests_id);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Question List",'href'=>site_url().'admin/tests/questions/'.$test_info->tests_id);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new",'href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Question Add Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}
	
	
	function add_question_face($test_id,$question_num=1)

	{ 

		if($this->input->post('add_question'))

		{

			$question_info['question']=$this->input->post('question');

			$question_info['test_id']=$test_id;
			$question_info['lang_code']='en';
			$question_info['status']=1;

			

			$question_id=$this->test_model->add_question($question_info);
			
			//-----------------
				$update_ques_info['test_questionid']=$question_id;
				$this->test_model->question_edit($update_ques_info,$question_id);
			// --------------

			$this->session->set_flashdata('success_message','Question has been saved');

			redirect('admin/tests/add_answer_face/'.$test_id.'/'.$question_num.'/'.$question_id);

		}

		else

		{

			

			$db_data['test_id']	=$test_id;	
			$db_data['question_num']	=$question_num;	

			$test_info=$this->test_model->get_test($test_id);

			$data['content']=$this->load->view('admin/test/face_question_add_form',$db_data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>$test_info->title,'href'=>site_url().'admin/tests/test_edit/'.$test_info->tests_id.'/en');

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Question List",'href'=>site_url().'admin/tests/questions/'.$test_info->tests_id.'/en');

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new",'href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Question Add Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}

	

	

	function real_add_question_wizard($test_id,$question_num=1)

	{ 

		if($this->input->post('add_question'))

		{

			$question_info['question']=$this->input->post('question');

			$question_info['test_id']=$test_id;
			$question_info['lang_code']='en';

			$question_info['status']=1;

			

			$config['upload_path'] = 'assets/img/image/';

			$config['allowed_types'] = 'gif|jpg|png|jpeg';

			$config['max_size']  = '0';

			$config['max_width']  = '0';

			$config['max_height']  = '0';

			$this->load->library('upload', $config);

			$this->load->library('image_lib');

			print_r($_FILES);

			if($this->upload->do_upload('image'))

			{

				$file_info = $this->upload->data();

				$question_info['image']=$file_info['file_name'];

				

				$this->image_lib->clear();

				$settings['image_library'] = 'gd2';

				$settings['source_image']	= 'assets/img/image/'.$file_info['file_name'];

				$settings['create_thumb'] = true;

				$settings['thumb_marker'] = '';

				$settings['maintain_ratio'] = true;

				$settings['new_image'] = 'assets/img/image/thumb_'.$file_info['file_name'];

				$settings['width']	 = 500;

				$settings['height']	 = 200;

				

				$this->load->library('image_lib');

				$this->image_lib->initialize($settings); 

				

				$this->image_lib->resize();

				

			}

			

			$question_id=$this->test_model->add_question($question_info);
			
			//-----------------
				$update_ques_info['test_questionid']=$question_id;
				$this->test_model->question_edit($update_ques_info,$question_id);
			// --------------

			$this->session->set_flashdata('success_message','Question has been saved');

			redirect('admin/tests/real_add_answer_wizard/'.$test_id.'/'.$question_num.'/'.$question_id);

		}

		else

		{

			

			$db_data['test_id']	=$test_id;	

			$db_data['question_num']	=$question_num;	

			$test_info=$this->test_model->get_test($test_id);

			$data['content']=$this->load->view('admin/test/real/question_add_wizard_form',$db_data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>$test_info->title,'href'=>site_url().'admin/tests/test_edit/'.$test_info->tests_id);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Question List",'href'=>site_url().'admin/tests/questions/'.$test_info->tests_id);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new",'href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Question Add Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}

	

	

	function add_answer_wizard($test_id,$question_num,$test_question_id,$answer_num=1)

	{

		if($this->input->post('add_answer'))

		{

			$answers_info_1['answere']=$this->input->post('answere');
			$answers_info_1['test_question_id']=$test_question_id;
			$answers_info_1['lang_code']='en';
			$answers_info_1['marks']=$this->input->post('marks');
			$answers_info_1['status']=1;
			
			$answers_info_2['answere']=$this->input->post('answere2');
			$answers_info_2['test_question_id']=$test_question_id;
			$answers_info_2['lang_code']='en';
			$answers_info_2['marks']=$this->input->post('marks2');
			$answers_info_2['status']=1;
			
			$answers_info_3['answere']=$this->input->post('answere3');
			$answers_info_3['test_question_id']=$test_question_id;
			$answers_info_3['lang_code']='en';
			$answers_info_3['marks']=$this->input->post('marks3');
			$answers_info_3['status']=1;

			//$this->test_model->add_batch_answer($answers);
			
			$insert_answer_id1=$this->test_model->add_answer($answers_info_1);
			//-------
				$update_answer_1['answereid']=$insert_answer_id1;				
				$this->test_model->update_answer_lang($update_answer_1,$insert_answer_id1);
			//-------
			$insert_answer_id2=$this->test_model->add_answer($answers_info_2);
			//-------
				$update_answer_2['answereid']=$insert_answer_id2;				
				$this->test_model->update_answer_lang($update_answer_2,$insert_answer_id2);
			//-------
			$insert_answer_id3=$this->test_model->add_answer($answers_info_3);
			//-------
				$update_answer_3['answereid']=$insert_answer_id3;				
				$this->test_model->update_answer_lang($update_answer_3,$insert_answer_id3);
			//-------

			$this->session->set_flashdata('success_message','Answer has been saved');

			redirect('admin/tests/add_question_wizard/'.$test_id."/".($question_num+1));

			//redirect('admin/tests/add_question_wizard/'.$test_id."/".$question_num+1);

		}

		else

		{

			

			$db_data['test_question_id']	=$test_question_id;	

			$db_data['question_num']=$question_num;

			$db_data['test_id']=$test_id;

			$data['content']=$this->load->view('admin/test/answer_add_wizard_form',$db_data,true);

			$question_info=$this->test_model->get_question($test_question_id);

			$test_info=$this->test_model->get_test($question_info->test_id);



			//------- end breadcrumbs

			

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>$test_info->title,'href'=>site_url().'admin/tests/test_edit/'.$test_info->tests_id);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Question List",'href'=>site_url().'admin/tests/questions/'.$test_info->tests_id);

			$breadcrumbs['breadcrumbs'][]=array('text'=>$question_info->question,'href'=>site_url().'admin/tests/question_edit/'.$test_question_id."/".$test_info->tests_id);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Answer List",'href'=>site_url().'admin/tests/answers/'.$test_question_id);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new answer",'href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Test : ".$question_info->title." => Question : ".$question_info->question;

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}

	function add_answer_face($test_id,$question_num,$test_question_id,$answer_num=1)

	{

		if($this->input->post('add_answer'))

		{

			$answers_info_1['answere']=$this->input->post('answere');
			$answers_info_1['test_question_id']=$test_question_id;
			$answers_info_1['lang_code']='en';
			$answers_info_1['marks']=$this->input->post('marks');
			$answers_info_1['status']=1;
			
			$answers_info_2['answere']=$this->input->post('answere2');
			$answers_info_2['test_question_id']=$test_question_id;
			$answers_info_2['lang_code']='en';
			$answers_info_2['marks']=$this->input->post('marks2');
			$answers_info_2['status']=1;
			
			$answers_info_3['answere']=$this->input->post('answere3');
			$answers_info_3['test_question_id']=$test_question_id;
			$answers_info_3['lang_code']='en';
			$answers_info_3['marks']=$this->input->post('marks3');
			$answers_info_3['status']=1;

			//$this->test_model->add_batch_answer($answers);
			
			$insert_answer_id1=$this->test_model->add_answer($answers_info_1);
			//-------
				$update_answer_1['answereid']=$insert_answer_id1;				
				$this->test_model->update_answer_lang($update_answer_1,$insert_answer_id1);
			//-------
			$insert_answer_id2=$this->test_model->add_answer($answers_info_2);
			//-------
				$update_answer_2['answereid']=$insert_answer_id2;				
				$this->test_model->update_answer_lang($update_answer_2,$insert_answer_id2);
			//-------
			$insert_answer_id3=$this->test_model->add_answer($answers_info_3);
			//-------
				$update_answer_3['answereid']=$insert_answer_id3;				
				$this->test_model->update_answer_lang($update_answer_3,$insert_answer_id3);
			//-------

			$this->session->set_flashdata('success_message','Answer has been saved');

			redirect('admin/tests/add_question_face/'.$test_id."/".($question_num+1));

			//redirect('admin/tests/add_question_wizard/'.$test_id."/".$question_num+1);

		}

		else

		{

			

			$db_data['test_question_id']	=$test_question_id;	

			$db_data['question_num']=$question_num;

			$db_data['test_id']=$test_id;

			$data['content']=$this->load->view('admin/test/face_answer_add_form',$db_data,true);

			$question_info=$this->test_model->get_question($test_question_id);

			$test_info=$this->test_model->get_test($question_info->test_id);



			//------- end breadcrumbs

			

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>$test_info->title,'href'=>site_url().'admin/tests/test_edit/'.$test_info->tests_id.'/en');

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Question List",'href'=>site_url().'admin/tests/questions/'.$test_info->tests_id.'/en');

			$breadcrumbs['breadcrumbs'][]=array('text'=>$question_info->question,'href'=>site_url().'admin/tests/question_edit/'.$test_question_id."/".$test_info->tests_id.'/en');

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Answer List",'href'=>site_url().'admin/tests/answers/'.$test_question_id.'/en');

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new answer",'href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Test : ".$question_info->title." => Question : ".$question_info->question;

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}


	function real_add_answer_wizard($test_id,$question_num,$test_question_id,$answer_num=1)

	{

		if($this->input->post('add_answer'))

		{

			
			$answers_info_1['answere']=$this->input->post('answere');
			$answers_info_1['test_question_id']=$test_question_id;
			$answers_info_1['lang_code']='en';
			$answers_info_1['marks']=$this->input->post('marks');
			$answers_info_1['status']=1;
			
			$answers_info_2['answere']=$this->input->post('answere2');
			$answers_info_2['test_question_id']=$test_question_id;
			$answers_info_2['lang_code']='en';
			$answers_info_2['marks']=$this->input->post('marks2');
			$answers_info_2['status']=1;
			
			$answers_info_3['answere']=$this->input->post('answere3');
			$answers_info_3['test_question_id']=$test_question_id;
			$answers_info_3['lang_code']='en';
			$answers_info_3['marks']=$this->input->post('marks3');
			$answers_info_3['status']=1;
			
			
			//$this->test_model->add_batch_answer($answers);
				
			$insert_answer_id1=$this->test_model->add_answer($answers_info_1);
			//-------
				$update_answer_1['answereid']=$insert_answer_id1;				
				$this->test_model->update_answer_lang($update_answer_1,$insert_answer_id1);
			//-------
			$insert_answer_id2=$this->test_model->add_answer($answers_info_2);
			//-------
				$update_answer_2['answereid']=$insert_answer_id2;				
				$this->test_model->update_answer_lang($update_answer_2,$insert_answer_id2);
			//-------
			$insert_answer_id3=$this->test_model->add_answer($answers_info_3);
			//-------
				$update_answer_3['answereid']=$insert_answer_id3;				
				$this->test_model->update_answer_lang($update_answer_3,$insert_answer_id3);
			//-------


			$this->session->set_flashdata('success_message','Answer has been saved');

			redirect('admin/tests/real_add_question_wizard/'.$test_id."/".($question_num+1));

			//redirect('admin/tests/add_question_wizard/'.$test_id."/".$question_num+1);

		}

		else

		{

			

			$db_data['test_question_id']	=$test_question_id;	

			$db_data['question_num']=$question_num;

			$db_data['test_id']=$test_id;

			$data['content']=$this->load->view('admin/test/real/answer_add_wizard_form',$db_data,true);

			$question_info=$this->test_model->get_question($test_question_id);

			$test_info=$this->test_model->get_test($question_info->test_id);



			//------- end breadcrumbs

			

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>$test_info->title,'href'=>site_url().'admin/tests/test_edit/'.$test_info->tests_id);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Question List",'href'=>site_url().'admin/tests/questions/'.$test_info->tests_id);

			$breadcrumbs['breadcrumbs'][]=array('text'=>$question_info->question,'href'=>site_url().'admin/tests/question_edit/'.$test_question_id."/".$test_info->tests_id);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Answer List",'href'=>site_url().'admin/tests/answers/'.$test_question_id);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new answer",'href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Test : ".$question_info->title." => Question : ".$question_info->question;

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}

	

	function add_wizard_result_option($id,$result_num=1)

	{

		if($this->input->post('add_result_option'))

		{

			$result_options['interval_from']=$this->input->post('interval_from');

			$result_options['interval_to']=$this->input->post('interval_to');

			$result_options['result']=$this->input->post('result');

			$result_options['result_description']=$this->input->post('result_description');

			$result_options['test_id']=$this->input->post('test_id');
			$result_options['lang_code']='en';
			

			

			$result_inseret_id=$this->test_model->add_result_option($result_options);
			$update_result_options['result_optionid']=$result_inseret_id;
			$this->test_model->update_wizard_result($update_result_options,$result_inseret_id);

			$this->session->set_flashdata('success_message','Result option has been saved');

			redirect('admin/tests/add_wizard_result_option/'.$id."/".($result_num + 1));

		}

		else

		{

			

			$data['test_info']=$this->test_model->get_test($id);

			$data['test_id']=$id;

			$data['result_num']=$result_num;

			

			$data['content']=$this->load->view('admin/test/add_wizard_result_option',$data,true);

			

			$data['page_header']="Result Option : ".$data['test_info']->title;

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>$data['test_info']->title,'href'=>site_url().'admin/tests/test_edit/'.$data['test_info']->tests_id);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Result Option",'href'=>site_url().'admin/tests/result_option/'.$data['test_info']->tests_id);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new",'href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Test Edit Form";

				

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}

	
	function add_face_result_option($id,$result_num=1)

	{

		if($this->input->post('add_result_option'))

		{

			$result_options['interval_from']=$this->input->post('interval_from');

			$result_options['interval_to']=$this->input->post('interval_to');

			$result_options['result']=$this->input->post('result');

			$result_options['result_description']=$this->input->post('result_description');

			$result_options['test_id']=$this->input->post('test_id');
			$result_options['lang_code']='en';
			

			

			$result_inseret_id=$this->test_model->add_result_option($result_options);
			$update_result_options['result_optionid']=$result_inseret_id;
			$this->test_model->update_wizard_result($update_result_options,$result_inseret_id);

			$this->session->set_flashdata('success_message','Result option has been saved');

			redirect('admin/tests/add_face_result_option/'.$id."/".($result_num + 1));

		}

		else

		{

			

			$data['test_info']=$this->test_model->get_test($id);

			$data['test_id']=$id;

			$data['result_num']=$result_num;

			

			$data['content']=$this->load->view('admin/test/add_face_result_option',$data,true);

			

			$data['page_header']="Result Option : ".$data['test_info']->title;

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>$data['test_info']->title,'href'=>site_url().'admin/tests/test_edit/'.$data['test_info']->tests_id);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Result Option",'href'=>site_url().'admin/tests/result_option/'.$data['test_info']->tests_id);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new",'href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Test Edit Form";

				

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}

	

	function save_test_col($lang_code,$page)

	{
		$col_name=$this->input->post('col_name');
		$value=$this->input->post('value');
		$test_info["$col_name"]=$value;
		
		$this->db->where('post_type','games');
		$this->db->update('tests',$test_info);

		//$this->test_model->edit_test($test_info,$test_id);

		//echo $this->db->last_query();exit;

		$this->load_ajax_test_list($lang_code,$page);

		

	}

	

	

	

	

	function all_image_added()

	{		

		$all_image_added_info['all_image_added']=$this->input->post('all_image_added');

		$test_id=$this->input->post('test_id');

		

		$this->test_model->update_all_image_added($all_image_added_info,$test_id);

		$this->session->set_flashdata('success_message',' All image added has been saved');

		redirect('admin/tests/test_details/'.$test_id);	

	}

	

	function all_content_ready()

	{		

		$all_content_ready_info['all_content_ready']=$this->input->post('all_content_ready');

		$test_id=$this->input->post('test_id');

		

		$this->test_model->update_all_content_ready($all_content_ready_info,$test_id);

		$this->session->set_flashdata('success_message',' All content ready has been saved');

		redirect('admin/tests/test_details/'.$test_id);	

	}

	

	function test_content($testid,$lang_code)

	{
		if($this->session->userdata('access_language')) $access_language=explode(',',$this->session->userdata('access_language'));
		else $access_language=array();
		if(!(in_array($lang_code,$access_language))) redirect('admin/tests'); 
		//echo "safsdf"; exit;

		if($this->input->post('test_content'))

		{

			$this->load->library( 'form_validation' );			



			$this->form_validation->set_rules('title', 'Title', 'trim|required');

			if($this->input->post('alias')) $this->form_validation->set_rules('alias', 'Alias', 'trim|required|callback_check_duplicate_alias');



			if($this->form_validation->run()) 

			{

				$test_content_info['testid']=$testid;

				$test_content_info['lang_code']=$lang_code;

				$test_content_info['title']=$this->input->post('title');

				if($this->input->post('alias')) $test_content_info['alias']=$this->input->post('alias');

				$test_content_info['page_title']=$this->input->post('page_title');

				$test_content_info['category_id']=$this->input->post('category_id');

				$test_content_info['description']=$this->input->post('description');

				$test_content_info['start_point']=$this->input->post('start_point');

				$test_content_info['result_text']=$this->input->post('result_text');

				$test_content_info['fbshare_des']=$this->input->post('fbshare_des');
				$test_content_info['is_real_test']=$this->input->post('is_real_test');
				
				$test_content_info['created_by']=$this->session->userdata('user_id');
				$test_content_info['created']=date('Y-m-d');
				$test_content_info['modify_date']=date('Y-m-d H:i:s');
				$test_content_info['activated_date']=date('Y-m-d H:i:s');
				$test_content_info['is_real_test']=$this->input->post('is_real_test');
				
											

				$config['upload_path'] = 'assets/img/image/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']  = '0';
				$config['max_width']  = '0';
				$config['max_height']  = '0';
				
				$this->load->library('upload');
				$this->upload->initialize($config);
				$this->load->library('image_lib');

				if($this->upload->do_upload('image'))
				{
					$file_info = $this->upload->data();
					$test_content_info['image']=$file_info['file_name'];
					
					if($this->input->post('pre_img_path') != "assets/img/image/".$this->input->post('en_image'))
					{

						 @unlink($this->input->post('pre_img_path'));
						
					}

				}
				
				// upload thumb image
				$this->image_lib->clear();
				$config['upload_path'] = 'assets/img/thumbs/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']  = '0';
				$config['max_width']  = '0';
				$config['max_height']  = '0';
				
				$this->load->library('upload');
				$this->upload->initialize($config);
				$this->load->library('image_lib');

				if($this->upload->do_upload('image_thumb'))
				{
					$file_info = $this->upload->data();
					$test_content_info['image_thumb']=$file_info['file_name'];	
					
					$this->image_lib->clear();
					$settings['image_library'] = 'gd2';
					$settings['source_image']	= 'assets/img/thumbs/'.$file_info['file_name'];
					$settings['create_thumb'] = true;
					$settings['thumb_marker'] = '';
					$settings['maintain_ratio'] = false;
					$settings['new_image'] = 'assets/img/thumbs/'.$file_info['file_name'];
					$settings['width']	 = $this->test_image_width;
					$settings['height']	 = $this->test_image_height;	
	
					$this->load->library('image_lib');
					$this->image_lib->initialize($settings); 			
					$this->image_lib->resize();				

					

					if($this->input->post('pre_img_path2') != "assets/img/thumbs/".$this->input->post('en_image_thumb'))
					{

						 @unlink($this->input->post('pre_img_path2'));
					}

				}
				//End upload thumb image
				

				else if($this->input->post('test_info') == 0)

				{

					$test_content_info['image']=$this->input->post('en_image');
					$test_content_info['image_thumb']=$this->input->post('en_image_thumb');

				}

				//------- manage flags

					$flags='';

					if($this->input->post('flags'))

					{

						$flags=$this->input->post('flags');

						$flags=serialize($flags);

					} 

					

					

					//--------- end flags 

				

				$test_info=$this->input->post('test_info');

				if($test_info == 0)

				{
					$test_content_info['status']=2;
					$test_content_info['alias']=$this->input->post('eng_test_alias');
					
					
					
					$id=$this->test_model->save_test_content($test_content_info);
					
					//-------- meta insert -----
					$meta_info['test_id']=$id;
					$meta_info['meta_key']='sub_title';
					$meta_info['meta_value']=$this->input->post('sub_title');
					$this->test_model->add_meta($meta_info);	
					
					$meta_info=array();
					$meta_info['meta_value']=$this->input->post('button_text');
					$meta_info['test_id']=$id;
					$meta_info['meta_key']="button_text";
					$this->test_model->edit_testMeta($meta_info,$id,'button_text');
							
					//--------end  meta insert -----

					//----------------------

					/*$input_alias=str_replace(" ",'-',strtolower(trim($this->input->post('title'))));

					$input_alias=str_replace(array("\r", "\n", "'",'"',",","?",":",";"), "", $input_alias);

					if($this->test_model->is_unique_alia($input_alias))

					{

						$alias=$input_alias;

					}

					else

					{

						$alias=$input_alias."-".$id;

					}

					

					$tests_update['alias']=$alias;

					$this->test_model->edit_test($tests_update,$id);*/

				}

				else

				{
					if($this->input->post('sub_title'))
					{
						$tests_Id=$this->input->post('tests_Id');
						$meta_info['meta_value']=$this->input->post('sub_title');					
						$this->test_model->edit_testMeta($meta_info,$tests_Id,'sub_title');
					}
					
					
					
					$meta_info=array();
					$meta_info['meta_value']=$this->input->post('button_text');
					$meta_info['test_id']=$this->input->post('tests_Id');
					$meta_info['meta_key']="button_text";
					$this->test_model->edit_testMeta($meta_info,$this->input->post('tests_Id'),'button_text');
					

					$this->test_model->update_test_content($test_content_info,$testid,$lang_code);

				}

				

				

				//print_r($test_content_info);

				$this->session->set_flashdata('success_message',' Test Content has been saved');

			    redirect('admin/tests/index/'.$lang_code);
			   //redirect('admin/tests');

			}

			else

			{

				$data['test_info']=$this->test_model->get_test_content($testid,$lang_code);

				// for old image

				$eng_test_info=$this->test_model->get_test_content($testid,'en');
				//print_r($eng_test_info); exit;
				$data['eng_test_info']=$eng_test_info;
				$data['eng_test_image']=$eng_test_info->image;
				$data['eng_test_image_thumb']=$eng_test_info->image_thumb;

				$data['eng_test_alias']=$eng_test_info->alias;
				$data['is_real_test']=$eng_test_info->is_real_test;

				// end for old image

				$data['flags']=$this->test_model->get_flags();

				$data['testid']=$testid;

				$data['lang_code']=$lang_code;

				

				$data['category_list']=$this->test_model->get_categories($lang_code);

				$data['referance']='';

				$data['content']=$this->load->view('admin/test/test_content_form',$data,true);

				//----- this is for breadcrumbs

				$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');			

				$breadcrumbs['breadcrumbs'][]=array('text'=>'Test Content','href'=>'');

				$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

				$data['page_header']="Test Content Form";

				//------- end breadcrumbs

				$data['active_menu']='';

				$this->load->view('admin/layout/default',$data);

			}

			

		}

		else

		{

			$data['test_info']=$this->test_model->get_test_content($testid,$lang_code);

			// for old image

			$eng_test_info=$this->test_model->get_test_content($testid,'en');
			$data['eng_test_info']=$eng_test_info;
			$data['eng_test_image']=$eng_test_info->image;
			$data['eng_test_image_thumb']=$eng_test_info->image_thumb;
			$data['is_real_test']=$eng_test_info->is_real_test;
			// end for old image

			$data['eng_test_alias']=$eng_test_info->alias;

			$data['flags']=$this->test_model->get_flags();

			$data['testid']=$testid;

			$data['lang_code']=$lang_code;

			

			$data['category_list']=$this->test_model->get_categories($lang_code);

			$data['referance']='';

			$data['content']=$this->load->view('admin/test/test_content_form',$data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');			

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Test Content','href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Test Content Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}

	

	

	function question_content($test_id,$test_questionid,$lang_code)

	{
		if($this->session->userdata('access_language')) $access_language=explode(',',$this->session->userdata('access_language'));
		else $access_language=array();
		if(!(in_array($lang_code,$access_language))) redirect('admin/tests/questions/'.$test_id ."/en");		
		
		
		if($this->input->post('add_question_content'))

		{

			$question_info['question']=$this->input->post('question');

			$question_info['test_id']=$test_id;

			$question_info['status']=1;

			$question_info['test_questionid']=$test_questionid;

			$question_info['lang_code']=$lang_code;
			//print_r($question_info); exit;
			

			$config['upload_path'] = 'assets/img/image/';

			$config['allowed_types'] = 'gif|jpg|png|jpeg';

			$config['max_size']  = '0';

			$config['max_width']  = '0';

			$config['max_height']  = '0';

			$this->load->library('upload', $config);

			$this->load->library('image_lib');

			//print_r($_FILES);

			if($this->upload->do_upload('image'))

			{

				$file_info = $this->upload->data();

				$question_info['image']=$file_info['file_name'];

				

				

				$this->image_lib->clear();

				$settings['image_library'] = 'gd2';

				$settings['source_image']	= 'assets/img/image/'.$file_info['file_name'];

				$settings['create_thumb'] = true;

				$settings['thumb_marker'] = '';

				$settings['maintain_ratio'] = true;

				$settings['new_image'] = 'assets/img/image/thumb_'.$file_info['file_name'];

				$settings['width']	 = 500;

				$settings['height']	 = 200;

				

				$this->load->library('image_lib');
				$this->image_lib->initialize($settings); 
				$this->image_lib->resize();
				
				if($this->input->post('pre_imgpath') != "assets/img/image/".$this->input->post('eng_question_image'))
					{

						 @unlink($this->input->post('pre_imgpath'));
						 @unlink($this->input->post('pre_imgpath2'));
					}


			} 

			else

			{

				$question_info['image']=$this->input->post('eng_question_image');

			}

			//print_r($question_info);exit;

			

			$have_question=$this->input->post('have_question');

			if($have_question == 0)

			{

				$this->test_model->add_question($question_info);

			}

			else

			{

				$this->test_model->update_question_content($question_info,$test_questionid,$lang_code);

			}

			

			$this->session->set_flashdata('success_message','Question has been saved');

			

			//------update test table---------

			$test['modify_date']=date('Y-m-d H:i:s');

			$this->test_model->edit_test($test,$test_id);

			//------------- end -----------------

			redirect('admin/tests/questions/'.$test_id."/".$lang_code);

		}

		else

		{

			

			$db_data['test_id']	=$test_id;

			$db_data['question_info']=$this->test_model->get_question($test_questionid,$lang_code);				

			// for eng image

			$eng_question_info=$this->test_model->get_question($test_questionid,'en');	

			$db_data['eng_question_info']=$eng_question_info;
			$db_data['eng_question_image']=$eng_question_info->image;

			// End for eng image

			//print_r($db_data['question_info']);

			$db_data['test_questionid']	=$test_questionid;

			$db_data['lang_code']	=$lang_code;

			$test_info=$this->test_model->get_test($test_id);

			$data['content']=$this->load->view('admin/test/question_content_form',$db_data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>$test_info->title,'href'=>site_url().'admin/tests/test_edit/'.$test_info->testid."/".$lang_code);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Question List",'href'=>site_url().'admin/tests/questions/'.$test_info->testid."/".$lang_code);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new",'href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Question Add Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}

	

	function answer_content($answereid,$test_question_id,$lang_code)
	{
		if($this->session->userdata('access_language')) $access_language=explode(',',$this->session->userdata('access_language'));
		else $access_language=array();		
		if(!(in_array($lang_code,$access_language))) redirect('admin/tests/answers/'.$test_question_id."/en");
		
		if($this->input->post('edit_answer_content'))
		{

			$answer_info['answere']=$this->input->post('answere');

			$answer_info['lang_code']=$lang_code;

			$answer_info['answereid']=$answereid;

			$answer_info['test_question_id']=$test_question_id;

			$answer_info['marks']=$this->input->post('marks');

			if($this->input->post('status')) $answer_info['status']=$this->input->post('status');

			

		    //print_r($answer_info); exit;

			$have_answer=$this->input->post('have_answer');

			if($have_answer==0)

			{

				$answer_insert_id=$this->test_model->add_answer($answer_info); 

				//-----

				//$update_answer_info['answereid']=$answer_insert_id;			

				//$this->test_model->update_answer_lang($update_answer_info,$answer_insert_id);

				

				// ------

			}

			else

			{

				$this->test_model->edit_answer($answer_info,$answereid,$lang_code);

			}

			

			$this->session->set_flashdata('success_message','answer has been saved');

			redirect('admin/tests/answers/'.$test_question_id."/".$lang_code);

		}

		else

		{

			

			$question_info=$this->test_model->get_question($test_question_id);

			$db_data['answer_info']=$this->test_model->get_answer($answereid,$lang_code);
			$db_data['en_answer_info']=$this->test_model->get_answer($answereid,'en');

			$db_data['test_question_id']=$test_question_id;	

			$db_data['answereid']=$answereid;

			$db_data['lang_code']=$lang_code;	

			$test_info=$this->test_model->get_test($question_info->test_id);

			$data['content']=$this->load->view('admin/test/answer_content_form',$db_data,true);



			

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>$test_info->title,'href'=>site_url().'admin/tests/test_edit/'.$test_info->testid."/".$lang_code);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Question List",'href'=>site_url().'admin/tests/questions/'.$test_info->testid."/".$lang_code);

			$breadcrumbs['breadcrumbs'][]=array('text'=>$question_info->question,'href'=>site_url().'admin/tests/question_edit/'.$test_question_id."/".$test_info->testid."/".$lang_code);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Answer List",'href'=>site_url().'admin/tests/answers/'.$test_question_id."/".$lang_code);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new answer",'href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Test : ".$question_info->title." => Question : ".$question_info->question;

			//------- end breadcrumbs

		

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

		

	}

	

	function result_content($result_optionid,$id,$lang_code)

	{

		//echo $lang_code; exit;

		if($this->input->post('result_content_option'))

		{

			$result_options['interval_from']=$this->input->post('interval_from');

			$result_options['interval_to']=$this->input->post('interval_to');

			$result_options['result']=$this->input->post('result');

			$result_options['result_description']=$this->input->post('result_description');

			$result_options['lang_code']=$lang_code;

			$result_options['test_id']=$id;

			$result_options['result_optionid']=$result_optionid;

			

			//print_r($result_options); exit;

			

			$config['upload_path'] = 'assets/img/test_result_img/';

			$config['allowed_types'] = 'gif|jpg|png|jpeg';

			$config['max_size']  = '500';

			$config['max_width']  = '0';

			$config['max_height']  = '0';

			$this->load->library('upload', $config);

			//$this->load->library('image_lib');

			

			//unlink('assets/img/test_result_img/file.jpg');

			

			if($this->upload->do_upload('test_result_img'))

			{

				$file_info = $this->upload->data();

				$result_options['test_result_img']=$file_info['file_name'];

				

				//---- resize image

				$config2['image_library'] = 'gd2';

				$config2['source_image'] = 'assets/img/test_result_img/'.$file_info['file_name'];

				$config2['new_image'] = 'assets/img/test_result_img/'.$file_info['file_name'];

				$config2['create_thumb'] = TRUE;

				$config2['thumb_marker'] ="";

				$config2['maintain_ratio'] = false;

				$config2['width'] = 180;

				$config2['height'] = 180;

				

				$this->load->library('image_lib', $config2);

				

				$this->image_lib->resize();

				

				//@unlink($this->input->post('pre_img_path'));

				//------ end image resize

			}

			else

			{

				$result_options['test_result_img']=$this->input->post('eng_result_image');

			}

			

		 $have_result=$this->input->post('have_result');

			

			if($have_result == 0)

			{			

				 //print_r($result_options); exit;

				$result_inseret_id=$this->test_model->add_result_option($result_options);



			}

			else

			{

				$this->test_model->update_result_option($result_options,$result_optionid,$lang_code);

			}

			

			$this->session->set_flashdata('success_message','Result option has been saved');

			//-------------update test table

			$test['modify_date']=date('Y-m-d H:i:s');

			$this->test_model->edit_test($test,$id);

			//------------- end ----------------

			redirect('admin/tests/result_option/'.$id."/".$lang_code);

		}

		else

		{

			//echo $lang_code; exit;

			$data['lang_code']=$lang_code;

			$data['test_info']=$this->test_model->get_test($id);			

			$data['result_option']=$this->test_model->get_result_option($result_optionid,$lang_code);

			$eng_result_option=$this->test_model->get_result_option($result_optionid,$lang_code='en');
			
			$data['eng_result_option']=$eng_result_option;
			$data['eng_result_image']=$eng_result_option->test_result_img;

			$data['test_id']=$id;

			$data['result_optionid']=$result_optionid;

			

			

			$data['content']=$this->load->view('admin/test/result_content_option',$data,true);

			

			$data['page_header']="Result Option  : ".$data['test_info']->title;

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>$data['test_info']->title,'href'=>site_url().'admin/tests/test_edit/'.$data['test_info']->testid."/".$lang_code);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Result Option",'href'=>site_url().'admin/tests/result_option/'.$data['test_info']->testid."/".$lang_code);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new",'href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Test Edit Form";

				

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}
	
	
	
	function twist_test_add_wizard()
	{
		if($this->input->post('add_twist_test'))
		{
			$test['title']=$this->input->post('title');
			$test['lang_code']='en';
			$test['description']=$this->input->post('description');
			$test['fbshare_des']=$this->input->post('description');
			$test['question']="You will see few questions describing you. Be honest, and find out what your result is at the end of the quiz.";
			$test['answer']="You cannot change your answers - keep this in mind, but do not think about them too long.";
			$test['fun']="This test is not based on any scientific study whatsoever. It is made for fun only so do not treat the result too seriously :)";
			$test['enjoy_and_share']="At the end of the quiz we will give you the result. It may surprise you a lot.";
			$test['popup_box_text']="Share your result with your friends and see what result they've got! That might surprise both of you!";
			$test['is_real_test']=2;
			if($this->session->userdata('user_type') == 2)
			{
				$test['page_title']=$this->input->post('title');
				$test['category_id']=1;
			}
			else
			{
				$test['page_title']=$this->input->post('page_title');
				$test['category_id']=$this->input->post('category_id');
			}
			
			$test['created_by']=$this->session->userdata('user_id');
			$test['start_point']=0;
			$test['status']=2;
			$test['created']=date('Y-m-d');
			$test['modify_date']=date('Y-m-d H:i:s');
			$id=$this->test_model->add_test($test);
			//----------------------
			$input_alias=str_replace(" ",'-',strtolower(trim($this->input->post('title'))));
			$input_alias=str_replace(array("\r", "\n", "'",'"',",","?",":",";"), "", $input_alias);
			if($this->test_model->is_unique_alia($input_alias))
			{
				$alias=$input_alias;
			}
			else
			{
				$alias=$input_alias."-".$id;
			}
			$tests_update['alias']=$alias;
			$tests_update['testid']=$id;
			$this->test_model->update_test($tests_update,$id);
			//-------------------------
			redirect('admin/tests/twist_add_question_wizard/'.$id);
		}
		else
		{
			$db_data['category_list']=$this->test_model->get_categories();
			$data['content']=$this->load->view('admin/test/real/twist_test_add_form',$db_data,true);
			//----- this is for breadcrumbs
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new Knowledge Test",'href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Test Edit Form";
			//------- end breadcrumbs
			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data);
		}
	}
	
	
	function twist_add_question_wizard($test_id,$question_num=1)
	{ 
		if($this->input->post('add_question'))
		{
			$question_info['question']=$this->input->post('question');
			$question_info['test_id']=$test_id;
			$question_info['lang_code']='en';
			$question_info['status']=1;
			$config['upload_path'] = 'assets/img/image/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']  = '0';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			$this->load->library('upload', $config);
			$this->load->library('image_lib');
			if($this->upload->do_upload('image'))
			{
				$file_info = $this->upload->data();
				$question_info['image']=$file_info['file_name'];
				$this->image_lib->clear();
				$settings['image_library'] = 'gd2';
				$settings['source_image']	= 'assets/img/image/'.$file_info['file_name'];
				$settings['create_thumb'] = true;
				$settings['thumb_marker'] = '';
				$settings['maintain_ratio'] = true;
				$settings['new_image'] = 'assets/img/image/thumb_'.$file_info['file_name'];
				$settings['width']	 = $this->question_img_width;
				$settings['height']	 = $this->question_img_height;
				$this->load->library('image_lib');
				$this->image_lib->initialize($settings); 
				$this->image_lib->resize();
			}
			$question_id=$this->test_model->add_question($question_info);
			//-----------------
				$update_ques_info['test_questionid']=$question_id;
				$this->test_model->question_edit($update_ques_info,$question_id);
			// --------------
			$this->session->set_flashdata('success_message','Question has been saved');
			redirect('admin/tests/twist_add_answer_wizard/'.$test_id.'/'.$question_num.'/'.$question_id);
		}
		else
		{
			$db_data['test_id']	=$test_id;	
			$db_data['question_num']	=$question_num;	
			$test_info=$this->test_model->get_test($test_id);
			$data['content']=$this->load->view('admin/test/real/twist_question_add_wizard_form',$db_data,true);
			//----- this is for breadcrumbs
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>$test_info->title,'href'=>site_url().'admin/tests/test_edit/'.$test_info->tests_id);
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Question List",'href'=>site_url().'admin/tests/questions/'.$test_info->tests_id);
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new",'href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Question Add Form";
			//------- end breadcrumbs
			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data);

		}

	}
	
	function twist_add_answer_wizard($test_id,$question_num,$test_question_id,$answer_num=1)
	{
		if($this->input->post('add_answer'))
		{
			$answers_info_1['answere']=$this->input->post('answere');
			$answers_info_1['test_question_id']=$test_question_id;
			$answers_info_1['lang_code']='en';
			$answers_info_1['marks']=$this->input->post('marks');
			$answers_info_1['status']=1;
			
			$answers_info_2['answere']=$this->input->post('answere2');
			$answers_info_2['test_question_id']=$test_question_id;
			$answers_info_2['lang_code']='en';
			$answers_info_2['marks']=$this->input->post('marks2');
			$answers_info_2['status']=1;
			
			$answers_info_3['answere']=$this->input->post('answere3');
			$answers_info_3['test_question_id']=$test_question_id;
			$answers_info_3['lang_code']='en';
			$answers_info_3['marks']=$this->input->post('marks3');
			$answers_info_3['status']=1;
			//$this->test_model->add_batch_answer($answers);
			$insert_answer_id1=$this->test_model->add_answer($answers_info_1);
			//-------
				$update_answer_1['answereid']=$insert_answer_id1;				
				$this->test_model->update_answer_lang($update_answer_1,$insert_answer_id1);
			//-------
			$insert_answer_id2=$this->test_model->add_answer($answers_info_2);
			//-------
				$update_answer_2['answereid']=$insert_answer_id2;				
				$this->test_model->update_answer_lang($update_answer_2,$insert_answer_id2);
			//-------
			$insert_answer_id3=$this->test_model->add_answer($answers_info_3);
			//-------
				$update_answer_3['answereid']=$insert_answer_id3;				
				$this->test_model->update_answer_lang($update_answer_3,$insert_answer_id3);
			//-------
			$this->session->set_flashdata('success_message','Answer has been saved');

			redirect('admin/tests/twist_add_question_wizard/'.$test_id."/".($question_num+1));

			//redirect('admin/tests/add_question_wizard/'.$test_id."/".$question_num+1);
		}

		else
		{
			$db_data['test_question_id']	=$test_question_id;	
			$db_data['question_num']=$question_num;
			$db_data['test_id']=$test_id;
			$data['content']=$this->load->view('admin/test/real/twist_answer_add_wizard_form',$db_data,true);
			$question_info=$this->test_model->get_question($test_question_id);
			$test_info=$this->test_model->get_test($question_info->test_id);
			//------- end breadcrumbs
			//----- this is for breadcrumbs
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>$test_info->title,'href'=>site_url().'admin/tests/test_edit/'.$test_info->tests_id);
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Question List",'href'=>site_url().'admin/tests/questions/'.$test_info->tests_id);
			$breadcrumbs['breadcrumbs'][]=array('text'=>$question_info->question,'href'=>site_url().'admin/tests/question_edit/'.$test_question_id."/".$test_info->tests_id);
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Answer List",'href'=>site_url().'admin/tests/answers/'.$test_question_id);
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new answer",'href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Test : ".$question_info->title." => Question : ".$question_info->question;
			//------- end breadcrumbs
			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data);
		}

	}
	
	
	
	function twist_test_wizard_result_option($id,$result_num=1)
	{
		if($this->input->post('add_result_option'))
		{
			$result_options['interval_from']=$this->input->post('interval_from');
			$result_options['interval_to']=$this->input->post('interval_to');
			$result_options['result']=$this->input->post('result');
			$result_options['result_description']=$this->input->post('result_description');
			$result_options['test_id']=$this->input->post('test_id');
			$result_options['lang_code']='en';
			
			$config['upload_path'] = 'assets/img/test_result_img/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']  = '0';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			$this->load->library('upload', $config);

			$this->load->library('image_lib');

			

			if($this->upload->do_upload('test_result_img'))
			{	
				$file_info = $this->upload->data();
				$result_options['test_result_img']=$file_info['file_name'];
			}
			
			$result_inseret_id=$this->test_model->add_result_option($result_options);
			$update_result_options['result_optionid']=$result_inseret_id;
			$this->test_model->update_wizard_result($update_result_options,$result_inseret_id);

			$this->session->set_flashdata('success_message','Result option has been saved');
			redirect('admin/tests/twist_test_wizard_result_option/'.$id."/".($result_num + 1));
		}
		else
		{
			$data['test_info']=$this->test_model->get_test($id);
			$data['test_id']=$id;
			$data['result_num']=$result_num;

			$data['content']=$this->load->view('admin/test/real/twist_test_wizard_result_option',$data,true);
			$data['page_header']="Result Option : ".$data['test_info']->title;

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>$data['test_info']->title,'href'=>site_url().'admin/tests/test_edit/'.$data['test_info']->tests_id);
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Result Option",'href'=>site_url().'admin/tests/result_option/'.$data['test_info']->tests_id);
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new",'href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Test Edit Form";

			//------- end breadcrumbs

			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data);
		}

	}
	
	
	
	function apps_test_add_wizard()
	{
		if($this->input->post('add_3apps_test'))
		{
			$test['title']=$this->input->post('title');
			$test['lang_code']='en';
			$test['description']=$this->input->post('description');
			$test['result_text']='<h2></h2>
					<h1><RESULT></h1>
					<PRE_RESULT>
					<p class="result_des">
					<h2>Are you surprised? Leave a comment!</h2>
					</p>';

			$test['fbshare_des']=$this->input->post('description');
			$test['question']="You will see few questions describing you. Be honest, and find out what your result is at the end of the quiz.";
			$test['answer']="You cannot change your answers - keep this in mind, but do not think about them too long.";
			$test['fun']="This test is not based on any scientific study whatsoever. It is made for fun only so do not treat the result too seriously :)";
			$test['enjoy_and_share']="At the end of the quiz we will give you the result. It may surprise you a lot.";
			$test['popup_box_text']="Share your result with your friends and see what result they've got! That might surprise both of you!";
			$test['is_real_test']=3;
			if($this->session->userdata('user_type') == 2)
			{
				$test['page_title']=$this->input->post('title');
				$test['category_id']=1;
			}
			else
			{
				$test['page_title']=$this->input->post('page_title');
				$test['category_id']=$this->input->post('category_id');
			}

			$test['created_by']=$this->session->userdata('user_id');
			$test['start_point']=9;
			$test['status']=2;
			$test['created']=date('Y-m-d');
			$test['modify_date']=date('Y-m-d H:i:s');
			//print_r($test); exit;
			$id=$this->test_model->add_test($test);
			//----------------------
			$input_alias=str_replace(" ",'-',strtolower(trim($this->input->post('title'))));
			$input_alias=str_replace(array("\r", "\n", "'",'"',",","?",":",";"), "", $input_alias);
			if($this->test_model->is_unique_alia($input_alias))
			{
				$alias=$input_alias;
			}
			else
			{
				$alias=$input_alias."-".$id;
			}
			$tests_update['alias']=$alias;
			$tests_update['testid']=$id;
			$this->test_model->update_test($tests_update,$id);
			//-------------------------
			redirect('admin/tests/add_3apps_result_option/'.$id);
			//$this->session->set_flashdata('success_message','test has been saved');
			//redirect('admin/tests');
		}
		else
		{
			$db_data['category_list']=$this->test_model->get_categories();
			$data['content']=$this->load->view('admin/test/3apps/add_wizard_form',$db_data,true);
			//----- this is for breadcrumbs
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new",'href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Test Edit Form";
			//------- end breadcrumbs
			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data);
		}
	}
	
	
	function add_3apps_result_option($id,$result_num=1)
	{
		if($this->input->post('add_result_option'))
		{
			$result_options['interval_from']=$this->input->post('interval_from');
			$result_options['interval_to']=$this->input->post('interval_to');
			$result_options['result']=$this->input->post('result');
			$result_options['result_description']=$this->input->post('result_description');
			$result_options['test_id']=$this->input->post('test_id');
			$result_options['lang_code']='en';
			$result_options['font_name']=$this->input->post('font_name');
			
			$config['upload_path'] = 'assets/img/test_result_img/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']  = '500';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			$this->load->library('upload', $config);
			if($this->upload->do_upload('test_result_img'))
			{
				$file_info = $this->upload->data();
				$result_options['test_result_img']=$file_info['file_name'];
				//---- resize image
				$config2['image_library'] = 'gd2';
				$config2['source_image'] = 'assets/img/test_result_img/'.$file_info['file_name'];
				$config2['new_image'] = 'assets/img/test_result_img/'.$file_info['file_name'];
				$config2['create_thumb'] = TRUE;
				$config2['thumb_marker'] ="";
				$config2['maintain_ratio'] = false;
				$config2['width'] = 742;
				$config2['height'] = 389;
				$this->load->library('image_lib', $config2);
				$this->image_lib->resize();


				//------ end image resize

			}
			
			$result_inseret_id=$this->test_model->add_result_option($result_options);
			$update_result_options['result_optionid']=$result_inseret_id;
			$this->test_model->update_wizard_result($update_result_options,$result_inseret_id);
			$this->session->set_flashdata('success_message','Result option has been saved');
			redirect('admin/tests/add_3apps_result_option/'.$id."/".($result_num + 1));
		}
		else
		{
			$data['test_info']=$this->test_model->get_test($id);
			$data['test_id']=$id;
			$data['result_num']=$result_num;
			$data['content']=$this->load->view('admin/test/3apps/add_result_option',$data,true);
			$data['page_header']="Result Option : ".$data['test_info']->title;
			//----- this is for breadcrumbs
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>$data['test_info']->title,'href'=>site_url().'admin/tests/test_edit/'.$data['test_info']->tests_id);
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Result Option",'href'=>site_url().'admin/tests/result_option/'.$data['test_info']->tests_id);
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new",'href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Test Edit Form";

			//------- end breadcrumbs
			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data);
		}
	}

	

	

	

}



/* End of file home.php */

/* Location: ./application/controllers/home.php */