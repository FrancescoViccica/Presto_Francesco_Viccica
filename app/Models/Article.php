<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use Searchable;

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

    public function toSearchableArray()
    {
        return [
            'id' => (int) $this->id,
            'title' => $this->title,
            'description' => $this->description,
            // CORRETTO: Estrae solo il testo per evitare il crash di TNTSearch
            'category' => $this->category ? $this->category->name : null, 
        ];
    }

    public function images(): HasMany{
        return $this->hasMany(Image::class);
    }
    
    protected $fillable = [
        'title',
        'description',
        'price',
        'category_id',
        'user_id'
    ];
}
