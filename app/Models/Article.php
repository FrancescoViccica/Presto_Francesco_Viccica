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

    public function setAccepted($value){
        $this->is_accepted = $value;
        $this->save();
        return true;
    }

    public static function toBerevisionedCount(){
        return Article::whereNull('is_accepted')->count();
    }
    
    protected $fillable = [
        'title',
        'description',
        'price',
        'category_id',
        'user_id'
    ];
}
