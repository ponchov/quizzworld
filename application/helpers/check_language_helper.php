<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



function is_support_language($lang)

{

	$languages= array(

				"en" => "english",

				"de" => "german",

				"fr" => "french",

				"nl" => "dutch",

				"bn" => "bangla"

			);

	if(array_key_exists($lang,$languages))

	{

		return true;

	}

	else

	{

		return false;

	}
	
	
	



}



function get_language_name($code) 
	{
		$languages= array(

				"en" => "english",

				"de" => "german",

				"fr" => "french",

				"nl" => "dutch",

				"bn" => "bangla"

			);
			
		return $languages[$code];
	}

/* End of file MY_language_helper.php */

/* Location: ./application/helpers/MY_language_helper */