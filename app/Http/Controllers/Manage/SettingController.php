<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings;

class SettingController extends Controller
{
    private $uid;
    private $username;
    private $assignData;
    public function __construct(){
        $uid = session("uid", 0);
        $username = session("username", "");
        $this->uid = $uid;
        $this->username = $username;
        $this->assignData["uid"] = $uid;
        $this->assignData["username"] = $username;
    }

    //
    public function index(){
        if(!empty($_GET)){
            $action = request("action","");
            switch ($action){
                case "get":
                    return $this->_get();
                    break;
            }
        }
        if(!empty($_POST)){
            $action = request("action","");
            switch ($action){
                case "save":
                    return $this->save();
                    break;
            }
        }
        return;
    }

    // 获取配置信息
    private function _get(){
        $model = new Settings();
        $info = $model->getAll();
        $data["status"] = 1000;
        $data["info"] = $info;
        return json_encode($data);
    }

    // 保存
    public function save(){
        $data = [];
        $data["title"] = request("title","");
        $data["description"] = request("description", "");
        $data["keywords"] = request("keywords", "");
        $data["icon"] = request("icon", "");
        $data["code"] = request("code", "");
        $model = new Settings();
        $r = $model->saveAll($data);
        $data = [];
        if($r){
            $data["status"] = 1000;
            $data["msg"] = "保存成功！";
        }
        else{
            $data["status"] = 1001;
            $data["msg"] = "保存失败！";
        }
        return json_encode($data);
    }
}
