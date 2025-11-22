<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Payment;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Transaction::with(['user', 'payment']);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            })
                ->orWhere('amount', 'LIKE', "%{$search}%")
                ->orWhere('price', 'LIKE', "%{$search}%")
                ->orWhereHas('payment', function ($q) use ($search) {
                    $q->where('payment_method', 'LIKE', "%{$search}%");
                })
                ->orWhere('notes', 'LIKE', "%{$search}%")
                ->orWhere('status', 'LIKE', "%{$search}%")
                ->orWhere('created_at', 'LIKE', "%{$search}%");

            $transactions = $query->paginate(10);
        } else {
            $transactions = Transaction::latest()->paginate(10);
        }

        $users = User::all();
        $payments = Payment::all();
        $setting = Setting::first();
        return view('admin.transactions.index', compact('transactions', 'users', 'payments', 'setting'));
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
    public function store(StoreTransactionRequest $request)
    {

        // Cek apakah user sudah memiliki transaksi dengan status "pending"
        $pendingTransaction = Transaction::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        if ($pendingTransaction) {
            $link = route('invoice', $pendingTransaction->id);
            return redirect()->back()->with('error', "You already have a pending transaction. <a href='{$link}' class='text-blue-500 underline'>View Invoice</a>");
        }

        $validatedData = $request->validated();

        $coinPrice = Setting::first()->coin_price;

        $rawPrice = $validatedData['amount'] * $coinPrice;

        $calculatedPrice = round($rawPrice * 100) / 100;

        // Ambil minimum transaksi dari Payment berdasarkan payment_id
        $payment = Payment::find($validatedData['payment_id']);

        if (!$payment) {
            return redirect()->back()->with('error', 'Invalid payment method.');
        }

        if ($calculatedPrice < $payment->minimum_transaction) {
            $currencySymbol = Setting::first()->currency_symbol;
            return redirect()->back()->with('error', "The minimum transaction amount is {$currencySymbol} {$payment->minimum_transaction}.");
        }

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'amount' => $validatedData['amount'],
            'price' => $calculatedPrice,
            'payment_id' => $validatedData['payment_id'],
            'status' => 'pending',
        ]);

        return redirect()->route('invoice', $transaction->id)
            ->with('success', 'Top Up request submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $validatedData = $request->validated();

        if (isset($validatedData['status'])) {
            if ($validatedData['status'] === 'approved') {
                if ($transaction->status === 'pending') {
                    $transaction->update(['status' => 'approved']);

                    $user = $transaction->user;
                    $user->increment('coins', $transaction->amount);

                    return redirect()->route('transactions.index')->with('success', 'Transaction approved successfully!');
                }
            } elseif ($validatedData['status'] === 'rejected') {
                if ($transaction->status === 'pending') {
                    $transaction->update(['status' => 'rejected']);

                    return redirect()->route('transactions.index')->with('success', 'Transaction rejected successfully!');
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
