<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;

// get all Posts
$app->get('/api/categories',function(Request $request, Response $response, array $args){
$sql = "SELECT * FROM category";

try{
    //Get db objet 
    $db = new DB;
   $db = $db->connection();
    $stmt = $db->query($sql);
    $posts = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;

     echo json_encode($posts);

}catch(PDOException $e){
    echo json_encode($e->getMessage());
}
});

//$app->run();