<?php
namespace PHPCrawler\Core;
class Parser {
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

	public function run($html) {
		$pre = $this->config['pre_processor'];
		/*
		if (!empty($pre)) { 
			foreach ($pre as $func) {
				if (function_exist($this, $call)) {
					call_user_func($this, $call['func'], $call['params']);
				}
			}
		}
		*/
		if ($pre) {
		    $html = $this->charset_convert('gb2312','utf8',$html);
        }
        file_put_contents('/tmp/utf',$html);
		return $this->parse_page($html);
	}
	protected  function charset_convert($in, $out, $html) {
        $out_charset = $out.'//IGNORE';
        return iconv($in,$out_charset,$html);
    }

	protected function parse_page($html) {
	    $cfg = $this->config;
        $root = $this->get_xml($html, $cfg['root']);
        $list = $this->parse_rule($root,$cfg['list']);
        $detail = $this->parse_detail($list, $cfg['detail']);
        return $list;
	}
	private function prefix($params,$url) {
	    return $params[0] .$url;
    }
	protected function parse_detail($list,$cfg) {
        $req = new Request();
        foreach ($list as $item) {
            $html = $req->get_page(['url'=>$item['url']]);
            $root = $this->get_xml($html, $cfg['root']);
            $data = $this->parse_rule($root,$cfg);
            var_dump($data);exit;
            $xml = simplexml_load_string($xml);
        }
        $data = [];
	    foreach ($cfg['fields'] as $field=>$cf){
            $tmp = [];
            $path = "{$cf['xpath']}";
            $v = $xml->xpath($path);
            $after = $cf['after'];
            if ($cf['type'] == 'array') {
               foreach ($v as $item)  {
                   $ret = (string)$item;
                   $url = call_user_func_array([$this,$after[0]], [$after[1], $ret]);
                   $tmp[$field][]=$ret;
               }
            } elseif ($v['type'] == 'string') {
                $tmp[$field]=(string)$v[0];
            } else {
                $tmp[$field]=(string)$v[0];
            }
            $data[]=$tmp;
        }
        return $data;
    }
	protected function parse_rule($xml,$cfg) {
        $xml = simplexml_load_string($xml);
        $data = [];
	    foreach ($cfg['fields'] as $field=>$cf){
            $tmp = [];
            $path = "{$cf['xpath']}";
            $v = $xml->xpath($path);
            $after = $cf['after'];
            if ($cf['type'] == 'array') {
               foreach ($v as $item)  {
                   $ret = (string)$item;
                   $url = call_user_func_array([$this,$after[0]], [$after[1], $ret]);
                   $tmp[$field][]=$ret;
               }
            } elseif ($v['type'] == 'string') {
                $tmp[$field]=(string)$v[0];
            } else {
                $tmp[$field]=(string)$v[0];
            }
            $data[]=$tmp;
        }
        return $data;
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
    protected function get_xml($html, $root_path) {
        $dom = new \DomDocument();
        @$dom->loadHtml($html);
        $xml = @simplexml_import_dom($dom);
        if ($xml && $root_path){
            $root_nodes = $xml->xpath($root_path);
            if (!empty($root_nodes)){
                $xml = $root_nodes[0];
            }
            else {
                $xml = null;
            }
        }
        if ($xml){
            return $xml->asXML();
        }
        return '';
    }

}
