<?php

namespace App\Http\Controllers\Manage;

use App\Models\Manager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SysMenu;

class IndexController extends Controller
{
    //
    public function index(){
        $uid = session("uid", 0);
        $username = session("username", "");
        $data = [];
        if($uid == 0){
            $data["uInfo"] = [];
        } else {
            //获取菜单
            $sys_menu_model = new SysMenu();
            $menu = $sys_menu_model->getMenus();
            //格式化输出
            $data["uInfo"] = ["uid" => $uid, "username" => $username];
            $data["menu"] = $menu;
        }
        return view("manage/index", array("data"=>json_encode($data)));
    }

    /*
     * 登录
     */
    public function login(){
        $username = request("username", "");
        $password = request("password", "");
        $managerModel = new Manager();
        $info = $managerModel->uInfo($username, $password);
        $return = array();
        if(empty($info)){
            $return["msg"] = "用户名或密码错误！";
            $return["status"] = 1001;
            return json_encode($return);
        }
        session(["uid" => $info["id"]]);
        session(["username" => $username]);
        //更新登录时间
        $managerModel->upLogin($info["id"]);
        $return["msg"] = "登录成功！";
        $return["status"] = 1000;
        $return["uinfo"] = $info;
        return json_encode($return);
    }
    
    public function test(){
        $phpExcel = new \PHPExcel();
        $phpExcel->getProperties()->setCreator("Maarten Balliauw")
            ->setLastModifiedBy("Maarten Balliauw")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");

        $phpExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hello')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');

        // Miscellaneous glyphs, UTF-8
        $phpExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');

        // Rename worksheet
        $phpExcel->getActiveSheet()->setTitle('Simple');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcel->setActiveSheetIndex(0);


        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="01simple.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = \PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;

    }
}
