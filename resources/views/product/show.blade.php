<x-layouts.master>
    <x-data-display.card>
        <x-slot name="heading">
           Product Details of -{{ $product->title }}
        </x-slot>
        <x-slot name="body">

            <div class="row m-1">
                <div class="col-lg-6">
                    <div> 
                        <label for="">
                            <p><strong>Product Title :</strong> {{ isset($product->title) ? $product->title : ' ' }}</p>
                        </label>
                    </div>
                    <div>
                        <label for="">
                            <p><strong>Product SKU :</strong> {{ isset($product->sku) ? $product->sku : ' ' }}</p>
                        </label>
                    </div>

                    <div>
                        <label for="">
                            <p><strong>Unit :</strong> {{ isset($product->unit_id) ? $product->unit->title : ' ' }}</p>
                        </label>
                    </div>
                    <div>
                        <label for="">
                            <p><strong>Applicable Tax :</strong>
                                {{ isset($product->tax) ? $product->tax : ' ' }} %</p>
                        </label>
                    </div>
                    <div>
                        <label for="">
                            <p><strong>Discount:</strong>
                                {{ isset($product->discount) ? $product->discount : ' ' }} %
                            </p>
                        </label>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" width="150" height="100"
                                alt="Product Image">
                        @else
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDpYgKX6Na9EAfhKgjLD4iyPugeNE0wggdkw&usqp=CAU"
                                width="250" height="200" alt="Default Image">
                        @endif
                    </div>


                </div>
            </div>
            <div class="table mt-5">
                <table class="table datatable-basic">
                    <thead class="bg-indigo-600">
                        <tr>
                            <th>SL</th>
                            <th>Product Title</th>
                            <th>SKU</th>
                            <th>Size</th>
                            <th>Color</th>
                            <th>Current Stock</th>
                            <th>Default Selling Price (Exc. tax)</th>
                            <th>Selling Price (Inc. tax)</th>
                            <th>Variation Images</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product->variations as $variation)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $variation->variation_sku }}</td>
                                <td>{{ $variation->size->title }}</td>
                                <td>{{ $variation->color->title }}</td>
                                <td>{{ $variation->stock }} {{ $product->unit->title }}</td>
                                <td>{{ $variation->default_price }}</td>
                                <td>{{ $variation->selling_price }}
                                </td>
                                <td>
                                    @if ($variation->variation_image)
                                        <img src="{{ asset('storage/' . $variation->variation_image) }}" width="100"
                                            height="70" alt="Variation Image">
                                    @else
                                        <span>No Image</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </x-slot>
        <x-slot name="cardFooterCenter">
            <a href="{{ route('product.create') }}"
                class="btn 
            btn-sm 
            bg-success 
            border-2 
            border-success
            btn-icon 
            rounded-round 
            legitRipple 
            shadow 
            mr-1"><i
                    class="icon-plus2"></i></a>
        </x-slot>
    </x-data-display.card>
</x-layouts.master>
