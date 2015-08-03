<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widgets extends CI_Controller { 

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
	function __construct() 

	{	

		parent::__construct();

		//echo  $this->session->userdata('user_type'); exit;

		if(!$this->session->userdata('user_id')  || $this->session->userdata('user_type')!=1 ) redirect('admin/auth');

		$this->load->model('admin/widget_model');	
		$this->load->model('admin/test_model');		

           

	}

	

	function index()

	{	

        $db_data['widgets']=$this->widget_model->get_widgets();
		$db_data['language_list']=$this->test_model->get_languages();
		$data['content'] = $this->load->view('admin/widgets/list',$db_data,true);
		//----- this is for breadcrumbs
		$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');
		$breadcrumbs['breadcrumbs'][]=array('text'=>'Widget List','href'=>'');
		$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
		$data['page_header']="Widgets";
		//------- end breadcrumbs
		$data['active_menu']='';
		$this->load->view('admin/layout/default',$data);   
	}


	function edit($widget_id)
	{
		if($this->input->post('save_widget'))
		{
			
			$items=array();
			$item_values=$this->input->post('items');
			if($this->input->post('item'))
			{
				foreach($this->input->post('item') as $item)
				{ 
					$items[$item]=$item_values[$item];
				}
			}
			
			$items=json_encode($items);
			
			$is_override=0;
			if($this->input->post('is_override')) $is_override=1;
			
			$include_templates=0;
			if($this->input->post('include_templates')) $include_templates=1;
			
			$have_external_links=0;
			if($this->input->post('have_external_links')) $have_external_links=1;
			
			$have_direct_link=0;
			if($this->input->post('have_direct_link')) $have_direct_link=1;
			
			$widget_info['title']=$this->input->post('title');
			$widget_info['columns']=$this->input->post('columns');
			$widget_info['rows']=$this->input->post('rows');
			$widget_info['items']=$items;
			$widget_info['is_override']=$is_override;
			$widget_info['include_templates']=$include_templates;
			$widget_info['have_external_links']=$have_external_links;
			$widget_info['have_direct_link']=$have_direct_link;
			$widget_info['test_ids']=$this->input->post('test_ids');
			
			$this->widget_model->save($widget_info,$widget_id);
			
			$widgetid=$this->input->post('widgetid');
			
			//------------- manage external links
			if($have_external_links == 1)
			{
				$external_link=$this->input->post('external_link');
				$external_title=$this->input->post('external_title');
				$external_imaage=$this->input->post('external_imaage');
				
				foreach($external_link as $key=>$ext_link)
				{
					$link_info=array();
					$link_info['widgetid']=$widgetid;
					$link_info['lang_code']='en';
					$link_info['url']=$ext_link;
					$link_info['type']='2';
					$link_info['title']=$external_title[$key];
					//---------- upload images
					$config['upload_path'] = 'assets/img/thumbs/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']  = '0';
					$config['max_width']  = '0';
					$config['max_height']  = '0';
					
					$this->load->library('upload');
					$this->upload->initialize($config);
					$this->load->library('image_lib');			
		
					if($this->upload->do_upload("external_imaage[$key]"))
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
						
						$link_info['image']=$file_info['file_name'];
					}
					
					$this->widget_model->save_widget_links($link_info,$widgetid,'en',2);
				}
			}
			
			
			
			
			
			
			//------------- manage Direct links
			if($have_direct_link == 1)
			{
				$direct_link=$this->input->post('direct_link');
				$direct_title=$this->input->post('direct_title');
				$direct_imaage=$this->input->post('direct_imaage');
				
				foreach($direct_link as $key=>$det_link)
				{
					$link_info=array();
					$link_info['widgetid']=$widgetid;
					$link_info['lang_code']='en';
					$link_info['url']=$det_link;
					$link_info['type']='1';
					$link_info['title']=$direct_title[$key];
					//---------- upload images
					$config['upload_path'] = 'assets/img/thumbs/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']  = '0';
					$config['max_width']  = '0';
					$config['max_height']  = '0';
					
					$this->load->library('upload');
					$this->upload->initialize($config);
					$this->load->library('image_lib');			
		
					if($this->upload->do_upload("direct_imaage[$key]"))
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
						
						$link_info['image']=$file_info['file_name'];
					}
					
					$this->widget_model->save_widget_links($link_info,$widgetid,'en',1);
				}
			}
			
			
			redirect('admin/widgets');
			
		}
		else
		{
			$db_data['widget_info']=$this->widget_model->get_widget($widget_id);
			$data['content'] = $this->load->view('admin/widgets/edit',$db_data,true);
			//----- this is for breadcrumbs
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Widgets','href'=>site_url().'admin/widgets');
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Widget Edit','href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Widgets";
			//------- end breadcrumbs
			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data);
		}
	}
	
	function widget_content($widgetid,$lang='en')
	{
		if($this->input->post('save_widget_content'))
		{
			
			$items=array();
			$item_values=$this->input->post('items');
			if($this->input->post('item'))
			{
				foreach($this->input->post('item') as $item)
				{ 
					$items[$item]=$item_values[$item];
				}
			}
			
			$items=json_encode($items);
			
			$is_override=0;
			if($this->input->post('is_override')) $is_override=1;
			
			$include_templates=0;
			if($this->input->post('include_templates')) $include_templates=1;
			
			$widget_info['title']=$this->input->post('title');
			$widget_info['widgetid']=$widgetid;
			$widget_info['columns']=$this->input->post('columns');
			$widget_info['rows']=$this->input->post('rows');
			$widget_info['widget_code']=$this->input->post('widget_code');
			$widget_info['items']=$items;
			$widget_info['is_override']=$is_override;
			$widget_info['include_templates']=$include_templates;
			$widget_info['lang_code']=$lang;
			$widget_info['test_ids']=$this->input->post('test_ids');
			
			$this->widget_model->update_widget($widget_info,$widgetid,$lang);
			
			redirect('admin/widgets');
			
		}
		else
		{
			$db_data['widget_info']=$this->widget_model->widget_content($widgetid,$lang);
			$db_data['en_widget_info']=$this->widget_model->widget_content($widgetid,'en');
			$db_data['lang']=$lang;
			
			$data['content'] = $this->load->view('admin/widgets/widget_content',$db_data,true);
			//----- this is for breadcrumbs
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Widgets','href'=>site_url().'admin/widgets');
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Widget Edit','href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Widgets";
			//------- end breadcrumbs
			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data);
		}
	}































	

	

	

	

	


	

}



/* End of file home.php */

/* Location: ./application/controllers/home.php */