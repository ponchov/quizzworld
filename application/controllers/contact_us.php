<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('main_site.php');

class Contact_us extends main_site { 

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

		//echo "test"; exit;

		$this->load->model('contact_us_model');

		$this->load->model('home_model');		

           

	}

	

	function index()
 
	{	

		if($this->input->post('add_contact'))

		{
			
			$contact_info['name']=$this->input->post('name');

			$contact_info['email']=$this->input->post('email');

			$contact_info['comments']=$this->input->post('comments');

			

			

				$to="zenbaj@yahoo.com";
				//$to="kamrulhsn10@gmail.com";

				$from=$this->input->post('email');
				$name=$this->input->post('name');
				$subject="User Query";			
				$mess=nl2br($this->input->post('comments'));
				$message="
					Name:$name <br/> 
					Subject:$subject<br/>
					From:$from <br/>
					Message:$mess 				
				";

				/*$headers  = "From: $from\r\n";
				$headers .= "Content-type: text/html\r\n";
			   mail($to, $subject, $message, $headers);*/
			   
			   
			   //----------------
			   
			    $this->load->library('email');
				$this->email->from($from, $name);
				$this->email->to($to);
				$this->email->subject($subject);
				$this->email->message($message);
		
				$this->email->send();
			   // ------------

			$this->contact_us_model->save_contact_info($contact_info);

			$this->session->set_flashdata('success_message','Your Message has been Successfully Send');
			$lang_code='';
			if($this->session->userdata('lang_code') != 'en') $lang_code=$this->session->userdata('lang_code')."/";
			redirect($lang_code.'contact-us.html');

		}

		else

		{

			$db_data=array();

			$db_data['config_info']=$this->home_model->get_config();		

			$data['content'] = $this->load->view($this->template.'/home/contact_us',$db_data,true);

			$data['config_info'] = $db_data['config_info'];		

			$data['active_menu']='';

			$data['cur_page'] ="";

			$this->load->view($this->template.'/layout/default',$data);    

		}

	}
	
	
	
	
	function delete_images()
	{

		$current_time = date('Y-m-d H:i:s',(time() - (60*3)));
		//$current_time = date('Y-m-d H:i:s');
		$pre_fb_apps_result_list=$this->home_model->get_pre_fbapps_result($current_time);
		echo count($pre_fb_apps_result_list);
		if($pre_fb_apps_result_list)
		{
			foreach($pre_fb_apps_result_list as $row)
			{
				//echo $row->image_name; exit;
				//echo $row->image_name;
				unlink($row->image_name);
			}
			$this->home_model->delete_pre_fbapps_result($current_time); 
		}
		
	}
	
	function count_images()
	{
		$files = glob('assets/fb_apps/*'); // get all file names 
		$i=0;
		//print_r($files); exit;
		//----unlink("assets/fb_apps/999613246717701.jpg"); exit;
		foreach($files as $file){ // iterate files

		  if(is_file($file))
		  {
		  	echo $file;
			echo "<br>";
		  	unlink($file); // delete file
		  }
			
		}


		$fi = new FilesystemIterator("assets/fb_apps", FilesystemIterator::SKIP_DOTS);
		printf("There were %d Files", iterator_count($fi));
	}

	

	

}



/* End of file home.php */

/* Location: ./application/controllers/home.php */