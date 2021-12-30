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
            <h2>Up-Comming Detail</h2>
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
                        <h3>{{ $product->title }}</h3>
                        {!! $product->description != '' ? $product->description : '' !!}
                        <ul>
                            <li><strong>Year</strong>: {{ $product->year }}</li>
                            <li><strong>Category</strong>: {{ $product->category->title }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Portfolio Details Section -->
</section>
@endsection

@push('scripts')
@endpush