<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Setting;
use App\Models\Transaction;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Payment::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('payment_method', 'LIKE', "%{$search}%")
                ->orWhere('minimum_transaction', 'LIKE', "%{$search}%");

            $payments = $query->paginate(10);
        } else {
            $payments = Payment::latest()->paginate(10);
        }

        $setting = Setting::first();
        return view('admin.payments.index', compact('payments', 'setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.payments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        $validated = $request->validated();

        Payment::create([
            'payment_method' => $validated['payment_method'],
            'instructions' => $validated['instructions'],
            'minimum_transaction' => $validated['minimum_transaction'],
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        return view('admin.payments.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $validated = $request->validated();

        $payment->update([
            'payment_method' => $validated['payment_method'],
            'instructions' => $validated['instructions'],
            'minimum_transaction' => $validated['minimum_transaction'],
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $transactions = Transaction::where('payment_id', $payment->id)->get();

        foreach ($transactions as $transaction) {
            if (Storage::disk('public')->exists($transaction->proof)) {
                Storage::disk('public')->delete($transaction->proof);
            }
            $transaction->delete();
        }

        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully!');
    }
}
