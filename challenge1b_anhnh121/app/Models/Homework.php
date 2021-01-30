<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;
    protected $table = 'HOMEWORKS';
    protected $primaryKey = 'hw_id';
    public $timestamps = false;
    public function hw_kq() {
        return $this->hasMany(Results::class, 'kq_homeworkid', 'hw_id');
    }
    
    public function hw_acc() {
        return $this->belongsTo(Account::class, 'hw_teacherid', 'acc_id');
    }
    
}
