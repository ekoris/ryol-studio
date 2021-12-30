@extends('admin.theme.master')

@php
use App\Constants\CategoryType;
@endphp

@push('styles')
@endpush

@section('body')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Category
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Category</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-5">
                                <a class="btn btn-warning mb-0" href="{{ route('admin.category.create') }}">Create</a>
                            </div>
                            <div class="col-md-7 row" style="text-align: right">
                                <form class="form-inline">
                                    <div class="form-group">
                                        <select name="type" class="form-control" id="">
                                            <option value="">Choose Type</option>
                                            @foreach (CategoryType::labels() as $key => $item)
                                                <option value="{{ $key }}" {{ Request::get('type') == $key ? 'selected' : '' }}>{{ $item }}</option>
                                            @endforeach
                                        </select>
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
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Type</th>
                                    <th></th>
                                </tr>
                                @forelse ($categories as $item)
                                    <tr>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->slug }}</td>
                                        <td><span class="label @switch($item->type)
                                            @case(1)
                                                label-success
                                            @break
                                            @case(2)
                                                label-info
                                            @break
                                            @case(3)
                                                label-danger
                                            @break
                                            @default
                                            
                                            @endswitch">{{ CategoryType::label($item->type) }}</span>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="{{ route('admin.category.edit', $item->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                <a href="{{ route('admin.category.delete', $item->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center">Data Empty</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $categories->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
    @endsection
