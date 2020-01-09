<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NoticeAndRoles extends Model
{
    protected $table = 'notice_to_roles';

    public function role(){
      return $this->belongsTo(Role::class);
    }

    public function notice(){
      return $this->belongsTo(Notice::class);
    }
}
