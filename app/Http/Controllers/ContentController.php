<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Package;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreContentRequest;
use App\Http\Requests\UpdateContentRequest;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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

            $contents = $query->paginate(10);
        } else {
            $contents = Content::latest()->paginate(10);
        }

        $packages = Package::all();
        return view('admin.contents.index', compact('contents', 'packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $packages = Package::all();
        return view('admin.contents.create', compact('packages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContentRequest $request)
    {
        $validated = $request->validated();

        $data = [
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'package_id' => $validated['package_id'],
            'content_type' => $validated['content_type'],
            'source_type' => $validated['source_type'],
            'is_premium' => $request->has('is_premium'),
        ];

        if ($validated['source_type'] === 'file' && $request->hasFile('source')) {
            $filePath = $request->file('source')->store('contents/' . $validated['content_type'], 'public');
            $data['source'] = $filePath;
        } elseif ($validated['source_type'] === 'url') {
            $data['source'] = $validated['source'];
        }

        if ($validated['content_type'] === 'video' && $request->hasFile('thumbnail')) {
            $imagePath = $request->file('thumbnail')->store('contents/' . $validated['content_type'] . '/thumbnail', 'public');
            $data['thumbnail'] = $imagePath;
        } elseif ($validated['content_type'] === 'image' && $request->hasFile('thumbnail')) {
            $imagePath = $request->file('thumbnail')->store('contents/' . $validated['content_type'] . '/thumbnail', 'public');
            $data['thumbnail'] = $imagePath;
        }

        Content::create($data);

        return redirect()->route('contents.index')->with('success', 'Content created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Content $content)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Content $content)
    {
        $packages = Package::all();
        return view('admin.contents.edit', compact('content', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContentRequest $request, Content $content)
    {
        $validated = $request->validated();

        $data = [
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'package_id' => $validated['package_id'],
            'content_type' => $validated['content_type'],
            'source_type' => $validated['source_type'],
            'is_premium' => $request->has('is_premium')
        ];

        if ($validated['source_type'] === 'file' && $request->hasFile('source')) {
            if (Storage::disk('public')->exists($content->source)) {
                Storage::disk('public')->delete($content->source);
            }
            $filePath = $request->file('source')->store('contents/' . $validated['content_type'], 'public');
            $data['source'] = $filePath;
        } elseif ($validated['source_type'] === 'url') {
            if (Storage::disk('public')->exists($content->source)) {
                Storage::disk('public')->delete($content->source);
            }
            $data['source'] = $validated['source'];
        }

        if ($validated['content_type'] === 'video' && $request->hasFile('thumbnail')) {
            if (Storage::disk('public')->exists($content->thumbnail)) {
                Storage::disk('public')->delete($content->thumbnail);
            }
            $imagePath = $request->file('thumbnail')->store('contents/' . $validated['content_type'] . '/thumbnail', 'public');
            $data['thumbnail'] = $imagePath;
        } elseif ($validated['content_type'] === 'image' && $request->hasFile('thumbnail')) {
            if (Storage::disk('public')->exists($content->thumbnail)) {
                Storage::disk('public')->delete($content->thumbnail);
            }
            $imagePath = $request->file('thumbnail')->store('contents/' . $validated['content_type'] . '/thumbnail', 'public');
            $data['thumbnail'] = $imagePath;
        }

        $content->update($data);

        return redirect()->route('contents.index')->with('success', 'Content updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content)
    {
        if (Storage::disk('public')->exists($content->source)) {
            Storage::disk('public')->delete($content->source);
        }
        if (Storage::disk('public')->exists($content->thumbnail)) {
            Storage::disk('public')->delete($content->thumbnail);
        }
        $content->delete();
        return redirect()->route('contents.index')->with('success', 'Content deleted successfully!');
    }
}
