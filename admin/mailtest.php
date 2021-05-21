<?php
include_once("./_common.php");
//메일템플릿
require '../vendor/autoload.php';

use Philo\Blade\Blade;

$views = $_SERVER['DOCUMENT_ROOT'] . '/views';
$cache = $_SERVER['DOCUMENT_ROOT'] . '/data/cache';

$blade = new Blade($views, $cache);

echo $blade->view()->make('email/editor/revision',['info'=>$info,'title'=>'논문제목','abstract'=>'초록내용초록내용']);

