<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug'
    ];

    protected $primaryKey = 'id';

    public function scopeSlug($query, $slug) {
        return $query->where('slug', $slug);
    }

    public function products(): HasMany {
        return $this->hasMany(Product::class)->withTrashed();
    }
}
