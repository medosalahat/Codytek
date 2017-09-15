<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 15/09/17
 * Time: 05:33 م
 */
require_once 'method.php';

if(isset($_POST['title']) and !empty($_POST['title'])){
    $data = file_get_contents('category.json');

        $data = json_decode($data);
        $data = add_category($data,$_POST['title']);
        if( @file_put_contents('category.json',json_encode($data))){
            echo 'Category has been created ';
        }else{
            echo 'not saved';
        }

}