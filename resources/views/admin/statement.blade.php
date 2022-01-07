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
            Statement
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Statement</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Statement Data</h3>
                    </div>
                    <form role="form" method="POST" action="{{ route('admin.statement.store') }}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Statement</label>
                                <textarea name="cv" id="" style="width: 100%">{{ $website->cv ?? null }}</textarea>
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
