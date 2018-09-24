<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
    protected $connection = 'mysql';  // 多数据库操作时最好进行绑定
    protected $table = 'statistics'; // 指定表
    public $timestamps = true;  // 是否自动维护时间戳
}
