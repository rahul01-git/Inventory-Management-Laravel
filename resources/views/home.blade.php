@extends('layouts.master');
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-chart">
                        <canvas id="sales-chart" height="80"></canvas>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Product Available</h4>
                        </div>
                        <div class="card-body">
                            {{ $productCount }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-chart">
                        <canvas id="balance-chart" height="80"></canvas>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Purchase</h4>
                        </div>
                        <div class="card-body">
                            ${{ $purchaseCount }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-chart">
                        <canvas id="sales-chart" height="80"></canvas>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Today Sales</h4>
                        </div>
                        <div class="card-body">
                            ${{ $invoiceCount }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h4>Unpaid Invoices</h4>
                <div class="card-header-action">
                  <a href="{{route('invoice.index')}}" class="btn btn-danger">View all invoices <i class="fas fa-chevron-right"></i></a>
                </div>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive table-invoice">
                  <table class="table table-striped">
                    <tr>
                      <th>Invoice ID</th>
                      <th>Customer</th>
                      <th>Status</th>
                    </tr>
                    @foreach ($unpaidInvoices as $item)
                        <td>{{$item->invoice_no}}</td>
                        <td>{{$item->customer->name}}</td>
                        <td><span class="badge badge-danger">Unpaid</span></td></td>
                    @endforeach
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h4>Unpaid Purchases</h4>
                <div class="card-header-action">
                  <a href="{{route('purchase.index')}}" class="btn btn-danger">View all purchases <i class="fas fa-chevron-right"></i></a>
                </div>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive table-invoice">
                  <table class="table table-striped">
                    <tr>
                      <th>Purchase ID</th>
                      <th>Supplier</th>
                      <th>Status</th>
                    </tr>
                    @foreach ($unpaidPurchases as $item)
                        <td>{{$item->purchase_no}}</td>
                        <td>{{$item->supplier->name}}</td>
                        <td><span class="badge badge-danger">Unpaid</span></td></td>
                    @endforeach
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
@endsection
