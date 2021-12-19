@extends('theme.master')

@push('styles')
@endpush

@section('body')
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Statement CV</h2>
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
                    <div class="portfolio-description">
                        <h2>Cv</h2>
                        <p>{!! $website->cv !!}</p>
                    </div>
                </div>
                
            </div>
            
        </div>
    </section><!-- End Portfolio Details Section -->
</section>
@endsection