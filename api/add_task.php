<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 15/09/17
 * Time: 05:33 م
 */
require_once 'method.php';

if(
    (isset($_POST['title']) and !empty($_POST['title'])) and
    isset($_POST['category_id']) and !empty($_POST['category_id']) and
    isset($_POST['description']) and !empty($_POST['description']) and
    isset($_POST['due_date']) and !empty($_POST['due_date']) and
    isset($_POST['tags'])
){
    $data = file_get_contents('task.json');

        $post_data = [
            'title'=>$_POST['title'],
            'category_id'=>$_POST['category_id'],
            'description'=>$_POST['description'],
            'tags'=>$_POST['tags'],
            'due_date'=>$_POST['due_date'],
        ];
        $data = json_decode($data);
        $data = add_task($data,$post_data);
        if( @file_put_contents('task.json',json_encode($data))){
            echo 'Task has been created ';
        }else{
            echo 'not saved';
        }
     
}