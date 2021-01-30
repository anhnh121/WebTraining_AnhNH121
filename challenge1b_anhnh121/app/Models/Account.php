<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    protected $table = 'ACCOUNTS';
    protected $primaryKey = 'acc_id';
    public $timestamps = false;
    
    protected $fillable = [
        'username', 'password',
    ];
    
    protected $hidden = [
        'password',
    ];

    public function acc_msg_sender() {
        return $this->hasMany(Msg::class, 'msg_idsender', 'acc_id'); 
    }
    
    public function acc_msg_recver() {
        return $this->hasMany(Msg::class, 'msg_idrecver', 'acc_id');
    }
    
    public function acc_hw_teacher() {
        return $this->hasMany(Homework::class, 'hw_teacherid', 'acc_id');
    }

    public function acc_kq_student() {
        return $this->hasMany(Results::class, 'kq_studentid', 'acc_id');
    }    
}
