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
        $cateModel = new Cate();
        $cate = $cateModel->getCate();
        $data = array();
        $data["cate"] = $cate;
        return view("manage/cate/add",array("data"=>$data));
    }

    public function test(){
        //$models = new Models("cate", array());
        //var_dump($models->getTable());
        $cateModel = new Cate();
        //$data = array('name'=>'火龙果');
        //$where = array('id' => 30);
        //$r = $cateModel->add(1,"火龙果");
        //$r = $cateModel->upData(array("name"=>"柠檬"),32);
        $r = $cateModel->getOne(32);
        var_dump($r);
    }
}
