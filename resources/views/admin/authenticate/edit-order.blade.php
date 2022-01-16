@extends('admin.theme.master')

@php
    use App\Constants\CategoryType;
@endphp

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/bower_components/select2/dist/css/select2.min.css">
@endpush

@section('body')
<div class="content-wrapper" style="min-height: 926.281px;">
    <section class="content-header">
        <h1>
            Authenticate
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Authenticate</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Authenticate Data</h3>
                    </div>
                    <form role="form" method="POST" action="{{ route('admin.authenticate.update', [ $order->id, 'order' => true]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">User</label>
                                <select name="user_id" class="select2 form-control" id="" required>
                                    @foreach (resolve(App\Repositories\Entities\User::class)->get() as $item)
                                        <option value="{{ $item->id }}" {{ $order->user_id == $item->id ? 'selected' : '' }}>{{ $item->name.' - '.$item->email }}</option>
									@endforeach
                                </select>
                                <a href="{{ route('admin.user.create') }}">
                                    <button class="btn btn-sm btn-warning" style="margin-top: 10px">add User</button>
                                </a>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Product</label>
                                <select name="product_id" class="select2 form-control" id="product" required>
                                    {{-- @foreach (resolve(App\Repositories\Entities\Product::class)->whereHas('category', function($q){$q->where('title', 'product');})->get() as $item) --}}
                                    @foreach (resolve(App\Repositories\Entities\Product::class)->get() as $item)
                                        <option value="{{ $item->id }}" {{ $order->product_id == $item->id ? 'selected' : '' }}>{{ $item->title }}</option>
									@endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Variation</label>
                                <select name="variation" class="form-control" id="variation" required>
                                    <option value="{{ $order->variation }}" selected>{{ $order->variation }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Edition</label>
                                <select name="edition" class="select2 form-control" id="edition" required>
                                    <option value="{{ $order->productEdition->id }}" selected>{{ $order->productEdition->edition }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Order Date</label>
                                <input type="text" id="" class="datepicker-input form-control" value="{{ date('m/d/Y', strtotime($order->created_at)) }}" required name="created_at" placeholder="Date" required>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">Country</label>
                                <select name="country" class="form-control" id="" required>
                                    @php
                                        $country = resolve(App\Repositories\Entities\Country::class)->get();
                                    @endphp
                                    @foreach ($country as $item)
                                        <option value="{{ $item->name }}" {{ $order->shippingOrder->country == $item->name ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <h5>Shipping Address</h5>
                            <div class="row mt-2">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Name</label>
                                    <input type="Text" name="name" class="form-control" id="inputEmail4" value="{{ $order->shippingOrder->name }}" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <label for="inputAddress">Address</label>
                                <input type="text" class="form-control" name="address" id="inputAddress" value="{{ $order->shippingOrder->address }}" placeholder="1234 Main St">
                            </div>
                            <div class="form-group mt-2">
                                <label for="inputAddress2">Address 2 (Optional)</label>
                                <input type="text" class="form-control" id="inputAddress2" value="{{ $order->shippingOrder->optional_address }}" placeholder="Apartment, studio, or floor">
                            </div>
                            <div class="form-group mt-2">
                                <label>Contact</label>
                                <input type="text" class="form-control" name="contact" value="{{ $order->shippingOrder->contact }}" placeholder="Contact Number">
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="{{ asset('assets/admin') }}/bower_components/select2/dist/js/select2.full.min.js"></script>

<script>
    $(function () {
        $('.select2').select2()
        $(".datepicker-input").datepicker({ 
            autoclose: true, 
            todayHighlight: true,
        });
        $('#product').on('change', function (param) { 
            $("#variation").val('').trigger('change')
            $("#edition").val('').trigger('change')
        })
        
        $('#variation').select2({
            placeholder: 'Variation',
            allowClear: true,
            ajax: {
                url: '{{ route('admin.json.order.variation') }}',
                dataType: 'json',
                data: function (params) {
                    var product = $('#product').val();
                    var query = {
                        q: params.term,
                        page: params.page,
                        product_id : product
                    }
                    return query;
                },
                delay: 250,
                processResults: function (data) {
                    return data;
                },
                cache: true
            }
        })

        $('#edition').select2({
            placeholder: 'Edition',
            allowClear: true,
            ajax: {
                url: '{{ route('admin.json.order.edition') }}',
                dataType: 'json',
                data: function (params) {
                    var product = $('#product').val();
                    var query = {
                        q: params.term,
                        page: params.page,
                        product_id : product
                    }
                    return query;
                },
                delay: 250,
                processResults: function (data) {
                    return data;
                },
                cache: true
            }
        })
    });



</script>
@endpush
