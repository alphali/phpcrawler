<?php
$crawler = new Crawler();
$cases = [
	'imdb',
	'qq_news',
];
$key = 'imdb'
$data = $crawler->run($key);
var_dump($data);exit;
