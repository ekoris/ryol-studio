@extends('admin.theme.master')

@php
use App\Constants\CategoryType;
@endphp

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
@endpush

@section('body')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Order
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Order</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-7 col-lg-12 row" style="text-align: right">
                                <form class="form-inline">
                                  
                                    <div class="form-group">
                                        <input type="text" name="created" class="form-control datepicker-input" placeholder="create" value="{{ Request::get('created') }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="product" class="form-control" placeholder="Search Product..." value="{{ Request::get('product') }}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="text" name="user" class="form-control" placeholder="Search User..." value="{{ Request::get('user') }}">
                                    </div>
                                    <button type="submit" class="btn btn-default">
                                        <span class="fa fa-search"></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th></th>
                                    <th>Status</th>
                                    <th>Create</th>
                                    <th>Product</th>
                                    <th>Variation</th>
                                    <th>Edition</th>
                                    <th>Total Order</th>
                                    <th>Shipping</th>
                                    <th>Product Detail</th>
                                    <th>User</th>
                                </tr>
                                @forelse ($orders as $item)
                                    <tr>
                                        <td>
                                            @switch($item->status)
                                                @case(1)
                                                    <a href="{{ route('admin.order.action', [$item->id, 'status' => 2]) }}" onclick = "if (! confirm('Are You Sure Approve this orders ??')) { return false; }">
                                                        <button class="btn btn-danger btn-sm">Approve</button>
                                                    </a>
                                                    <br>
                                                    <a href="{{ route('admin.order.action', [$item->id, 'status' => 0]) }}"  onclick = "if (! confirm('Are You Sure Rejected this orders ??')) { return false; }">
                                                        <button class="btn btn-warning btn-sm">Rejected</button>
                                                    </a>
                                                    @break
                                                @default
                                                    -
                                            @endswitch
                                            
                                        </td>
                                        <td>
                                            @switch($item->status)
                                                @case(1)
                                                    <span class="badge bg-blue">Waiting Action</span>
                                                    @break
                                                @case(2)
                                                    <span class="badge bg-green">Approved</span>
                                                    @break
                                                @default
                                                    <span class="badge bg-red">Rejected</span>
                                            @endswitch
                                        </td>
                                        <td>{{ date('d F Y', strtotime($item->created_at)) }}</td>
                                        <td>{{ optional($item->product)->title }}</td>
                                        <td>{{ $item->variation }}</td>
                                        <td>{{ $item->edition }}</td>
                                        <td>{{ optional($item->product)->qurency.''.$item->total_price }}</td>
                                        <td><address>{{ optional($item->shippingOrder)->name.', '.optional($item->shippingOrder)->country.' '.optional($item->shippingOrder)->address.' ('.optional($item->shippingOrder)->optional_address.')'.' '.optional($item->shippingOrder)->contact }}</address></td>
                                        <td><a href="{{ route('detail-product', (optional($item->product)->slug ?? '#')) }}" target="_blank">{{ route('detail-product', ( optional($item->product)->slug ?? '#' )) }}</a></td>
                                        <td>
                                            {{ optional($item->user)->name }} <br>
                                            {{ optional($item->user)->email }} <br>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center">Data Empty</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $orders->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script>
    $(function () {
        $(".datepicker-input").datepicker({ 
            autoclose: true, 
            todayHighlight: true,
            format: "yyyy",
            viewMode: "years", 
            minViewMode: "years"
        });
    });
</script>
@endpush