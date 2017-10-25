<?php

namespace App\Models;

class Logs extends Models
{
    public function __construct()
    {
        $table = "logs";
        $attributes = array();
        parent::__construct($table, $attributes);
    }

    /*
     * 记录日志
     */
    public function log($id, $message){
        $data = array();
        $data["message"] = is_array($message) ? json_encode($message, JSON_UNESCAPED_UNICODE) : $message;
        $data["addtime"] = time();
        $data["tbid"] = intval($id);
        $data["uid"] = session("uid", 0);
        return $this->add($data);
    }

}
