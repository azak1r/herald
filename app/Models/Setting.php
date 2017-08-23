<?php

namespace nullx27\Herald\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{

    protected $fillable = ['key', 'value'];
    public $timestamps = false;

    public static function key($name)
    {
        return Cache::get($name);
    }

}
