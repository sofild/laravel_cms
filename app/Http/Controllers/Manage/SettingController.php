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
        if($uid==0){
            redirect("/manage/index/login");
            return;
        }
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
        $title = request("title","");
        $cate_id = request("cate_id", 0);
        $description = request("description", "");
        $content = request("content", "");
        $pic = request("pic", "");
        $author = request("author", "");
        $id = request("id", 0);
        $newsModel = new News();
        $r = $newsModel->saveNews($id,$title,$cate_id,$description,$content,$pic,$author);
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
