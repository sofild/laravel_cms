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
        if(!empty($_GET)){
            $action = request("action","");
            switch ($action){
                case "get_new":
                    return $this->_getNew();
                    break;
                case "get_list":
                    return $this->_getList();
                    break;
            }
        }
        return view("manage/news/index", array("data"=>$this->assignData));
    }

    // 获取新闻信息
    private function _getNew(){
        $id = request("id", 0);
        $cate_id = request("cate_id", 0);
        $data = [];
        if($id == 0 && $cate_id == 0) {
            $data["status"] = 1001;
            $data["msg"] = "数据异常，请刷新页面重新操作";
            return json_encode($data);
        }
        $newsModel = new News();
        if($cate_id > 0) {
            $info = $newsModel->getByCateId($cate_id);
        }
        if($id > 0) {
            $info = $newsModel->getOne($id);
        }
        $data["status"] = 1000;
        $data["info"] = $this->_formatNew($info);
        return json_encode($data);
    }

    //格式化新闻信息
    private function _formatNew($data){
        $new = [];
        if(empty($data)){
            $new["title"] = '';
            $new['description'] = '';
            $new["pic"] = '';
            $new["content"] = '';
            $new["author"] = '';
            return $new;
        }
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

    // 获取新闻列表
    private function _getList(){
        $cate_id = request("cate_id", -1);
        $page = request("page", 1);
        $data = [];
        if($cate_id < 0) {
            $data["status"] = 1001;
            $data["msg"] = "数据异常，请刷新页面重新操作";
            return json_encode($data);
        }
        $newsModel = new News();
        $total = $newsModel->getTotal($cate_id);
        $info = $newsModel->getList(["cate_id = ".$cate_id.""], ["id","desc"], [($page-1) * 20, 20]);
        $data["total"] = $total;
        $data["status"] = 1000;
        $data["info"] = $this->_formatList($info);
        return json_encode($data);
    }

    public function add(){
        return view("manage/news/add", array("data"=>["info"=>["pic"=>'']]));
    }

    // 保存
    public function save(){
        $title = request("title","");
        $cate_id = request("cate_id", 0);
        $description = request("description", "");
        $content = request("content", "");
        $pic = request("pic", "");
        $author = session("MANAGE_UID", 0);
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

    /*
     * 格式化列表数据
     * @param array $data
     * @return array
     */
    private function _formatList($info){
        $data = [];
        foreach($info as $k=>$v){
            $new = [];
            $new["title"] = $v["title"];
            $new["description"] = $v["description"];
            $new["addtime"] = date("Y-m-d H:i", $v["addtime"]);
            $new["pic"] = $v["pic"];
            $data[] = $new;
        }
        return $data;
    }
}
