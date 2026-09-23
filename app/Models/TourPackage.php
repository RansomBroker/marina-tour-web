<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourPackage extends Model
{
    protected $fillable = [
        'tour_category_id',
        'name',
        'slug',
        'price',
        'duration',
        'description',
        'images',
        'itinerary',
        'highlights',
        'included',
        'excluded',
        'what_to_bring',
        'cancellation_policy',
        'faq',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'images' => 'array',
        'itinerary' => 'array',
        'highlights' => 'array',
        'included' => 'array',
        'excluded' => 'array',
        'what_to_bring' => 'array',
        'faq' => 'array',
    ];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TourCategory::class, 'tour_category_id');
    }

    public function relatedPackages(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            TourPackage::class,
            'related_packages',
            'tour_package_id',
            'related_package_id'
        );
    }
}
