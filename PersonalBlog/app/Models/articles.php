<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class articles extends Model
{
    //  Mass assignment protection - fields that can be filled
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'status',
        'published_at'
    ];

    //  Cast published_at to Carbon datetime object
    protected $casts = [
        'published_at' => 'datetime',
    ];

    //  Relationship: Article belongs to one User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //  Relationship: Article belongs to one Category
    public function category(): BelongsTo
    {
        return $this->belongsTo(categories::class);
    }

    //  Query Scope: Get only published articles
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
