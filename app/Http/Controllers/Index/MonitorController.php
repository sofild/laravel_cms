<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Monitor;

class MonitorController extends Controller
{
    public function index(){
        $model = new Monitor();
        $time = request("firstTime", 0);
        $url = request("url", "");
        $model->addData($time, $url);
    }
}
