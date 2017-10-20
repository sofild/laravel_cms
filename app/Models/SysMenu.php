<?php

namespace App\Models;

class SysMenu extends Models
{
    public function __construct()
    {
        $table = "sys_menu";
        $attributes = array();
        parent::__construct($table, $attributes);
    }

    /*
     * 新增
     * @param int $sme_id
     * @param int $sme_sm_id
     * @param int $sme_parent_id
     * @param string $sme_title
     * @param string $sme_path
     * @return bool
     */
    public function saveMenu($sme_id, $sme_sm_id, $sme_parent_id, $sme_title, $sme_path){
        $data = array();
        $data["sme_sm_id"] = $sme_sm_id;
        $data["sme_parent_id"] = $sme_parent_id;
        $data["sme_title"] = $sme_title;
        $data["sme_path"] = $sme_path;
        if($sme_id > 0){
            return $this->up($data, $sme_id);
        }
        else{
            $data["sme_addtime"] = time();
            return $this->add($data);
        }
    }

    /*
     * 递归获取菜单及子菜单信息
     * @param int $pCateId
     * @param array
     */
    public function getChild($sme_id=0){
        $where = array("sme_parent_id = ".$sme_id."");
        $cate_data = $this->getList($where, array("sme_id", "asc"));
        if(!empty($cate_data)){
            foreach($cate_data as $k=>$v){
                $cate_data[$k]["child"] = $this->getChild($v["sme_id"]);
            }
        }
        return $cate_data;
    }

    /*
     * 获取菜单信息
     * @param array $sm_ids
     * @return array
     */
    public function getMenusByModule($sm_ids){
        $result = $this->newQuery()->whereIn("sme_sm_id", $sm_ids)->where("sme_type","=", 1)->orderBy("sme_sort", "desc")->get();
        $results = $this->formatResult($result);
        $data = [];
        foreach($results as $k=>$v){
            if(!isset($data[$v["sme_sm_id"]])){
                $data[$v["sme_sm_id"]] = [];
            }
            $data[$v["sme_sm_id"]][] = $v;
        }
        return $data;
    }
    
    /*
     * 格式化菜单信息
     * @param array $menus
     * @return array
     */
    public function formatMenu($menus){
        $data = [];
        foreach($menus as $mk=>$mv){
            if(!isset($data[$mv["sme_parent_id"]])){
                $data[$mv["sme_parent_id"]] = [];
            }
            $data[$mv["sme_parent_id"]][] = $mv;
        }
        return $data;
    }

    /*
     * 获取菜单
     * @return array
     */
    public function getMenus(){
        $sys_module = new SysModule();
        $modules = $sys_module->lists();
        $sm_ids = [];
        $data = [];
        foreach($modules as $k=>$v){
            $sm_ids[] = $v["sm_id"];
        }
        if(empty($sm_ids)){
            return [];
        }
        $menus = $this->getMenusByModule($sm_ids);
        foreach($menus as $mk=>$mv){
            $data[$mk] = $this->formatMenu($mv);
        }
        foreach($modules as $k=>$v){
            $modules[$k]["child"] = isset($data[$k]) ? $data[$k] : [];
        }
        return $modules;
    }


}
