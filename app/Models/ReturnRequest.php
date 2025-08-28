<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnRequest extends Model
{
    protected $fillable = ['user_id', 'order_id', 'reason', 'status', 'admin_comment'];

    public function user() {
         return $this->belongsTo(User::class);
         }
    public function order() { 
        return $this->belongsTo(Order::class);
     }
}
