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

    /*
     * 获取单条数据
     * @param int $cate_id
     * 各种花式用法，参见：\Illuminate\Database\Eloquent\Builder
     */
    function getByCateId($cate_id){
        $data = $this->newQuery()->where("cate_id", $cate_id)->first();
        if(empty($data)){
            return array();
        }
        return $data->attributes;
    }

    /*
     * 统计数据总量
     */
    function getTotal($cate_id){
        $data = $this->newQuery()->where("cate_id", $cate_id)->count();
        return $data;
    }
}
