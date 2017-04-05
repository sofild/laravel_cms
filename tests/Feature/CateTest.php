<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CateTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testIndex(){
        $response = $this->call('GET', '/manage/cate');
        $this->assertEquals(200, $response->status());
    }

    public function testAdd(){
        $this->call("POST", "/manage/cate/add", ["parent_id"=>1, "name"=>"雪梨"]);
    }
}
