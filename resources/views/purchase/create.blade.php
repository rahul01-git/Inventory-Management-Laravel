@extends('layouts.master')
@section('title', 'Create | Purchase')

@section('content')
    <meta name="csrf-token" content="{{csrf_token()}}">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add purchase</h4>
                    </div>
                    <form action="{{ route('purchase.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Purchase No</label>
                                        <input type="text" name="purchase_no" id="purchase_no" class="form-control"
                                            readonly value="{{$purchase_no}}">
                                    </div>
                                    @error('purchase_no')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Supplier</label>
                                        <select name="supplier_id" id="supplier_id" class="form-control">
                                            <option>--Choose supplier --</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('supplier_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Paid amount</label>
                                        <input type="text" name="paid_amount" id="paid_amount" class="form-control">
                                    </div>
                                    @error('paid_amount')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <table class="table table-striped table-responsive">
                                        <thead>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">Product</th>
                                            <th class="text-center">Unit</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">Unit Price</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">
                                                <button class="btn btn-success" type="button" onclick="cloneRow()"><i class="fas fa-plus" ></i></button>
                                            </th>
                                        </thead>
                                        <tbody class="tbody">
                                            <tr class="tr">
                                                <td>
                                                    <select name="category_id[]" id="category_1" class="form-control category">
                                                        <option>--Choose Category--</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="product_id[]" id="product_1" class="form-control">
                                                        <option>--Choose Product--</option>
                
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="unit_id[]" id="unit_1" class="form-control">
                                                        <option>--Choose Unit--</option>
                                                        @foreach ($units as $unit)
                                                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="quantity[]" id="quantity_1" onkeyup="calculateTotal(event)" class="form-control" placeholder="Quantity">
                                                </td>
                                                <td>
                                                    <input type="text" name="unit_price[]" id="price_1" onkeyup="calculateTotal(event)" class="form-control" placeholder="Unit Price">
                                                </td>
                                                <td>
                                                    <input type="text" id="total_1" class="form-control total" disabled placeholder="Total">
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger" type="button" onclick="removeRow(event)">x</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <th colspan="5">Total</th>
                                            <th><input type="text" name="total_amount" id="total" class="form-control" readonly placeholder="All Total"></th>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"> Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let count = 2;
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name = "csrf-token"]').attr('content')
            }
        })
        function cloneRow(){
            const tr = `
            <tr class="tr">
                <td>
                    <select name="category_id[]" id="category_${count}" class="form-control category">
                        <option>--Choose Category--</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="product_id[]" id="product_${count}" class="form-control">
                        <option>--Choose Product--</option>

                    </select>
                </td>
                <td>
                    <select name="unit_id[]" id="unit_${count}" class="form-control">
                        <option>--Choose Unit--</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="text" name="quantity[]" id="quantity_${count}" onkeyup="calculateTotal(event)" class="form-control" placeholder="Quantity">
                </td>
                <td>
                    <input type="text" name="unit_price[]" id="price_${count}" onkeyup="calculateTotal(event)" class="form-control" placeholder="Unit Price">
                </td>
                <td>
                    <input type="text" id="total_${count}" class="form-control total" disabled placeholder="Total">
                </td>
                <td>
                    <button class="btn btn-danger" type="button" onclick="removeRow(event)">x</button>
                </td>
            </tr>
            `;

            $('.tbody').append(tr);
            count++;
            
        }

        function removeRow(event){
            if($('.tr').length>1){
                $(event.target).closest('tr').remove();
            }
        }

        function calculateTotal(event){
            let allTotal = 0;
            const id = $(event.target).attr('id') 
            const number = id.split('_')
            const quantity = parseFloat($('#quantity_'+number[1]).val())
            const price = parseFloat($('#price_'+number[1]).val())
            const total = quantity * price

            console.log(quantity,price,total)
            $('#total_'+number[1]).val(total)

            $('.total').each(function(){
                const value = parseFloat($(this).val())
                if($(this).val() != ''){
                    allTotal += value;
                }
            });

            $('#total').val(allTotal);


        }

        $(document).on('change', '.category', function () {
            const id = $(this).val();
            const dataId = $(this).attr('id')
            const num = dataId.split('_')
            $.ajax({
                type: "GET",
                url: "{{route('product.get','')}}" +'/' +id,
                dataType: "json",
                success: function (data) {
                    let html = '<option>--Choose Product--</option>'
                    
                    data.forEach(product => {
                        html += `<option value=${product.id}>${product.name}</option>`
                    });

                    $('#product_'+num[1]).html(html)
                    
                }
            });
            console.log(id)
        }) 

    </script>
@endsection