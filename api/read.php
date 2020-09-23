<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    //initialise api
    include_once('../core/initialise.php');

    $post = new Post($db);
    $userid = isset($_GET['id']) ? $_GET['id'] : '';
    if($userid == '') {
    $result = $post->read();
    $num = $result->rowCount();
        if($num > 0) {
            $post_arr = array();
            $post_arr['data'] = array();
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $post_item = array(
                    'id' => $id,
                    'title' => $title,
                    'body' => html_entity_decode($body),
                    'author' => $author,
                    'category_id' => $category_id,
                    'category_name' => $category_name
                );
                array_push($post_arr['data'], $post_item);
            }
            echo json_encode($post_arr);
        }
        else {
            echo json_encode(array('message' => 'No posts found'));
        }
    }
    else {
        $post->id = $_GET['id'];
        $post->read_single();
        $post_item = array(
            'id' => $post->id,
            'title' => $post->title,
            'body' => $post->body,
            'author' => $post->author,
            'category_id' => $post->category_id,
            'category_name' => $post->category_name,
        );
        print_r(json_encode($post_item));
    }
?>