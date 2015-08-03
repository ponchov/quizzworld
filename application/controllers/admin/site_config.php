<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_config extends CI_Controller { 

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

		//if(!$this->session->userdata('user_id')) redirect('admin/auth');

		if(!$this->session->userdata('user_id')  || $this->session->userdata('user_type')!=1 ) redirect('admin/auth');

		$this->load->model('admin/site_config_model');		

          /* ini_set('display_errors',1);
			ini_set('display_startup_errors',1);
			error_reporting(-1);*/

	}

	

	function index($lan='en')
	{	
		if($this->input->post('edit_config'))
		{
			$config_info['site_title']=$this->input->post('site_title');
			$config_info['app_name']=$this->input->post('app_name');
			$config_info['page_description']=$this->input->post('page_description');
			$config_info['facebook_url']=$this->input->post('facebook_url');
			$config_info['share_des']=$this->input->post('share_des');
			$config_info['facebook_appid']=$this->input->post('facebook_appid');
			
			$config_info['google_analytics']=htmlspecialchars($this->input->post('google_analytics'));
			$config['upload_path'] = 'assets/img/meta_img/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']  = '500';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			$this->load->library('upload');
			$this->upload->initialize($config);
			

			if($this->upload->do_upload('meta_img'))
			{
				$file_info = $this->upload->data();
				$config_info['meta_img']=$file_info['file_name'];
				@unlink($this->input->post('pre_img_path'));
				//------ end image resize
			}
			
			//-------- upload logo
			$config['upload_path'] = 'assets/img/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']  = '500';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			$this->load->library('upload');
			$this->upload->initialize($config);
			if($this->upload->do_upload('logo'))
			{
				$file_info = $this->upload->data();
				$config_info['logo']=$file_info['file_name'];
				@unlink($this->input->post('pre_logo_path'));
				
			}
			//-------- end upload logo
			
			//-------- upload favicon
			$config['upload_path'] = 'assets/img/';
			$config['allowed_types'] = '*';
			$config['max_size']  = '500';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			$this->load->library('upload');
			$this->upload->initialize($config);
			if($this->upload->do_upload('favicon'))
			{
				$file_info = $this->upload->data();
				$config_info['favicon']=$file_info['file_name'];
				@unlink($this->input->post('pre_favicon_path'));
				
			}
			//-------- end upload favicon

			$this->site_config_model->edit_config($config_info);
			$this->session->set_flashdata('success_message',' Configuration has been Change');
			redirect('admin/site_config');
		}
		else
		{
			$db_data['config_info']=$this->site_config_model->get_config('config',$lan);
			$db_data['lang']=$lan;
			$db_data['language_list']=$this->site_config_model->get_languages();	
			$data['content'] = $this->load->view('admin/site_config/config_form',$db_data,true);
			//----- this is for breadcrumbs
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>'System Configuration','href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Configuration Form";
			//------- end breadcrumbs
			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data); 

		}  

	}
	
	function js_config()
	{	
		if($this->input->post('js_config'))
		{
			$config_info['google_analytics']=$this->input->post('google_analytics');
			$config_info['fb_pixel']=$this->input->post('fb_pixel');
			$config_info['quantcast']=$this->input->post('quantcast');
			$config_info['google_remarking']=$this->input->post('google_remarking');
			$config_info['taboola_head']=$this->input->post('taboola_head');
			$config_info['taboola_body']=$this->input->post('taboola_body');
			$config_info['google_survey']=$this->input->post('google_survey');
			$config_info['google_plus']=$this->input->post('google_plus');
			
			$id=$this->input->post('id');
			
			$this->site_config_model->save_jsconfig($config_info,$id);
			$this->session->set_flashdata('success_message',' Configuration has been Change');
			redirect('admin/site_config/js_config');
		}
		else
		{
			$db_data['config_info']=$this->site_config_model->get_jsconfig();
			$data['content'] = $this->load->view('admin/site_config/js_config',$db_data,true);
			//----- this is for breadcrumbs
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Home','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>'JS Configuration','href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Configuration Form";
			//------- end breadcrumbs
			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data); 

		}  

	}

	

	

	

	function ad_config()

	{	

		if($this->input->post('edit_config'))

		{

			$config_info['dfp_ad']=htmlspecialchars($this->input->post('dfp_ad'));

			$config_info['adsense']=htmlspecialchars($this->input->post('adsense'));

			$config_info['adsense_bottom']=htmlspecialchars($this->input->post('adsense_bottom'));

			$config_info['adsense_middle']=htmlspecialchars($this->input->post('adsense_middle'));

			$config_info['adsense_sky_left']=htmlspecialchars($this->input->post('adsense_sky_left'));

			$config_info['adsense_sky_right']=htmlspecialchars($this->input->post('adsense_sky_right'));

			

			$config_info['test_top_adsense']=htmlspecialchars($this->input->post('test_top_adsense'));
			$config_info['test_middle_adsense']=htmlspecialchars($this->input->post('test_middle_adsense'));
			$config_info['test_middle_adsense2']=htmlspecialchars($this->input->post('test_middle_adsense2'));
			$config_info['test_bottom_adsense']=htmlspecialchars($this->input->post('test_bottom_adsense'));
			$config_info['test_sky_left_adsense']=htmlspecialchars($this->input->post('test_sky_left_adsense'));
			$config_info['test_sky_right_adsense']=htmlspecialchars($this->input->post('test_sky_right_adsense'));
			$config_info['test_wm_adsense']=htmlspecialchars($this->input->post('test_wm_adsense'));
			$config_info['test_tabo_adsense']=htmlspecialchars($this->input->post('test_tabo_adsense'));
			

			

			$config_info['question_top_adsense']=htmlspecialchars($this->input->post('question_top_adsense'));
			$config_info['question_top_adsense2']=htmlspecialchars($this->input->post('question_top_adsense2'));
			$config_info['question_bottom_adsense']=htmlspecialchars($this->input->post('question_bottom_adsense'));
			$config_info['question_bottom_adsense2']=htmlspecialchars($this->input->post('question_bottom_adsense2'));
			$config_info['question_sky_left_adsense']=htmlspecialchars($this->input->post('question_sky_left_adsense'));
			$config_info['question_sky_right_adsense']=htmlspecialchars($this->input->post('question_sky_right_adsense'));
			$config_info['question_wm_adsense']=htmlspecialchars($this->input->post('question_wm_adsense'));
			$config_info['question_tabo_adsense']=htmlspecialchars($this->input->post('question_tabo_adsense'));

			

			

			$config_info['result_adsense']=htmlspecialchars($this->input->post('result_adsense'));
			$config_info['result_bottom_adsense']=htmlspecialchars($this->input->post('result_bottom_adsense'));
			$config_info['result_middle_adsense']=htmlspecialchars($this->input->post('result_middle_adsense'));
			$config_info['result_middle_adsense2']=htmlspecialchars($this->input->post('result_middle_adsense2'));
			$config_info['result_sky_left_adsense']=htmlspecialchars($this->input->post('result_sky_left_adsense'));
			$config_info['result_sky_right_adsense']=htmlspecialchars($this->input->post('result_sky_right_adsense'));
			$config_info['result_wm_adsense']=htmlspecialchars($this->input->post('result_wm_adsense'));
			$config_info['result_tabo_adsense']=htmlspecialchars($this->input->post('result_tabo_adsense'));
			
			

			

			

			$this->site_config_model->edit_config($config_info);

			$this->session->set_flashdata('success_message',' Configuration has been Change');

			redirect('admin/site_config/ad_config');

			

		}

		else

		{

			$db_data['config_info']=$this->site_config_model->get_config();

			$data['content'] = $this->load->view('admin/site_config/ad_config_form',$db_data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Ads Configuration','href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			

			$data['page_header']="Configuration Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data); 

		}  

	}
	
	
	function knowledge_ad_config()
	{	

		if($this->input->post('edit_config'))
		{
			$config_info['config_type']="knowledge";
			$config_info['test_top_adsense']=htmlspecialchars($this->input->post('adsense_knowledge_top'));
			$config_info['test_middle_adsense']=htmlspecialchars($this->input->post('adsense_knowledge_middle'));
			$config_info['test_bottom_adsense']=htmlspecialchars($this->input->post('adsense_knowledge_bottom'));
	
			$this->site_config_model->edit_config($config_info,'knowledge');

			$this->session->set_flashdata('success_message',' Configuration has been Change');

			redirect('admin/site_config/knowledge_ad_config');
		}

		else

		{

			$db_data['config_info']=$this->site_config_model->get_config('knowledge');
			$data['content'] = $this->load->view('admin/site_config/knowledge_ad_config_form',$db_data,true);
			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Ads Configuration','href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Configuration Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data); 

		}  

	}
	
	
	function twist_ad_config()
	{	

		if($this->input->post('edit_config'))
		{
			$config_info['config_type']="twist";
			$config_info['test_top_adsense']=htmlspecialchars($this->input->post('test_top_adsense'));
			$config_info['test_middle_adsense']=htmlspecialchars($this->input->post('test_middle_adsense'));
			$config_info['test_bottom_adsense']=htmlspecialchars($this->input->post('test_bottom_adsense'));
			$config_info['result_bottom_adsense']=htmlspecialchars($this->input->post('result_bottom_adsense'));
			
			$config_info['test_sitebar_1_adsense']=htmlspecialchars($this->input->post('test_sitebar_1_adsense'));
			$config_info['test_sitebar_2_adsense']=htmlspecialchars($this->input->post('test_sitebar_2_adsense'));
	
			$this->site_config_model->edit_config($config_info,'twist');
			$this->session->set_flashdata('success_message',' Configuration has been Change');
			redirect('admin/site_config/twist_ad_config');
		}

		else

		{

			$db_data['config_info']=$this->site_config_model->get_config('twist');
			$data['content'] = $this->load->view('admin/site_config/twist_ad_config_form',$db_data,true);
			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Twist Ads Configuration','href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Configuration Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data); 

		}  

	}
	
	function apps_ad_config()
	{	

		if($this->input->post('edit_config'))
		{
			$config_info['config_type']="3apps";
			$config_info['test_top_adsense']=htmlspecialchars($this->input->post('test_top_adsense'));
			$config_info['test_middle_adsense']=htmlspecialchars($this->input->post('test_middle_adsense'));
			$config_info['test_bottom_adsense']=htmlspecialchars($this->input->post('test_bottom_adsense'));
			$config_info['test_wm_adsense']=htmlspecialchars($this->input->post('test_wm_adsense'));
			$config_info['test_tabo_adsense']=htmlspecialchars($this->input->post('test_tabo_adsense'));
			$config_info['test_sky_left_adsense']=htmlspecialchars($this->input->post('test_sky_left_adsense'));
			$config_info['test_sky_right_adsense']=htmlspecialchars($this->input->post('test_sky_right_adsense'));
			
			
			
			$config_info['result_adsense']=htmlspecialchars($this->input->post('result_adsense'));
			$config_info['result_middle_adsense']=htmlspecialchars($this->input->post('result_middle_adsense'));
			$config_info['result_bottom_adsense']=htmlspecialchars($this->input->post('result_bottom_adsense'));
			$config_info['result_sky_left_adsense']=htmlspecialchars($this->input->post('result_sky_left_adsense'));
			$config_info['result_sky_right_adsense']=htmlspecialchars($this->input->post('result_sky_right_adsense'));
			$config_info['result_wm_adsense']=htmlspecialchars($this->input->post('result_wm_adsense'));
			$config_info['result_tabo_adsense']=htmlspecialchars($this->input->post('result_tabo_adsense'));
			
	
			$this->site_config_model->edit_config($config_info,'3apps');
			$this->session->set_flashdata('success_message',' Configuration has been Change');
			redirect('admin/site_config/apps_ad_config');
		}

		else

		{

			$db_data['config_info']=$this->site_config_model->get_config('3apps');
			$data['content'] = $this->load->view('admin/site_config/3apps_ad_config_form',$db_data,true);
			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>'3apps Ads Configuration','href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Configuration Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data); 

		}  

	}
	
	function face_test_config()
	{	

		if($this->input->post('edit_config'))
		{
			$config_info['config_type']="face_test";
			$config_info['test_top_adsense']=htmlspecialchars($this->input->post('test_top_adsense'));
			$config_info['test_middle_adsense']=htmlspecialchars($this->input->post('test_middle_adsense'));
			$config_info['test_bottom_adsense']=htmlspecialchars($this->input->post('test_bottom_adsense'));
			$config_info['test_middle_adsense2']=htmlspecialchars($this->input->post('test_middle_adsense2'));
	
			$this->site_config_model->edit_config($config_info,'face_test');
			$this->session->set_flashdata('success_message',' Configuration has been Change');
			redirect('admin/site_config/face_test_config');
		}

		else

		{

			$db_data['config_info']=$this->site_config_model->get_config('face_test');
			$data['content'] = $this->load->view('admin/site_config/face_test_ad_config_form',$db_data,true);
			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Face Test Ads Configuration','href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Configuration Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data); 

		}  

	}
	
	
	function how_old_config()
	{	
		if($this->input->post('edit_config'))
		{
			$config_info['config_type']="how_old";
			$config_info['test_top_adsense']=htmlspecialchars($this->input->post('test_top_adsense'));
			$config_info['test_middle_adsense']=htmlspecialchars($this->input->post('test_middle_adsense'));
			$config_info['test_bottom_adsense']=htmlspecialchars($this->input->post('test_bottom_adsense'));
			$config_info['test_middle_adsense2']=htmlspecialchars($this->input->post('test_middle_adsense2'));
	
			$this->site_config_model->edit_config($config_info,'how_old');
			$this->session->set_flashdata('success_message',' Configuration has been Change');
			redirect('admin/site_config/how_old_config');
		}
		else
		{
			$db_data['config_info']=$this->site_config_model->get_config('how_old');
			$data['content'] = $this->load->view('admin/site_config/how_old_ad_config_form',$db_data,true);
			//----- this is for breadcrumbs
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>'How Old Ads Configuration','href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Configuration Form";

			//------- end breadcrumbs

			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data); 
		}  
	}
	
	function facebook_apps()
	{	
		if($this->input->post('edit_config'))
		{
			$config_info['config_type']="facebook_apps";
			$config_info['test_top_adsense']=htmlspecialchars($this->input->post('test_top_adsense'));
			$config_info['test_middle_adsense']=htmlspecialchars($this->input->post('test_middle_adsense'));
			$config_info['test_bottom_adsense']=htmlspecialchars($this->input->post('test_bottom_adsense'));
			$config_info['test_tabo_adsense']=htmlspecialchars($this->input->post('test_tabo_adsense'));
			$config_info['test_wm_adsense']=htmlspecialchars($this->input->post('test_wm_adsense'));
			$config_info['test_sky_left_adsense']=htmlspecialchars($this->input->post('test_sky_left_adsense'));
			$config_info['test_sky_right_adsense']=htmlspecialchars($this->input->post('test_sky_right_adsense'));
			
			
			
			$config_info['result_adsense']=htmlspecialchars($this->input->post('result_adsense'));
			$config_info['result_middle_adsense']=htmlspecialchars($this->input->post('result_middle_adsense'));
			$config_info['result_bottom_adsense']=htmlspecialchars($this->input->post('result_bottom_adsense'));
			$config_info['result_sky_left_adsense']=htmlspecialchars($this->input->post('result_sky_left_adsense'));
			$config_info['result_sky_right_adsense']=htmlspecialchars($this->input->post('result_sky_right_adsense'));
			$config_info['result_wm_adsense']=htmlspecialchars($this->input->post('result_wm_adsense'));
			$config_info['result_tabo_adsense']=htmlspecialchars($this->input->post('result_tabo_adsense'));
			
			
			
	
			$this->site_config_model->edit_config($config_info,'facebook_apps');
			$this->session->set_flashdata('success_message',' Configuration has been Change');
			redirect('admin/site_config/facebook_apps');
		}
		else
		{
			$db_data['config_info']=$this->site_config_model->get_config('facebook_apps');
			$data['content'] = $this->load->view('admin/site_config/facebook_apps_config_form',$db_data,true);
			//----- this is for breadcrumbs
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Facebook Apps Ads Configuration','href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Configuration Form";

			//------- end breadcrumbs

			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data); 
		}  
	}
	
	function video_config()
	{	
		if($this->input->post('edit_config'))
		{
			$config_info['config_type']="video";
			$config_info['test_top_adsense']=htmlspecialchars($this->input->post('test_top_adsense'));
			$config_info['test_middle_adsense']=htmlspecialchars($this->input->post('test_middle_adsense'));
			$config_info['test_middle_adsense2']=htmlspecialchars($this->input->post('test_middle_adsense2'));
			$config_info['test_bottom_adsense']=htmlspecialchars($this->input->post('test_bottom_adsense'));			
			$config_info['test_sky_left_adsense']=htmlspecialchars($this->input->post('test_sky_left_adsense'));
			$config_info['test_sky_right_adsense']=htmlspecialchars($this->input->post('test_sky_right_adsense'));
	
			$this->site_config_model->edit_config($config_info,'video');
			$this->session->set_flashdata('success_message',' Configuration has been Change');
			redirect('admin/site_config/video_config');
		}
		else
		{
			$db_data['config_info']=$this->site_config_model->get_config('video');
			$data['content'] = $this->load->view('admin/site_config/video_ad_config_form',$db_data,true);
			//----- this is for breadcrumbs
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Video Ads Configuration','href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Configuration Form";

			//------- end breadcrumbs

			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data); 
		}  
	}
	
	function airticle_config()
	{	
		if($this->input->post('edit_config'))
		{
			$config_info['config_type']="ariticle";
			$config_info['test_top_adsense']=htmlspecialchars($this->input->post('test_top_adsense'));
			$config_info['test_middle_adsense']=htmlspecialchars($this->input->post('test_middle_adsense'));
			$config_info['test_middle_adsense2']=htmlspecialchars($this->input->post('test_middle_adsense2'));
			$config_info['test_bottom_adsense']=htmlspecialchars($this->input->post('test_bottom_adsense'));			
			$config_info['test_sky_left_adsense']=htmlspecialchars($this->input->post('test_sky_left_adsense'));
			$config_info['test_sky_right_adsense']=htmlspecialchars($this->input->post('test_sky_right_adsense'));
	
			$this->site_config_model->edit_config($config_info,'ariticle');
			$this->session->set_flashdata('success_message',' Configuration has been Change');
			redirect('admin/site_config/airticle_config');
		}
		else
		{
			$db_data['config_info']=$this->site_config_model->get_config('ariticle');
			$data['content'] = $this->load->view('admin/site_config/ariticle_ad_config_form',$db_data,true);
			//----- this is for breadcrumbs
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Ariticle Ads Configuration','href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Configuration Form";

			//------- end breadcrumbs

			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data); 
		}  
	}
	
	function list_config()
	{	
		if($this->input->post('edit_config'))
		{
			$config_info['config_type']="list";
			$config_info['test_top_adsense']=htmlspecialchars($this->input->post('test_top_adsense'));
			$config_info['test_middle_adsense']=htmlspecialchars($this->input->post('test_middle_adsense'));
			$config_info['test_middle_adsense2']=htmlspecialchars($this->input->post('test_middle_adsense2'));
			$config_info['test_bottom_adsense']=htmlspecialchars($this->input->post('test_bottom_adsense'));			
			$config_info['test_sky_left_adsense']=htmlspecialchars($this->input->post('test_sky_left_adsense'));
			$config_info['test_sky_right_adsense']=htmlspecialchars($this->input->post('test_sky_right_adsense'));
	
			$this->site_config_model->edit_config($config_info,'list');
			$this->session->set_flashdata('success_message',' Configuration has been Change');
			redirect('admin/site_config/list_config');
		}
		else
		{
			$db_data['config_info']=$this->site_config_model->get_config('list');
			$data['content'] = $this->load->view('admin/site_config/list_ad_config_form',$db_data,true);
			//----- this is for breadcrumbs
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>'List Ads Configuration','href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Configuration Form";

			//------- end breadcrumbs

			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data); 
		}  
	}
	
	
	function template_manager()
	{
		if($this->input->post('set_template'))
		{
			$template_id=$this->input->post('template_id');
			$template_info['status']=1;
			$this->site_config_model->active_template($template_info,$template_id);
			
			$update_info['status']=0;
			$this->site_config_model->update_template($update_info,$template_id);
			
			$this->session->set_flashdata('success_message',' Template has been successfully change.');
			redirect('admin/site_config/template_manager');
			
		}
		else
		{
			$db_data['template_list']=$this->site_config_model->get_templates();
			$data['content'] = $this->load->view('admin/site_config/templates',$db_data,true);
			//----- this is for breadcrumbs
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Dashboard','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Template Manager','href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Template Manager";
			//------- end breadcrumbs
			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data); 
		}
	}
	
	
	
	function ajax_language_config()
	{
		$language=$this->input->post('language');
		$db_data['config_info']=$this->site_config_model->get_config('config',$language);
		$db_data['language_list']=$this->site_config_model->get_languages();
		$db_data['language']=$language;
		echo $data['content'] = $this->load->view('admin/site_config/ajax_language_config',$db_data,true);
	}
	
	function language_config()
	{
		if($this->input->post('edit_config'))
		{
			$config_info['site_title']=$this->input->post('site_title');
			$config_info['app_name']=$this->input->post('app_name');
			$config_info['page_description']=$this->input->post('page_description');
			$config_info['facebook_url']=$this->input->post('facebook_url');
			$config_info['share_des']=$this->input->post('share_des');
			$config_info['facebook_appid']=$this->input->post('facebook_appid');
			$language=$this->input->post('language');
			$config_info['language']=$language;
			$config_info['config_type']="config";
			
			$config_info['google_analytics']=htmlspecialchars($this->input->post('google_analytics'));
			
			$config['upload_path'] = 'assets/img/meta_img/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']  = '500';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			$this->load->library('upload');
			$this->upload->initialize($config);
			

			if($this->upload->do_upload('meta_img'))
			{
				$file_info = $this->upload->data();
				$config_info['meta_img']=$file_info['file_name'];
				@unlink($this->input->post('pre_img_path'));
				//------ end image resize
			}
			
			//-------- upload logo
			$config['upload_path'] = 'assets/img/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']  = '500';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			$this->load->library('upload');
			$this->upload->initialize($config);
			if($this->upload->do_upload('logo'))
			{
				$file_info = $this->upload->data();
				$config_info['logo']=$file_info['file_name'];
				@unlink($this->input->post('pre_logo_path'));
				
			}
			//-------- end upload logo
			
			//-------- upload favicon
			$config['upload_path'] = 'assets/img/';
			$config['allowed_types'] = '*';
			$config['max_size']  = '500';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			$this->load->library('upload');
			$this->upload->initialize($config);
			if($this->upload->do_upload('favicon'))
			{
				$file_info = $this->upload->data();
				$config_info['favicon']=$file_info['file_name'];
				@unlink($this->input->post('pre_favicon_path'));
				
			}
			//-------- end upload favicon

			$this->site_config_model->edit_config($config_info,'config',$language);
			$this->session->set_flashdata('success_message',' Configuration has been Change');
			redirect('admin/site_config/index/'.$language);
		}
	}
	
	
	function language_manager()
	{
		$db_data['language_list']=$this->site_config_model->get_languages();
		$data['content'] = $this->load->view('admin/site_config/language/list',$db_data,true);
		//----- this is for breadcrumbs
		$breadcrumbs['breadcrumbs'][]=array('text'=>'Dashboard','href'=>site_url().'admin');
		$breadcrumbs['breadcrumbs'][]=array('text'=>'Language Manager','href'=>'');
		$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
		$data['page_header']="Language Manager";
		//------- end breadcrumbs
		$data['active_menu']='';
		$this->load->view('admin/layout/default',$data); 
	
	}
	
	function language_translate($lang_id,$lang_code)
	{
		if($this->input->post('edit_lang'))
		{
			$lang_info['label']=$this->input->post('label');
			$lang_info['language_id']=$lang_id;
			$lang_info['lang_code']=$lang_code;
			
			if($this->input->post('language_info') == 1)
			{
			
				$this->site_config_model->update_language($lang_info,$this->input->post('languageId'));
			}
			else
			{
				$this->site_config_model->save_language($lang_info);
			}
			
			redirect('admin/site_config/language_manager');
		
		}
		else
		{
			$db_data['language_info']=$this->site_config_model->get_language($lang_id,$lang_code);
			$db_data['en_language_info']=$this->site_config_model->get_language($lang_id,'en');
			$db_data['english_lang_name']=$this->site_config_model->get_en_language($lang_id);
			$db_data['lang_id']=$lang_id;
			$db_data['lang_code']=$lang_code;
			$data['content'] = $this->load->view('admin/site_config/language/edit',$db_data,true);
			//----- this is for breadcrumbs
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Dashboard','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Language Manager','href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Language Manager";
			//------- end breadcrumbs
			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data);
		}	
	}
	

	

}



/* End of file home.php */

/* Location: ./application/controllers/home.php */