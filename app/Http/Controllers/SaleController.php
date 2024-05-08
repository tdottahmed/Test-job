<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\SaleProduct;
use App\Models\Variation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with('saleProduct')->latest()->get();
        return view('pos.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Variation::paginate(58);
        return view('pos.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $salesInfos = $request->only('customer_id', 'total_price', 'paid_amount', 'total_quantity', 'discountedAmount', 'payment_type');
            $sale = Sale::create($salesInfos);
            $productIds = $request->variation_ids;
            foreach ($productIds as $key => $id) {
                $productSale = SaleProduct::create([
                    'sale_id' => $sale->id,
                    'variation_id' => $id,
                    'product_id' => $request->product_ids[$key],
                    'quantity' => $request->proQuantity[$key],
                    'unit_total' => $request->unit_price[$key],
                    'sub_total' => $request->sub_total[$key]
                ]);
                $variation = Variation::find($productSale->variation_id);
                $newStock = ($variation->stock - $productSale->quantity);
                $variation->update(['stock'=>$newStock]);
            }
            return redirect()->route('pos.index')->with('success', 'Order Stored Successfully');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }

    public function singleProduct($id)
    {
        $variation = Variation::find($id);
        $data = [
                'id'=>$variation->id,
                'product_id'=>$variation->product_id,
                'title'=>$variation->product->title,
                'sku'=>$variation->variation_sku,
                'unit_value'=>$variation->unit_value,
                'stock'=>$variation->stock,
                'default_price'=>$variation->default_price,
                'selling_price'=>$variation->selling_price,
        ];       
        return response()->json($data);
    }

    
}
