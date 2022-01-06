@extends('theme.master')

@push('styles')
<style>
    body{
        background-color: #f8f7f3 !important;
    }

    ol li a:hover, .active, .active:focus, .navbar li:hover > a {
       color:#aaaaaa !important;
    }
</style>
@endpush

@section('body')
<section class="breadcrumbs" style="background-color: #f8f7f3 !important;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2></h2>
            <ol>
                @foreach (resolve(\App\Repositories\Entities\Cv::class)->groupBy('year')->get() as $item)
                    <li><a class="{{ $cv->year == $item->year ? 'active' : '' }}" href="{{ route('about.cv.periodic', ['year' => $item->year]) }}">{{ $item->year ?? '' }}</a></li>
                @endforeach
            </ol>
        </div>
    </div>
    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details" style="background-color: #f8f7f3 !important;">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-12">
                    <div class="portfolio-description">
                        <p>{!! $cv->description ?? '-' !!}</p>
                    </div>
                </div>
                
            </div>
            
        </div>
    </section><!-- End Portfolio Details Section -->
</section>
@endsection
