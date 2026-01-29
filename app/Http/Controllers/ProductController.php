<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Load all products so DataTables can handle paging/search/length (e.g. "Show 100 entries").
        $products = Product::with(['cat_info', 'sub_cat_info', 'brand'])
            ->orderByDesc('id')
            ->get();
        return view('backend.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::get();
        $categories = Category::where('is_parent', 1)->get();
        return view('backend.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'summary' => 'required|string',
            'description' => 'nullable|string',
            'warranty' => 'nullable|string',
            'returns' => 'nullable|string',
            'photo' => 'required',
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'size' => 'nullable',
            'stock' => 'required|numeric',
            'weight' => 'nullable|numeric|min:0',
            'cat_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'is_featured' => 'sometimes|in:1',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:default,new,hot',
            'price' => 'required|numeric',
            'discount_enabled' => 'sometimes|in:1',
            'discount' => 'nullable|numeric|min:0|max:100',
            'bulk_discount_type' => 'nullable|in:none,qty,value',
            'bulk_discount_threshold' => 'nullable|numeric',
            'bulk_discount_amount' => 'nullable|numeric',
            'bulk_discount_amount_type' => 'nullable|in:fixed,percent',
        ]);
        // Force only percent type for bulk discount
        $validatedData['bulk_discount_amount_type'] = 'percent';

        $slug = generateUniqueSlug($request->title, Product::class);
        $validatedData['slug'] = $slug;
        $validatedData['is_featured'] = $request->input('is_featured', 0);

        if (!$request->boolean('discount_enabled')) {
            $validatedData['discount'] = 0;
        }

        $sizeInput = $request->input('size');
        if (is_array($sizeInput)) {
            $sizes = $sizeInput;
        } elseif (is_string($sizeInput)) {
            $sizes = preg_split('/\s*,\s*/', $sizeInput, -1, PREG_SPLIT_NO_EMPTY);
        } else {
            $sizes = [];
        }
        $sizes = array_values(array_filter(array_map('trim', $sizes), function ($value) {
            return $value !== '';
        }));
        $validatedData['size'] = empty($sizes) ? '' : implode(',', $sizes);

        // Handle multiple image upload
        $imagePaths = [];
        if($request->hasFile('photo')) {
            foreach($request->file('photo') as $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('products', 'public');
                    $imagePaths[] = '/storage/' . $path;
                }
            }
        }
        $validatedData['photo'] = implode(',', $imagePaths);

        $product = Product::create($validatedData);

        $message = $product
            ? 'Product Successfully added'
            : 'Please try again!!';

        return redirect()->route('product.index')->with(
            $product ? 'success' : 'error',
            $message
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Implement if needed
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brands = Brand::get();
        $product = Product::findOrFail($id);
        $categories = Category::where('is_parent', 1)->get();
        $items = Product::where('id', $id)->get();

        return view('backend.product.edit', compact('product', 'brands', 'categories', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string',
            'summary' => 'required|string',
            'description' => 'nullable|string',
            'warranty' => 'nullable|string',
            'returns' => 'nullable|string',
            'photo' => 'nullable',
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'size' => 'nullable',
            'stock' => 'required|numeric',
            'weight' => 'nullable|numeric|min:0',
            'cat_id' => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'is_featured' => 'sometimes|in:1',
            'brand_id' => 'nullable|exists:brands,id',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:default,new,hot',
            'price' => 'required|numeric',
            'discount_enabled' => 'sometimes|in:1',
            'discount' => 'nullable|numeric|min:0|max:100',
            'bulk_discount_type' => 'nullable|in:none,qty,value',
            'bulk_discount_threshold' => 'nullable|numeric',
            'bulk_discount_amount' => 'nullable|numeric',
        ]);
        // Force only percent type for bulk discount
        $validatedData['bulk_discount_amount_type'] = 'percent';

        $validatedData['is_featured'] = $request->input('is_featured', 0);

        if (!$request->boolean('discount_enabled')) {
            $validatedData['discount'] = 0;
        }

        $sizeInput = $request->input('size');
        if (is_array($sizeInput)) {
            $sizes = $sizeInput;
        } elseif (is_string($sizeInput)) {
            $sizes = preg_split('/\s*,\s*/', $sizeInput, -1, PREG_SPLIT_NO_EMPTY);
        } else {
            $sizes = [];
        }
        $sizes = array_values(array_filter(array_map('trim', $sizes), function ($value) {
            return $value !== '';
        }));
        $validatedData['size'] = empty($sizes) ? '' : implode(',', $sizes);

        // Handle new image uploads and merge with existing
        $existingImages = $product->photo ? explode(',', $product->photo) : [];
        $newImages = [];
        if($request->hasFile('photo')) {
            foreach($request->file('photo') as $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('products', 'public');
                    $newImages[] = '/storage/' . $path;
                }
            }
        }
        $allImages = array_merge($existingImages, $newImages);
        $validatedData['photo'] = implode(',', array_filter($allImages));

        $status = $product->update($validatedData);

        $message = $status
            ? 'Product Successfully updated'
            : 'Please try again!!';

        return redirect()->route('product.index')->with(
            $status ? 'success' : 'error',
            $message
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $status = $product->delete();

        $message = $status
            ? 'Product successfully deleted'
            : 'Error while deleting product';

        return redirect()->route('product.index')->with(
            $status ? 'success' : 'error',
            $message
        );
    }
}
