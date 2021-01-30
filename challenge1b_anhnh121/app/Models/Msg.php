<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Msg extends Model
{
    use HasFactory;
    protected $table = 'MSG';
    protected $primaryKey = 'msg_id';
    public $timestamps = false;
    
    public function msg_sender_acc() {
        return $this->belongsTo(Account::class, 'msg_idsender', 'acc_id'); 
    }
    
    public function msg_recver_acc() {
        return $this->belongsTo(Account::class, 'msg_idrecver', 'acc_id');
    }
}
