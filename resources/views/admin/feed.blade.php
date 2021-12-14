@extends('admin.theme.master')

@push('styles')
@endpush

@section('body')

<div class="col-12">
    <a href="">
        <button class="btn btn-danger">Create Feed</button>
    </a>
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
               <h6 class="text-white text-capitalize ps-3">Project - Feed</h6>
            </div>
        </div>
        <div class="row" style="padding-top: 50px">
            @for ($i = 0; $i < 10; $i++) 
            <div class="col-xl-3 col-md-6 mb-xl-0 mb-4" style="padding-bottom: 20px">
                <div class="card card-blog card-plain">
                    <div class="card-header p-0 mt-n4 mx-3">
                        <a class="d-block shadow-xl border-radius-xl">
                            <img src="https://images.unsplash.com/photo-1606744824163-985d376605aa?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                                alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                        </a>
                    </div>
                    <div class="card-body p-3">
                        <p class="mb-0 text-sm">{{ date('d F Y') }}</p>
                        <a href="javascript:;">
                            <h5>{{ Str::random(20) }}</h5>
                        </a>
                        <p class="mb-4 text-sm">
                            Why would anyone pick blue over pink? Pink is obviously a better color.
                        </p>
                        <div class="d-flex align-items-center justify-content-between">
                            <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                            <div class="avatar-group">
                                <span style="font-size: 10px;font-style: italic">#category</span>
                                <span style="font-size: 10px;font-style: italic">#category</span>
                                <span style="font-size: 10px;font-style: italic">#category</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush
