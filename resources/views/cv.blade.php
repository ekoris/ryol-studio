@extends('theme.master')

@push('styles')
<style>
    body{
        background-color: #f8f7f3 !important;
    }
</style>
@endpush

@section('body')
<section class="breadcrumbs" style="background-color: #f8f7f3 !important;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            {{-- <h2>Statement CV</h2> --}}
        </div>
    </div>
    
    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details" style="background-color: #f8f7f3 !important;">
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