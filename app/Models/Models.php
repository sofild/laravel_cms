<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    //
    protected $table;
    public function __construct($table, array $attributes)
    {
        parent::__construct($attributes);
        $this->table = $table;
    }

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

    /*
     * 递归获取分类及子分类信息
     * @param int $pCateId
     * @param array
     */
    public function getCate($pCateId=0){
        $where = array("parent_id = ".$pCateId."");
        $cate_data = $this->getList($where, array("id", "asc"));
        if(!empty($cate_data)){
            foreach($cate_data as $k=>$v){
                $cate_data[$k]["child"] = $this->getCate($v["id"]);
            }
        }
        return $cate_data;
    }

    /*
     * 新增
     */
    public function add($parentId, $name){
        $data = array();
        $data["parent_id"] = $parentId;
        $data["name"] = $name;
        $data["addtime"] = time();
        $this->fillable = array_keys($data);
        $this->exists = false;
        $this->timestamps = false;
        $r = $this->fill($data)->save();
        if($r){
            return $this->attributes["id"];
        }
        else{
            return false;
        }
    }

    /*
     * 更新信息
     * @param array $data
     * @param array $where
     * @return bool
     * @usage：upData(array('name'=>'橘子'),22);
     */
    public function upData($data,$id){
        $this->timestamps = false;
        $old = $this->getOne($id);
        if(empty($old)){
            return false;
        }
        foreach($old as $k=>$v){
            if(!isset($data[$k])){
                $data[$k] = $v;
            }
        }
        $this->fillable = array_keys($data);
        $this->exists = true;
        return $this->fill($data)->save();
    }

    /*
     * 删除
     * @param array $where
     * @return bool
     * @usage del(30)
     */
    public function del($id){
        $data = $this->getOne($id);
        if(empty($data)){
            return true;
        }
        $this->exists = true;
        $this->attributes = $data;
        return $this->delete();
    }
}
