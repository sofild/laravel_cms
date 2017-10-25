<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Manager;

class ManagerController extends Controller
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
                case "get_info":
                    return $this->_getInfo();
                    break;
                case "get_list":
                    return $this->_getList();
                    break;
                case "del":
                    return $this->_del();
                    break;
                case "save":
                    return $this->_save();
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
    public function _save(){
        $info = [];
        $info["username"] = request("username","");
        $info["password"] = request("password", "");
        $info["grade"] = request("grade", 1);
        $info["job"] = request("job", "");
        $info["telphone"] = request("telphone", "");
        $info["id"] = request("id", 0);
        $model = new Manager();
        $r = $model->saveData($info);
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

    /*
     * 格式化列表数据
     * @param array $data
     * @return array
     */
    private function _formatList($info){
        $data = [];
        foreach($info as $k=>$v){
            $m = [];
            $m[$k] = $v;
            if($k == "password") {
                $m[$k] = "***";
            }
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
