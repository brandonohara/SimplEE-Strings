<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require_once(PATH_THIRD."simplee_strings/config.php");
	
	$plugin_info = array(
		'pi_name' 			=> SIMPLEE_STRINGS_NAME,
		'pi_version' 		=> SIMPLEE_STRINGS_VERSION,
		'pi_author' 		=> 'Brandon OHara',
		'pi_author_url' 	=> 'http://brandonohara.com/',
		'pi_description' 	=> 'Manipulate strings without PHP',
	    'pi_usage'        	=> Simplee_strings::usage()
	);

	class Simplee_strings {
		public $params = array();
		public $return_data = "";
		public $plugin_name = SIMPLEE_STRINGS_NAME;
		
		function __construct(){
			$text = ee()->TMPL->tagdata;
			$this->params = ee()->TMPL->tagparams;
			
			if($this->_variable("remove")){
				$text = str_replace($this->_variable("remove"), "", $text);
			}
			if($this->_varisset("url_title")){
				$text = strtolower(str_replace(" ", "-", $text));
			}
			
			$this->return_data = $text;
		}
		
		function _varisset($name){
			return isset($this->params[$name]) ? true : false;
		}
		
		function _variable($name){
			$variable = ee()->TMPL->fetch_param($name);
			return $variable != "" ? $variable : false;
		}
		
		function usage(){
			return "";
		}
		
	}

/* End of file pi.simplee_strings.php */
/* Location: ./system/expressionengine/third_party/simplee_strings/pi.simplee_strings.php */