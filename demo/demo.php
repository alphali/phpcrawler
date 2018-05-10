<?php
namespace PHPCrawler\Demo;
use PHPCrawler\Core\Config;
use PHPCrawler\Core\Request;
use PHPCrawler\Core\Parser;
include __DIR__."/../core/config.php";
include __DIR__."/../core/request.php";
include __DIR__."/../core/parser.php";
$cfg_manager= new Config();
$config = $cfg_manager->get_config('autohome');
$req = new Request($config['request']);
$parser = new Parser($config['parser']);
//$html = $req->run();
$html = file_get_contents('/tmp/e9320b40eb91293d0717ad76a4f155a3.html');
$data =$parser->run($html);
var_dump($data);exit;

$crawler = new Crawler();
$cases = [
	'imdb',
	'qq_news',
];
$key = 'imdb';
$data = $crawler->run($key);
var_dump($data);exit;
