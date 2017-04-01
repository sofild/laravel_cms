<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    //
    public function index(){
        $data = array();
        return view("manage/news/index", array("data"=>$data));
    }

    public function add(){
        $data = array();
        return view("manage/news/add", array("data"=>$data));
    }
}
