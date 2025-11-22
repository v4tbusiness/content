<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Content;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Purchase;


class BaseController extends Controller
{

    function home(Package $package)
    {
        $packages = Package::simplePaginate(10);
        return view('home', compact('packages'));
    }

    function package(Package $package)
    {
        // $contents = Content::where('package_id', $package->id)->latest()->simplePaginate(36);
        $contents = Content::where('package_id', $package->id)
            ->orderByRaw('is_premium ASC, created_at DESC') // Non-premium dulu, lalu terbaru
            ->simplePaginate(36);
        return view('package', compact('package', 'contents'));
    }

    function page(Page $page)
    {
        return view('page', compact('page'));
    }

    function explore(Request $request)
    {
        $query = Content::with(['package']);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'LIKE', "%{$search}%")
                ->orWhereHas('package', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                })
                ->orWhere('content_type', 'LIKE', "%{$search}%")
                ->orWhere('source_type', 'LIKE', "%{$search}%")
                ->orWhere('is_premium', 'LIKE', "%{$search}%")
                ->orWhere('created_at', 'LIKE', "%{$search}%");

            $contents = $query->simplePaginate(36);
        } else {
            $contents = Content::latest()->simplePaginate(36);
        }

        return view('explore', compact('contents'));
    }

    function topup()
    {
        $payments = Payment::all();
        return view('topup', compact('payments'));
    }

    function invoice(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(404);
        }
        return view('invoice', compact('transaction'));
    }

    function updateInvoice(UpdateInvoiceRequest $request, Transaction $transaction)
    {
        $validatedData = $request->validated();

        $proofPath = $request->file('proof')->store('proofs', 'public');

        $transaction->update([
            'proof' => $proofPath,
            'notes' => $validatedData['notes'],
        ]);

        return redirect()->route('invoice', $transaction->id)
            ->with('success', 'Transaction updated successfully!!');
    }

    function profile(Request $request)
    {
        return view('profile', [
            'user' => $request->user(),
        ]);
    }

    function profileEdit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    function content(Content $content)
    {
        // Periksa apakah konten adalah premium
        if ($content->is_premium) {

            // Periksa apakah user sudah login
            if (!Auth::check()) {
                return redirect()->route('login')->with('error', 'You need to login first to access this content.');
            }

            // Ambil user yang sedang login
            $user = Auth::user();

            // Periksa apakah user sudah memiliki purchase untuk package ini
            $hasPurchased = Purchase::where('user_id', $user->id)
                ->where('package_id', $content->package_id)
                ->exists();

            // Jika belum, buat purchase baru
            if (!$hasPurchased) {
                $price = $content->package->price;
                if ($user->coins < $price) {
                    // Ambil nama package
                    $packageName = $content->package->name;
                    // Ambil total konten dalam package
                    $totalContents = Content::where('package_id', $content->package_id)->count();
                    return redirect()->route('package', $content->package->slug)->with('error', '<h3 class="text-xl font-semibold text-red-500">This is Premium Content</h3><p>Please top up at least <span class="font-semibold text-gray-800">' . number_format($price) . ' Coins</span> to unlock <span class="font-semibold text-gray-800">' . number_format($totalContents) . ' Contents</span> in the <span class="font-semibold text-indigo-500">' . $packageName . '</span> package.</p>');
                }

                return redirect()->route('package', $content->package->slug)->with('confirm', 'confirm');
            }
        }

        // Ambil semua konten dalam package dengan urutan yang sama seperti halaman package
        // $allContents = Content::where('package_id', $content->package_id)
        //     ->latest() // Sesuai dengan halaman package
        //     ->get();
        $allContents = Content::where('package_id', $content->package_id)
            ->orderByRaw('is_premium ASC, created_at DESC') // Sesuai dengan halaman package
            ->get();

        // Temukan index dari konten saat ini dalam daftar
        $currentIndex = $allContents->search(fn($c) => $c->id === $content->id);

        // Ambil previous dan next berdasarkan posisi dalam daftar
        $previousContent = $currentIndex > 0 ? $allContents[$currentIndex - 1] : null;
        $nextContent = $currentIndex < $allContents->count() - 1 ? $allContents[$currentIndex + 1] : null;

        return view('content', compact('content', 'previousContent', 'nextContent'));
    }
}
