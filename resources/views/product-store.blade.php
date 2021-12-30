@extends('theme.master')

@php
use App\Constants\CategoryType;
$website = resolve(App\Repositories\Entities\WebsiteManagement::class)->first();
@endphp

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .fa {
        font-size: 18px;
        width: 18px;
        text-align: center;
        text-decoration: none;
        margin: 5px 2px;
        border-radius: 50%;
    }

    .fa:hover {
        opacity: 0.7;
        color: black;
    }
</style>
@endpush

@section('body')
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Project Detail</h2>
            <ol>
                <li><a href="">Home</a></li>
                <li>Detail</li>
            </ol>
        </div>
    </div>
    
    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-9">
                    <div class="portfolio-details-slider swiper">
                        <div class="swiper-wrapper align-items-center">
                            <div class="swiper-slide">
                                <img src="{{ $product->image_url }}" alt="">
                            </div>
                            @forelse (($product->productPhotos ?? []) as $item)
                                <div class="swiper-slide">  
                                    <img src="{{ $item->image_url }}" alt="">
                                </div>
                            @empty
                                
                            @endforelse
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                
                <div class="col-lg-3">
                    <div class="portfolio-info">
                        <h3>{{ $product->title }}</h3>
                        <h4>{{ $product->qurency.''.number_format($product->price) }}</h4>
                        <ul>
                            <li><strong>Year</strong>: {{ $product->year }}</li>
                            <li><strong>Category</strong>: {{ $product->category->title }}</li>
                            <li><strong>Description</strong>: <br>{!! $product->description != '' ? $product->description : '-' !!}</li>
                        </ul>
                        @if ($product->product_type == CategoryType::PRODUCT)
                        <hr>
                        <form action="{{ route('order.checkout') }}" method="post">
                            @csrf
                            <div style="padding-bottom: 10px">
                                <h5>Qty : <input type="number" name="qty" style="width: 50px;font-size: 14px" value="1" min="1" max="10" width="20px"></h5>
                            </div>
                            <div style="padding-bottom: 10px">
                                <h5>Variation : </h5>
                                @foreach (($product->productVariations ?? []) as $item)
                                    <input type="radio" name="variant" required value="{{ $item->id }}"> {{ $item->variation->name }}
                                @endforeach
                            </div>
                            @if (logged_in_user())
                                <input type="hidden" name="slug" value="{{ $product->slug }}">
                                <button type="submit" id="buy" class="btn btn-custom btn-snm btn-block" style="width: 100%">Order</button>
                            @else
                                <a href="{{ route('auth.login') }}">
                                    <button type="button" id="buy" class="btn btn-custom btn-snm btn-block" style="width: 100%">Login To order</button>
                                </a>
                            @endif
                        </form>
                        @endif
                        <div class="socmed" style="padding-top: 30px; text-align: right">
                            <a href="#" class="fa fa-facebook"></a>
                            <a href="#" class="fa fa-twitter"></a>
                            <a href="#" class="fa fa-google"></a>
                            <a href="#" class="fa fa-linkedin"></a>
                            <a href="#" class="fa fa-youtube"></a>
                            <a href="#" class="fa fa-instagram"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Portfolio Details Section -->
</section>
@endsection

@push('scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        @if ($product->product_type == CategoryType::PRODUCT && logged_in_user())
        function save(){
            $.ajax({
                type: "post",
                url: "{{ route('orders') }}",
                data : {
                    _token : '{{ csrf_token() }}',
                    user_id : '{{ logged_in_user()->id ?? 'null'    }}',
                    product_id : '{{ $product->id }}',
                },
                dataType: "json",
                success: function (response) {
                    console.log(response);
                }
            });
        }
        @endif
    </script>
@endpush