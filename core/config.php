<?php
namespace PHPCrawler\Core;
class Config
{
    const BASE_PATH = __DIR__.'/../';
    public function get_config($key) {
        $config_dir = self::BASE_PATH . 'config/';
        $file = $config_dir . $key . '.php';
        $config = require_once($file);
        return $config;
    }
}