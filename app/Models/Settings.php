<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Models
{
    public function __construct()
    {
        $table = "stttings";
        $attributes = array();
        parent::__construct($table, $attributes);
    }

    /*
     * 获取全部
     */
    public function getAll(){
        $list = $this->getList();
        $data = [];
        foreach($list as $k=>$v){
            $data[$v["key"]] = $v["value"];
        }
        return $data;
    }

    /*保存信息*/
    public function saveData($data){
        $data = $this->newQuery()->where("key", $data["key"])->first();
        $msg = '';
        if(empty($data)){
            $msg = '添加配置:';
            $this->exists = false;
        }
        else{
            $msg = '修改配置:';
            $this->exists = true;
        }
        $this->fillable = array_keys($data);
        $this->timestamps = false;
        $r = $this->fill($data)->save();
        if($r){
            $logs = new Logs();
            $logs->log(0, $msg.json_encode($data, JSON_UNESCAPED_UNICODE));
        }
        return $r;
    }

    /*
        保存全部
    */
    public function saveAll($data){
        $datas = $this->getAll();
        foreach($data as $k=>$v){
            if($datas[$k] != $v){
                $this->saveData(["key"=>$k, "value"=>$v]);
            }
        }
        return true;
    }
}
