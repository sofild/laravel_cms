<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\Logs;

class ManagerController extends Controller
{
    private $uid;
    private $username;
    public function __construct(){
        $uid = session("uid", 0);
        $username = session("username", "");
        $this->uid = $uid;
        $this->username = $username;
    }

    //
    public function index(){
        if(!empty($_GET)){
            $action = request("action","");
            switch ($action){
                case "get_info":
                    return $this->_getInfo();
                    break;
                case "get_list":
                    return $this->_getList();
                    break;
                case "del":
                    return $this->_del();
                    break;
            }
        }
        if(!empty($_POST)){
            $action = request("action","");
            switch ($action){
                case "save_info":
                    return $this->_saveInfo();
                    break;
                case "save_pass":
                    return $this->_savePass();
                    break;
            }
        }
        return;
    }

    // 获取用户信息
    private function _getInfo(){
        $id = request("id", 0);
        $data = [];
        if($id == 0) {
            $data["status"] = 1001;
            $data["msg"] = "数据异常，请刷新页面重新操作";
            return json_encode($data);
        }
        $managerModel = new Manager();
        $info = $managerModel->getOne($id);
        if(!empty($info)){
            $info["hasAvatar"] = empty($info["avatar"]) ? 0 : 1;
            $info["password"] = "***";
        }
        $data["status"] = 1000;
        $data["info"] = $info;
        return json_encode($data);
    }

    // 获取列表
    private function _getList(){
        $data = [];
        $model = new Manager();
        $info = $model->getList();
        $data["status"] = 1000;
        $data["info"] = $this->_formatList($info);
        return json_encode($data);
    }

    // 保存
    public function _saveInfo(){
        $info = [];
        $info["username"] = request("username","");
        $info["telphone"] = request("telphone", "");
        $info["avatar"] = request("avatar", "");
        $job = request("job", "");
        if(!empty($job)){
            $info["job"] = $job;
        }
        $password = request("password", "");
        if(!empty($password) && $password!="***"){
            $info["password"] = $password;
        }
        $info["id"] = request("id", 0);
        $model = new Manager();
        $same = $model->getSameUser($info["username"], $info["id"]);
        $data = [];
        if($same){
            $data["status"] = 1001;
            $data["msg"] = "存在同名用户，请修改！";
            return json_encode($data);
        }
        $r = $model->saveData($info);
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

    // 保存
    public function _savePass(){
        $info = [];
        $old_pass = request("old_pass","");
        $uid = request("id", 0);
        $model = new Manager();
        $uInfo = $model->getOne($uid);
        if($uInfo["password"]!=md5($old_pass)){
            $data["status"] = 1001;
            $data["msg"] = "原密码错误！";
            return json_encode($data);
        }
        $info["password"] = request("new_pass", "");
        $info["id"] = $uid;
        $r = $model->saveData($info);
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

    /*
     * 格式化列表数据
     * @param array $data
     * @return array
     */
    private function _formatList($info){
        $data = [];
        foreach($info as $k=>$v){
            $m = [];
            $m["id"] = $v["id"];
            $m["username"] = $v["username"];
            $m["password"] = "***";
            $m["addtime"] = date("Y-m-d H:i", $v["addtime"]);
            $m["logintime"] = $v["logintime"] > 0 ? date("Y-m-d H:i", $v["logintime"]) : '';
            $m["job"] = $v["job"];
            $m["telphone"] = $v["telphone"];
            $m["loginip"] = $v["loginip"];
            $m["avatar"] = !empty($v["avatar"]) ? $v["avatar"] : '/img/no-people.jpg';
            $data[] = $m;
        }
        return $data;
    }

    /*
     * 删除
     */
    private function _del(){
        $id = request("id", 0);
        $data = [];
        if($id == 0) {
            $data["status"] = 1001;
            $data["msg"] = "数据异常，请刷新页面重新操作";
            return json_encode($data);
        }
        $model = new Manager();
        $r = $model->del($id);
        if($r){
            $logs = new Logs();
            $logs->log($id, "删除管理员");
            $data["status"] = 1000;
            $data["msg"] = "删除成功！";
        }
        else{
            $data["status"] = 1001;
            $data["msg"] = "删除失败！";
        }
        return json_encode($data);
    }
}
