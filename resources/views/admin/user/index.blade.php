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
            User
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-5">
                                <a class="btn btn-warning mb-0" href="{{ route('admin.user.create') }}">Create</a>
                            </div>
                            <div class="col-md-7 col-lg-12 row" style="text-align: right">
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
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover table-light">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->hasRole('admin') ? 'admin' : 'User' }}</td>
                                        <td>
                                            @if ($item->hasRole('user') && $item->status == 1)
                                                <a href="{{ route('admin.user.status', $item->id) }}" type="button" class="btn btn-info btn-sm">Non Aktifkan</a>
                                            @elseif($item->hasRole('user') && $item->status == 0)
                                                <a href="{{ route('admin.user.status', $item->id) }}" type="button" class="btn btn-info btn-sm">Aktifkan</a>
                                            @endif
                                            <a href="{{ route('admin.user.edit', $item->id) }}" type="button" class="btn btn-primary btn-sm">Edit</a>
                                            @if ($item->id != 1)
                                                <a href="{{ route('admin.user.delete', $item->id) }}" onclick="confirm("Are You Sure ??")" class="btn btn-danger btn-sm">Delete</a>
                                            @endif

                                            

                                        </td>
                                    </tr>
                                @empty
                                    <tr> 
                                        <td class="text-center" colspan="3">Data Empty</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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