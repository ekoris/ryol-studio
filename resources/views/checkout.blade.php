@extends('theme.master')

@php
@endphp

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    
    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    
    tr:nth-child(even) {
    }
</style>
@endpush

@section('body')
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Checkout</h2>
            <ol>
                <li><a href="">Home</a></li>
                <li>Checkout Order</li>
            </ol>
        </div>
    </div>
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <form method="POST" action="{{ route('order.proced.checkout') }}">
                        @csrf
                        <input type="hidden" value="{{ json_encode($data) }}" name="order_detail">
                        <h5>Shipping Address</h5>
                        <div class="mt-5 mt-lg-0">
                            <div class="form-group">
                                <label for="inputAddress2">Country</label>
                                <select name="country" class="form-control" id="" required>
                                    @php
                                        $country = resolve(App\Repositories\Entities\Country::class)->get();
                                    @endphp
                                    @foreach ($country as $item)
                                        <option value="{{ $item->name }}" {{ $item->name == 'Indonesia' ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row mt-2">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Firstname</label>
                                    <input type="Text" name="firstname" class="form-control" id="inputEmail4" required placeholder="First Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Lastname</label>
                                    <input type="text" name="lastname" class="form-control" required placeholder="Last Name">
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <label for="inputAddress">Address</label>
                                <input type="text" class="form-control" name="address" id="inputAddress" required placeholder="1234 Main St">
                            </div>
                            <div class="form-group mt-2">
                                <label for="inputAddress2">Address 2 (Optional)</label>
                                <input type="text" class="form-control" id="inputAddress2" required placeholder="Apartment, studio, or floor">
                            </div>
                            <div class="form-group mt-2">
                                <label>Contact</label>
                                <input type="text" class="form-control" name="contact" required placeholder="Contact Number">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-custom btn-block mt-2">Procced Checkout</button>
                    </form>
                </div>
                <div class="col-lg-5">
                    <h5>Order Details</h5>
                    <table>
                        <tr>
                            <th>Product</th>
                            <th>QTY</th>
                            <th>Variant</th>
                            <th>Price</th>
                        </tr>
                        <tr>
                            <td>
                                <img src="{{ $product->image_url }}" width="100px" alt="">
                            </td>
                            <td>{{ $data['qty'] }}</td>
                            @php
                                $variant = resolve(App\Repositories\Entities\ProductVariation::class)->find($data['variant']);
                            @endphp
                            <td>{{ $variant->variation->name ?? '-' }}</td>
                            <td>{{ $product->qurency.''.$product->price }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section><!-- End Portfolio Details Section -->
</section>
@endsection

@push('scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
</script>
@endpush