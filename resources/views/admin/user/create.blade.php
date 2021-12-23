@extends('admin.theme.master')

@php
use App\Constants\CategoryType;
@endphp

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/admin') }}/bower_components/select2/dist/css/select2.min.css">
@endpush

@section('body')
<div class="content-wrapper" style="min-height: 926.281px;">
    <section class="content-header">
        <h1>User</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Create</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create</h3>
                    </div>
                    <form role="form" method="POST" action="{{ route('admin.user.store') }}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="name" required class="form-control" placeholder="Enter Name" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email" required class="form-control" placeholder="Enter Email" required>
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" name="password" required class="form-control" placeholder="Enter Password" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Role</label>
                                <select name="role" class="select2 form-control" id="">
                                    <option value="">Choose Role</option>
                                    <option value="admin">admin</option>
                                    <option value="user">user</option>
                                </select>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="{{ asset('assets/admin') }}/bower_components/select2/dist/js/select2.full.min.js"></script>

<script>
    $(function () {
        $('.select2').select2()
        $(".datepicker-input").datepicker({ 
            autoclose: true, 
            todayHighlight: true,
            format: "yyyy",
            viewMode: "years", 
            minViewMode: "years"
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah').show();
                $('#blah').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    CKEDITOR.replace('description',{
        fullPage: true,
        allowedContent: true
    });
</script>
@endpush
