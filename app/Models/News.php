<?php

namespace App\Models;

class News extends Models
{
    public function __construct()
    {
        $table = "news";
        $attributes = array();
        parent::__construct($table, $attributes);
    }
    
    public function saveNews($id, $title, $cate_id, $description, $content, $pic, $author){
        $data = array();
        $data["title"] = $title;
        $data["cate_id"] = $cate_id;
        $data["description"] = $description;
        $data["content"] = $content;
        $data["pic"] = $pic;
        $data["author"] = $author;
        $data["addtime"] = time();
        if($id > 0){
            return $this->up($data, $id);
        }
        else{
            return $this->add($data);
        }
    }
}
