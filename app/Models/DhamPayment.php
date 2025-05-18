<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DhamPayment extends Model
{
    use HasFactory;

    protected $table = 'dham_payments';

    protected $fillable = ['name', 'price', 'dham_id'];

    public function dham()
    {
        return $this->belongsTo(Dham::class);
    }
}
