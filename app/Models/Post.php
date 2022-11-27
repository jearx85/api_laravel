<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = [
        "title",
        "description",
        "state",
        "content",
        "category_id"
    ];

    public function category(){
        return $this->hasOne(Category::class, 'foreign_key');
    }

    public function autor(){
        return $this->hasOne(Autor::class);
    }
}

