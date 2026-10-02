<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'code',
        'title',
        'description',
        'start_at',
        'end_at',
        'location',
        'capacity',
        'activity_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'activity_date' => 'date',
            'start_at' => 'date',
            'end_at' => 'date',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

        public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
    
}