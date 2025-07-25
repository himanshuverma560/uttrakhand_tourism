<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pilgrim extends Model
{
    use HasFactory;

    protected $table = 'add_pilgrims';

    protected $fillable = [
        'tour_id',
        'user_id',
        'name',
        'age',
        'gender',
        'aadhar_card',
        'address',
        'city',
        'district',
        'state',
        'country',
        'contact_person',
        'contact_number',
        'contact_relation',
        'medical',
        'doctor',
        'vehicle_details',
        'mobile',
        'email',
        'status'
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function aadhaarVerification()
    {
        return $this->belongsTo(AadhaarVerification::class, 'aadhar_card', 'aadhaar_number');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function getProfileImageUrl()
    {
        // Assuming `profile_image_path` is stored in the `AadhaarVerification` model
        if ($this->aadhaarVerification) {
            return asset($this->aadhaarVerification->profile_image_path);
        }

        return null; // Return null if no image is found
    }
}
