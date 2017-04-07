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
        $data = $this->newQuery()
            ->where("username", $username)
            ->where("password", md5($password))
            ->first();
        if(empty($data)){
            return array();
        }
        return $data->attributes;
    }

    /*
     * 更新登录时间
     * @param int $id
     */
    public function upLoginTime($id){
        $data = array();
        $data["logintime"] = time();
        return $this->up($data, $id);
    }

    /*
     * 更新积分
     * @param int $id
     * @param int $integral
     */
    public function upIntegral($id, $integral){
        if($integral==0 || $id==0){
            return false;
        }
        $data = array();
        $data["integral"] = $integral;
        return $this->up($data, $id);
    }

    /*
     * 获取积分
     * @param int $id
     * @return int
     */
    public function getIntegral($id){
        $uInfo = $this->getOne($id);
        return intval($uInfo["integral"]);
    }
}
