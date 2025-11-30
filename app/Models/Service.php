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
}
