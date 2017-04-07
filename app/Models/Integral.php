<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Integral extends Models
{
    private $source;

    public function __construct()
    {
        $table = "integral_log";
        $attributes = array();
        parent::__construct($table, $attributes);
        //来源
        $this->source = array(
            "1" => array('integral'=>100,'note'=>'test')
        );
    }

    /*
     * 计算总积分
     * @param int $userId
     * @return int 
     */
    public function total($userId){
        return $this->newQuery()
            ->where("userid", $userId)
            ->sum("integral");
    }

    /*
     * 积分操作/加/减积分
     * @param int $userId
     * @param int $source
     * @return bool
     */
    public function op($userId, $source){
        $integral_info = $this->source[$source];
        $data = array();
        $data["source"] = $source;
        $data["integral"] = $integral_info["integral"];
        $data["note"] = $integral_info["note"];
        $data["addtime"] = time();
        $data["userid"] = $userId;
        return $this->add($data);
    }

    /*
     * 积分处理
     * @param int $userId
     * @param int $source
     * @return bool
     */
    public function process($userId, $source){
        $r = $this->op($userId, $source);
        if($r){
            $userModel = new User();
            $org_integral = $userModel->getIntegral($userId);
            $integral = $this->source[$source]["integral"];
            $now_integral = $org_integral + $integral;
            return $userModel->upIntegral($userId, $now_integral);
        }
        return $r;
    }
    
}
