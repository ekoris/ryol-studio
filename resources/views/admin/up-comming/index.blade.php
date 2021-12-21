@extends('admin.theme.master')

@php
use App\Constants\CategoryType;
@endphp

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
@endpush

@section('body')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Art Work
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Art Work</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-5">
                                <a class="btn btn-warning mb-0" href="{{ route('admin.up-comming.create') }}">Create</a>
                            </div>
                            <div class="col-md-7 col-lg-12 row" style="text-align: right">
                                <form class="form-inline">
                                    <div class="form-group">
                                        <select name="category_id" class="form-control" id="">
                                            <option value="">Choose Category</option>
                                            @foreach (resolve(App\Repositories\Entities\Category::class)->where('type', CategoryType::UP_COMMING_EVENT)->get() as $item)
                                            <option value="{{ $item->id }}" {{ Request::get('category_id') == $item->id ? 'selected' : '' }}>{{ $item->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="year" class="form-control datepicker-input" placeholder="Year" value="{{ Request::get('year') }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="q" class="form-control" placeholder="Search ..." value="{{ Request::get('q') }}">
                                    </div>
                                    <button type="submit" class="btn btn-default">
                                        <span class="fa fa-search"></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            @forelse ($products as $item)
                            <div class="col-sm-4 col-lg-3 col-md-2">
                                <div class="card mb-4 box-shadow">
                                    <img class="card-img-top" data-src="{{ $item->image_url }}" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;object-fit: scale-down;" src="{{ $item->image_url }}" data-holder-rendered="true">
                                    <div class="card-body">
                                        <p class="card-text">{{ $item->title }}</p>
                                        <small><i>{{ $item->year.' - '.$item->category->title }}</i></small>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="{{ route('admin.up-comming.edit', $item->id) }}" class="btn btn-sm btn-info">Edit</a>
                                            <a href="{{ route('admin.up-comming.delete', $item->id) }}" onclick="return confirm('Are You Sure ??')" class="btn btn-sm btn-danger">delete</a>
                                            <a href="{{ route('admin.qrcode', $item->slug) }}" target="_blank" class="btn btn-sm btn-primary">Download QR Code</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="card text-center">
                                <div class="card-header">
                                    Art Work
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Data Empty</h5>
                                    <a href="#" class="btn btn-primary">Find Someelse or create Something</a>
                                </div>
                            </div>
                            @endforelse
                            {{ $products->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script>
    $(function () {
        $(".datepicker-input").datepicker({ 
            autoclose: true, 
            todayHighlight: true,
            format: "yyyy",
            viewMode: "years", 
            minViewMode: "years"
        });
    });
</script>
@endpush