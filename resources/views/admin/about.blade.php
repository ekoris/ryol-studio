@extends('admin.theme.master')

@push('styles')
@endpush

@section('body')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">About</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="row">
                    <form role="form">
                        <div class="col-12 col-xl-12">
                            <div class="card-header pb-0 p-3">
                                <h6 class="mb-0">Platform Settings</h6>
                            </div>
                            <div class="card card-plain h-100">
                               <div class="card-body">
                                    <h6 class="text-uppercase text-body text-xs font-weight-bolder">Tagline</h6>
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Input Tagline</label>
                                        <input type="text" class="form-control" name="about">
                                    </div>
                                    <h6 class="text-uppercase text-body text-xs font-weight-bolder">Logo</h6>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="file" class="form-control" name="logo">
                                    </div>
                                    <h6 class="text-uppercase text-body text-xs font-weight-bolder">About Me</h6>
                                    <div class="mb-3">
                                        <textarea name="about_me" class="form-control" id="" cols="30" rows="10"></textarea>
                                    </div>
                                    <h6 class="text-uppercase text-body text-xs font-weight-bolder">CV</h6>
                                    <div class="mb-3">
                                        <textarea name="cv" id="" style="width: 100%"></textarea>
                                    </div>
                                    <div>
                                        <div>
                                            <button class="btn btn-danger">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('cv',{
        fullPage: true,
        allowedContent: true
    });
    
    CKEDITOR.replace('about_me',{
        fullPage: true,
        allowedContent: true
    });
</script>
@endpush
