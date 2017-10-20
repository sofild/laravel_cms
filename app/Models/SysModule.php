<?php

namespace App\Models;

class SysModule extends Models
{
    public function __construct()
    {
        $table = "sys_module";
        $attributes = array();
        parent::__construct($table, $attributes);
    }
    
    public function lists(){
        $result =  $this->getList([], ["sm_sort", "asc"]);
        $data = [];
        foreach($result as $k=>$v){
            $data[$v["sm_id"]] = $v;
        }
        return $data;
    }

    
}
