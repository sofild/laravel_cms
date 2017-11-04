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
        $data = $this->newQuery()
            ->where("username", $username)
            ->where("password", md5($password))
            ->first();
        //var_dump($this->getLastSql(), md5($password));
        if(empty($data)){
            return array();
        }
        return $data->attributes;
    }

    /*
     * 更新登录时间
     * @param int $uid
     */
    public function upLogin($uid){
        $data = array();
        $data["logintime"] = time();
        $data["loginip"] = $_SERVER["REMOTE_ADDR"];
        $logs = new Logs();
        $logs->log($uid, "登录");
        return $this->up($data, $uid);
    }

    /*保存信息*/
    public function saveData($data){
        if(isset($data["password"])){
            $data["password"] = md5($data["password"]);
        }
        if($data["id"] > 0){
            $id = $data["id"];
            unset($data["id"]);
            $r = $this->up($data, $id);
        }
        else{
            $data["addtime"] = time();
            $r = $this->add($data);
            $id = 0;
        }
        $logs = new Logs();
        if($r){
            $logs->log($id, $data);
        }
        return $r;
    }

    /*
        获取相同Username，不同ID的用户
    */
    public function getSameUser($username, $uid){
        $data = $this->newQuery()
            ->where("username", $username)
            ->where("id", "<>", $uid)
            ->first();
        if(empty($data)){
            return false;
        }
        return true;
    }
}
