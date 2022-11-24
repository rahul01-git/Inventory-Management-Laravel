@extends('layouts.master')
@section('title', 'Invoice')
@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $page_title }}</h4>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <th>Sl No.</th>
                                <th>Invoice No</th>
                                <th>Total Amount</th>
                                <th>Paid Amount</th>
                                <th>Due Amount</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{$invoice->invoice_no}}</td>
                                        <td>{{$invoice->total_amount}}</td>
                                        <td>{{$invoice->paid_amount}}</td>
                                        <td>{{$invoice->due_amount}}</td>
                                        <td><a href="{{ route('invoice.edit', $invoice->id) }}"
                                                class="btn btn-primary">Edit
                                            </a> |
                                            <button type="button" class="btn btn-danger delete" data-toggle="modal"
                                                data-target="#exampleModal" id="{{$invoice->id}}">
                                                Delete
                                            </button> |
                                            <a href="{{ route('invoice.show', $invoice->id) }}"
                                                class="btn btn-success">View
                                            </a> 
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="deleteModal" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="exampleModalLabel">Confirm Delete</h5>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger ">Delete</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            
        });

        $('.delete').on('click',function(){
            const id = this.id;
            $('#deleteModal').attr('action','{{route("invoice.destroy","")}}'+'/'+id);
        });
    </script>
@endsection
