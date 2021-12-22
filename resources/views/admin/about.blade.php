@extends('admin.theme.master')

@php
use App\Constants\CategoryType;
@endphp

@push('styles')
@endpush

@section('body')
<div class="content-wrapper" style="min-height: 926.281px;">
    <section class="content-header">
        <h1>
            About
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">About</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">About Data</h3>
                    </div>
                    <form role="form" method="POST" action="{{ route('admin.about.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tagline</label>
                                <input type="text" name="tagline" value="{{ $website->tagline ?? null }}" required class="form-control" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Image</label>
                                <div class="input-group input-group-outline mb-3">
                                    <input type='file' name="logo" onchange="readURL(this);"/>
                                    <br>
                                    <img id="blah" style="height: 100px" src="{{ $website->logo_url ?? 'http://placehold.it/180' }}" alt="your image" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">About</label>
                                <textarea name="about" class="form-control" id="" cols="30" rows="10">{{ $website->about ?? null }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Cv</label>
                                <textarea name="cv" id="" style="width: 100%">{{ $website->cv ?? null }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" name="email" value="{{ $website->email ?? null }}" required class="form-control" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <input type="text" name="address" value="{{ $website->address ?? null }}" required class="form-control" placeholder="Enter Address">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Contact</label>
                                <input type="text" name="contact" value="{{ $website->contact ?? null }}" required class="form-control" placeholder="Enter Contact">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Maps</label>
                                <input type="text" name="maps" value="{{ $website->maps ?? null }}" required class="form-control" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Order Contact</label>
                                <input type="text" name="no_contact" value="{{ $website->no_contact ?? null }}" required class="form-control" placeholder="Enter Order Contact">
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    CKEDITOR.replace('cv',{
        fullPage: true,
        allowedContent: true
    });
    
    CKEDITOR.replace('about',{
        fullPage: true,
        allowedContent: true
    });
</script>
@endpush
