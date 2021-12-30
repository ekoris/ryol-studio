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
            <h2>Contact US</h2>
        </div>
    </div>
    
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div>
                {!! $website->maps  !!}
            </div>
            <div class="row mt-5">
                <div class="col-lg-4">
                    <div class="info">
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Location:</h4>
                            <p>{{ $website->address }}</p>
                        </div>
                        
                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>Email:</h4>
                            <p>{{ $website->email }}</p>
                        </div>
                        
                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>Call:</h4>
                            <p>+62 {{ $website->contact }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-8 mt-5 mt-lg-0">
                    <form action="" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>
            </div>
            
        </div>
    </section><!-- End Contact Section -->
</section>
<footer id="footer" style="background-color: #282828 !important">
    <div class="container">
        <div class="copyright">
            <a href="{{ $website->link_ig ?? '#' }}" target="_blank">
                <img src="{{ asset('assets/frontend/assets/img/sosmed/ig.png') }}" width="30px" alt="">
            </a>
            <a href="{{ $website->link_twitter ?? '#' }}" target="_blank">
                <img src="{{ asset('assets/frontend/assets/img/sosmed/twitter.png') }}" width="30px" alt="">
            </a>
            <a href="{{ $website->link_wa ?? '#' }}" target="_blank">
                <img src="{{ asset('assets/frontend/assets/img/sosmed/wa.png') }}" width="30px" alt="">
            </a>
        </div>
    </div>
</footer>
@endsection