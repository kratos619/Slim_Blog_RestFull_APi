<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;

// get all Posts
$app->get('/api/posts',function(Request $request, Response $response, array $args){
echo 'POSTS';
});

//$app->run();