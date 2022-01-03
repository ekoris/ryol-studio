@extends('theme.master')

@push('styles')
@endpush

@section('body')
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                {{-- <li><a href="">Home</a></li> --}}
                {{-- <li>Login or Register</li> --}}
            </ol>
        </div>
    </div>
    
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">
            <h3>
                Changes Ur Profile
            </h3>
            <div class="row mt-5">
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <form action="{{ route('auth.profile.update') }}" method="post" class="php-email-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" value="{{ logged_in_user()->name }}" class="form-control" id="name" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" name="number" class="form-control" value="{{ logged_in_user()->no_contact }}" id="name" placeholder="Your Number Phone" required>
                            </div>
                        </div>
                        <div class="form-group mt-3 mt-md-0">
                            <input type="email" class="form-control" name="email" id="email" value="{{ logged_in_user()->email }}" placeholder="Your Email" required>
                        </div>
                        <div class="form-group mt-3">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Your Password">
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </section><!-- End Contact Section -->
</section>
@endsection