<x-layouts.master>  
    <x-data-display.card>
        <x-slot name="heading">
            Products
        </x-slot>
        <x-slot name="body">
            <div class="table">
                <table class="table datatable-basic">
                    <thead class="bg-indigo-600">
                        <tr>
                            <th>SL</th>
                            <th>Title</th>
                            <th>SKU</th>
                            <th>TAX</th>
                            <th>Discount</th>
                            <th>Image</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->tax }} %</td>
                                <td>{{ $product->discount }} %</td>
                                <td><img src="{{ asset('storage/'.$product->image)}}" width="100"
                                        height="70" alt="no image"></td>
                                
                               <td class="text-center">
									<div class="list-icons">
										<div class="dropdown">
											<a href="#" class="list-icons-item" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>

											<div class="dropdown-menu dropdown-menu-right">
												<a href="" class="dropdown-item"><i class="icon-pencil7"></i> Edit Product</a>
												<a href="{{ route('product.show', $product->id) }}" class="dropdown-item"><i class="icon-eye"></i> View Product</a>
                                                <form style="display:inline" action="{{ route('product.destroy', $product->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button
                                                        onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this product?')){ this.closest('form').submit(); }"
                                                        class="dropdown-item"
                                                        title="Delete product">
                                                        <i class="icon-trash-alt"></i>Delete
                                                    </button>
                                                </form>
											</div>
										</div>
									</div>
								</td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </x-slot>
        <x-slot name="cardFooterCenter">
            <a href="{{ route('product.create') }}" class="btn 
            btn-sm 
            bg-success 
            border-2 
            border-success
            btn-icon 
            rounded-round 
            legitRipple 
            shadow 
            mr-1"><i class="icon-plus2"></i></a>
        </x-slot>
    </x-data-display.card>
</x-layouts.master>