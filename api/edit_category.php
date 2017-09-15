<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 15/09/17
 * Time: 09:56 م
 */
require_once 'method.php';


if((isset($_GET['id']) and !empty($_GET['id'])) and (isset($_GET['get']) and $_GET['get'])){
    $data = file_get_contents('category.json');
    if(!empty($data)){
        $data = json_decode($data);
        $data = get_category($data,$_GET['id']);
        echo json_encode($data);
    }
}

if((isset($_POST['id']) and !empty($_POST['id'])) and (isset($_POST['title']) and !empty($_POST['title']))){
    $data = file_get_contents('category.json');
    if(!empty($data)){
        $data = json_decode($data);
        $data = update_category($data,$_POST['id'],$_POST['title']);
        if( @file_put_contents('category.json',json_encode($data))){
            echo 'Category has been Update ';
        }else{
            echo 'not saved';
        }
    }
}
