<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'ordering'
    ];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'parent_category', 'id');
    }
}
