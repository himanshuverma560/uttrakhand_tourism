<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class AadhaarVerification extends Model
{
    use HasFactory;

    protected $appends = ['formatted_address', 'profile_image_url', 'age'];

    protected $fillable = [
        'request_id',
        'aadhaar_number',
        'name',
        'dob',
        'gender',
        'phone_number',
        'address',
        'state',
        'district',
        'pincode',
        'profile_image_path',
        'raw_response',
        'street',
        'house',
        'user_id',
        'tour_id'
    ];


    public function getFormattedAddressAttribute()
    {
        // Decode the JSON string stored in the `address` column
        $address = json_decode($this->address, true);

        // Return null if decoding failed or if not an array
        if (!is_array($address)) {
            return null;
        }

        // Build the address parts in desired order
        $parts = [
            $address['house'] ?? null,
            $address['street'] ?? null,
            $address['landmark'] ?? null,
            $address['vtc'] ?? null,
            $address['loc'] ?? null,
            $address['po'] ?? null,
            $address['subdist'] ?? null,
            $address['dist'] ?? null,
            $address['state'] ?? null,
            $address['country'] ?? null,
            $address['zip'] ?? $this->pincode ?? null,
        ];

        // Filter out empty values and return joined string
        return implode(', ', array_filter($parts));
    }

    public function getProfileImageUrlAttribute()
    {
        if (!$this->profile_image_path) {
            return null;
        }

        return asset($this->profile_image_path);
    }

    public function getAgeAttribute()
    {
        if (!$this->dob) {
            return null;
        }

        return Carbon::parse($this->dob)->age;
    }


}
