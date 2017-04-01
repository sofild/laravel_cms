<?php

namespace App\Models;

class Cate extends Models
{
    public function __construct()
    {
        $table = "cate";
        $attributes = array();
        parent::__construct($table, $attributes);
    }

    /*
     * 新增分类
     * @param int $parentId
     * @param string $name
     * @return bool
     */
    public function saveCate($id, $parentId, $name){
        $data = array();
        $data["parent_id"] = $parentId;
        $data["name"] = $name;
        if($id > 0){
            return $this->up($data, $id);
        }
        else{
            $data["addtime"] = time();
            return $this->add($data);
        }
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
     * 获取分类名称
     * @param array $ids
     * @return array
     */
    public function getCateNames($ids){
        if(empty($ids)){
            return array();
        }
        $result = $this->newQuery()->whereIn("id", $ids)->get();
        $data_s = $this->formatResult($result);
        $return = array();
        foreach ($data_s as $k=>$v){
            $id = $v["id"];
            $name = $v["name"];
            $return[$id] = $name;
        }
        return $return;
    }

}
