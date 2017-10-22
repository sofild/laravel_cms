<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    public function index(){
        $request = new Request();
        if(!$request->hasFile("upload")){
            $data["msg"] = '上传失败，请重新上传1';
            $data["status"] = 1001;
            return json_encode($data);
        }
        $path = $this->saveFile("upload");
        $data = array();
        if($path==""){
            $data["msg"] = '上传失败，请重新上传2';
            $data["status"] = 1002;
            return json_encode($data);
        }
        $data["msg"] = "上传成功！";
        $data["status"] = 1000;
        $data["path"] = $path;
        return json_encode($data);
    }

    /*
     * 保存文件
     * @param string $fieldName
     * @param string $dir
     * @param return
     */
    public function saveFile($fieldName, $dir='upload'){
        $request = new Request();
        $path = $request->file($fieldName)->store($dir);
        return $path;
    }

}
