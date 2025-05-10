<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\AadhaarVerification;
use Auth;
class AadhaarController extends Controller
{
    public function generateOtp(Request $request)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://api.quickekyc.com/api/v1/aadhaar-v2/generate-otp', [
                    'key' => 'daa708b4-9dec-4a3b-8150-47f76f80add1',
                    'id_number' => $request->id_number,
                ]);

        return response()->json($response->json());
    }



    public function verifyOtp(Request $request)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://api.quickekyc.com/api/v1/aadhaar-v2/submit-otp', [
                    'key' => 'daa708b4-9dec-4a3b-8150-47f76f80add1',
                    'request_id' => $request->request_id,
                    'otp' => $request->otp,
                ]);

        \Log::info($response);

        $data = $response->json();

        if (empty($data['data']['aadhaar_number']) && empty($data['data']['full_name'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Aadhaar api is down. Please try after some time',
                'data' => []
            ]);
        }

        $profileImagePath = null;

        if (isset($data['data']['profile_image'])) {
            $imageData = base64_decode($data['data']['profile_image']);
            $fileName = 'aadhaar_' . time() . '.jpg';
            $directoryPath = public_path('aadhaar_photos');

            // Create the directory if it doesn't exist
            if (!file_exists($directoryPath)) {
                mkdir($directoryPath, 0755, true);
            }

            $profileImagePath = 'aadhaar_photos/' . $fileName;
            file_put_contents(public_path($profileImagePath), $imageData);
        }


        // Save to database
        $data = AadhaarVerification::updateOrCreate(
            ['aadhaar_number' => $data['data']['aadhaar_number']],
            [
                'request_id' => $request->request_id,
                'aadhaar_number' => $data['data']['aadhaar_number'] ?? null,
                'name' => $data['data']['full_name'] ?? null, // Fix here
                'dob' => $data['data']['dob'] ?? null,
                'gender' => $data['data']['gender'] ?? null,
                'phone_number' => $data['data']['phone_number'] ?? null,
                'address' => json_encode($data['data']['address'] ?? []),
                'state' => $data['data']['address']['state'] ?? null,
                'district' => $data['data']['address']['dist'] ?? null,
                'house' => $data['data']['address']['house'] ?? null,
                'street' => $data['data']['address']['street'] ?? null,
                'pincode' => $data['data']['zip'] ?? null,
                'profile_image_path' => $profileImagePath,
                'user_id' => Auth::user()->id,
                'tour_id' => $request->tour_id
            ]
        );
        
        return response()->json([
            'status' => 'success',
            'message' => 'OTP verified and data saved.',
            'data' => $data
        ]);
    }

}

