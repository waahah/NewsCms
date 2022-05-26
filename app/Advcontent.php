<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advcontent extends Model
{
    protected $table = "adcontent";
    public $fillable = ['advid','path'];
    public function position()
    {
        return $this->belongsTo('App\Adv', 'advid', 'id');
    }
}
