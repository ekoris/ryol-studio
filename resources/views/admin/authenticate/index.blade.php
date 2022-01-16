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
            Authenticate Product User
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Authenticate Product User</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-5">
                                <a class="btn btn-warning mb-0" href="{{ route('admin.authenticate.create') }}">Create</a>
                            </div>
                            <div class="col-md-7 col-lg-12 row" style="text-align: right">
                                <form class="form-inline">
                                    <div class="form-group">
                                        <input type="text" name="email" class="form-control" placeholder="Search Email ..." value="{{ Request::get('email') }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="date_order" class="form-control datepicker-input" placeholder="Search Date Order..." value="{{ Request::get('date_order') }}">
                                    </div>
                                    <button type="submit" class="btn btn-default">
                                        <span class="fa fa-search"></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="box-body table table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>URL</th>
                                    <th>Created</th>
                                    <th></th>
                                </tr>
                                @forelse ($data as $key => $item)
                                    @php
                                        $num = $key+=1;
                                    @endphp
                                    @if ($item->getTable() == 'authentication_products')
                                        <tr>
                                            <td>{{ $num }}</td>
                                            <td>{{ $item->user->name.' - '.$item->user->email }}</td>
                                            <td>{{ $item->name ?? '-' }}</td>
                                            <td>{{ date('d F Y', strtotime($item->date)) }}</td>
                                            <td>{{ $item->url  ?? '-'}}</td>
                                            <td>{{ date('d F Y', strtotime($item->created_at)) }}</td>
                                            <td>
                                                <div>
                                                    <a href="{{ route('admin.authenticate.edit', $item->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                    <a href="{{ route('admin.authenticate.delete', $item->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{ $num }}</td>
                                            <td>{{ $item->user->name.' - '.$item->user->email }}</td>
                                            <td>{{ date('F Y', strtotime($item->product->date_production)) .' / ' .$item->product->title.' / '.$item->variation.' / '.$item->edition }}</td>
                                            <td>{{ date('d F Y', strtotime($item->created_at)) }}</td>
                                            <td>-</td>
                                            <td>{{ date('d F Y', strtotime($item->created_at)) }}</td>
                                            <td>
                                                -
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="6">Data Empty</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $data->withQueryString()->links() }}
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
        });
    });
</script>
@endpush

