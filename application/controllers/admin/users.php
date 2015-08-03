<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {  

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

		$this->load->model('admin/user_model');		

           

	}

	

	function index()

	{	

		if(!$this->session->userdata('user_id')  || $this->session->userdata('user_type')!=1 ) redirect('admin/auth');

        $db_data['user_list']=$this->user_model->get_users();		

		$data['content'] = $this->load->view('admin/user/user_list',$db_data,true);

		//----- this is for breadcrumbs

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Dashboard','href'=>site_url().'admin');

		$breadcrumbs['breadcrumbs'][]=array('text'=>'User List','href'=>'');

		$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

		$data['page_header']="users";

		//------- end breadcrumbs

		$data['active_menu']='';

		$this->load->view('admin/layout/default',$data);   

	}

	

	function check_duplicate($str)

	{

		

		$username=$this->input->post('username');

		

		$this->db->select('count(*) as num');

		$this->db->where('username',$username);

		if($this->input->post('edit_id')) $this->db->where('userid !=',$this->input->post('edit_id'));

		$this->db->from('users');

		$query=$this->db->get();

		$res=$query->row();		

		if($res->num > 0)

		{

			$this->form_validation->set_message('check_duplicate', 'This username already used , please try with another.');

			return FALSE;

		} 

		else

		{

			

			return true;

		}  

	}

	

	function check_password($str)

	{

		

		$old_password=md5($this->input->post('old_password')); 

		

		$this->db->select('count(*) as num');

		$this->db->where('password',$old_password);

		$this->db->where('userid',$this->session->userdata('user_id'));

		$this->db->from('users');

		$query=$this->db->get();

		$res=$query->row();	

		//echo $res-num; exit;	

		if($res->num > 0)

		{

			//echo "success";

			return true;

		} 

		else

		{

			

			$this->form_validation->set_message('check_password', 'Your old password does not match.');			

			return FALSE;

		}  

	}

	

	function add()

	{

		if(!$this->session->userdata('user_id')  || $this->session->userdata('user_type')!=1 ) redirect('admin/auth');

		

		if($this->input->post('add_user'))

		{

			$this->load->library( 'form_validation' );

			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');

			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');

			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

			$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_check_duplicate');

			$this->form_validation->set_rules('user_type', 'User Type', 'trim|required');

			

			if($this->form_validation->run()) 

			{

				$user_info['first_name']=$this->input->post('first_name');

				$user_info['last_name']=$this->input->post('last_name');

				$user_info['telephone']=$this->input->post('telephone');

				$user_info['email']=$this->input->post('email');

				$user_info['username']=$this->input->post('username');

				$user_info['password']=md5($this->input->post('password'));

				$user_info['user_type']=$this->input->post('user_type');
				
				$user_info['access_language']=implode(',',$this->input->post('access_language'));
				
				/*echo "<pre>";
				print_r($user_info); exit;*/

				$this->user_model->add_user($user_info);

				//-------------------------

				$this->session->set_flashdata('success_message','user has been saved');

				redirect('admin/users');

			}

			else

			{

				$db_data['language_list']=$this->user_model->get_languages();

				$data['content']=$this->load->view('admin/user/add_form',$db_data,true);

				//----- this is for breadcrumbs

				$breadcrumbs['breadcrumbs'][]=array('text'=>'users','href'=>site_url().'admin');

				$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new",'href'=>'');

				$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

				$data['page_header']="user Add Form";

				//------- end breadcrumbs

				$data['active_menu']='';

				$this->load->view('admin/layout/default',$data);

			}

		}

		else

		{

			

			$db_data['language_list']=$this->user_model->get_languages();

			$data['content']=$this->load->view('admin/user/add_form',$db_data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'users','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Add new",'href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="user Add Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}

	

	

	function edit($id)

	{

		if(!$this->session->userdata('user_id')  || $this->session->userdata('user_type')!=1 ) redirect('admin/auth');

		

		if($this->input->post('edit_user'))

		{

			$this->load->library( 'form_validation' );

			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');

			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');

			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');			

			$this->form_validation->set_rules('user_type', 'User Type', 'trim|required');

			

			if($this->form_validation->run()) 

			{

				$user_info['first_name']=$this->input->post('first_name');

				$user_info['last_name']=$this->input->post('last_name');

				$user_info['telephone']=$this->input->post('telephone');

				$user_info['email']=$this->input->post('email');
				$user_info['access_language']=implode(',',$this->input->post('access_language'));
				

				if($this->input->post('password')) $user_info['password']=md5($this->input->post('password'));

				$user_info['user_type']=$this->input->post('user_type');

			

				$this->user_model->edit_user($user_info,$id);

				//-------------------------

				$this->session->set_flashdata('success_message','user has been saved');

				redirect('admin/users');

			}

			else

			{

				$data['user_info']=$this->user_model->get_user($id);	
				$data['language_list']=$this->user_model->get_languages();		

				$data['content']=$this->load->view('admin/user/edit_form',$data,true);

				//----- this is for breadcrumbs

				$breadcrumbs['breadcrumbs'][]=array('text'=>'users','href'=>site_url().'admin');

				$breadcrumbs['breadcrumbs'][]=array('text'=>"Edit User",'href'=>'');

				$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

				$data['page_header']="user Add Form";

				//------- end breadcrumbs

				$data['active_menu']='';

				$this->load->view('admin/layout/default',$data);

			}

		}

		else

		{

			

			$data['user_info']=$this->user_model->get_user($id);
			$data['language_list']=$this->user_model->get_languages();		

			$data['content']=$this->load->view('admin/user/edit_form',$data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'users','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Edit User",'href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="user Add Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

		

	}

	

	function delete($id)

	{

		if(!$this->session->userdata('user_id')  || $this->session->userdata('user_type')!=1 ) redirect('admin/auth');

		$this->user_model->delete_user($id);

		$this->session->set_flashdata('success_message','user has been Deleted');

		redirect('admin/users');

	}

	

	

	function change_password()

	{

		if(!$this->session->userdata('user_id')  || $this->session->userdata('user_type')!=1 ) redirect('admin/auth');

		

		if($this->input->post('change_password'))

		{

			$this->load->library( 'form_validation' );

			$this->form_validation->set_rules('new_password', 'Password', 'trim|required|callback_check_password');

			

			if($this->form_validation->run()) 

			{

				//$old_password=$this->input->post('old_password');

				$user_info['password']=md5($this->input->post('new_password'));

				

				$this->user_model->edit_user($user_info,$this->session->userdata('user_id'));

				//-------------------------

				$this->session->set_flashdata('success_message','user has been saved');

				redirect('admin/users');

			}

			else

			{

				$db_data['user']=array();

				$data['content']=$this->load->view('admin/user/change_password',$db_data,true);

				//----- this is for breadcrumbs

				$breadcrumbs['breadcrumbs'][]=array('text'=>'users','href'=>site_url().'admin');

				$breadcrumbs['breadcrumbs'][]=array('text'=>"Change Password",'href'=>'');

				$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

				$data['page_header']="user Add Form";

				//------- end breadcrumbs

				$data['active_menu']='';

				$this->load->view('admin/layout/default',$data);

			}

			

		}

		else

		{

			$db_data['user']=array();

			$data['content']=$this->load->view('admin/user/change_password',$db_data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'users','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>"Change Password",'href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="user Add Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}

	

		

	



	

}



/* End of file home.php */

/* Location: ./application/controllers/home.php */