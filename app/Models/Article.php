<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    protected $fillable = [
        'title',
        'description',
        'price',
        'category_id',
        'user_id'
    ];
}
