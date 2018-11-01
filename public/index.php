<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;

$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'] ,PHP_URL_PATH);
$segmets = explode("/",$_SERVER['REQUEST_URI_PATH']);
// echo $segmets[1] = api
// echo $segmets[2] = post

if(isset($segmets[2])){
    $page_name = $segmets[2];
    if($page_name == 'category' || $page_name == 'categories'){
        require_once('../app/api/category.php');
    }elseif($page_name == 'post' || $page_name == 'posts'){
        require_once('../app/api/post.php');
    }
}else{
    die('Please Use Api');
}



$app->run();