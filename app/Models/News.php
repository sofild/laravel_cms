<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = "news";

    /*
     * 获取单条数据
     * @param int $id
     * 各种花式用法，参见：\Illuminate\Database\Eloquent\Builder
     */
    function getOne($id){
        return $this->newQuery()->where("id", $id)->first()->attributes;
    }

    /*
     * 获取分类列表
     * @param array $where
     * @param array $order
     * @param array $limit
     */
    public function getList($where=array(), $order=array(), $limit=array()){
        $cateModel = $this->newQuery();
        if(!empty($where)){
            foreach($where as $k=>$v){
                $data = explode(" ", $v);
                if(!empty($data)){
                    $op = trim($data[1]);
                    if($op=='=='){
                        $cateModel->where($data[0], $data[2]);
                    }
                    else{
                        $cateModel->where($data[0],$data[1],$data[2]);
                    }
                }
            }
        }
        if(!empty($order)){
            $cateModel->orderBy($order[0], $order[1]);
        }
        if(!empty($limit)){
            $cateModel->offset($limit[0]);
            $cateModel->limit($limit[1]);
        }
        $result = $cateModel->get();
        $data_s = array();
        foreach($result as $k=>$v){
            $data_s[] = $v->attributes;
        }
        return $data_s;
    }
    
    
}
