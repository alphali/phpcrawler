<?php
return [
	'request' => [
		'url' => 'http://imdb/subject/123456',
	],
	'parse' => [
		'pre_processor' => [
			'charset_handle' => ['gb2312', 'utf8'],
		],
		'target' => [
			'name' => [
				'xpath' => '',
				'repeat' => true,
				'formater' => 'trim',
			],
			'open_date' => [
				'xpath' => '',
				'repeat' => false,
				'formater' => 'date_ymd',
			],
		],
	],
];
