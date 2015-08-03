<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Flags extends CI_Controller { 

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

		if(!$this->session->userdata('user_id')  || $this->session->userdata('user_type')!=1 ) redirect('admin/auth');

		$this->load->model('admin/flag_model');		

           

	}

	

	function index()

	{	

		

        $db_data['flag_list']=$this->flag_model->get_flags();

		$data['content'] = $this->load->view('admin/flags/list',$db_data,true);

		//----- this is for breadcrumbs

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Flag List','href'=>'');

		$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

		$data['page_header']="Cateogories";

		//------- end breadcrumbs

		$data['active_menu']='';

		$this->load->view('admin/layout/default',$data);   

	}

	

	function add()

	{

		if($this->input->post('add_flags'))

		{

			$flag['flag']=$this->input->post('flag');

			

			$id=$this->flag_model->add($flag);

			

			

			$this->session->set_flashdata('success_message','Flag has been saved');

			redirect('admin/flags');

		}

		else

		{

			

			$data=array();

			$data['content']=$this->load->view('admin/flags/add_form',$data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Category List','href'=>'');

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Flag Add Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

	}

	

	

	function edit($id)

	{

		if($this->input->post('edit_flag'))

		{

			$flag_info['flag']=$this->input->post('flag');

			

			$this->flag_model->edit($flag_info,$id);

			$this->session->set_flashdata('success_message','Flag has been saved');

			redirect('admin/flags');

		}

		else

		{

			

			$data['flag_info']=$this->flag_model->get_flag($id);

			$data['content']=$this->load->view('admin/flags/edit_form',$data,true);

			//----- this is for breadcrumbs

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Tests','href'=>site_url().'admin');

			$breadcrumbs['breadcrumbs'][]=array('text'=>'Flag Edit','href'=>'');

			

			$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

			$data['page_header']="Category Edit Form";

			//------- end breadcrumbs

			$data['active_menu']='';

			$this->load->view('admin/layout/default',$data);

		}

		

	}

	

	function delete($id)

	{

		$this->flag_model->delete($id);

		$this->session->set_flashdata('success_message','Flag has been Deleted');

		redirect('admin/flags');

	}

	

}



/* End of file home.php */

/* Location: ./application/controllers/home.php */