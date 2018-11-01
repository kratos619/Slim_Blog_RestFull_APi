<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;

// get all categories
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

// get Single cat
$app->get('/api/categories/{id}',function(Request $request, Response $response, array $args){
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM category where id = '{$id}'";

    try{
        //Get db objet 
            $db = new DB;
            $db = $db->connection();
            $stmt = $db->query($sql);
            $cat_by_id = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo json_encode($cat_by_id);

    }catch(PDOException $e){
        echo json_encode($e->getMessage());
    }   
});

// insert all data
// add Categories
$app->post('/api/categories/add',function(Request $request, Response $response, array $args){
    $cat_name = $request->getParam('cat_name');
    // $cat_id = $request->getParam('cat_id');
    // $body = $request->getParam('body');

    $sql = "INSERT INTO category (cat_name) values (:cat_name)";

    try{
    //Get db objet 
        $db = new DB;
        $db = $db->connection();
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':cat_name',$cat_name);
        $stmt->execute();
        
        echo json_encode("Category Successfully added");
        print_r($stmt);
        
    }catch(PDOException $e){
            echo json_encode($e->getMessage());
    }
});

// update categories
$app->put('/api/categories/update/{id}',function(Request $request, Response $response, array $args){
    
    $id = $request->getAttribute('id');
    $cat_name = $request->getParam('cat_name');
    // $cat_id = $request->getParam('cat_id');
    // $body = $request->getParam('body');

    $sql = "UPDATE category SET cat_name = :cat_name where id = '{$id}'";

    try{
    //Get db objet 
        $db = new DB;
        $db = $db->connection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":cat_name",$cat_name);
        $stmt->execute();
        
        echo json_encode("Category Successfully added");
        print_r($stmt);
    }catch(PDOException $e){
            echo json_encode($e->getMessage());
    }
});

// delete 
$app->delete('/api/categories/delete/{id}',function(Request $request, Response $response){
$id = $request->getAttribute('id');

$sql = "DELETE FROM category WHERE id = '{$id}'";
try{
    //Get db objet 
        $db = new DB;
        $db = $db->connection();
        $stmt = $db->prepare($sql);
        //$stmt->bindParam(":cat_name",$cat_name);
        $stmt->execute();
        
        echo json_encode("Category Successfully Delete");
        
    }catch(PDOException $e){
            echo json_encode($e->getMessage());
    }
});