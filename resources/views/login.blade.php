@extends('theme.master')

@push('styles')
@endpush

@section('body')
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Login or Register</h2>
        </div>
    </div>
    
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">
            <h3>
                Create Account or Login
            </h3>
            <p>
                Share your thouhts with the world form today.
            </p>
            <div class="row mt-5">
                <div class="col-lg-6">
                    <form action="{{ route('auth.do-login') }}" method="post" class="php-email-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                            </div>
                            <div class="col-md-12 form-group mt-3 mt-md-0">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Your password" required>
                            </div>
                            <div class="col-md-12">
                                <button class="btn-block" type="submit">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    @if (Session::get('error'))
                        <div class="alert alert-danger" role="alert">
                            Email Or Password Error !!
                        </div>
                    @endif
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-6">
                    Or
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <form action="{{ route('auth.do-register') }}" method="post" class="php-email-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" name="number" class="form-control" id="name" placeholder="Your Number Phone" required>
                            </div>
                        </div>
                        <div class="form-group mt-3 mt-md-0">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                        </div>
                        <div class="form-group mt-3">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Your Password" required>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </section><!-- End Contact Section -->
</section>
@endsection