<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderItem extends Model
{
    use HasFactory;

    protected $dates = ['deleted_at'];
    protected $table = 'orders_items';
    protected $hidden = ['created_at', 'updated_at'];
}
