<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pilgrim;
use App\Models\Setting;
use App\Models\Qr;
use App\Models\User;
use App\Models\Dham;
class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $query = \DB::table('users')
            ->leftJoin('add_pilgrims', 'users.id', '=', 'add_pilgrims.user_id')
            ->leftJoin('tours', 'add_pilgrims.tour_id', '=', 'tours.id')
            ->select(
                'users.name',
                'users.email',
                'users.mobile',
                'add_pilgrims.id',
                'tours.start_date',
                'tours.end_date',
                'add_pilgrims.status',
                'tours.tour_id',
                'tours.date_wise_destination',
            )
            ->orderBy('users.id', 'desc');

        if ($request->filled('email')) {
            $query->where('users.email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('mobile')) {
            $query->where('users.mobile', 'like', '%' . $request->mobile . '%');
        }

        $tours = $query->get();
        //dd($tours);

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
        $qrs = Qr::all();
        $dhams = Dham::all();
        $payments = Setting::where('id', 1)->first();
        return view('admin.setting', compact('qrs', 'payments', 'dhams'));
    }

    public function storeQr(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
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
        Qr::updateOrCreate(['dham_id' => $request->dham_id], [
            'name' => $request->name,
            'qr_image' => 'qr/' . $fileName,
            'price' => $request->price,
            'dham_id' => $request->dham_id
        ]);

        return back()->with('success', 'QR uploaded successfully.');
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

    public function editQr($id)
    {
        $qr = Qr::findOrFail($id);
        $dhams = Dham::all(); // Assuming you have this model

        return view('admin.edit_qr', compact('qr', 'dhams'));
    }

    public function updateQr(Request $request, $id)
    {
        $qr = Qr::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'dham_id' => 'required|integer',
            'qr_image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($request->hasFile('qr_image')) {
            // Delete old image
            if (file_exists(public_path($qr->qr_image))) {
                unlink(public_path($qr->qr_image));
            }

            $file = $request->file('qr_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('qr');
            $file->move($destinationPath, $fileName);
            $qr->qr_image = 'qr/' . $fileName;
        }

        $qr->name = $request->name;
        $qr->price = $request->price;
        $qr->dham_id = $request->dham_id;
        $qr->save();

        return redirect()->route('admin.settings')->with('success', 'QR updated successfully.');
    }

}
