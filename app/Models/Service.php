<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'sub_title',
        'description',
        'thumbnail',
        'images',
        'price',
        'author_id',
        'slug',
        'tax_percentage',
        'shipping_installation_cost',
    ];

    /**
     * Cast attributes
     */
    protected $casts = [
        'title' => 'string',
        'sub_title' => 'string',
        'description' => 'string',
        'thumbnail' => 'string',
        'images' => 'array',
        'price' => 'decimal:2',
        'slug' => 'string',
        'tax_percentage' => 'decimal:2',
        'shipping_installation_cost' => 'decimal:2',
        'author_id' => 'integer',
    ];

    /**
     * Relationship: Service belongs to an author (User)
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Relationship: A service can have many orders
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getThumbnailAttribute($value): string|null
    {
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }
        // Check if the request is an API request
        if (request()->is('api/*') && !empty($value)) {
            // Return the full URL for API requests
            return url($value);
        }

        // Return only the path for web requests
        return $value;
    }
}
