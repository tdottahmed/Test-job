<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Unit;
use App\Models\Color;
use App\Models\Product;
use App\Models\Variation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colors = Color::all();
        $sizes = Size::all();
        $units = Unit::all();
        return view('product.create', compact('colors', 'sizes', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $productInfos = $request->except('child', '_token', 'sku');
        $variations = $request->child;
        $validatedData = $request->validate([
            'variations.default_price' => 'required|array',
        ]);
        try {
            $productImagePath = null;
            if ($request->file('image')) {
                $productImagePath = $this->uploadFile($request->file('image'), 'product/images');
            }
            $product = Product::create([
                'uuid' => Str::uuid(),
                'sku'  => $request->sku ? $request->sku : $this->generateProductSKU(),
                'image' => $productImagePath
            ] + $productInfos);
            foreach ($variations['default_price'] as $key => $default_price) {
                $variationImagePath = null;
                if (isset($variations['variation_image'][$key])) {
                    $variationImagePath = $this->uploadFile($variations['variation_image'][$key], 'product-variation/images');
                }
                Variation::create([
                    'product_id' => $product->id,
                    'variation_sku' => $variations['variation_sku'][$key] ? $variations['variation_sku'][$key] : $product->sku . '-' . $key,
                    'size_id' => $variations['size_id'][$key],
                    'color_id' => $variations['color_id'][$key],
                    'unit_value' => $variations['unit_value'][$key],
                    'default_price' => $default_price,
                    'selling_price' => $default_price + ($default_price * $productInfos['tax'] / 100) - ($default_price * $productInfos['discount'] / 100),
                    'stock' => $variations['stock'][$key],
                    'variation_image' => $variationImagePath,
                ]);
            }
            return redirect()->route('product.index')->with('success', 'Product Inserted Successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    function uploadFile($file, $directory)
    {
        if (!$file) {
            return null;
        }
        Storage::makeDirectory($directory);
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs($directory, $fileName, 'public');
        return $filePath;
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $product = Product::where('sku', 'like', "%$searchTerm%")
            ->orWhere('title', 'like', "%$searchTerm%")
            ->first();
        $products = $product->variations;
        foreach ($products as $product) {
            $product->variation_image = asset('storage/' . $product->variation_image);
        }
        return response()->json($products);
    }
    public function generateProductSKU()
    {
        do {
            $randomNumber = str_pad(mt_rand(100000, 999999), 6, '0', STR_PAD_LEFT);
            $sku = 'SKU-' . $randomNumber;
            $existingProduct = Product::where('sku', $sku)->first();
        } while ($existingProduct);
        return $sku;
    }
}
