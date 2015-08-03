<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_user extends CI_Controller { 

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

		$this->load->model('admin/contact_user_model');		

           

	}

	

	function index()

	{	

		$db_data['contact_user_list']=$this->contact_user_model->get_contact_users();

		$data['content'] = $this->load->view('admin/contact_user/contact_user_list',$db_data,true);

		//----- this is for breadcrumbs

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Contact User List','href'=>'');

		$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

		$data['page_header']="Contact User List";

		//------- end breadcrumbs

		$data['active_menu']='';

		$this->load->view('admin/layout/default',$data); 

	

	}

	

	function contact_user_edit($id)

	{

		if($this->input->post('edit_contact_user'))

		{

			$contact_info['name']=$this->input->post('name');

			$contact_info['email']=$this->input->post('email');

			$contact_info['comments']=$this->input->post('comments');

			$contact_info['status']=$this->input->post('status');

			

			$this->contact_user_model->edit_contact_user($contact_info,$id);

			$this->session->set_flashdata('success_message','Contact User has been saved');

			redirect('admin/contact_user');

		}

		else

		{

			

			$data['contact_user_info']=$this->contact_user_model->get_contact_user($id);

			$data['content']=$this->load->view('admin/contact_user/contact_user_edit_form',$data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Contact User Information','href'=>'');

			

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Contact User Edit Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

		

	}

	

	function view_contact_user($id)

	{

		$data['contact_user_info']=$this->contact_user_model->get_contact_user($id);

		$data['content']=$this->load->view('admin/contact_user/contact_user_view',$data,true);

		//----- this is for breadcrumbs

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Contact User Information','href'=>'');

		

		$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

		$data['page_header']="Contact User View";

		//------- end breadcrumbs

		$data['active_menu']='';

		$this->load->view('admin/layout/default',$data);

	}

	

	

	function contact_user_delete($id)

	{

		$this->contact_user_model->delete_contact_user($id);

		$this->session->set_flashdata('success_message','Contact User has been Deleted');

		redirect('admin/contact_user');

	}

	

}



/* End of file home.php */

/* Location: ./application/controllers/home.php */