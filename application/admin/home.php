<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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

		$this->load->model('admin/home_model');		

           

	}

	

	function index()

	{	

		redirect('admin/tests');

        $db_data=array();

		$data['content'] = $this->load->view('admin/home',$db_data,true);

		//----- this is for breadcrumbs

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Dashboard','href'=>site_url().'admin');

		$breadcrumbs['breadcrumbs'][]=array('text'=>'Overview','href'=>'');

		$data['breadcrumbs']=$this->load->view('admin/layout/breadcrumbs',$breadcrumbs,true);	

		

		$data['page_header']="Dashbaord";

		//------- end breadcrumbs

		$data['active_menu']='';

		$this->load->view('admin/layout/default',$data);   

	}

	

}



/* End of file home.php */

/* Location: ./application/controllers/home.php */