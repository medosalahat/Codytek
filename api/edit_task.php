<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 15/09/17
 * Time: 09:56 م
 */
require_once 'method.php';


if((isset($_GET['id']) and !empty($_GET['id'])) and (isset($_GET['get']) and $_GET['get'])){
    $data = file_get_contents('task.json');
    if(!empty($data)){
        $data = json_decode($data);
        $data = get_task($data,$_GET['id']);
        echo json_encode($data);
    }
}

if(
    (isset($_POST['title']) and !empty($_POST['title'])) and
    isset($_POST['category_id']) and !empty($_POST['category_id']) and
    isset($_POST['description']) and !empty($_POST['description']) and
    isset($_POST['due_date']) and !empty($_POST['due_date']) and
    isset($_POST['tags'])
){
    $data = file_get_contents('task.json');
    if(!empty($data)){
        $data = json_decode($data);
        $data = update_task($data,$_POST['id'],$_POST);
        if( @file_put_contents('task.json',json_encode($data))){
            echo 'Task has been Update ';
        }else{
            echo 'not saved';
        }
    }
}
