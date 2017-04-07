<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
use App\Models\Integral;

class UserTest extends TestCase
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

    public function testModel_saveUser(){
        $user = new User();
        $uInfo = $user->login("sofild", "123456");
        if(empty($uInfo)){
            $return = $user->saveUser(0, 'e3600ea7131c02b4adef97031393f22469a26dd0','sofild','e10adc3949ba59abbe56e057f20f883e');
            $this->assertInternalType("int", $return);
        }
        else{
            $return = $user->saveUser($uInfo["id"], 'e3600ea7131c02b4adef97031393f22469a26dd0','sofild','123456');
            $this->assertTrue($return);
        }
    }

    public function testModel_process(){
        $integral = new Integral();
        $r = $integral->process(3, 1);
        $this->assertTrue($r);
    }
}
