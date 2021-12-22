@extends('theme.master')

@push('styles')
@endpush

@section('body')
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Project</h2>
            <ol>
                <li><a href="">Home</a></li>
                <li>Store</li>
            </ol>
        </div>
    </div>
</section>

<section id="portfolio" class="portfolio inner-page" >
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Store</h2>
            <p>Check our Store</p>
        </div>  
        
        <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul id="portfolio-flters">
                </ul>
            </div>
        </div>
        
        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
            @foreach ($products as $item)
                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                        <img src="{{ $item->image_url }}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>{{ $item->title }}</h4>
                            <p>{{ $item->year.' - '.$item->category->title }}</p>
                            <div class="portfolio-links">
                                <a href="{{ $item->image_url }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 1"><i class="bx bx-plus"></i></a>
                                <a href="{{ route('detail-product', $item->slug) }}" title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection