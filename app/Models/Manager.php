<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manager extends Models
{
    public function __construct()
    {
        $table = "manager";
        $attributes = array();
        parent::__construct($table, $attributes);
    }

    /*
     * 获取用户信息
     * @param $username string
     * @param $password string
     * @param array
     */
    public function uInfo($username, $password){
        return $this->newQuery()
            ->where("username", $username)
            ->where("password", md5($password))
            ->first()
            ->attributes;
    }

    /*
     * 更新登录时间
     * @param int $uid
     */
    public function upLoginTime($uid){
        $data = array();
        $data["logintime"] = time();
        return $this->up($data, $uid);
    }
}
