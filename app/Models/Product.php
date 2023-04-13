<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'image',
        'price',
        'category_id'
    ];

    protected $primaryKey = 'id';

    public function scopeSlug($query, $slug) {
        return $query->where('slug', $slug);
    }

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function comments(): HasMany {
        return $this->hasMany(Comment::class);
    }

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class)->withPivot(['quantity', 'id']);
    }

}
