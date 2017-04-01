<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cate;
use App\Models\Models;

class CateController extends Controller
{
    //
    public function index(){
        $cateModel = new Cate();
        $data = $cateModel->getCate();
        return view("manage/cate/index",array("data"=>$data));
    }

    //编辑
    public function add(){
        if(!empty($_POST)){
            $this->_doAdd();
            return;
        }
        $cateModel = new Cate();
        $id = request("id", 0);
        $data = array();
        if($id > 0){
            $cateInfo = $cateModel->getOne($id);
            $data["cateInfo"] = $cateInfo;
        }
        $cate = $cateModel->getCate();
        $data["cate"] = $cate;
        return view("manage/cate/add",array("data"=>$data));
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
