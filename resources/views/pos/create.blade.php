<x-layouts.master>    
    <div class="main-content">
        <div id="createDiscount" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Discount</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="discountForm">
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">{{ __('Select Expense Category') }}</label>
                                <div class="col-sm-9">
                                    <select name="discountType" id="discountType" class="form-control select-search">
                                        <option value="" disabled selected>-- Please select --</option>
                                        <option value="plain">Plain ammount</option>
                                        <option value="percent">Percentage</option>
                                    </select>
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">Amount</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="amount" id="amountInput"
                                        placeholder="ex 0.00">
                                </div>
                            </div>
                    </div>
        
                    <div class="modal-footer">
                        <button type="button" class="btn btn-lg bg-danger-400 shadow-2" data-dismiss="modal"><i
                                class="icon-cross2 mr-1"></i>Close</button>
                        <button type="submit" class="btn btn-lg bg-teal-400 shadow-2"><i
                                class="icon-checkmark4 mr-1 "></i>{{ __('Submit') }}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card-body ">
                <div class="buttons">
                    <a href="{{route('pos.index')}}" class="btn btn-sm bg-blue-800 mr-2"><i class="icon icon-list2 mr-2"></i>Pos List</a>
                </div>      
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        Product
                    </div>
                    <div class="card-body">
                        <form action="" id="searchProductForm">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search Product by SKU or title" id="searchInput">
                                <span class="input-group-append bg-indigo-600">
                                    <button class="btn btn-primary" type="submit"><i class="icon-search4"></i></button>
                                </span>
                            </div>
                        </form>                        
                        <div class="row my-3" id="productContainer">
                            @foreach ($products as $variation)
                                <div class="col-xl-3 col-4 col-lg-3" >
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-img-actions">
                                                <a target="_blank" href="{{ asset('storage/' . $variation->variation_image)}}" data-popup="lightbox">
                                                    <img height="180px" width="150px" src="{{ asset('storage/' . $variation->variation_image) }}" class="card-img" alt="{{ $variation->product->title }}">
                                                    <span class="card-img-actions-overlay card-img">
                                                        <i class="icon-plus3 icon-2x"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body bg-light text-center">
                                            <div class="mb-2">
                                                <h6 class="font-weight-semibold mb-0">
                                                    <a href="#" class="text-default">{{$variation->product->title }}</a>
                                                </h6>
                                            </div>
                                            <h3 class="mb-0 font-weight-semibold">Price: {{ $variation->selling_price }} /- <del>{{$variation->default_price}}</del></h3> 
                                            <button type="button" onclick="addProductToCart({{$variation->id}})" class="btn bg-teal-400 addToCartBtn"><i class="icon-cart-add mr-2"></i> Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">
                        Billing Section
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pos.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="total_price" id="total_price">
                            <input type="hidden" name="paid_amount" id="paid_amount">
                            <input type="hidden" name="total_quantity" id="total_quantity">
                            <div class="scroll-product">
                                <div class="card">
                                    <table class="table table-bordered" id="productTable">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Unit Price</th>
                                                <th>Sub Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="productTbody">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card shadow-lg height-full">
                                <div class="m-3">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="button" class="btn btn-sm bg-brown-800" data-toggle="modal"
                                                data-target="#createDiscount">Discount (-) <i
                                                    class="icon icon-pencil7 ml-2"></i></button>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" name="discountAmount" class="form-control"
                                                id="discountAmount" disabled>
                                            <input type="hidden" name="discountedAmount" id="discountedAmmount">
                                        </div>
                                    </div>
                                    <div class="row justify-content-center mt-2">
                                        <div class="card-body ">
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <h6 class=" text-bold ">Total Item :</h6>
                                                    </td>
                                                    <td>
                                                        <p class="text-bold " id="total">0</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p class=" text-bold ">Total Price :</p>
                                                    </td>
                                                    <td>
                                                        <p class=" text-bold "id="totalPrice">0.0</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p class=" text-bold ">Payable Amount :</p>
                                                    </td>
                                                    <td>
                                                        <p class=" text-bold "id="payable_amount">0.0</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between mx-4 card-body">
                                        <div class="col-lg-4 form-check">
                                            <label class="form-check-label">
                                                <div class="uniform-choice border-info text-info"><span class=""><input
                                                            type="radio" name="payment_type" value="cash"
                                                            class="form-check-input-styled-info" data-fouc=""></span></div>
                                                Cash Payment
                                            </label>
                                        </div>
                                        <div class="col-lg-4 form-check">
                                            <label class="form-check-label">
                                                <div class="uniform-choice border-warning text-warning"><span
                                                        class=""><input type="radio" name="payment_type"
                                                            value="Bank" class="form-check-input-styled-warning"
                                                            data-fouc=""></span></div>
                                                Bank Pyment
                                            </label>
                                        </div>
                                        <div class="col-lg-4 form-check">
                                            <label class="form-check-label">
                                                <div class="uniform-choice border-danger text-danger"><span
                                                        class=""><input type="radio" name="payment_type"
                                                            value="mobile_banking" class="form-check-input-styled-danger"
                                                            data-fouc=""></span></div>
                                                Mobile Banking
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary fs-1 w-100 py-2 mt-3"> <i
                                            class="icon-shredder mr-2"></i> Print Bills</button>
                                </div>
                            </div>
                        </form>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
    <x-pos.script/>
    @endpush
</x-layouts.master>
