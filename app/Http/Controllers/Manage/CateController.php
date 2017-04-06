<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cate;
use App\Models\Models;

class CateController extends Controller
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
        return view("manage/cate/index",array("data"=>$this->assignData));
    }

    /*
     * 列表展示
     */
    public function data(){
        $cateModel = new Cate();
        $data = $cateModel->getCate();
        $list = $this->_formatList($data);
        echo json_encode($list);
        return;
    }

    /*
     * 格式化列表
     */
    private function _formatList($cate, $start=0, $list=[]){
        foreach($cate as $k=>$v){
            $list[$start] = $v;
            $list[$start]["time"] = date("Y-m-d H:i:s",$v["addtime"]);
            if($v["parent_id"] > 0){
                $list[$start]["name"] = "|-".$v["name"];
            }
            $start++;
            if(!empty($v["child"])){
                $this->_formatList($v["child"], $start, $list);
            }
        }
    }

    //编辑
    public function add(){
        $request = new Request();
        $method = $request->method();
        if($method=='POST'){
            $this->_doAdd();
            return;
        }
        $cateModel = new Cate();
        $id = request("id", 0);
        $data = array();
        $cateInfo = array();
        $cateInfo["id"] = 0;
        $cateInfo["name"] = '';
        if($id > 0){
            $cateInfo = $cateModel->getOne($id);
        }
        $this->assignData["cateInfo"] = $cateInfo;
        $cate = $cateModel->getCate();
        $this->assignData["cate"] = $cate;
        return view("manage/cate/add",array("data"=>$this->assignData));
    }

    public function _doAdd(){
        $name = request("name","");
        $parent_id = request("parent_id", 0);
        $id = request("id", 0);
        if($name==""){
            back();
            return false;
        }
        $cateModel = new Cate();
        $r = $cateModel->saveCate($id, $parent_id, $name);
        if($r){
            redirect("/manage/cate/index");
        }
        else{
            back();
        }
    }
}
