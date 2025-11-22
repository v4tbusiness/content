<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Package;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Package::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('price', 'LIKE', "%{$search}%");

            $packages = $query->paginate(10);
        } else {
            $packages = Package::latest()->paginate(10);
        }

        return view('admin.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePackageRequest $request)
    {
        $validated = $request->validated();

        $data = [
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'description' => $validated['description'],
            'price' => $validated['price'],
        ];

        if ($request->hasFile('cover')) {
            $imagePath = $request->file('cover')->store('packages/cover', 'public');
            $data['cover'] = $imagePath;
        }

        Package::create($data);

        return redirect()->route('packages.index')->with('success', 'Package created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePackageRequest $request, Package $package)
    {
        $validated = $request->validated();

        $data = [
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'description' => $validated['description'],
            'price' => $validated['price'],
        ];

        if ($request->hasFile('cover')) {
            if (Storage::disk('public')->exists($package->cover)) {
                Storage::disk('public')->delete($package->cover);
            }
            $imagePath = $request->file('cover')->store('packages/cover', 'public');
            $data['cover'] = $imagePath;
        }

        $package->update($data);

        return redirect()->route('packages.index')->with('success', 'Package updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        $contents = Content::where('package_id', $package->id)->get();

        foreach ($contents as $content) {
            if (Storage::disk('public')->exists($content->source)) {
                Storage::disk('public')->delete($content->source);
            }
            if (Storage::disk('public')->exists($content->thumbnail)) {
                Storage::disk('public')->delete($content->thumbnail);
            }
            $content->delete();
        }

        $purchases = Purchase::where('package_id', $package->id)->get();

        foreach ($purchases as $purchase) {
            $purchase->delete();
        }

        if (Storage::disk('public')->exists($package->cover)) {
            Storage::disk('public')->delete($package->cover);
        }

        $package->delete();
        return redirect()->route('packages.index')->with('success', 'Package deleted successfully!');
    }
}
