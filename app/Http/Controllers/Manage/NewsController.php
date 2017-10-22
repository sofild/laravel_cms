<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Cate;

class NewsController extends Controller
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
        if(!empty($_POST)){
            $action = request("action","");
            switch ($action){
                case "get_new":
                    return $this->_getNew();
                    break;
            }
        }
        return view("manage/news/index", array("data"=>$this->assignData));
    }

    // 获取新闻信息
    private function _getNew(){
        $id = request("id", 0);
        $data = [];
        if($id == 0) {
            $data["err"] = 1;
            $data["msg"] = "数据异常，请刷新页面重新操作";
            return json_encode($data);
        }
        $newsModel = new News();
        $info = $newsModel->getOne($id);
        $data["err"] = 0;
        $data["info"] = $this->_formatNew($info);
        return json_encode($data);
    }

    //格式化新闻信息
    private function _formatNew($data){
        $new = [];
        foreach($data as $k => $v){
            $new[$k] = $v;
            if($k=="addtime"){
                $new["addtime"] = date("Y-m-d H:i", $v);
            }
            if($k=="content"){
                $new["content"] = htmlspecialchars_decode($v);
            }
        }
        return $new;
    }

    public function add(){
        if(!empty($_POST)){
            $this->_doAdd();
            return;
        }
        $cateModel = new Cate();
        $newsModel = new News();
        $id = request("id", 0);
        if($id > 0){
            $info = $newsModel->getOne($id);
            $this->assignData["info"] = $info;
        }
        $cate = $cateModel->getCate();
        $this->assignData["cate"] = $cate;
        return view("manage/news/add", array("data"=>$this->assignData));
    }

    private function _doAdd(){
        $title = request("title","");
        $cate_id = request("cate_id", 0);
        $description = request("description", "");
        $content = request("content", "");
        $pic = request("pic", "");
        $author = session("MANAGE_UID", 0);
        $id = request("id", 0);
        if($title=="" || $cate_id==0){
            back();
            return false;
        }
        $newsModel = new News();
        $r = $newsModel->saveNews($id,$title,$cate_id,$description,$content,$pic,$author);
        if($r){
            redirect("/manage/news/index");
        }
        else{
            back();
        }
    }

    public function data(){
        $newsModel = new News();
        $where = array();
        $order = array("addtime", "desc");
        $limit = array(0,100);
        $data = $newsModel->getList($where, $order, $limit);
        $list = $this->_formatList($data);
        echo json_encode($list);
        return;
    }

    /*
     * 格式化列表数据
     * @param array $data
     * @return array
     */
    private function _formatList($data){
        $cateIds = array();
        foreach ($data as $k=>$v){
            $cateIds[] = $v["cate_id"];
        }
        $cateModel = new Cate();
        $cateNames = $cateModel->getCateNames($cateIds);
        foreach($data as $k=>$v){
            $cateId = $v["cate_id"];
            $name = $cateNames[$cateId];
            $time = date("Y-m-d H:i:s",$v["addtime"]);
            $data[$k]["cate_name"] = $name;
            $data[$k]["time"] = $time;
            $data[$k]["imgUrl"] = '<img src="'.$v["pic"].'" width="50px" height="50px" />';
            $data[$k]["op"] = '<a href="/manage/news/add/'.$v["id"].'">修改</a> &nbsp;&nbsp; <a href="/manage/news/del/'.$v["id"].'">删除</a>';
        }
        return $data;
    }
}
