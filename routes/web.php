<?php

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Content;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Purchase;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/contents/{content:slug}', [BaseController::class, 'content'])->name('content'); // need to be updated
Route::get('/explore', [BaseController::class, 'explore'])->name('explore');
Route::get('/', [BaseController::class, 'home'])->name('home');
Route::get('/packages/{package:slug}', [BaseController::class, 'package'])->name('package');
Route::get('/pages/{page:slug}', [BaseController::class, 'page'])->name('page');

Route::middleware('auth')->group(function () {
    Route::get('/invoices/{transaction}', [BaseController::class, 'invoice'])->name('invoice');
    Route::put('/invoices/{transaction}', [BaseController::class, 'updateInvoice'])->name('updateInvoice');
    Route::get('/profile', [BaseController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [BaseController::class, 'profileEdit'])->name('profileEdit');
    Route::get('/topup', [BaseController::class, 'topup'])->name('topup');
    Route::post('/admin/purchases', [PurchaseController::class, 'store'])->name('purchases.store');
    Route::post('/admin/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'access:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        $totalPackages = Package::count();
        $totalContents = Content::count();
        $totalPurchases = Purchase::count();
        $totalTransactions = Transaction::count();
        $totalUsers = User::count();
        $profit = Transaction::where('status', 'approved')->sum('price');

        $transactions = Transaction::latest()->paginate(5);
        $purchases = Purchase::latest()->paginate(5);
        $users = User::all();
        $payments = Payment::all();
        $packages = Package::all();
        $setting = Setting::first();
        return view('admin.dashboard', compact('totalPackages', 'totalContents', 'totalPurchases', 'totalTransactions', 'totalUsers', 'profit', 'transactions', 'purchases', 'users', 'payments', 'packages', 'setting'));
    })->name('dashboard');

    Route::resource('/admin/contents', ContentController::class)->except(['show'])->names([
        'index' => 'contents.index',
        'create' => 'contents.create',
        'store' => 'contents.store',
        'edit' => 'contents.edit',
        'update' => 'contents.update',
        'destroy' => 'contents.destroy',
    ]);

    Route::resource('/admin/packages', PackageController::class)->except(['show'])->names([
        'index' => 'packages.index',
        'create' => 'packages.create',
        'store' => 'packages.store',
        'edit' => 'packages.edit',
        'update' => 'packages.update',
        'destroy' => 'packages.destroy',
    ]);

    Route::resource('/admin/pages', PageController::class)->except(['show'])->names([
        'index' => 'pages.index',
        'create' => 'pages.create',
        'store' => 'pages.store',
        'edit' => 'pages.edit',
        'update' => 'pages.update',
        'destroy' => 'pages.destroy',
    ]);

    Route::resource('/admin/payments', PaymentController::class)->except(['show'])->names([
        'index' => 'payments.index',
        'create' => 'payments.create',
        'store' => 'payments.store',
        'edit' => 'payments.edit',
        'update' => 'payments.update',
        'destroy' => 'payments.destroy',
    ]);

    Route::resource('/admin/purchases', PurchaseController::class)->except(['create', 'store', 'show', 'edit', 'update', 'destroy'])->names([
        'index' => 'purchases.index',
    ]);

    Route::resource('/admin/settings', SettingController::class)->except(['create', 'store', 'show', 'edit', 'destroy'])->names([
        'index' => 'settings.index',
        'update' => 'settings.update',
    ]);

    Route::resource('/admin/transactions', TransactionController::class)->except(['create', 'store', 'show', 'edit', 'destroy'])->names([
        'index' => 'transactions.index',
        'update' => 'transactions.update',
    ]);

    Route::resource('/admin/users', UserController::class)->except(['show'])->names([
        'index' => 'users.index',
        'create' => 'users.create',
        'store' => 'users.store',
        'edit' => 'users.edit',
        'update' => 'users.update',
        'destroy' => 'users.destroy',
    ]);

    Route::get('/admin/contents/import', [ImportController::class, 'import'])->name('import');
    Route::post('/admin/contents/import', [ImportController::class, 'storeImport'])->name('storeImport');

    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
