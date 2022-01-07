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
        <h1>
            Authenticate
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Authenticate</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Authenticate Data</h3>
                    </div>
                    <form role="form" method="POST" action="{{ route('admin.authenticate.update', $authenticate->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">User</label>
                                <select name="user_id" class="select2 form-control" id="" required>
                                    @foreach (resolve(App\Repositories\Entities\User::class)->get() as $item)
                                        <option value="{{ $item->id }}" {{ $authenticate->id == $item->id ? 'selected' : '' }}>{{ $item->name.' - '.$item->email }}</option>
									@endforeach
                                </select>
                                <a href="{{ route('admin.user.create') }}">
                                    <button class="btn btn-sm btn-warning" style="margin-top: 10px">add User</button>
                                </a>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date</label>
                                <input type="text" id="" class="datepicker-input form-control" value="{{ $authenticate->date }}" required name="date" placeholder="Date" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description</label>
                                <input type="text" class="form-control" name="name" required placeholder="description" value="{{ $authenticate->name }}">
                            </div> 
                            <div class="form-group">
                                <label for="exampleInputEmail1">URL</label>
                                <input type="text" class="form-control" name="url" placeholder="url" value="{{ $authenticate->url }}">
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
