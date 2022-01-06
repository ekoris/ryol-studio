@extends('theme.master')

@php
use App\Constants\CategoryType;
$website = resolve(App\Repositories\Entities\WebsiteManagement::class)->first();
@endphp

@push('styles')
@endpush

@section('body')
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2></h2>
        </div>
    </div>
    
    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-12">
                    <div class="portfolio-details-slider swiper">
                        <div class="align-items-center">
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
                <div class="col-md-12">
                    <div class="portfolio-info">
                        <h3>Project information</h3>
                        <ul>
                            <li><strong>Year</strong>: {{ $product->year }}</li>
                            <li><strong>Category</strong>: {{ $product->category->title }}</li>
                            <li><strong>Description</strong>: <br>{!! $product->description != '' ? $product->description : '' !!}</li>
                        </ul>
                        <div style="text-align: right !important">
                            <button class="btn btn-dark" onclick="history.go(-1)">Back</button>
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