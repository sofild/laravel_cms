<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Cate;

class CateTest extends TestCase
{
    public function testModel_saveCate(){
        

    }

    public function testModel_getCate(){
        $cate = new Cate();
        //var_dump($cate->getCate());
        $this->assertInternalType("array", $cate->getCate());
    }

    public function testModel_getCateNames(){
        $cate = new Cate();
        $data = $cate->getOne(1);
        $id = $data["id"];
        $name = $data["name"];
        $expect = array();
        $expect[$id] = $name;
        $this->assertEquals($expect, $cate->getCateNames(array(1)));
    }

    public function testPage_Index(){
        $response = $this->call('GET', '/manage/cate');
        $this->assertEquals(200, $response->status());
    }

    public function testPage_Data(){
        $response = $this->call('GET', '/manage/cate/data');
        $this->assertEquals(200, $response->status());
    }

    public function testPage_Add(){
        $response = $this->call('GET', '/manage/cate/add');
        $this->assertEquals(200, $response->status());
    }

    public function testPage_DoAdd(){
        $response = $this->call("POST", "/manage/cate/add", ["parent_id"=>1, "name"=>"雪梨"]);
        $this->assertEquals(200, $response->status());
    }
}
