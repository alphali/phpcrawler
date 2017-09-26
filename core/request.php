<?php
class Request {
	protected $curl;	
	protected $headers;
	protected $config = [];

	public function __construct($config) {
		$this->valid_config($config);
		$this->config = $config;
	}

	public function run() {
		$pre = $this->config['pre_preocessor'];
		if (!empty($pre)) { }
		return $this->fetch_page();
	}

	protected function fetch_page() {
		$url = $this->config['url'];
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
