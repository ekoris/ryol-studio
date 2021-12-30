@extends('theme.master')

@push('styles')
<style>

    ol li a:hover, .active, .active:focus, .navbar li:hover > a {
       color:#aaaaaa !important;
    }
</style>
@endpush

@section('body')
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Project</h2>
            <ol>
                @foreach (resolve(\App\Repositories\Entities\Category::class)->where('type', 3)->get() as $item)
                    <li><a class="{{ Request::get('category') == $item->slug ? 'active' : '' }}" href="{{ route('art-work', [$param, 'category' => $item->slug]) }}">{{ $item->title ?? '' }}</a></li>
                @endforeach
            </ol>
        </div>
    </div>
</section>

<section id="portfolio" class="portfolio inner-page" >
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Art Work</h2>
            <p>Check our Art Work - {{ $param }}</p>
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
                    <a href="{{ route('detail-product', $item->slug) }}" >
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