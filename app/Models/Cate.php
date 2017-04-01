<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class Cate extends Models
{
    public function __construct()
    {
        $table = "cate";
        $attributes = array();
        parent::__construct($table, $attributes);
    }


}
