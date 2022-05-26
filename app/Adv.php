<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adv extends Model
{
    protected $table = "adv";
    public $fillable = ['name'];

    public function content()
    {
        return $this->hasMany('App\Advcontent', 'advid', 'id');
    }

}
