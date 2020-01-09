<?php

namespace App\Model;

use App\Http\Traits\TimestampTrait;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{

    use TimestampTrait;

    //tables
    protected $table = 'notices';



    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function noticeandroles(){
        return $this->hasMany(NoticeAndRoles::class);
    }

    public function noticeplatform(){
        return $this->hasMany(NoticePlatform::class);
    }

}
