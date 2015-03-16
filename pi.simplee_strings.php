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
		public $tagparts = array();
		public $params = array();
		public $return_data = "";
		public $plugin_name = SIMPLEE_STRINGS_NAME;
		
		function __construct(){
			$this->params = ee()->TMPL->tagparams;
			$this->tagparts = ee()->TMPL->tagparts;
			$this->return_data = ee()->TMPL->tagdata;
			
			if(!isset($tagparts[1])){
				foreach($this->params as $param => $value){
					if(method_exists($this, $param)){
						$this->return_data = $this->$param($value);
					}
				}
			}
			
			return $this->return_data;
		}
		
		private function _value($value, $default = NULL){
			return $value != "" ? $value : ee()->TMPL->fetch_param("value", $default);
		}
		
		private function _run_method($value){
			return $value == "yes" ? true : false;
		}
		
		function remove($value = NULL){
			$value = $this->_value($value);
			return str_replace($value, "", $this->return_data);
		}
		
		function replace($value = NULL){
			$arr = explode("|", $this->_value($value));
			return isset($arr[1]) ? str_replace($arr[0], $arr[1], $this->return_data) : $this->return_data;
		}
		
		function url_title($value = NULL){
			$value = $this->_value($value, "yes");
			return $this->_run_method($value) ? strtolower(str_replace(" ", "-", $this->return_data)) : $this->return_data;
		}
		
		public static function usage(){
			return "";
		}
		
	}

/* End of file pi.simplee_strings.php */
/* Location: ./system/expressionengine/third_party/simplee_strings/pi.simplee_strings.php */