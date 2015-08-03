<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller { 

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

		//echo  $this->session->userdata('user_type'); exit;

		if(!$this->session->userdata('user_id')) redirect('admin/auth');

		$this->load->model('admin/category_model');		

           

	}

	

	function index($lang='en')

	{	

		

        $db_data['category_list']=$this->category_model->get_categories($lang);

		$db_data['language_list']=$this->category_model->get_languages();
		$db_data['lang']=$lang;

		$data['content'] = $this->load->view('admin/categories/category_list',$db_data,true);

		//----- this is for breadcrumbs

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Category List','href'=>'');

		$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

		$data['page_header']="Cateogories";

		//------- end breadcrumbs

		$data['active_menu']='';

		$this->load->view('admin/layout/default',$data);   

	}

	

	function category_add()

	{

		if($this->input->post('add_category'))

		{

			$category['category_name']=$this->input->post('category_name');

			$category['description']=$this->input->post('description');

			$category['created']=date('Y-m-d');

			$category['lang_code']='en';
			$category['post_type']=$this->input->post('post_type');

			$id=$this->category_model->add_category($category);

			

			// ----------- alias create

			$input_alias=str_replace(" ",'-',strtolower(trim($this->input->post('category_name'))));

			if($this->category_model->is_unique_alia($input_alias))

			{

				$alias=$input_alias;

			}

			else

			{

				$alias=$input_alias."-".$id;

			}

			

			$category_update['alias']=$alias;

			$category_update['categoryid']=$id;

			$this->category_model->edit_category($category_update,$id);

			

			// ----------- end alias create

			$this->session->set_flashdata('success_message','Category has been saved');

			redirect('admin/categories');

		}

		else

		{

			

			$data=array();

			$data['content']=$this->load->view('admin/categories/category_add_form',$data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Category List','href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Category Add Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}

	

	

	function category_edit($id)

	{

		if($this->input->post('edit_category'))

		{

			$category['category_name']=$this->input->post('category_name');

			$category['description']=$this->input->post('description');

			$category['status']=$this->input->post('status');

			$category['created']=date('Y-m-d');

			$category['post_type']=$this->input->post('post_type');

			$this->category_model->edit_category($category,$id);

			$this->session->set_flashdata('success_message','Category has been saved');

			redirect('admin/categories');

		}

		else

		{

			

			$data['category_info']=$this->category_model->get_category($id);

			$data['content']=$this->load->view('admin/categories/category_edit_form',$data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Category List','href'=>'');

			

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Category Edit Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

		

	}

	

	function category_delete($id)

	{

		$this->category_model->delete_category($id);

		$this->session->set_flashdata('success_message','Category has been Deleted');

		redirect('admin/categories');

	}

	

	function category_content($categoryid, $lang_code)

	{

		if($this->input->post('edit_category_content'))

		{

			$category_info['category_name']=$this->input->post('category_name');

			$category_info['categoryid']=$categoryid;

			$category_info['lang_code']=$lang_code;
			$category_info['post_type']=$this->input->post('post_type');

			$category_info['description']=$this->input->post('description');

			$category_info['created']=date('Y-m-d');

			$cat_info=$this->input->post('cat_info');

			if($cat_info == 0)

			{

				$id=$this->category_model->add_category($category_info);
				// ----------- alias create
				$input_alias=str_replace(" ",'-',strtolower(trim($this->input->post('category_name'))));
				if($this->category_model->is_unique_alia($input_alias))
				{
					$alias=$input_alias;
				}
				else
				{
					$alias=$input_alias."-".$id;
				}

				

				$category_update['alias']=$alias;

				$this->category_model->edit_category($category_update,$id);

			}

			else

			{

				$this->category_model->update_category_content($category_info,$categoryid,$lang_code);

			}

			

			$this->session->set_flashdata('success_message','Category has been saved');

			redirect('admin/categories');

			

		}

		else

		{

			$data['category_info']=$this->category_model->get_category_content($categoryid,$lang_code);
			$data['en_category_info']=$this->category_model->get_category_content($categoryid,'en');

			$data['categoryid']=$categoryid;

			$data['lang_code']=$lang_code;

			

			$data['content']=$this->load->view('admin/categories/edit_category_content_form',$data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Category List','href'=>'');

			

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Category Edit Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}

	

}



/* End of file home.php */

/* Location: ./application/controllers/home.php */