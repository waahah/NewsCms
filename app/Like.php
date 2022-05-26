<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public $fillable = ['cid', 'uid'];

    public function content(){
        return $this->belongsTo('App\Content', 'cid', 'id');
    }
}
