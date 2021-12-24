@extends('theme.master')

@php
    $website = resolve(App\Repositories\Entities\WebsiteManagement::class)->first();
@endphp


@push('styles')
@endpush

@section('body')
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Authentication</h2>
            <ol>
                <li><a href="">Home</a></li>
                <li>Authentication</li>
            </ol>
        </div>
    </div>
    
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-12">
                    <form action="{{ route('authentication.product.check') }}" method="post" class="php-email-form">
                        @csrf
                        <div class="row">
                            <div class="text-center">
                                <div class="col-lg-6" style="float:none;margin:auto;padding-bottom: 20px">
                            		<a href="/" class="logo me-auto me-lg-0"><img src="{{ $website->logo_url }}" alt="" class="img-fluid" style="width: 30%"></a>
                                    <h3>
                                        Authenticity Access
                                    </h3>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                                    <input type="hidden" name="slug" value="{{ $slug }}">
                                    @if (Session::get('error'))
                                        <div class="alert alert-danger" role="alert" style="padding-top: 20px;">
                                            Email Not Registered !!
                                        </div>
                                    @endif

                                    @if (Session::get('error_product'))
                                        <div class="alert alert-danger" role="alert" style="padding-top: 20px;">
                                            You haven't bought this product yet !!
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-6" style="float:none;margin:auto;">
                                    <button class="btn-block" type="submit">Check</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection