<x-layouts.master>
    <x-data-display.card>
        <x-slot name="heading">
            {{ __('Insert Your Product Info') }}
        </x-slot>
        <x-slot name="body">
            <form action="{{ route('product.store') }} " method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label for="title">Name:</label>
                        <input type="text" class="form-control" name="title" id="title">
                    </div>
                    <div class="col-lg-6">
                        <label for="sku">Sku Code(Leave empty to generate):</label>
                        <input type="text" class="form-control" name="sku" id="sku" placeholder="Leave empty to generate">
                    </div>
                </div>
                <hr>
                
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label for="">{{ __('Select Unit') }}</label>
                        <select name="unit_id" id="unit_id" class="form-control select-search">
                            <option value="">-- Please select --</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label for="image">Image</label>
                        <input type="file" class="form-control h-auto" name="image" id="image">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label for="">{{ __('Tax(%)') }}</label>
                        <input type="number" name="tax" id="tax" class="form-control" placeholder="10%">
                    </div>
                    <div class="col-lg-6">
                        <label for="image">{{__('Discount(%)')}}</label>
                        <input type="number" class="form-control" name="discount" id="discount">
                    </div>
                </div>
               
                
                <div class="row mb-3">
                    
                    
                </div>
                <hr>
                <div class="card ">
                    <div class="card-body ">
                        <div id="varibale_product">
                            <table class="table table-bordered">
                                <thead class="bg-indigo-600">
                                    <tr>
                                        <th>SKU(Leave empty to generate)</th>
                                        <th>Size</th>
                                        <th>Color</th>
                                        <th>Unit Value</th>
                                        <th>Default Price</th>
                                        <th>Stock</th>
                                        <th>Variation Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="multiple_variation">
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="child[variation_sku][]"
                                                placeholder="Leave empty to generate">
                                        </td>
                                        <td>
                                            <select name="child[size_id][]" id="size_id" class="form-control select-search">
                                                <option value="">-- Please select --</option>
                                                @foreach ($sizes as $size)
                                                    <option value="{{ $size->id }}">{{ $size->title }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="child[color_id][]" id="color_id" class="form-control select-search">
                                                <option value="">-- Please select --</option>
                                                @foreach ($colors as $color)
                                                    <option value="{{ $color->id }}">{{ $color->title }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="child[unit_value][]"
                                                placeholder="">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="child[default_price][]"
                                                placeholder="Inc. Tax">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="child[stock][]"
                                                placeholder="">
                                        </td>
                                        <td>
                                            <input type="file" class="form-control h-auto" name="child[variation_image][]">
                                        </td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-sm rounded-round btn-icon bg-danger-800 shadow d-none">
                                                <i class="icon-cross"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row justify-content-end mt-2">
                                <div class="col-lg-2 text-right">
                                    <button type="button"
                                        class="btn btn-sm bg-indigo border-2 border-indigo btn-icon rounded-round legitRipple shadow mr-1"
                                        id="vriation_add"><i class="icon-plus3"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-end">
                    <div class="col-lg-4 text-right">
                        <a class="btn btn-lg bg-danger-400 shadow-2" href=""><i
                                class="icon-cross2 mr-1"></i>Cancel</a>
                        <button type="submit" class="btn btn-lg bg-teal-400 shadow-2"><i
                                class="icon-checkmark4 mr-1"></i>{{ __('Submit') }}</button>
                    </div>
                </div>

            </form>
        </x-slot>
        <x-slot name="cardFooterCenter">
            <a href="{{ route('product.index') }}"
                class="btn 
            btn-sm bg-indigo 
            border-2 
            border-indigo 
            btn-icon 
            rounded-round 
            legitRipple 
            shadow 
            mr-1"><i
                    class="icon-list"></i></a>
        </x-slot>
    </x-data-display.card>
    <script>
        $(document).ready(function() {           
            $('#vriation_add').click(function() {
                let html = 
                `<tr>
                <td>
                    <input type="text" class="form-control" name="child[variation_sku][]" placeholder="Variation SKU">
                </td>
                <td>
                    <select name="child[size_id][]" class="form-control select-search">
                        <option value="">-- Please select --</option>
                        @foreach ($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->title }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="child[color_id][]" class="form-control select-search">
                        <option value="">-- Please select --</option>
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->title }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" class="form-control" name="child[unit_value][]"
                        placeholder="">
                </td>
                <td>
                    <input type="number" class="form-control" name="child[default_price][]" placeholder="Exc. Tax">
                </td>
                <td>
                    <input type="number" class="form-control" name="child[stock][]" placeholder="">
                </td>
                <td>
                    <input type="file" class="form-control h-auto" name="child[variation_image][]">
                </td>
                <td>
                    <button type="button" class="btn btn-sm rounded-round btn-icon bg-danger-800 shadow remove-row">
                        <i class="icon-cross"></i>
                    </button>
                </td>
            </tr>`
                ;
                $('#multiple_variation').append(html);
            });

            $(document).on('click', '.remove-row', function() {
                if (confirm("Are you sure you want to delete this row?")) {
                    $(this).closest('tr').remove();
                }
            });
        });
    </script>
</x-layouts.master>
