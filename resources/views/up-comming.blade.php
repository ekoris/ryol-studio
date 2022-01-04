@extends('theme.master')

@push('styles')
@endpush

@section('body')
<section id="portfolio" class="portfolio inner-page" >
    <div class="container" data-aos="fade-up">
        <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul id="portfolio-flters">
                </ul>
            </div>
        </div>
        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
            @foreach ($products as $item)
                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <a href="{{ route('detail-product', $item->slug) }}">
                        <div class="portfolio-wrap">
                            <img src="{{ $item->image_url }}" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>{{ $item->title }}</h4>
                                <p>{{ $item->year.' - '.$item->category->title }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection