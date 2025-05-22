<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pilgrim;
use App\Models\Setting;
use App\Models\Qr;
use App\Models\User;
use App\Models\Dham;
use App\Models\DhamPayment;
use Barryvdh\DomPDF\Facade\Pdf;
use Endroid\QrCode\Builder\Builder;
use Carbon\Carbon;
use Endroid\QrCode\Writer\PngWriter;


class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $query = \DB::table('users')
            ->leftJoin('add_pilgrims', 'users.id', '=', 'add_pilgrims.user_id')
            ->leftJoin('payments', 'add_pilgrims.id', '=', 'payments.pilgrim_id')
            ->leftJoin('tours', 'add_pilgrims.tour_id', '=', 'tours.id')
            ->leftJoin('aadhaar_verifications', 'aadhaar_verifications.aadhaar_number', '=', 'add_pilgrims.aadhar_card')
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
                'aadhaar_verifications.profile_image_path',
                'payments.image'
            )
            ->orderBy('users.id', 'desc');

        if ($request->filled('email')) {
            $query->where('users.email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('mobile')) {
            $query->where('users.mobile', 'like', '%' . $request->mobile . '%');
        }

        $tours = $query->get();

        foreach ($tours as $tour) {
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
            $startDate = $tour_days[0] ?? '';
            $endDate = end($tour_days) ?: '';
            $tour->date_wise_destination = $date_wise_destination ?? '';
            $tour->tour_days = "$startDate - $endDate";
            $tour->destinations = end($destinations) ?? '';
            $tour->profile_image_path = $tour->profile_image_path ? asset($tour->profile_image_path) : '';

            // for vehicle and driver
            $drivers = json_decode($tour->driver_name, true);
            if (!empty($drivers)) {
                $tour->driver_name = $drivers[0]['driver'];
                $tour->vehicle_number = $drivers[0]['vehicle'];
            }
        }

        return view('admin.dashboard', compact('tours'));
    }

    public function verifyPilgrim($id)
    {
        $pilgrim = Pilgrim::findOrFail($id);
        $pilgrim->status = 1;
        $pilgrim->save();

        return back()->with('success', 'Pilgrim status updated to Verified.');
    }

    public function settings()
    {
        $dhamPayments = DhamPayment::all();
        $dhams = Dham::all();
        $payments = Setting::where('id', 1)->first();
        $qrs = Qr::all();
        return view('admin.setting', compact('dhamPayments', 'payments', 'dhams', 'qrs'));
    }

    public function storeQr(Request $request)
    {
        $request->validate([
            'upi' => 'required|string|max:255',
            'qr_image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);


        $file = $request->file('qr_image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('qr');

        // Create folder if not exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Move file to public/qr
        $file->move($destinationPath, $fileName);

        // Save to DB
        Qr::truncate();
        Qr::create([
            'upi' => $request->upi,
            'qr_image' => 'qr/' . $fileName,
        ]);

        return back()->with('success', 'QR uploaded successfully.');
    }


    public function storePrice(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        DhamPayment::updateOrCreate(['dham_id' => $request->dham_id], [
            'name' => $request->name,
            'price' => $request->price,
            'dham_id' => $request->dham_id
        ]);

        return back()->with('success', 'Price Stored successfully.');
    }


    public function paymentStatus(Request $request)
    {
        $setting = Setting::find(1);
        $setting->status = $request->has('enable_payment') ? 1 : 0;
        $setting->save();

        return back()->with('success', 'Payment setting updated successfully.');
    }

    public function downloadQr($id)
    {
        $qr = Qr::findOrFail($id);
        $filePath = public_path($qr->qr_image);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        }

        return back()->with('error', 'File not found.');
    }

    public function editPrice($id)
    {
        $qr = DhamPayment::findOrFail($id);
        $dhams = Dham::all(); // Assuming you have this model

        return view('admin.edit_qr', compact('qr', 'dhams'));
    }

    public function updatePrice(Request $request, $id)
    {

        $qr = DhamPayment::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'dham_id' => 'required|integer',

        ]);

        // if ($request->hasFile('qr_image')) {
        //     // Delete old image
        //     if (file_exists(public_path($qr->qr_image))) {
        //         unlink(public_path($qr->qr_image));
        //     }

        //     $file = $request->file('qr_image');
        //     $fileName = time() . '_' . $file->getClientOriginalName();
        //     $destinationPath = public_path('qr');
        //     $file->move($destinationPath, $fileName);
        //     $qr->qr_image = 'qr/' . $fileName;
        // }

        $qr->name = $request->name;
        $qr->price = $request->price;
        $qr->dham_id = $request->dham_id;
        $qr->save();

        return redirect()->route('admin.settings')->with('success', 'Price updated successfully.');
    }


    public function downloadPdf($id)
    {
        $tour = \DB::table('users')
            ->leftJoin('add_pilgrims', 'users.id', '=', 'add_pilgrims.user_id')
            ->leftJoin('payments', 'add_pilgrims.id', '=', 'payments.pilgrim_id')
            ->leftJoin('tours', 'add_pilgrims.tour_id', '=', 'tours.id')
            ->leftJoin('aadhaar_verifications', 'aadhaar_verifications.aadhaar_number', '=', 'add_pilgrims.aadhar_card')
            ->select(
                'aadhaar_verifications.name',
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
                'add_pilgrims.medical',
                'add_pilgrims.doctor',
                'add_pilgrims.vehicle_details',
                'aadhaar_verifications.profile_image_path',
                'payments.image'
            )
            ->where('add_pilgrims.id', $id)
            ->orderBy('users.id', 'desc')
            ->first();

        if ($tour) {
            // Decode date_wise_destination
            $decoded = json_decode($tour->date_wise_destination ?? '', true);
            if (is_string($decoded)) {
                $decoded = json_decode($decoded, true);
            }

            $date_wise_destination = '';
            $tour_days = [];
            $destinations = [];
            $date_map = [];

            $dhams = Dham::pluck('name')->toArray();

            if (is_array($decoded)) {
                foreach ($decoded as $destination) {
                    //$date_wise_destination .= $destination['dham'] . '-' . $destination['date'] . ", ";
                    $tour_days[] = $destination['date'];
                    $destinations[] = $destination['dham'];
                    $date_map[$destination['dham']] = $destination['date'];
                }
            }

            //$date_wise_destination = '';
            foreach ($dhams as $dham) {
                $date = $date_map[$dham] ?? '-';
                $date_wise_destination .= $dham . ': ' . $date . "\n";
            }

            $startDate = $tour_days[0] ?? '';
            $endDate = end($tour_days) ?: '';

            $tour->date_wise_destination = rtrim($date_wise_destination, ', ');
            $tour->tour_days = Carbon::parse($startDate)->format('d/m/Y') ." To ".  Carbon::parse($endDate)->format('d/m/Y');
            $tour->destinations = end($destinations) ?? '';
            $tour->profile_image_path = $tour->profile_image_path ? public_path($tour->profile_image_path) : '';
            $tour->unique_id = $tour->aadhar_card;

            // Decode driver and vehicle
            $drivers = json_decode($tour->driver_name, true);
            if (!empty($drivers)) {
                $tour->driver_name = $drivers[0]['driver'] ?? '';
                $tour->vehicle_number = $drivers[0]['vehicle'] ?? '';
            }

            $qrImage = Builder::create()
                ->writer(new PngWriter())
                ->data($tour->aadhar_card)
                ->size(120)
                ->margin(10)
                ->build();

            $tour->qr_code = 'data:image/png;base64,' . base64_encode($qrImage->getString());
            $tour->aadhar_card = 'XXXXXXXX' . substr($tour->aadhar_card, -4);
            $tour->medical = implode(',', json_decode($tour->medical ?? [], true));
            $tour->doctor = $tour->doctor == 1 ? 'Doctor' : '-';

            // footer logo
            $tour->pdf_logo = public_path('images/pdf_logo.png');
            $tour->logo_vertical = public_path('images/logo_vertical.png');

            $data = (array) $tour;

            // Generate PDF
            $pdf = Pdf::loadView('pdf', compact('data'));
            return $pdf->download('Yatra Registration Letter - UTD.pdf');

        } else {
            return redirect()->back()->with('error', 'Data not found for the given pilgrim.');
        }

    }

}
