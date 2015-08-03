<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// CodeIgniter i18n library by Jérôme Jaglale
// http://maestric.com/en/doc/php/codeigniter_i18n
// version 10 - May 10, 2012

class MY_Lang extends CI_Lang {

	/**************************************************
	 configuration
	***************************************************/

	// languages
	var $languages = array(
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

	// special URIs (not localized)
	var $special = array (
		"admin"
	);
	
	// where to redirect if no language in URI
	var $default_uri = ''; 
	var $host='';

	/**************************************************/
	
	
	function __construct()
	{
		
		parent::__construct();		
		
		global $CFG;
		global $URI;
		global $RTR;
		//$_SESSION['dfksl']="dfkjsdlfslkfslk";
		//echo "I am here";
		//print_r($_SESSION); exit;
		//echo "I am here"; exit;
		//$_SESSION['choosen_language']='no';
		
		
		/*ini_set('display_startup_errors',1);
		ini_set('display_errors',1);
		error_reporting(-1);*/

		$this->host=str_replace("www.","",$_SERVER['HTTP_HOST']);
		
		$segment = $URI->segment(1);
		
		if (!empty($segment) &&  !isset($this->languages[$segment]) && !empty($_SESSION['choosen_language']) && $_SESSION['choosen_language'] == 'yes')
		{
			//echo "I am here"; exit;
			return true;
		}
		
		
		if(isset($segment) && $segment == 'en') 
		{
			//return true;
			//----------------------------------$_SESSION['choosen_language']='yes';
			//----------------------------------return ;
		}
		
		//------------------- this is for enable en.domainname.com/en
		/*if(isset($segment) && $segment == 'en')
		{ 
			$url=$CFG->item('root_url');
			$_SESSION['choosen_language']='yes';
			header("Location: " . $url, TRUE, 302);
			exit;
		}
		else
		{
			$_SESSION['choosen_language']='no';
		}*/
		
		//print_r($_SESSION); exit;
		$subdomains=explode('.',$this->host);
		if(array_key_exists($subdomains[0], $this->languages)) 
		{
			 
			//echo "I am here"; exit;
			//echo $this->host; exit;
			//echo $this->host;
			//echo "<br>";
			$CFG->set_item('base_url', "http://".$this->host."/");
			$CFG->set_item('language', $this->languages[$subdomains[0]]);
			
			return true;	
		}
		//echo $CFG->item('base_url');exit;
		//echo $CFG->item('base_url');exit;
		//echo "dkflsf"; exit;
		
		if (!empty($segment) &&  !isset($this->languages[$segment]))
		{
			//echo "I am here"; exit;
			//--------------------return true;
		}
		
		if (isset($this->languages[$segment]))	// URI with language -> ok
		{ //print_r($segment); exit;
			
			$language = $this->languages[$segment];
			//print_r($language ); exit;
			$CFG->set_item('language', $language);
			//echo $segment; exit;
			//---------------
			$subdomains=explode('.',$this->host);
			//print_r($subdomains); exit;
			if(!array_key_exists($subdomains[0], $this->languages)) 
			{ 
				//echo $CFG->site_url($this->localized($subdomains[0])); exit;
				//print_r($this->languages); exit;
				$CFG->set_item('base_url', "http://".$segment.".".$this->host."/");
				
				$final_url=$CFG->site_url();
				if($URI->uri_string) $final_url.=$URI->uri_string;
				//echo $final_url; exit;
				header("Location: " . $final_url, TRUE, 302);
				//exit;
			}
			//$CFG->set_item('base_url', "http://".$this->host."/");
			//print_r($this->host); exit;
			return;
			//----------------

		}
		else if($this->is_special($segment)) // special URI -> no redirect
		{
			
			return;
		}
		else	// URI without language -> redirect to default_uri
		{ 
			//$browser_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
			//print_r($browser_lang); exit;
			
			$subdomains=explode('.',$this->host);
			//print_r($subdomains); exit;
			//print_r($subdomains); exit;
			//print_r($this->languages); exit;
			if(array_key_exists($subdomains[0],$this->languages)) 
			{
				//echo $CFG->site_url($this->localized($subdomains[0])); exit;
				header("Location: " . $CFG->site_url($this->localized($subdomains[0])), TRUE, 302);
				exit;
			}
			
			//-------------
			$browser_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
			//print_r($browser_lang); exit;
			if(array_key_exists($browser_lang,$this->languages))
			{
				$CFG->set_item('language', $this->languages[$browser_lang]);
			}
			else
			{
				$CFG->set_item('language', $this->languages[$this->default_lang()]);
			}
			//--------------------------------if($CFG->item('language') == 'english') return true;
			//--------------
			//echo $CFG->site_url($this->localized($this->default_uri)) ; exit;
			// set default language
			
			//echo $this->default_uri ;exit;
			// redirect
			//print_r($URI->uri_string);
			//echo $this->default_uri; exit;
			
			$language_code = array_search($CFG->item('language'),$this->languages); 
			//print_r($subdomains[0]);
			if(!array_key_exists($subdomains[0],$this->languages))
			{ //echo "I am here"; exit;
				
				$CFG->set_item('base_url', "http://".$language_code.".".$this->host."/");
			} 
			
			//echo $this->host; exit;
			$final_url=$CFG->site_url($this->localized($this->default_uri));
			$final_url=rtrim(trim($final_url),'/');
			//print_r($final_url); exit;
			if($URI->uri_string) $final_url.="/".$URI->uri_string;
			//echo $final_url; exit;
			header("Location: " . $final_url, TRUE, 302);
			exit;
		}
	}
	
	// get current language
	// ex: return 'en' if language in CI config is 'english' 
	function lang()
	{
		global $CFG;		
		$language = $CFG->item('language');
		
		$lang = array_search($language, $this->languages);
		if ($lang)
		{
			return $lang;
		}
		
		return NULL;	// this should not happen
	}
	
	function is_special($uri)
	{ //echo $uri; 
		//echo "<h3>".$uri."</h3>";
		$exploded = explode('/', $uri);
		//print_r($exploded); exit;
		//echo "<h1>dkjfsldkf</h1>";
		if (in_array($exploded[0], $this->special))
		{ // echo "<h2>True</h1>";
			return TRUE;
		}
		if(isset($this->languages[$uri]))
		{
			return TRUE;
		}
		//echo "<h2>false</h1>";
		return FALSE;
	}
	
	function switch_uri($lang)
	{
		$CI =& get_instance();

		$uri = $CI->uri->uri_string();
		if ($uri != "")
		{
			$exploded = explode('/', $uri);
			if($exploded[0] == $this->lang())
			{
				$exploded[0] = $lang;
			}
			$uri = implode('/',$exploded);
		}
		return $uri;
	}
	
	// is there a language segment in this $uri?
	function has_language($uri)
	{
		$first_segment = NULL;
		
		$exploded = explode('/', $uri);
		if(isset($exploded[0]))
		{
			if($exploded[0] != '')
			{
				$first_segment = $exploded[0];
			}
			else if(isset($exploded[1]) && $exploded[1] != '')
			{
				$first_segment = $exploded[1];
			}
		}
		
		if($first_segment != NULL)
		{
			return isset($this->languages[$first_segment]);
		}
		
		return FALSE;
	}
	
	// default language: first element of $this->languages
	function default_lang()
	{
		foreach ($this->languages as $lang => $language)
		{
			return $lang;
		}
	}
	
	// add language segment to $uri (if appropriate)
	function localized($uri)
	{ 
		$uri2  = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
		if(in_array('admin',$uri2))
		{
			return $uri;
		}

		if($this->has_language($uri)
				|| $this->is_special($uri)
				|| preg_match('/(.+)\.[a-zA-Z0-9]{2,4}$/', $uri))
		{
			// we don't need a language segment because:
			// - there's already one or
			// - it's a special uri (set in $special) or
			// - that's a link to a file
		}
		else
		{
			$uri = $this->lang() . '/' . $uri;
		}
		//echo $uri; exit;
		return $uri;
	}
	
}

/* End of file */
