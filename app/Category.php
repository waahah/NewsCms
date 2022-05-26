<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category";
    public $fillable = ['pid', 'name', 'sort'];
    public function content()
    {
        return $this->hasMany('App\Content', 'cid', 'id')->orderBy('id', 'desc')->limit(1);
    }
}
