<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    use HasFactory;
    protected $table = 'RESULTS';
    protected $primaryKey = 'kq_id';
    
    public function kq_hw() {
        return $this->belongsTo(Results::class, 'kq_homeworkid', 'hw_id');
    }
    
    public function kq_acc() {
        return $this->belongsTo(Account::class, 'kq_studentid', 'acc_id');
    }
}
