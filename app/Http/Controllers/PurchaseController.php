<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Purchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Purchase::with(['user', 'package']);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            })
                ->orWhereHas('package', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                })
                ->orWhere('price', 'LIKE', "%{$search}%")
                ->orWhere('created_at', 'LIKE', "%{$search}%");

            $purchases = $query->paginate(10);
        } else {
            $purchases = Purchase::latest()->paginate(10);
        }

        $users = User::all();
        $packages = Package::all();
        return view('admin.purchases.index', compact('purchases', 'users', 'packages'));
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
    public function store(Request $request)
    {

        Purchase::create([
            'user_id'  => Auth::id(),
            'package_id' => $request->package_id
        ]);

        $price = Package::where('id', $request->package_id)->first()->price;

        // Kurangi koin user sesuai harga
        DB::table('users')->where('id', Auth::id())->decrement('coins', $price);

        return redirect()->back()->with('success', 'Package purchased successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
