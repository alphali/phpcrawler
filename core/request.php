<?php
namespace PHPCrawler\Core;
class Request {
	protected $curl;	
	protected $headers;
	protected $config = [];
    const USER_AGENT = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.    0.3359.139 Safari/537.36';

	public function __construct($config=[]) {
		$this->valid_config($config);
		$this->config = $config;
	}

	public function run() {
		$pre = $this->config['pre_preocessor'];
		if (!empty($pre)) {
		    $this->charset_convert('gb2312','utf8');
        }
		return $this->fetch_page();
	}
    public function get_page($cfg) {
	    $this->config=$cfg;
		$pre = $this->config['pre_preocessor'];
		if (!empty($pre)) {
		    $this->charset_convert('gb2312','utf8');
        }
		return $this->fetch_page();
	}
	protected function fetch_page() {
		$url = $this->config['url'];
		$page = $this->curl_get($url);
		$tmp_file = '/tmp/'.md5($url).'.html';
		file_put_contents($tmp_file, $page);
		echo "request page $tmp_file fin\n";
		return $page;
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
    protected function curl_post($url, $post) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        return curl_exec($ch);
    }
    protected function curl_get($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, self::USER_AGENT);
        $html = curl_exec($ch) ;
        curl_close($ch);
        return $html;
    }

}
