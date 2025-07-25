<?php

namespace App\Http\Controllers;

use App\Models\Qr;
use App\Models\Setting;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Tour;
use App\Models\Pilgrim;
use Illuminate\Support\Facades\Storage;
use App\Models\DhamPayment;
use App\Models\Payment;
use Carbon\Carbon;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function registration()
    {
        return view('registration');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|unique:users,mobile',
            'country_code' => 'nullable|string|max:5',
            'email' => 'required|email|unique:users,email',
            'pilgrim_type' => 'required|in:Indian Pilgrim,Foreign Pilgrim',
            'password' => ['confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'country_code' => $request->country_code ?? '+91',
            'email' => $request->email,
            'pilgrim_type' => $request->pilgrim_type,
            'password' => Hash::make($request->password),
            'original_password' => $request->password,
            'company_name' => $request->company_name ?? '',
            'gst_number' => $request->gst_number,
            'state' => $request->state ?? ''
        ]);

        do {
            $uniqueNumber = (string) mt_rand(1000000000, 9999999999);
        } while (User::where('unique_id', $uniqueNumber)->exists());

        $user->unique_id = $uniqueNumber;
        $user->save();

        Auth::login($user);

        return redirect()->intended('user/dashboard');

        //return redirect()->back()->with('success', 'Registration successful!');
    }


    public function dashboard()
    {
        return view('dashboard');
    }

    public function tour()
    {
        return view('registrationTour');
    }

    public function viewTour()
    {
        $tours = Tour::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('viewTour', compact('tours'));
    }

    public function addPligrim($id)
    {
        $data = Tour::find($id);
        return view('add_pilgrim', compact('id', 'data'));
    }

    public function editPligrim($id)
    {
        $pilgrim = Pilgrim::where('id', $id)
            ->where('user_id', Auth::user()->id)
            ->first();

        $data = Tour::find($pilgrim->tour_id);
        return view('update_pilgrim', compact('id', 'pilgrim', 'data'));
    }

    public function download()
    {
        $payments = DhamPayment::all();
        $query = \DB::table('users')
            ->join('add_pilgrims', 'users.id', '=', 'add_pilgrims.user_id')
            ->join('tours', 'add_pilgrims.tour_id', '=', 'tours.id')
            ->join('aadhaar_verifications', 'aadhaar_verifications.aadhaar_number', '=', 'add_pilgrims.aadhar_card')
            ->select(
                'users.name',
                'users.email',
                'users.unique_id',
                'users.mobile',
                'tours.start_date',
                'tours.end_date',
                'tours.tour_id',
                'tours.driver_name',
                'tours.vehicle_number',
                'tours.date_wise_destination',
                'add_pilgrims.status',
                'add_pilgrims.id',
                'add_pilgrims.gender',
                'add_pilgrims.age',
                'add_pilgrims.city',
                'add_pilgrims.state',
                'add_pilgrims.country',
                'add_pilgrims.district',
                'add_pilgrims.contact_person',
                'add_pilgrims.contact_number',
                'add_pilgrims.contact_relation',
                'add_pilgrims.aadhar_card',
                'add_pilgrims.address',
                'add_pilgrims.vehicle_details',
                'aadhaar_verifications.profile_image_path'
            )
            ->where('users.id', Auth::user()->id)
            ->orderBy('users.id', 'desc');
        $data = $query->get();

        foreach ($data as $tour) {
            $date_wise_destination = '';
            $tour_days = [];
            $destinations = [];
            $decoded = json_decode($tour->date_wise_destination ?? '', true);
            // Decode again if it's still a string
            if (is_string($decoded)) {
                $decoded = json_decode($decoded, true);
            }

            if (is_array($decoded)) {
                foreach ($decoded as $destination) {
                    $date_wise_destination .= $destination['dham'] . '-' . $destination['date'] . ",";
                    $tour_days[] = $destination['date'];
                    $destinations[] = $destination['dham'];
                }

            }

            $amount = 0;
            foreach ($destinations as $destination) {
                foreach ($payments as $payment) {
                    if ($destination == $payment->dham->name) {
                        $amount += $payment->price;
                    }
                }
            }
            $tour->amount = $amount;
        }
        $qr = Qr::first();
        $payment = Setting::where('id', 1)->first();
        return view('download', compact('data', 'qr', 'payment'));
    }

    public function storeTour(Request $request)
    {
        // Split the date range
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Build date-wise destination array
        $destinations = [];
        foreach ($request->dham as $index => $dhamName) {
            $destinations[] = [
                'dham' => $dhamName,
                'date' => $request->dhamDate[$index] ?? null,
            ];
        }

        $drivers = [];
        if ($request->drivers) {
            foreach ($request->drivers as $index => $driver) {
                $drivers[] = [
                    'driver' => $driver,
                    'vehicle' => $request->vehicle[$index] ?? null,
                ];
            }
        }


        do {
            $uniqueNumber = (string) mt_rand(1000000000, 9999999999);
            //$tourId = 'UK-' . $uniqueNumber;
            $tourId = $uniqueNumber;
        } while (Tour::where('tour_id', $tourId)->exists());

        $today = Carbon::today();
        $totalToursToday = Tour::whereDate('created_at', $today)
        ->where('user_id', auth()->id())
        ->count();

        $formattedDate = $today->format('dmY');
        $tourName = $formattedDate . '.' . ($totalToursToday + 1);

        // Store in the database
        $data = Tour::create([
            'user_id' => auth()->id(),
            'start_date' => date('Y-m-d', strtotime($startDate)),
            'end_date' => date('Y-m-d', strtotime($endDate)),
            'number_of_tourist' => $request->number_of_tourist,
            'mode_of_travel' => $request->mode_of_travel,
            'type_of_transport' => $request->type_of_transport,
            'date_wise_destination' => json_encode($destinations),
            'driver_name' => json_encode($drivers),
            'vehicle_number' => json_encode($drivers),
            'status' => 0,
            'tour_id' => $tourId,
            'tour_name' => 'Tour_'.$tourName
        ]);

        return redirect()->route('tour', [
            'success' => 'Tour created successfully.' . $tourId,
            'tour_id' => $data->id
        ]);
    }


    public function editTour($id)
    {
        $tour = Tour::findOrFail($id);
        return view('updateTour', compact('tour'));
    }

    public function updateTour(Request $request, $id)
    {
        $tour = Tour::findOrFail($id);
        // similar logic as store with date parsing and JSON encoding

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $dateWiseDestination = [];
        foreach ($request->dham as $index => $dham) {
            $dateWiseDestination[] = [
                'dham' => $dham,
                'date' => $request->dhamDate[$index] ?? null,
            ];
        }

        $drivers = [];
        if ($request->drivers) {
            foreach ($request->drivers as $index => $driver) {
                $drivers[] = [
                    'driver' => $driver,
                    'vehicle' => $request->vehicle[$index] ?? null,
                ];
            }
        }

        $tour->update([
            'start_date' => $startDate,
            'end_date' => $endDate,
            'number_of_tourist' => $request->number_of_tourist,
            'mode_of_travel' => $request->mode_of_travel,
            'type_of_transport' => $request->type_of_transport,
            'date_wise_destination' => json_encode($dateWiseDestination),
            'driver_name' => json_encode($drivers),
            'vehicle_number' => json_encode($drivers),
        ]);

        return redirect()->route('viewTour')->with('success', 'Tour updated successfully!');
    }

    public function createPligrim(Request $request, $id)
    {
        $data = $request->all();

        if (isset($data['doctor'])) {
            $data['doctor'] = 1;
        }

        if (!empty($data['medical'])) {
            $data['medical'] = json_encode($data['medical']);
        }

        Pilgrim::updateOrCreate([
            'user_id' => Auth::user()->id,
            'tour_id' => $id
        ], $data);

        return redirect()->route('viewTour')->with('success', 'Pilgrim added successfully!');

    }

    public function updatePligrim(Request $request, $id)
    {
        $data = $request->all();
        unset($data['_token']);

        if (isset($data['doctor'])) {
            $data['doctor'] = 1;
        }

        if (!empty($data['medical'])) {
            $data['medical'] = json_encode($data['medical']);
        }

        Pilgrim::where('id', $id)
            ->where('user_id', Auth::user()->id)
            ->update($data);

        return redirect()->route('download')->with('success', 'Pilgrim updated successfully!');

    }


    public function paymentStore(Request $request)
    {
        $request->validate([
            'pilgrim_id' => 'required|max:255',
            'qr_image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);


        $file = $request->file('qr_image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('payment');

        // Create folder if not exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Move file to public/qr
        $file->move($destinationPath, $fileName);

        // Save to DB
        $payment = Payment::updateOrCreate(['pilgrim_id' => $request->pilgrim_id, 'user_id' => auth()->id()], [
            'pilgrim_id' => $request->pilgrim_id,
            'image' => 'payment/' . $fileName,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('download', [
            'success' => 'Screenshort uploaded successfully.',
            'payment_id' => $payment->id
        ]);
    }



}
