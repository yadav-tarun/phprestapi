<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow--Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

    //initialise api
    include_once('../core/initialise.php');

    $post = new Post($db);

    //get raw posted data
    //$data = json_decode(file_get_contents("php://input"));
    //$post->id = $data->id;

    $post->id = $_GET['id'];

    //delete post
    if($post->delete()) {
        echo json_encode(
            array('message' => 'Post Deleted')
        );
    }
    else {
        echo json_encode(
            array('message' => 'Not Deleted')
        );
    }
?>