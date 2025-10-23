<?php

// app/Http/Controllers/CategoryController.php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Attachment; 

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','store']]);
    }

    public function index(Request $request)
    {
        
        $category = $request->input('category');
        $status = $request->input('status-cat');//dd($status);
        // Table data
        $categories = Category::with(['attachments' => fn($q) => $q->latest()])
            ->when($category, function ($query, $category) {
                $query->where('name', $category);
            })
            ->when($status !== null && $status !== '', function ($query) use ($status) {
                $query->where('is_active', $status);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $allCategories = Category::query()
            ->select('name')
            ->whereNotNull('name')
            ->where('name', '!=', '')
            ->distinct()
            ->orderBy('name')
            ->pluck('name');//dd($allCategories);
        
        return view('category-item.index', compact('categories', 'allCategories'));
    }

    public function create()
    {
        return view('category-item.create_category');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'status'       => 'required|in:0,1',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image_base64' => 'nullable|string',
        ]);

        $category = Category::create([
            'name'      => $request->name,
            'is_active' => (int) $request->status,
        ]);

        if ($request->filled('image_base64')) {
            $data   = preg_replace('#^data:image/\w+;base64,#i', '', $request->image_base64);
            $binary = base64_decode($data);

            $pathInDisk = 'uploads/'.time().'_'.uniqid().'.png';
            Storage::disk('public')->put($pathInDisk, $binary);

            $category->attachments()->create([
                'path'              => $pathInDisk,                
                'filename'          => basename($pathInDisk),      
                'original_filename' => 'base64.png',
                'size'              => strlen($binary),
                'mime_type'         => 'image/png',                
                'is_primary'        => true,                       
                'display_order'     => 0,                          
            ]);
        } elseif ($request->hasFile('image')) {
            $file       = $request->file('image');
            $pathInDisk = $file->store('uploads', 'public');      

            $category->attachments()->create([
                'path'              => $pathInDisk,
                'filename'          => basename($pathInDisk),      
                'original_filename' => $file->getClientOriginalName(),
                'size'              => $file->getSize(),
                'mime_type'         => $file->getMimeType(),       
                'is_primary'        => true,
                'display_order'     => 0,
            ]);
        }

        return redirect()->route('product-category.index')->with('success', 'Category created successfully!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $category = Category::with('attachments')->findOrFail($id);
        return view('category-item.edit_category', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'status' => 'required|in:0,1',
            'image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $category = Category::with('attachments')->findOrFail($id);

        $category->update([
            'name'      => $request->name,
            'is_active' => (int) $request->status,
        ]);

        
        if ($request->hasFile('image')) {
            $old = $category->attachments()->latest()->first();
            if ($old) {
                if ($old->path && Storage::disk('public')->exists($old->path)) {
                    Storage::disk('public')->delete($old->path);
                }
                $old->delete();
            }

            $file       = $request->file('image');
            $pathInDisk = $file->store('uploads', 'public');

            $category->attachments()->create([
                'path'              => $pathInDisk,
                'filename'          => basename($pathInDisk),      
                'original_filename' => $file->getClientOriginalName(),
                'size'              => $file->getSize(),
                'mime_type'         => $file->getMimeType(),
                'is_primary'        => true,
                'display_order'     => 0,
            ]);
        }

        return redirect()->route('product-category.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::with('attachments')->findOrFail($id);
        $category->delete();

        return redirect()->route('product-category.index')->with('success', 'Category deleted successfully.');
    }
}

