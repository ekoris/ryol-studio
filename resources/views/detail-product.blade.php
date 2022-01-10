@extends('theme.master')

@php
use App\Constants\CategoryType;
$website = resolve(App\Repositories\Entities\WebsiteManagement::class)->first();
@endphp

@push('styles')
<style>
    .zoom {
        display:inline-block;
        position: relative;
    }

    .zoom:after {
        content:'';
        display:block; 
        width:1000px; 
        height:1000px; 
        position:absolute; 
        top:0;
        right:0;
        background:url(icon.png);
    }
    
    .zoom img {
        display: block;
    }
    
    .zoom img::selection { 
        background-color: transparent; 
    }
</style>
@endpush

@section('body')
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2></h2>
        </div>
    </div>
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-12">
                    <div class="portfolio-details-slider swiper">
                        <div class="align-items-center">
                            <div class="swiper-slide zoom2 zoom"  id="panzoom">
                                <img src="{{ $product->image_url }}" alt="">
                            </div>
                        </div>
                        <div style="margin-top: 20px; margin-bottom: 30px;text-align: right;margin-right: 20px">
                            <button class="zoom-in btn btn-sm btn-dark">Zoom In</button>
                            <button class="zoom-out btn btn-sm btn-dark">Zoom Out</button>
                            <input type="range" class="zoom-range">
                            <button class="reset btn btn-sm btn-dark">Reset</button>
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
        </div>
    </section><!-- End Portfolio Details Section -->
</section>
@endsection

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.panzoom/2.0.6/jquery.panzoom.min.js"></script>
<script>
    $("#panzoom").panzoom({
        $zoomIn: $(".zoom-in"),
        $zoomOut: $(".zoom-out"),
        $zoomRange: $(".zoom-range"),
        $reset: $(".reset"),
        contain: 'invert',
    });
</script>
<script src='{{ asset('assets/frontend/zoom/jquery.zoom.js') }}'></script>

<script>
    $(document).ready(function(){
        $('.zoom2').zoom({ on:'click' });
    });
</script>
@endpush