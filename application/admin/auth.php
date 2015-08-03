<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

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

		

		$this->load->model('admin/auth_model');



	}

	public function index()

	{      





		if($this->session->userdata('user_id')) redirect('admin');

		

		$db_data['page_title']="Create Account";

		$data['content']=$this->load->view('admin/auth/login',$db_data,true);

		//----- this is for breadcrumbs

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Dashboard','href'=>site_url().'admin');

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Login','href'=>'');

		$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

		$data['page_header']="Login";	

		//------- end breadcrumbs

		$data['active_menu']='auth';

		$this->load->view('admin/layout/default',$data);

	}

	

	function signin()

	{

		

		if($this->input->post('user_login'))

		{

			$data['username']=$this->input->post('username');

			$data['password']=md5($this->input->post('password'));

			$res=$this->auth_model->signin($data);

			if($res)

			{

				//echo $res;

				redirect('admin/tests');

                

			}

			else

			{

				$db_data['page_title']="Signin";

				$db_data['page_load']="signing";

				$db_data['error_messaage']="Username or password does not match.";

				$data['content']=$this->load->view('admin/auth/login',$db_data,true);

				//----- this is for breadcrumbs

		

				$breadcrumbs['breadcrumbs'][]=array('text'=>'Login','href'=>'');

				$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

				$data['page_header']="Login";

				//------- end breadcrumbs

				

				$data['active_menu']='auth';

				$this->load->view('admin/layout/default',$data);

			}

		}

		else

		{

			$this->index();

		}

	}

	

	function logout()

	{

		$this->session->sess_destroy();

		redirect ('admin/auth');

	}

		

	

	

}































/* End of file welcome.php */















/* Location: ./application/controllers/welcome.php */

