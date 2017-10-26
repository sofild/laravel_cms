<?php

namespace App\Models;

class Monitor extends Models
{
    public function __construct()
    {
        $table = "monitor";
        $attributes = array();
        parent::__construct($table, $attributes);
    }

    /*
     * 新增
     * @param int $parentId
     * @param string $name
     * @return bool
     */
    public function addData($time, $url){
        $data = [];
        $data["time"] = $time;
        $data["date"] = date("Ymd", $time);
        $data["ip"] = ip2long($_SERVER["REMOTE_ADDR"]);
        $data["url"] = ''.$url.'';
        $data["addtime"] = time();
        $this->add($data);
    }


}
