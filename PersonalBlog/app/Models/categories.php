<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class categories extends Model
{
    //  Mass assignment protection - fields that can be filled
     protected $fillable = ['name'];

    //  Relationship: One category has many articles
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
