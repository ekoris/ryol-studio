@extends('theme.master')



@push('styles')
@endpush

@section('body')
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            {{-- <h2>Contact US</h2> --}}
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
                            <p>{{ $website->contact }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-8 mt-5 mt-lg-0">
                    <form action="{{ route('about.contact-us.send') }}" method="post" role="form" class="php-email-form">
                        @csrf
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
                        <div class="my-3" style="{{ Session::get('success') ? 'display: block !important' : '' }}">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message" style="{{ Session::get('success') ? 'display: block !important' : '' }}">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- End Contact Section -->
</section>

<script>
    @if(Session::get('wa'))
        window.onload = (event) => {
            window.open("https://wa.me/{{ Session::get('no_contact') }}?text={{ Session::get('message') }}");
        };
    @endif

</script>
@endsection