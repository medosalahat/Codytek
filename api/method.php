<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 15/09/17
 * Time: 03:06 م
 */
ini_set('display_errors', true);
error_reporting(E_ALL);
function get_category($data ,$id){
    foreach ($data as $index=>$item) {
        if($item->id == $id){
            return($item);
        }
    }
}
function update_category($data ,$id,$title){
    foreach ($data as $index=>$item) {
        if($item->id == $id){
            $item->title = $title;
        }
    }
    return $data;
}
function search_category($data ,$id){
    foreach ($data as $index=>$item) {
        if($item->id == $id){
            unset($data->$index);
        }
    }
    return $data;
}
function add_category($data ,$title){
    $id = ((int) (count((array)$data)))+1;
    $object = new StdClass();
    $object->id = $id;
    $object->title = $title;
    return (object) array_values(array_merge((array) $data,[$object]));
}
function get_task($data ,$id){
    foreach ($data as $index=>$item) {
        if($item->id == $id){
            return($item);
        }
    }
}
function update_task($data ,$id,$post_data){
    foreach ($data as $index=>$item) {
        if($item->id == $id){
            $item->title = $post_data['title'];
            $item->category_id = $post_data['category_id'];
            $item->description = $post_data['description'];
            $item->tags = $post_data['tags'];
            $item->due_date = $post_data['due_date'];
        }
    }
    return $data;
}
function add_task($data ,$post_data){
    $id = ((int) (count((array)$data)))+1;
    $object = new StdClass();
    $object->id = $id;
    $object->title = $post_data['title'];
    $object->category_id = $post_data['category_id'];
    $object->description = $post_data['description'];
    $object->tags = $post_data['tags'];
    $object->due_date = $post_data['due_date'];
    return (object) array_values(array_merge((array) $data,[$object]));
}
function search_task($data ,$id,$by){
    foreach ($data as $index=>$item) {
       if($by){
           if($item->category_id == $id){
               unset($data->$index);
           }
       }else{
           if($item->id == $id){
               unset($data->$index);
           }
       }
    }
    return $data;
}