@extends('layouts.master')
@section('title', 'View | Purchase')

@section('content')
    <meta name="csrf-token" content="{{csrf_token()}}">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>View purchase</h4>
                    </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Purchase No</label>
                                        <input type="text" name="purchase_no" id="purchase_no" class="form-control"
                                            disabled value="{{$purchase->purchase_no}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Supplier</label>
                                        <input type="text" name="supplier_id" id="supplier_id" class="form-control"
                                            disabled value="{{$purchase->supplier->name}}">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Paid amount</label>
                                        <input type="text" name="paid_amount" id="paid_amount" class="form-control" value="{{$purchase->paid_amount}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-striped table-responsive">
                                        <thead>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">Product</th>
                                            <th class="text-center">Unit</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">Unit Price</th>
                                            <th class="text-center">Total</th>
                                        </thead>
                                        <tbody class="tbody">
                                            @foreach ($purchase->purchaseMeta as $item)
                                            <tr class="tr">
                                                <td>
                                                    <input type="text"  class="form-control" value="{{$item->category->name}}" disabled>
                                                </td>
                                                <td>
                                                    <input type="text"  class="form-control" value="{{$item->product->name}}" disabled>
                                                </td>
                                                <td>
                                                    <input type="text"  class="form-control" value="{{$item->unit->name}}" disabled>
                                                </td>
                                                <td>
                                                    <input type="text"  class="form-control" value="{{$item->quantity}}" disabled>
                                                </td>
                                                <td>
                                                    <input type="text"  class="form-control" value="{{$item->unit_price}}" disabled>
                                                </td>
                                                <td>
                                                    <input type="text" id="total_1" class="form-control total" disabled placeholder="Total"
                                                    value="{{$item->unit_price * $item->quantity}}" >
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <th colspan="5">Total</th>
                                            <th><input type="text" name="total_amount" id="total" class="form-control" readonly placeholder="All Total" value="{{$purchase->total_amount}}"></th>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            
                              
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
