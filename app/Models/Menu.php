<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Menu extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'menus';

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id');
    }
}
