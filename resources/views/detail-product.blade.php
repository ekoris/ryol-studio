@extends('theme.master')

@push('styles')
@endpush

@section('body')
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Project Detail</h2>
            <ol>
                <li><a href="index.html">Home</a></li>
                <li>Detail</li>
            </ol>
        </div>
    </div>
    
    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            
            <div class="row gy-4">
                
                <div class="col-lg-12">
                    <div class="portfolio-details-slider swiper">
                        <div class="swiper-wrapper align-items-center">
                            <div class="swiper-slide">
                                <img src="{{ $product->image_url }}" alt="">
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="portfolio-info">
                        <h3>Project information</h3>
                        <ul>
                            <li><strong>Year</strong>: {{ $product->year }}</li>
                            <li><strong>Category</strong>: {{ $product->category->title }}</li>
                            <li><strong>QrCode</strong>: </li>
                        </ul>
                        {!! $qrcode !!}
                    </div>
                    @if (isset($product->desciption))
                        <div class="portfolio-description">
                            <h2>Description</h2>
                            <p>{!! $product->description !!}</p>
                        </div>
                    @endif
                </div>
                
            </div>
            
        </div>
    </section><!-- End Portfolio Details Section -->
</section>
@endsection