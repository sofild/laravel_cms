<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Models extends Model
{
    //
    protected $table;
    public function __construct($table, array $attributes)
    {
        parent::__construct($attributes);
        $this->table = $table;
        DB::connection()->enableQueryLog(); // 开启查询日志
    }

    /*
     * 获取单条数据
     * @param int $id
     * 各种花式用法，参见：\Illuminate\Database\Eloquent\Builder
     */
    function getOne($id){
        $data = $this->newQuery()->where("id", $id)->first();
        if(empty($data)){
            return array();
        }
        return $data->attributes;
    }

    /*
     * 获取分类列表
     * @param array $where
     * @param array $order
     * @param array $limit
     */
    public function getList($where=array(), $order=array(), $limit=array()){
        $model = $this->newQuery();
        if(!empty($where)){
            foreach($where as $k=>$v){
                $data = explode(" ", $v);
                if(!empty($data)){
                    $op = trim($data[1]);
                    if($op=='=='){
                        $model->where($data[0], $data[2]);
                    }
                    else{
                        $model->where($data[0],$data[1],$data[2]);
                    }
                }
            }
        }
        if(!empty($order)){
            $model->orderBy($order[0], $order[1]);
        }
        if(!empty($limit)){
            $model->offset($limit[0]);
            $model->limit($limit[1]);
        }
        $result = $model->get();
        return $this->formatResult($result);
    }

    /*
     * 新增
     */
    public function add($data){
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
    public function up($data,$id){
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


    /*
     * 格式化结果
     * @param array $result
     * @return array
     */
    public function formatResult($result){
        $data_s = array();
        foreach($result as $k=>$v){
            $data_s[] = $v->attributes;
        }
        return $data_s;
    }

    /*
        获取最后执行的SQL
    */
    function getLastSql(){
        $sql = DB::getQueryLog();
        $query = end($sql);
        return $query;
    }
}
