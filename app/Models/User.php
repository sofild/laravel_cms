<?php

namespace App\Models;

class User extends Models
{
    public function __construct()
    {
        $table = "user";
        $attributes = array();
        parent::__construct($table, $attributes);
    }

    /*
     * 保存用户信息
     * @param int $id
     * ...
     * @return bool
     */
    public function saveUser($id, $uid, $username, $password, $integral=0){
        $data = array();
        $data["uid"] = $uid;
        $data["username"] = $username;
        $data["password"] = md5($password);
        $data["integral"] = $integral;
        if($id > 0){
            return $this->up($data, $id);
        }
        else{
            $data["logintime"] = time();
            $data["addtime"] = time();
            return $this->add($data);
        }
    }

    /*
     * 用户登录
     */
    public function login($username, $password){
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
    public function upLoginTime($id){
        $data = array();
        $data["logintime"] = time();
        return $this->up($data, $id);
    }
}
