<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $dates = ['deleted_at'];
    protected $table = 'categories';
    protected $hidden = ['created_at', 'updated_at'];

    public function getSubCategories(){
        return $this->hasMany(Category::class, 'parent', 'id');
    }

    public function getParent(){
        return $this->hasOne(Category::class, 'id', 'parent');
    }
}
