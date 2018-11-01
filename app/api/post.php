<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;

// get all Posts
$app->get('/api/posts',function(Request $request, Response $response, array $args){
$sql = "SELECT * FROM posts";

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

// get Single Post

$app->get('/api/posts/{id}',function(Request $request, Response $response, array $args){
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM posts where id = '{$id}'";

 try{
    //Get db objet 
        $db = new DB;
      $db = $db->connection();
    $stmt = $db->query($sql);
    $posts_by_id = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;

     echo json_encode($posts_by_id);

}catch(PDOException $e){
    echo json_encode($e->getMessage());
}  


});



// add post 
$app->post('/api/posts/add',function(Request $request, Response $response, array $args){
    $title = $request->getParam('title');
    $cat_id = $request->getParam('cat_id');
    $body = $request->getParam('body');

    $sql = "INSERT INTO posts (title,cat_id,body) values (:title,:cat_id,:body)";

    try{
    //Get db objet 
        $db = new DB;
        $db = $db->connection();
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':title',$title);
        $stmt->bindParam(':cat_id',$cat_id);
        $stmt->bindParam(':body',$body);
        $stmt->execute();
        
        return json_encode("Post Successfully added");
        
    }catch(PDOException $e){
            echo json_encode($e->getMessage());
    }
});

// delete post 
$app->get('/api/posts/delete/id',function(Request $request, Response $response, array $args){
    $id = $request->getParam('id');
    
    $sql = "delete from posts where id = '{$id}'";

    try{
    //Get db objet 
        $db = new DB;
        $db = $db->connection();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return json_encode("data Successfully delete");   
    }catch(PDOException $e){
            echo json_encode($e->getMessage());
    }
});
