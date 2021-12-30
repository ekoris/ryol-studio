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
            cv
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">cv</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-5">
                                <a class="btn btn-warning mb-0" href="{{ route('admin.cv.create') }}">Create</a>
                            </div>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>Year</th>
                                    <th></th>
                                </tr>
                                @forelse ($cv as $item)
                                    <tr>
                                        <td>{{ $item->year }}</td>
                                        <td>
                                            <div>
                                                <a href="{{ route('admin.cv.edit', $item->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                <a href="{{ route('admin.cv.delete', $item->id) }}" class="btn btn-sm btn-danger">Delete</a>
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
                        {{ $cv->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
    @endsection
