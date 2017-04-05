<?php

namespace App\Http\Controllers\Manage;

use App\Models\Manager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function index(){
        $uid = session("uid", 0);
        if($uid==0){
            redirect("/manage/index/login");
            return;
        }
        $username = session("username", "");
        $data = array();
        $data["uid"] = $uid;
        $data["username"] = $username;
        return view("manage/index/index", array("data"=>$data));
    }

    /*
     * 登录
     */
    public function login(){
        if(!empty($_POST)){
            $this->_doLogin();
            return;
        }
        return view("manage/index/login");
    }

    /*
     * 处理登录
     */
    private function _doLogin(){
        $username = request("username", "");
        $password = request("password", "");
        $managerModel = new Manager();
        $info = $managerModel->uInfo($username, $password);
        $return = array();
        if(empty($info)){
            $return["msg"] = "用户名或密码错误！";
            $return["status"] = 1001;
            echo json_encode($return);
            return;
        }
        session(array("uid", $info["id"]));
        session(array("username", $username));
        //更新登录时间
        $managerModel->upLoginTime($info["id"]);
        $return["msg"] = "登录成功！";
        $return["status"] = 1000;
        $return["url"] = "/manage";
        echo json_encode($return);
        return;
    }
}
