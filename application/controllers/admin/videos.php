<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Videos extends CI_Controller {     

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
	var $post_type="videos";
	function __construct() 
	{

		parent::__construct();
		//site_url();
		if(!$this->session->userdata('user_id')) redirect('admin/auth');

		$this->load->model('admin/test_model');		
	}
	
	function index($lang_code='en',$page=0)
	{	
		
		$this->session->set_userdata('video_search','');
		$this->session->set_userdata('search_status','');
		$total_rows = $this->test_model->get_total_tests($lang_code,$this->post_type);
		
		$limit=30;
		$this->load->library('pagination');
	
		$config['base_url'] = site_url().'admin/videos/index/'.$lang_code;
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
		
		
		
        $db_data['test_list']=$this->test_model->get_tests($lang_code,$page,$limit,$this->post_type);	
		$db_data['lang']=$lang_code;
		$db_data['language_list']=$this->test_model->get_languages();	

		$data['content'] = $this->load->view('admin/'.$this->post_type.'/list',$db_data,true);

		//----- this is for breadcrumbs

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Dashboard','href'=>site_url().'admin');

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Video List','href'=>'');

		$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

		$data['page_header']="Articles";

		//------- end breadcrumbs

		$data['active_menu']='articles';

		$this->load->view('admin/layout/default',$data);   

	}
	
	function search_tests($lang_code='en',$page=0)
	{
		
		if($this->input->post('search'))
		{
			$this->session->set_userdata('video_search',$this->input->post('search'));
		}
		
		if(isset($_GET['status']))
		{
			$this->session->set_userdata('search_status',$_GET['status']);
		}		
		//echo $this->session->userdata('search_status');
		
		$total_rows = $this->test_model->get_total_search_tests($lang_code,$this->post_type);
		
		$limit=30;
		$this->load->library('pagination');
	
		$config['base_url'] = site_url().'admin/'.$this->post_type.'/search_tests/'.$lang_code;
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
		
		
		
        $db_data['test_list']=$this->test_model->get_search_tests($lang_code,$page,$limit,$this->post_type);	
		$db_data['lang']=$lang_code;
		$db_data['language_list']=$this->test_model->get_languages();	

		$data['content'] = $this->load->view('admin/'.$this->post_type.'/list',$db_data,true);

		//----- this is for breadcrumbs

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Dashboard','href'=>site_url().'admin');

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Video List','href'=>'');

		$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

		$data['page_header']="Tests";

		//------- end breadcrumbs

		$data['active_menu']='';

		$this->load->view('admin/layout/default',$data);
		

		
	}


	function add($lan='en')
	{
		if($this->input->post('add_video'))
		{
			$test['title']=$this->input->post('title');
			$test['page_title']=$this->input->post('title');
			//if(lan=='') $lancode='en'; else $lancode=$lan;
			$test['lang_code']=$lan;			
			$test['category_id']=$this->input->post('category_id');
			$test['created_by']=$this->session->userdata('user_id');
			$test['description']=$this->input->post('description');
			$test['fbshare_des']=$this->input->post('fbshare_des');

			
			$test['status']=2;
			$test['created']=date('Y-m-d');
			$test['modify_date']=date('Y-m-d H:i:s');
			
			$test['post_type']=$this->post_type;

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
			//----------upload thumb image
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
			
			//----------end upload thumb image
			//----------upload video
			$this->image_lib->clear();
			$config['upload_path'] = 'assets/videos/';
			$config['allowed_types'] = '*';
			$config['max_size']  = '0';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			$this->load->library('upload');
		    $this->upload->initialize($config);
			
			$video_name="";
			if($this->upload->do_upload('video'))
			{
				$file_info = $this->upload->data();
				$video_name=$file_info['file_name'];
				
				
			} 
			else
			{
				
			}
			//echo "<pre>";
			//print_r($test); exit;
			//-------------------------
			$id=$this->test_model->add_test($test);
			//----------------------
			
			//----------- adding test meta
			$meta_info[]=array(
						'test_id'=>$id,
						'meta_key'=>'sub_title',
						'meta_value'=>$this->input->post('sub_title')
						);
			$meta_info[]=array(
						'test_id'=>$id,
						'meta_key'=>'video_snippet',
						'meta_value'=>$this->input->post('video_snippet')
						);
			
						
			if($this->input->post('extranal_video'))
			{
				$meta_info[]=array(
						'test_id'=>$id,
						'meta_key'=>'video',
						'meta_value'=>$this->input->post('video_url')
						);
				$meta_info[]=array(
						'test_id'=>$id,
						'meta_key'=>'video_type',
						'meta_value'=>$this->input->post('video_type')
						);
			}
			else
			{
				$meta_info[]=array(
						'test_id'=>$id,
						'meta_key'=>'video',
						'meta_value'=>$video_name
						);
				$meta_info[]=array(
						'test_id'=>$id,
						'meta_key'=>'video_type',
						'meta_value'=>"internal"
						);
			}

			$this->test_model->add_test_metas($meta_info);
			//------------end adding test meta
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

			$this->session->set_flashdata('success_message','Video  has been saved successfully');
			
			redirect('admin/'.$this->post_type.'/index/'.$lan);

		}

		else
		{
			$db_data['category_list']=$this->test_model->get_categories($lan,$this->post_type);
			$db_data['lan']=$lan;
			$data['content']=$this->load->view('admin/'.$this->post_type.'/add_form',$db_data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Videos','href'=>site_url().'admin/'.$this->post_type);

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new",'href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Videos Add ";

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

	

	function edit($id,$lan,$referance='default')
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
				//if($this->session->userdata('user_type') != 2)
				//{
					$test['alias']=$this->input->post('alias');
					$test['page_title']=$this->input->post('title');
					$test['category_id']=$this->input->post('category_id');
					$test['description']=$this->input->post('description');
					$test['fbshare_des']=$this->input->post('fbshare_des');
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
						@unlink($this->input->post('pre_img_path'));

					}
					
					//----------upload thumb image
					$this->image_lib->clear();
					$config['upload_path'] = 'assets/img/thumbs/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']  = '0';
					$config['max_width']  = '0';
					$config['max_height']  = '0';
					
					$this->load->library('upload');
					$this->upload->initialize($config);
					$this->load->library('image_lib');	;					

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
					
					//---------- end thumb image
					
					
					//----------upload video
					$this->image_lib->clear();
					$config['upload_path'] = 'assets/videos/';
					$config['allowed_types'] = '*';
					$config['max_size']  = '0';
					$config['max_width']  = '0';
					$config['max_height']  = '0';
					$this->load->library('upload');
					$this->upload->initialize($config);
					
					$video_name="";
					if($this->upload->do_upload('video'))
					{
						$file_info = $this->upload->data();
						$video_name=$file_info['file_name'];
						@unlink($this->input->post('pre_video_path'));
						
					} 
					else
					{
						
					}
					
					//----------- adding test meta
					$meta_info=array(
								'meta_value'=>$this->input->post('sub_title')
								);
					$this->test_model->edit_testMeta($meta_info,$id,'sub_title');
					$meta_info=array(
								'meta_value'=>$this->input->post('video_snippet')
								);
					$this->test_model->edit_testMeta($meta_info,$id,'video_snippet');

					
					if($video_name != '')
					{
						$meta_info=array(
								'meta_value'=>$video_name
								);
						$this->test_model->edit_testMeta($meta_info,$id,'video');
						$meta_info=array(
							'meta_value'=>'internal'
							);

						$this->test_model->edit_testMeta($meta_info,$id,'video_type');
					}
					
				
					if($this->input->post('extranal_video'))
					{
						$meta_info=array(
							'meta_value'=>$this->input->post('video_url')
							);
						$this->test_model->edit_testMeta($meta_info,$id,'video');
						
						$meta_info=array(
							'meta_value'=>$this->input->post('video_type')
							);
								
						$this->test_model->edit_testMeta($meta_info,$id,'video_type');
					}
		
					$meta_info=array(
							'meta_value'=>$this->input->post('comments')
							);
								
					$this->test_model->edit_testMeta($meta_info,$id,'comments');
					
					
					

				//}

				
				//if($lan=="all") $lan='';
				$this->test_model->edit_test($test,$id,$lan);

				$this->session->set_flashdata('success_message','Video has been saved');
				if($referance && $referance == 'details') redirect('admin/'.$this->post_type.'/test_details/'.$id."/".$lan);
				else redirect('admin/'.$this->post_type.'/index/'.$lan);
			}
			else
			{ 
				$data['flags']=$this->test_model->get_flags();
				$data['test_info']=$this->test_model->get_test($id,$lan);
				$data['category_list']=$this->test_model->get_categories($lan,'articles');
				$data['referance']=$referance;
				$data['lan']=$lan;
				$data['content']=$this->load->view('admin/'.$this->post_type.'/edit_form',$data,true);
				//----- this is for breadcrumbs

				$breadcrumbs['breadcrumbs'][]=array('text'=>'Videos','href'=>site_url().'admin/'.$this->post_type);
				$breadcrumbs['breadcrumbs'][]=array('text'=>$data['test_info']->title,'href'=>'');
				$breadcrumbs['breadcrumbs'][]=array('text'=>"Preview",'href'=>site_url()."admin/".$this->post_type."/test_details/".$data['test_info']->testid."/".$lan);
				$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
				$data['page_header']="Video Edit Form";
				//------- end breadcrumbs
				$data['active_menu']='';
				$this->load->view('admin/layout/default',$data);

			}

		}

		else

		{

			$data['referance']=$referance;
			$data['lan']=$lan;
			$data['test_info']=$this->test_model->get_test($id,$lan);
			$data['category_list']=$this->test_model->get_categories($lan,$this->post_type);
			$data['content']=$this->load->view('admin/'.$this->post_type.'/edit_form',$data,true);
			//----- this is for breadcrumbs
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Videos','href'=>site_url().'admin/'.$this->post_type);
			$breadcrumbs['breadcrumbs'][]=array('text'=>$data['test_info']->title,'href'=>'');
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Preview",'href'=>site_url()."admin/".$this->post_type."/test_details/".$data['test_info']->testid."/".$lan);
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Article Edit Form";
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
			$this->load->library('upload', $config);
			$this->load->library('image_lib');

			

			if($this->upload->do_upload('image'))

			{

				$file_info = $this->upload->data();
				$test['image']=$file_info['file_name'];		
				
				$this->image_lib->clear();
				$settings['image_library'] = 'gd2';
				$settings['source_image']	= 'assets/img/image/'.$file_info['file_name'];
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
		if($this->session->userdata('user_type') == 3) redirect('admin/auth');
		$test_id=$this->input->post('test_id');
		$option=$this->input->post('option');
		$test_info['activated_date']=date('Y-m-d H:i:s');
		$test_info['status']=$option;
		$this->test_model->update_test($test_info,$test_id);
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

	}

	function set_featured($lang_code,$page)
	{
		if($this->session->userdata('user_type') != 1) redirect('admin/auth');
		$test_id=$this->input->post('test_id');
		$option=$this->input->post('option');
		$test_info['featured']=$option;
		$this->test_model->update_test($test_info,$test_id);
		$this->load_ajax_test_list($lang_code,$page);

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
	}

	

	

	function test_delete($id,$lan)
	{ 
		if($this->session->userdata('user_type') == 3) redirect('admin/auth');
		$tests_id=$this->test_model->get_tests_id($id,$lan);		
		
		$this->test_model->test_delete($id,$lan);
		$this->test_model->delete_postmeta($tests_id);
		$this->session->set_flashdata('success_message','Videos has been Deleted');

		redirect('admin/'.$this->post_type.'/index/'.$lan);

	}


	function load_ajax_test_list($lang_code='en',$page=0)
	{	//echo $page; exit;
		$total_rows = $this->test_model->get_total_tests($lang_code,$this->post_type);
		$limit=30;
		$this->load->library('pagination');
	
		$config['base_url'] = site_url().'admin/'.$this->post_type.'/search_tests/'.$lang_code;
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
		
        $db_data['test_list']=$this->test_model->get_tests($lang_code,$page,$limit,$this->post_type);	
		$db_data['lang']=$lang_code;
		$db_data['language_list']=$this->test_model->get_languages();
		$db_data['page_number']=$page;
		echo $data['content'] = $this->load->view('admin/'.$this->post_type.'/test_list_ajax',$db_data,true);

   

	}

	
	

	

	function ads_edit($test_id)
	{
		if($this->session->userdata('user_type') == 3) redirect('admin/auth');
		if($this->input->post('edit_config'))
		{
			$config_info['test_top_adsense']=htmlspecialchars($this->input->post('test_top_adsense'));
			$config_info['test_middle_adsense']=htmlspecialchars($this->input->post('test_middle_adsense'));
			$config_info['test_middle_adsense2']=htmlspecialchars($this->input->post('test_middle_adsense2'));
			$config_info['test_bottom_adsense']=htmlspecialchars($this->input->post('test_bottom_adsense'));
			$config_info['test_sky_left_adsense']=htmlspecialchars($this->input->post('test_sky_left_adsense'));
			$config_info['test_sky_right_adsense']=htmlspecialchars($this->input->post('test_sky_right_adsense'));
			



			$this->test_model->edit_test($config_info,$test_id);
			$this->session->set_flashdata('success_message',' Configuration has been Change');
			redirect('admin/'.$this->post_type.'/ads_edit/'.$test_id);
		}
		else
		{
			$db_data['test_id']=$test_id;
			$db_data['config_info']=$this->test_model->get_test($test_id);
			$data['content'] = $this->load->view('admin/articles/ad_config_form',$db_data,true);
			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Videos','href'=>site_url().'admin/'.$this->post_type);
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
		$data['content'] = $this->load->view('admin/'.$this->post_type.'/test_details',$db_data,true);
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

	

	

	
	

	function save_test_col($lang_code,$page)
	{
		$col_name=$this->input->post('col_name');
		$value=$this->input->post('value');
		$test_info["$col_name"]=$value;
		$this->db->where('post_type',$this->post_type);
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
		redirect('admin/'.$this->post_type.'/test_details/'.$test_id."/".$this->input->post('lang_code'));	
	}

	

	function all_content_ready()
	{		
		$all_content_ready_info['all_content_ready']=$this->input->post('all_content_ready');
		$test_id=$this->input->post('test_id');
		$this->test_model->update_all_content_ready($all_content_ready_info,$test_id);
		$this->session->set_flashdata('success_message',' All content ready has been saved');
		redirect('admin/'.$this->post_type.'/test_details/'.$test_id."/".$this->input->post('lang_code'));	

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
				$test_content_info['post_type']=$this->post_type;
				$test_content_info['lang_code']=$lang_code;
				$test_content_info['title']=$this->input->post('title');
				if($this->input->post('alias')) $test_content_info['alias']=$this->input->post('alias');
				$test_content_info['page_title']=$this->input->post('title');
				$test_content_info['category_id']=$this->input->post('category_id');
				$test_content_info['description']=$this->input->post('description');
				$test['fbshare_des']=$this->input->post('fbshare_des');
				$test_content_info['created_by']=$this->session->userdata('user_id');
				$test_content_info['created']=date('Y-m-d');
				$test_content_info['modify_date']=date('Y-m-d H:i:s');
				$test_content_info['status']=2;
				
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

					if($this->input->post('pre_img_path2') != "assets/img/image/".$this->input->post('en_image'))
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
				//end  upload thumb image
				
				
				else if($this->input->post('test_info') == 0)
				{
					$test_content_info['image']=$this->input->post('en_image');
					$test_content_info['image_thumb']=$this->input->post('en_image_thumb');
				}

				$test_info=$this->input->post('test_info');
				if($test_info == 0)
				{
					$test_content_info['alias']=$this->input->post('eng_test_alias');
					$id=$this->test_model->save_test_content($test_content_info);
					
				}
				else
				{
					$this->test_model->update_test_content($test_content_info,$testid,$lang_code);
					$id=$this->input->post('test_id');
				}
				
				
				//----------upload video
				$this->image_lib->clear();
				$config['upload_path'] = 'assets/videos/';
				$config['allowed_types'] = '*';
				$config['max_size']  = '0';
				$config['max_width']  = '0';
				$config['max_height']  = '0';
				$this->load->library('upload');
				$this->upload->initialize($config);
				
				$video_name="";
				if($this->upload->do_upload('video'))
				{
					$file_info = $this->upload->data();
					$video_name=$file_info['file_name'];
					if($this->input->post('pre_video_path') != "assets/videos/".$this->input->post('en_video'))
					@unlink($this->input->post('pre_video_path'));
					
				} 
				
				if($test_info == 0 && $video_name == '')
				{
					$video_name=$this->input->post('en_video');
				}
				else if($video_name == '' && $test_info != 0)
				{
					$video_name=$this->input->post('pre_video_path');
				}
				
				//----------- adding test meta
				if($test_info == 0)
				{
					$meta_info[]=array(
						'test_id'=>$id,
						'meta_key'=>'video_snippet',
						'meta_value'=>$this->input->post('video_snippet')
						);
						
					$meta_info[]=array(
						'test_id'=>$id,
						'meta_key'=>'sub_title',
						'meta_value'=>$this->input->post('sub_title')
						);
						
					$meta_info[]=array(
						'test_id'=>$id,
						'meta_key'=>'comments',
						'meta_value'=>$this->input->post('comments')
						);
								
					if($this->input->post('extranal_video'))
					{
						$meta_info[]=array(
								'test_id'=>$id,
								'meta_key'=>'video',
								'meta_value'=>$this->input->post('video_url')
								);
						$meta_info[]=array(
								'test_id'=>$id,
								'meta_key'=>'video_type',
								'meta_value'=>$this->input->post('video_type')
								);
					}
					else
					{
						$meta_info[]=array(
								'test_id'=>$id,
								'meta_key'=>'video',
								'meta_value'=>$video_name
								);
						$meta_info[]=array(
							'test_id'=>$id,
							'meta_key'=>'video_type',
							'meta_value'=>"internal"
							);
					}
					
					$this->test_model->add_test_metas($meta_info);
				}
				else
				{
					$meta_info=array(
							'meta_value'=>$this->input->post('video_snippet')
							);
					$this->test_model->edit_testMeta($meta_info,$id,'video_snippet');
					
					$meta_info=array(
							'meta_value'=>$this->input->post('comments')
							);
					$this->test_model->edit_testMeta($meta_info,$id,'comments');
					
					$meta_info=array(
							'meta_value'=>$this->input->post('sub_title')
							);
					$this->test_model->edit_testMeta($meta_info,$id,'sub_title');
					
					
					if($video_name != '')
					{
						$meta_info=array(
								'meta_value'=>$video_name
								);
						$this->test_model->edit_testMeta($meta_info,$id,'video');
						$meta_info=array(
							'meta_value'=>'internal'
							);

						$this->test_model->edit_testMeta($meta_info,$id,'video_type');
					}
					
				
					if($this->input->post('extranal_video'))
					{
						$meta_info=array(
							'meta_value'=>$this->input->post('video_url')
							);
						$this->test_model->edit_testMeta($meta_info,$id,'video');
						
						$meta_info=array(
							'meta_value'=>$this->input->post('video_type')
							);
								
						$this->test_model->edit_testMeta($meta_info,$id,'video_type');
					}
					
				}
				
				
				//print_r($test_content_info);
				$this->session->set_flashdata('success_message',' Video Content has been saved');
			    redirect('admin/'.$this->post_type.'/index/'.$lang_code);
			   //redirect('admin/tests');
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
				$data['category_list']=$this->test_model->get_categories($lang_code,$this->post_type);
				$data['referance']='';
				$data['content']=$this->load->view('admin/'.$this->post_type.'/test_content_form',$data,true);
				//----- this is for breadcrumbs
				$breadcrumbs['breadcrumbs'][]=array('text'=>'Videos','href'=>site_url().'admin/'.$this->post_type);			
				$breadcrumbs['breadcrumbs'][]=array('text'=>'Video Content','href'=>'');
				$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
				$data['page_header']="Video Content Form";
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
			$data['category_list']=$this->test_model->get_categories($lang_code,$this->post_type);
			$data['referance']='';
			$data['content']=$this->load->view('admin/'.$this->post_type.'/test_content_form',$data,true);
			//----- this is for breadcrumbs
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Videos','href'=>site_url().'admin/'.$this->post_type);			
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Video Content','href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Video Content Form";
			//------- end breadcrumbs
			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data);

		}

	}
	
	function edit_comments()
	{
		if($this->input->post('edit_comments'))
		{
			$lang_code=$this->input->post('lang_code');
			$test_id=$this->input->post('test_id');
			
			$meta_info=array(
					'meta_value'=>$this->input->post('comments')
					);
						
			$this->test_model->edit_testMeta($meta_info,$test_id,'comments');
			
			redirect('admin/videos/test_details/'.$test_id."/".$lang_code);
		}
		else
		{
			redirect('admin/videos');
		}
		
	}

}



/* End of file home.php */

/* Location: ./application/controllers/home.php */