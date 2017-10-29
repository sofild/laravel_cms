<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    public function index(){
        if(empty($_FILES["upload"])){
            $data["msg"] = '上传失败，请重新上传';
            $data["errno"] = 1001;
            $data["data"] = [];
            return json_encode($data);
        }
        $file = $_FILES["upload"];
        if($file["error"] > 0){
            $data["msg"] = '上传失败，请重新上传';
            $data["errno"] = 1002;
            $data["data"] = [];
            return json_encode($data);
        }
        $uploadConf = config('filesystems.disks')["uploads"];
        if(!in_array($file["type"], $uploadConf["allowType"])){
            $data["msg"] = '图片类型不符';
            $data["errno"] = 1003;
            $data["data"] = [];
            return json_encode($data);
        }
        if($file["size"] > $uploadConf["maxSize"]) {
            $data["msg"] = '文件太大';
            $data["errno"] = 1004;
            $data["data"] = [];
            return json_encode($data);
        }
        $saveFileName = time().rand(100,999).".".pathinfo($file["name"])["extension"];
        $saveDir = date("Ymd", time());
        if(!file_exists($uploadConf["root"]."/".$saveDir)){
            mkdir($uploadConf["root"]."/".$saveDir);
        }
        $saveFile = $uploadConf["root"]."/".$saveDir."/".$saveFileName;
        if(!move_uploaded_file($file["tmp_name"], $saveFile)){
            $data["msg"] = '上传失败，请重新上传';
            $data["errno"] = 1005;
            $data["data"] = [];
            return json_encode($data);
        }
        $data["errno"] = 0;
        $data["data"] = ["/uploads/".$saveDir."/".$saveFileName];
        return json_encode($data);
    }
}
