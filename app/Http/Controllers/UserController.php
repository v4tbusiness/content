<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Purchase;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('username', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('coins', 'LIKE', "%{$search}%")
                ->orWhere('access_level', 'LIKE', "%{$search}%")
                ->orWhere('created_at', 'LIKE', "%{$search}%");

            $users = $query->paginate(10);
        } else {
            $users = User::latest()->paginate(10);
        }

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'telegram' => $validated['telegram'],
            'whatsapp' => $validated['whatsapp'],
            'coins' => $validated['coins'],
            'access_level' => $validated['access_level'],
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        $data = [
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'telegram' => $validated['telegram'],
            'whatsapp' => $validated['whatsapp'],
            'coins' => $validated['coins'],
            'access_level' => $validated['access_level'],
        ];


        if ($validated['password'] != $user->password) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $purchases = Purchase::where('user_id', $user->id)->get();

        foreach ($purchases as $purchase) {
            $purchase->delete();
        }

        $transactions = Transaction::where('user_id', $user->id)->get();

        foreach ($transactions as $transaction) {
            if (Storage::disk('public')->exists($transaction->proof)) {
                Storage::disk('public')->delete($transaction->proof);
            }
            $transaction->delete();
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
