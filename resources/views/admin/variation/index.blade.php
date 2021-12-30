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
            Variations
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Variations</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-5">
                                <a class="btn btn-warning mb-0" href="{{ route('admin.variation.create') }}">Create</a>
                            </div>
                            <div class="col-md-7 row" style="text-align: right">
                                <form class="form-inline">
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
                                    <th></th>
                                </tr>
                                @forelse ($variations as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <div>
                                                <a href="{{ route('admin.variation.edit', $item->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                <a href="{{ route('admin.variation.delete', $item->id) }}" class="btn btn-sm btn-danger">Delete</a>
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
                        {{ $variations->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
    @endsection
