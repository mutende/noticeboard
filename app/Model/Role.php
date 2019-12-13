<?php

namespace App\Model;
use App\Http\Traits\TimestampTrait;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    
    use TimestampTrait;

    //tables
    protected $table = 'roles';
    
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function notices(){
        return $this->hasMany(Notice::class);
    }
}
