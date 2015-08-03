<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Languages extends CI_Controller {  

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

		if(!$this->session->userdata('user_id')  || $this->session->userdata('user_type')!=1 ) redirect('admin/auth');

		$this->load->model('admin/language_model');		

           

	}

	

	function index()

	{	

		

        $db_data['language_list']=$this->language_model->get_languages();

		$data['content'] = $this->load->view('admin/languages/list',$db_data,true);

		//----- this is for breadcrumbs

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

		$breadcrumbs['breadcrumbs'][]=array('text'=>'language List','href'=>'');

		$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

		$data['page_header']="Cateogories";

		//------- end breadcrumbs

		$data['active_menu']='';

		$this->load->view('admin/layout/default',$data);   

	}

	

	function add()

	{

		if($this->input->post('add_languages'))

		{

			$this->load->library( 'form_validation' );

			

			$this->form_validation->set_rules('language_name', 'Language Name', 'trim|required');			

			$this->form_validation->set_rules('language_code', 'Language Code', 'trim|required|callback_check_duplicate');

			

			if($this->form_validation->run()) 

			{

				$language_info['language_name']=$this->input->post('language_name');

				$language_info['language_code']=$this->input->post('language_code');

				$language_info['status']=1;

				

				$this->language_model->add($language_info);			

				

				$this->session->set_flashdata('success_message',' Language has been saved');

				redirect('admin/languages');

			}

			else

			{

				$data=array();

				$data['content']=$this->load->view('admin/languages/add_form',$data,true);

				//----- this is for breadcrumbs

				$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

				$breadcrumbs['breadcrumbs'][]=array('text'=>'Category List','href'=>'');

				$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

				$data['page_header']="language Add Form";

				//------- end breadcrumbs

				$data['active_menu']='';

				$this->load->view('admin/layout/default',$data);

			}

		}

		else

		{

			

			$data=array();

			$data['content']=$this->load->view('admin/languages/add_form',$data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Category List','href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="language Add Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}

	

	

	function edit($id)

	{

		if($this->input->post('edit_language'))

		{

			$this->load->library( 'form_validation' );

			

			$this->form_validation->set_rules('language_name', 'Language Name', 'trim|required');			

			$this->form_validation->set_rules('language_code', 'Language Code', 'trim|required|callback_check_duplicate');

			

			if($this->form_validation->run()) 

			{

				$language_info['language_name']=$this->input->post('language_name');

				$language_info['language_code']=$this->input->post('language_code');

				$language_info['status']=$this->input->post('status');

				

				$this->language_model->edit($language_info,$id);

				$this->session->set_flashdata('success_message',' Language has been saved');

				redirect('admin/languages');

			}

			else

			{

				$data['language_info']=$this->language_model->get_language($id);

				$data['content']=$this->load->view('admin/languages/edit_form',$data,true);

				//----- this is for breadcrumbs

				$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

				$breadcrumbs['breadcrumbs'][]=array('text'=>'language Edit','href'=>'');

				

				$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

				$data['page_header']="Category Edit Form";

				//------- end breadcrumbs

				$data['active_menu']='';

				$this->load->view('admin/layout/default',$data);

			}

		}

		else

		{

			

			$data['language_info']=$this->language_model->get_language($id);

			$data['content']=$this->load->view('admin/languages/edit_form',$data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>'language Edit','href'=>'');

			

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Category Edit Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

		

	}

	

	function delete($id)

	{

		$this->language_model->delete($id);

		$this->session->set_flashdata('success_message',' language has been Deleted');

		redirect('admin/languages');

	}

	

	

	function check_duplicate($str)

	{

		

		$language_code=$this->input->post('language_code');

		

		$this->db->select('count(*) as num');

		$this->db->where('language_code',$language_code);

		if($this->input->post('language_id')) $this->db->where('language_id !=',$this->input->post('language_id'));

		$this->db->from('languages');

		$query=$this->db->get();

		$res=$query->row();		

		if($res->num > 0)

		{

			$this->form_validation->set_message('check_duplicate', ' This languages Code already used , please try with another.');

			return FALSE;

		} 

		else

		{

			

			return true;

		}  

	}

	

	

	

	

	

	

	

	

	

	

}



/* End of file home.php */

/* Location: ./application/controllers/home.php */