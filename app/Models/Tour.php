<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;


    protected $casts = [
        'date_wise_destination' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    protected $appends = ['start_date_formatted', 'end_date_formatted'];

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'number_of_tourist',
        'mode_of_travel',
        'type_of_transport',
        'date_wise_destination',
        'status',
        'tour_id'
    ];

    public function pilgrims()
    {
        return $this->hasMany(Pilgrim::class);
    }


    public function getStartDateFormattedAttribute()
    {
        return $this->start_date ? $this->start_date->format('Y-m-d') : null;
    }

    public function getEndDateFormattedAttribute()
    {
        return $this->end_date ? $this->end_date->format('Y-m-d') : null;
    }


}
