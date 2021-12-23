@extends('admin.theme.master')

@php
use App\Constants\CategoryType;
@endphp

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/admin') }}/bower_components/select2/dist/css/select2.min.css">
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        border: 1px solid #ab5b5b;
        color: black;
    }
</style>
@endpush

@section('body')
<div class="content-wrapper" style="min-height: 926.281px;">
    <section class="content-header">
        <h1>
            Product
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Product</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Product Data</h3>
                    </div>
                    <form role="form" method="POST" action="{{ route('admin.product.update', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" name="title" required class="form-control" placeholder="Enter Name" value="{{ $product->title }}" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Year</label>
                                <input type="text" name="year" id="" class="datepicker-input form-control" value="{{ $product->year }}" placeholder="Year Work" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Production</label>
                                <input type="text" name="date_production" id="" class="datepicker-month-year form-control" value="{{ $product->date_production }}" name="name" placeholder="Date Production" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category</label>
                                <select name="category_id" class="form-control" id="">
                                    <option value="">Choose Category</option>
                                    @foreach (resolve(App\Repositories\Entities\Category::class)->where('type', CategoryType::PRODUCT)->get() as $item)
                                        <option value="{{ $item->id }}" {{ $product->category_id == $item->id ? 'selected' : '' }}>{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Image</label>
                                <div class="input-group input-group-outline mb-3">
                                    <input type='file' name="image" onchange="readURL(this);"/>
                                    <br>
                                    <img id="blah" style="height: 600px;" src="{{ $product->image_url }}" alt="your image" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description</label>
                                <textarea name="description" class="form-control" id="" cols="30" rows="10">{{ $product->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Type Product ?</label>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="radio" name="type_product" value="0" class="type" id="" {{ $product->is_privilege == 0 ? 'checked' : '' }} > All User
                                    <br>
                                    <input type="radio" name="type_product" value="1" class="type" id="" {{ $product->is_privilege == 1 ? 'checked' : '' }}> Privilege
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">User Privilege</label>
                                <select name="users[]" class="form-control users select2" {{ $product->is_privilege == 1 ? '' : 'disabled' }} multiple id="" placeholder="Pilih User">
                                    @foreach (resolve(App\Repositories\Entities\User::class)->get() as $item)
                                        <option value="{{ $item->id }}" {{ in_array($item->id, ($product->productUserPrivileges->pluck('user_id')->toArray() ?? [])) ? 'selected' : '' }}>{{ $item->name.' - '.$item->email }}</option>
                                    @endforeach
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
    $('.type').on('click', function () {
        if ($(this).val() === '1') {
            $('.users').attr('disabled', false);
        } else{
            $('.users').attr('disabled', true);
        }
    })
    $(function () {
        $('.select2').select2();
        
        $(".datepicker-month-year").datepicker({
            format: "yyyy-mm-dd",
            autoclose: true, 
            todayHighlight: true,
        });

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
