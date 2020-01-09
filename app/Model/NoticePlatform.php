<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NoticePlatform extends Model
{
    protected $table = 'notice_platforms';

    public function notice(){
        return $this->belongsTo(Notice::class);
    }

}
