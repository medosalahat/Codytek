<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 15/09/17
 * Time: 02:52 م
 */
require_once 'method.php';

if(isset($_POST['id']) and !empty($_POST['id'])){
    if(isset($_POST['remove']) and !empty($_POST['remove']) and $_POST['remove']=='category'){
        $data = file_get_contents('category.json');
        if(!empty($data)){
            $data = json_decode($data);
            $data = search_category($data,$_POST['id']);

            $task= file_get_contents('task.json');
            if(!empty($task)) {
                $task = json_decode($task);
                $task = search_task($task, $_POST['id'],true);
                file_put_contents('task.json',json_encode($task));
            }
            if( @file_put_contents('category.json',json_encode($data))){
                echo 'saved';
            }else{
                echo 'not saved';
            }
        }
    }

    if(isset($_POST['remove']) and !empty($_POST['remove']) and $_POST['remove']=='task'){
        $data = file_get_contents('task.json');
        if(!empty($data)){
            $data = json_decode($data);
            $data = search_task($data,$_POST['id'],false);

            if( @file_put_contents('task.json',json_encode($data))){
                echo 'saved';
            }else{
                echo 'not saved';
            }
        }
    }

}

