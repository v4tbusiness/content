<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $setting = Setting::first();
        // return view('admin.settings.index', compact('setting'));
        return view('admin.settings.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSettingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        $validated = $request->validated();

        $setting = Setting::first();

        $data = [
            'site_name' => $validated['site_name'],
            'site_description' => $validated['site_description'],
            'currency' => $validated['currency'],
            'coin_price' => $validated['coin_price'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'telegram' => $validated['telegram'],
            'whatsapp' => $validated['whatsapp'],
            'main_header' => $validated['main_header'],
            'custom_css' => $validated['custom_css'],
        ];

        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($setting->logo && file_exists(public_path($setting->logo))) {
                unlink(public_path($setting->logo));
            }

            // Ambil file logo
            $logoFile = $request->file('logo');

            // Tentukan nama file dan ekstensi
            $extension = $logoFile->getClientOriginalExtension(); // Dapatkan ekstensi file
            $fileName = 'logo.' . $extension; // Nama file: logo.extension

            // Simpan file di root folder public
            $logoFile->move(public_path(), $fileName);

            // Simpan path logo ke database
            $data['logo'] = $fileName;
        }

        if ($validated['currency'] == 'AFN') {
            $data['currency_symbol'] = '؋';
        }
        if ($validated['currency'] == 'ALL') {
            $data['currency_symbol'] = 'L';
        }
        if ($validated['currency'] == 'DZD') {
            $data['currency_symbol'] = 'د.ج';
        }
        if ($validated['currency'] == 'AOA') {
            $data['currency_symbol'] = 'Kz';
        }
        if ($validated['currency'] == 'ARS') {
            $data['currency_symbol'] = '$';
        }
        if ($validated['currency'] == 'AMD') {
            $data['currency_symbol'] = '֏';
        }
        if ($validated['currency'] == 'AWG') {
            $data['currency_symbol'] = 'ƒ';
        }
        if ($validated['currency'] == 'AUD') {
            $data['currency_symbol'] = '$';
        }
        if ($validated['currency'] == 'AZN') {
            $data['currency_symbol'] = '₼';
        }
        if ($validated['currency'] == 'BSD') {
            $data['currency_symbol'] = '$';
        }
        if ($validated['currency'] == 'BHD') {
            $data['currency_symbol'] = '.د.ب';
        }
        if ($validated['currency'] == 'BDT') {
            $data['currency_symbol'] = '৳';
        }
        if ($validated['currency'] == 'BBD') {
            $data['currency_symbol'] = '$';
        }
        if ($validated['currency'] == 'BYN') {
            $data['currency_symbol'] = 'Br';
        }
        if ($validated['currency'] == 'BZD') {
            $data['currency_symbol'] = 'BZ$';
        }
        if ($validated['currency'] == 'BMD') {
            $data['currency_symbol'] = '$';
        }
        if ($validated['currency'] == 'BTN') {
            $data['currency_symbol'] = 'Nu.';
        }
        if ($validated['currency'] == 'BOB') {
            $data['currency_symbol'] = 'Bs.';
        }
        if ($validated['currency'] == 'BAM') {
            $data['currency_symbol'] = 'KM';
        }
        if ($validated['currency'] == 'BWP') {
            $data['currency_symbol'] = 'P';
        }
        if ($validated['currency'] == 'BRL') {
            $data['currency_symbol'] = 'R$';
        }
        if ($validated['currency'] == 'GBP') {
            $data['currency_symbol'] = '£';
        }
        if ($validated['currency'] == 'BND') {
            $data['currency_symbol'] = '$';
        }
        if ($validated['currency'] == 'BGN') {
            $data['currency_symbol'] = 'лв';
        }
        if ($validated['currency'] == 'BIF') {
            $data['currency_symbol'] = 'FBu';
        }
        if ($validated['currency'] == 'KHR') {
            $data['currency_symbol'] = '៛';
        }
        if ($validated['currency'] == 'CAD') {
            $data['currency_symbol'] = '$';
        }
        if ($validated['currency'] == 'CNY') {
            $data['currency_symbol'] = '¥';
        }
        if ($validated['currency'] == 'COP') {
            $data['currency_symbol'] = '$';
        }
        if ($validated['currency'] == 'HRK') {
            $data['currency_symbol'] = 'kn';
        }
        if ($validated['currency'] == 'CZK') {
            $data['currency_symbol'] = 'Kč';
        }
        if ($validated['currency'] == 'DKK') {
            $data['currency_symbol'] = 'kr';
        }
        if ($validated['currency'] == 'EGP') {
            $data['currency_symbol'] = '£';
        }
        if ($validated['currency'] == 'EUR') {
            $data['currency_symbol'] = '€';
        }
        if ($validated['currency'] == 'HKD') {
            $data['currency_symbol'] = '$';
        }
        if ($validated['currency'] == 'HUF') {
            $data['currency_symbol'] = 'Ft';
        }
        if ($validated['currency'] == 'INR') {
            $data['currency_symbol'] = '₹';
        }
        if ($validated['currency'] == 'IDR') {
            $data['currency_symbol'] = 'Rp';
        }
        if ($validated['currency'] == 'ILS') {
            $data['currency_symbol'] = '₪';
        }
        if ($validated['currency'] == 'JPY') {
            $data['currency_symbol'] = '¥';
        }
        if ($validated['currency'] == 'KRW') {
            $data['currency_symbol'] = '₩';
        }
        if ($validated['currency'] == 'MYR') {
            $data['currency_symbol'] = 'RM';
        }
        if ($validated['currency'] == 'MXN') {
            $data['currency_symbol'] = '$';
        }
        if ($validated['currency'] == 'NOK') {
            $data['currency_symbol'] = 'kr';
        }
        if ($validated['currency'] == 'NZD') {
            $data['currency_symbol'] = '$';
        }
        if ($validated['currency'] == 'PHP') {
            $data['currency_symbol'] = '₱';
        }
        if ($validated['currency'] == 'PLN') {
            $data['currency_symbol'] = 'zł';
        }
        if ($validated['currency'] == 'RUB') {
            $data['currency_symbol'] = '₽';
        }
        if ($validated['currency'] == 'SGD') {
            $data['currency_symbol'] = '$';
        }
        if ($validated['currency'] == 'THB') {
            $data['currency_symbol'] = '฿';
        }
        if ($validated['currency'] == 'TRY') {
            $data['currency_symbol'] = '₺';
        }
        if ($validated['currency'] == 'USD') {
            $data['currency_symbol'] = '$';
        }
        if ($validated['currency'] == 'ZAR') {
            $data['currency_symbol'] = 'R';
        }

        $setting->update($data);

        return redirect()->route('settings.index')->with('success', 'Settings updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
