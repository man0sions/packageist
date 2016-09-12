<?php
/**
 * Created by PhpStorm.
 * User: man0sions
 * Date: 16/9/12
 * Time: 下午2:22
 */
require '../vendor/autoload.php';


$urls = [
    'http://www.apple.com',
    'http://php.net',
    'http://sdfssdwerw.org'
];


$scan = new \Luciferp\Url\ScanUrl($urls);
var_dump($scan->getInvalidUrl());
