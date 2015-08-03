<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banners extends CI_Controller {  

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

		if(!$this->session->userdata('user_id')) redirect('admin/auth');

		$this->load->model('admin/banner_model');		

	}

	function index()
	{	
		if(!$this->session->userdata('user_id')  || $this->session->userdata('user_type')!=1 ) redirect('admin/auth');
        $db_data['banner_list']=$this->banner_model->get_banners();	
		$db_data['language_list']=$this->banner_model->get_languages();	

		$data['content'] = $this->load->view('admin/banners/list',$db_data,true);
		//----- this is for breadcrumbs
		$breadcrumbs['breadcrumbs'][]=array('text'=>'Dashboard','href'=>site_url().'admin');
		$breadcrumbs['breadcrumbs'][]=array('text'=>'Banners','href'=>'');
		$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
		$data['page_header']="Banners";
		//------- end breadcrumbs
		$data['active_menu']='';
		$this->load->view('admin/layout/default',$data);   

	}


	function add()
	{
		if(!$this->session->userdata('user_id')  || $this->session->userdata('user_type')!=1 ) redirect('admin/auth');
		if($this->input->post('add_banner'))
		{
			$banner_info['template']=$this->input->post('template');
			$banner_info['title']=$this->input->post('title');
			$banner_info['url']=$this->input->post('url');
			$banner_info['brand_title']=$this->input->post('brand_title');
			$banner_info['created']=date('Y-m-d');
			$banner_info['status']=1;


			
			// Upload  image	
			$config['upload_path'] = 'assets/img/banners/';
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
				$settings['source_image']	= 'assets/img/banners/'.$file_info['file_name'];
				$settings['create_thumb'] = true;
				$settings['thumb_marker'] = '';
				$settings['maintain_ratio'] = false;
				$settings['new_image'] = 'assets/img/banners/'.$file_info['file_name'];
				$settings['width']	 = '425';
				$settings['height']	 = '223';	

				$this->load->library('image_lib');
				$this->image_lib->initialize($settings); 			
				$this->image_lib->resize();
				
				$banner_info['image']='assets/img/banners/'.$file_info['file_name'];
			}

			$this->banner_model->add_banner($banner_info);

			//-------------------------

			$this->session->set_flashdata('success_message',' Banner has been saved');
			redirect('admin/banners');

		}

		else

		{

			

			$db_data['']="";
			$data['content']=$this->load->view('admin/banners/add',$db_data,true);
			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Banners','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new",'href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="banner Add";
			//------- end breadcrumbs
			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}

	

	

	function edit($id)

	{

		if(!$this->session->userdata('user_id')  || $this->session->userdata('user_type')!=1 ) redirect('admin/auth');
		if($this->input->post('edit_banner'))

		{
			$banner_info['template']=$this->input->post('template');
			$banner_info['title']=$this->input->post('title');
			$banner_info['url']=$this->input->post('url');
			$banner_info['brand_title']=$this->input->post('brand_title');
			$banner_info['created']=date('Y-m-d');
			$banner_info['status']=$this->input->post('status');

			
			// Upload  image	
			$config['upload_path'] = 'assets/img/banners/';
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
				$settings['source_image']	= 'assets/img/banners/'.$file_info['file_name'];
				$settings['create_thumb'] = true;
				$settings['thumb_marker'] = '';
				$settings['maintain_ratio'] = false;
				$settings['new_image'] = 'assets/img/banners/'.$file_info['file_name'];
				$settings['width']	 = '425';
				$settings['height']	 = '223';	

				$this->load->library('image_lib');
				$this->image_lib->initialize($settings); 			
				$this->image_lib->resize();
				
				$banner_info['image']='assets/img/banners/'.$file_info['file_name'];
				
				@unlink($this->input->post('pre_image'));
			
			}

			$this->banner_model->edit_banner($banner_info,$id);

			//-------------------------

			$this->session->set_flashdata('success_message',' Banner has been Edit');
			redirect('admin/banners');
		}

		else

		{

			$data['banner_info']=$this->banner_model->get_banner($id);
			$data['content']=$this->load->view('admin/banners/edit',$data,true);
			//----- this is for breadcrumbs
			$breadcrumbs['breadcrumbs'][]=array('text'=>'Banner','href'=>site_url().'admin');
			$breadcrumbs['breadcrumbs'][]=array('text'=>"Edit Banner",'href'=>'');
			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	
			$data['page_header']="Banner Add Form";
			//------- end breadcrumbs
			$data['active_menu']='';
			$this->load->view('admin/layout/default',$data);
		}

		

	}

	

	function delete($id)

	{

		if(!$this->session->userdata('user_id')  || $this->session->userdata('user_type')!=1 ) redirect('admin/auth');
		
		$banner_info=$this->banner_model->get_banner($id);
		$banner_image=$banner_info->image;
		@unlink($banner_image);
		$this->banner_model->delete_banner($id);
		
		$this->session->set_flashdata('success_message',' Banner has been Deleted');
		redirect('admin/banners');

	}

	
	

}



/* End of file home.php */

/* Location: ./application/controllers/home.php */