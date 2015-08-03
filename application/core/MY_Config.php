<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// CodeIgniter i18n library by Jérôme Jaglale
// http://maestric.com/en/doc/php/codeigniter_i18n
// version 10 - May 10, 2012

class MY_Config extends CI_Config {
	
	function __construct()
	{
		
		parent::__construct();	
		global $URI;
		
	}

	function site_url($uri = '')
	{	
		if (is_array($uri))
		{ 
			$uri = implode('/', $uri);
		}
		
		if (class_exists('CI_Controller'))
		{  
			$CI =& get_instance();
			//echo parent::site_url(); exit;
			//--------------------if($CI->config->item('language') == 'english') return parent::site_url($uri);
			$uri = $CI->lang->localized($uri);		
			//echo $uri; exit;	
		}
		//echo $uri; exit;
		$site_url=parent::site_url($uri);
		$site_url=rtrim($site_url,'/');
		$site_url.="/";
		return $site_url;
	}
		
}

/* End of file */
