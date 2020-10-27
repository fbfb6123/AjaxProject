<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsvUser extends Model
{
    //ブラックリスト方式
    protected $guarded = ['id'];
}
