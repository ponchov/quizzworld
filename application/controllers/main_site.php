<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Main_site extends CI_Controller {



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
	var $template=null;
	var $fb_localize=null;
	 function __construct() 

	{
		
		
		parent::__construct();

		/*$router =& load_class('Router', 'core');
		echo $router->fetch_class();
		echo "<br>";
		echo $router->fetch_method();
		exit;*/
		//echo "dkfjlss".get_templateName(); exit;
		
		$this->template=get_templateName();
		$this->jsconfig=get_jsconfig();
		
		$languages = array(
			'en' => 'english',
			//'id' => 'indonesian',
			//'ar' => 'arabic',
			//'ru' => 'russian',
			'es' => 'spanish',
			//'zh' => 'chinese',
			'nl' => 'dutch',
			'fr' => 'french',
			//'pl' => 'polish',
			'tr' => 'turkish',
			'pt' => 'portuguese',
			'de' => 'german',
			'it' => 'italian'			
		);
		$laqnguage_county_codes=array(
			'en'=>'US',
			'id'=>'ID',
			'ar'=>'AR',
			'ru'=>'RU',
			'es'=>'LA',
			'zh'=>'CN',
			'nl'=>'NL',
			'fr'=>'FR',
			'pl'=>'PL',
			'tr'=>'TR',
			'pt'=>'PT',
			'de'=>'DE',
			'it'=>'IT'
		);
		$segment=$this->uri->segment(1); 
		//print_r($segment);
		if (!empty($segment) && !isset($languages[$segment]))
		{
			//echo "I am here"; exit;
		}
		else
		{
			if(!empty($segment) && isset($languages[$segment]))
			{
				$this->config->set_item('language', $languages[$segment]); 
			}
			else
			{ 
				$subdomains=explode('.',$_SERVER['HTTP_HOST']);
				$subdomain=$subdomains[0];
				
				if(isset($languages[$subdomain]))
				{
					$this->config->set_item('language', $languages[$subdomain]); 
				}
				else
				{
					$browser_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
					if(!empty($_SESSION['choosen_language']) && $_SESSION['choosen_language'] =='yes')
					{
						$this->config->set_item('language', 'english'); 
					}
					else
					{
						if(array_key_exists($browser_lang,$languages))
						{
							$this->config->set_item('language', $languages[$browser_lang]); 
						}
					}
				}
			}
		}
		//echo site_url(); exit;
		$language=$this->config->item('language');
		//echo $language; exit;
		$lang_code = array_search($language, $languages);
		//echo $language; exit;
		$this->session->set_userdata('lang_code',$lang_code);
		$this->fb_localize=$lang_code."_".$laqnguage_county_codes[$lang_code];
		//echo $this->session->userdata('lang_code'); exit;
		// $this->lang->load('label', get_language_name($this->session->userdata('lang_code')));
		//echo $this->session->userdata('lang_code'); exit;
		//$this->config->set_item('language', 'bangla');
		//echo $this->config->item('language'); exit;
		

		

	}

	

}



/* End of file core_admin.php */

/* Location: ./application/controllers/admin/core_admin.php */