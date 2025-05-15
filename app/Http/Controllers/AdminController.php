<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pilgrim;
use App\Models\Setting;
use App\Models\Qr;

class AdminController extends Controller
{
    public function dashboard()
    {
        $tours = Pilgrim::with('tour')->orderBy('created_at', 'desc')->get();
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
        $payments = Setting::where('id', 1)->first();
        return view('admin.setting', compact('qrs', 'payments'));
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
        Qr::updateOrCreate(['id' => 1], [
            'name' => $request->name,
            'qr_image' => 'qr/' . $fileName, // saved relative to public/
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
}
