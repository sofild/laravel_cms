<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function index(){
        $data = array();
        return view("manage/index/index", array("data"=>$data));
    }

    public function login(){
        return view("manage/index/login");
    }
}
