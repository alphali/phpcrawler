<?php
class Parse {
	public function __construct($config) {
		$this->valid_config($config);
		$this->config = $config;
	}
	
	protected function jsonp_handle($content, $regist_function):void {
	}

	protected function xml_handle() {
	}

	protected function charset_handle() {
	}

	protected function specialchars_handle() {
	}

	public function run() {
		$pre = $this->config['pre_processor'];
		if (!empty($pre)) { 
			foreach ($pre as $func) {
				if (function_exist($this, $call)) {
					call_user_func($this, $call['func'], $call['params']);
				}
			}
		}
		return $this->parse_page();
	}

	protected function parse_page() {
		
		return $curl->get($url);
	}

	protected function curl_handle() {
		$this->curl->set_options([]);
		$this->curl->set_headers([]);
	}

	protected function get_curl(array $options=[]) {
		$curl = new Curl();
		$curl->set_headers($this->headers);
		$curl->set_options($options);
		//$this->curl = $curl;
		return $curl;
	}
	
	protected function valid_config($config) {
		return true;
	}
}
