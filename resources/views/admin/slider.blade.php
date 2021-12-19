@extends('admin.theme.master')

@php
use App\Constants\CategoryType;
@endphp

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
<style>
.it .btn-orange
{
	background-color: transparent;
	border-color: #777!important;
	color: #777;
	text-align: left;
    width:100%;
}
.it input.form-control
{
	height: 54px;
	border:none;
  margin-bottom:0px;
	border-radius: 0px;
	border-bottom: 1px solid #ddd;
	box-shadow: none;
}
.it .form-control:focus
{
	border-color: #ff4d0d;
	box-shadow: none;
	outline: none;
}
.fileUpload {
    position: relative;
    overflow: hidden;
    margin: 10px;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
.it .btn-new, .it .btn-next
{
	margin: 30px 0px;
	border-radius: 0px;
	background-color: #333;
	color: #f5f5f5;
	font-size: 16px;
	width: 155px;
}
.it .btn-next
{
	background-color: #ff4d0d;
	color: #fff;
}
.it .remove
{
  cursor:pointer;
  line-height:54px;
  color:red;
}
.it .uploadDoc
{
	margin-bottom: 20px;
}
.it .uploadDoc
{
	margin-bottom: 20px;
}
.it .btn-orange img {
    height: 100%;
    width: 30px;
}
</style>
@endpush

@section('body')
<div class="content-wrapper" style="min-height: 926.281px;">
    <section class="content-header">
        <h1>
            Slider
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Slider</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Slider Data</h3>
                    </div>
                    <form role="form" method="POST" action="{{ route('admin.slider.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="container">
                            <div class="row it">
                                <div class="col-sm-offset-1 col-sm-10" id="one">
                                    <div id="uploader">
                                        @forelse ($sliders as $item)
                                            <div class="row uploadDoc">
                                                <input type="hidden" name="upload[]">
                                                <input type="hidden" name="upload_exist[]" value="{{ $item->id }}">
                                                <div class="col-sm-3">
                                                    <div class="fileUpload btn btn-orange">
                                                        <img src="https://static.vecteezy.com/system/resources/thumbnails/000/420/307/small/Multimedia__2845_29.jpg" class="icon">
                                                        <span class="upl" id="upload">{{ $item->file }}</span>
                                                        <input type="file" name="file_exist[{{ $item->id }}]" class="upload up" id="up" onchange="readURL(this);" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" name="name_exist[{{ $item->id }}]" placeholder="Name" value="{{ $item->title }}">
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" name="year_exist[{{ $item->id }}]" id="" class="datepicker-input form-control" name="name" placeholder="Year Work" value="{{ $item->year }}">
                                                </div>
                                                <div class="col-sm-1"><a class="btn remove"><i class="fa fa-times"></i></a></div>
                                            </div>
                                        @empty    
                                            <div class="row uploadDoc">
                                                <input type="hidden" name="upload[]">
                                                <div class="col-sm-3">
                                                    <div class="fileUpload btn btn-orange">
                                                        <img src="https://static.vecteezy.com/system/resources/thumbnails/000/420/307/small/Multimedia__2845_29.jpg" class="icon">
                                                        <span class="upl" id="upload">Upload Image</span>
                                                        <input type="file" name="file[]" class="upload up" id="up" onchange="readURL(this);" required />
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" name="name[]" placeholder="Name">
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" name="year[]" id="" class="datepicker-input form-control" name="name" placeholder="Year Work">
                                                </div>
                                                <div class="col-sm-1"><a class="btn remove"><i class="fa fa-times"></i></a></div>
                                            </div>
                                        @endforelse
                                    </div>
                                    <div class="text-center">
                                        <a class="btn btn-new"><i class="fa fa-plus"></i> Add new</a>
                                        <button type="submit" class="btn btn-next"><i class="fa fa-paper-plane"></i> Simpan</a>
                                    </div>
                                </div><!--one-->
                            </div><!-- row -->
                        </div><!-- container -->
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
    
    var fileTypes = ['jpg', 'jpeg', 'png'];  //acceptable file types
    function readURL(input) {
        if (input.files && input.files[0]) {
            var extension = input.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
            isSuccess = fileTypes.indexOf(extension) > -1;  //is extension in acceptable types
            
            if (isSuccess) { //yes
                var reader = new FileReader();
                reader.onload = function (e) {
                    if (extension == 'png'){ 
                        $(input).closest('.fileUpload').find(".icon").attr('src','https://static.vecteezy.com/system/resources/thumbnails/000/420/307/small/Multimedia__2845_29.jpg'); 
                    }
                    else if (extension == 'jpg' || extension == 'jpeg'){
                        $(input).closest('.fileUpload').find(".icon").attr('src','https://static.vecteezy.com/system/resources/thumbnails/000/420/307/small/Multimedia__2845_29.jpg');
                    }
                    else if (extension == 'txt'){
                        $(input).closest('.fileUpload').find(".icon").attr('src','https://static.vecteezy.com/system/resources/thumbnails/000/420/307/small/Multimedia__2845_29.jpg');
                    }
                    else {
                        $(input).closest('.uploadDoc').find(".docErr").slideUp('slow');
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
            else {
                $(input).closest('.uploadDoc').find(".docErr").fadeIn();
                setTimeout(function() {
                    $('.docErr').fadeOut('slow');
                }, 9000);
            }
        }
    }
    $(document).ready(function(){
        $(document).on('change','.up', function(){
            var id = $(this).attr('id'); /* gets the filepath and filename from the input */
            var profilePicValue = $(this).val();
            var fileNameStart = profilePicValue.lastIndexOf('\\'); /* finds the end of the filepath */
            profilePicValue = profilePicValue.substr(fileNameStart + 1).substring(0,20); /* isolates the filename */
            if (profilePicValue != '') {
                $(this).closest('.fileUpload').find('.upl').html(profilePicValue); /* changes the label text */
            }
        });
        
        $(".btn-new").on('click',function(){
            
            $("#uploader").append('<div class="row uploadDoc"> <input type="hidden" name="upload[]"> <div class="col-sm-3"> <div class="fileUpload btn btn-orange"> <img src="https://static.vecteezy.com/system/resources/thumbnails/000/420/307/small/Multimedia__2845_29.jpg" class="icon"> <span class="upl" id="upload">Upload Image</span> <input type="file" name="file[]" class="upload up" id="up" onchange="readURL(this);" required /> </div> </div> <div class="col-sm-5"> <input type="text" class="form-control" name="name[]" placeholder="Name"> </div> <div class="col-sm-3"> <input type="text" name="year[]" id="" class="datepicker-input form-control" name="name" placeholder="Year Work"> </div> <div class="col-sm-1"><a class="btn remove"><i class="fa fa-times"></i></a></div> </div>');
            $(".datepicker-input").datepicker({ 
                autoclose: true, 
                todayHighlight: true,
                format: "yyyy",
                viewMode: "years", 
                minViewMode: "years"
            });
        });
        
        $(document).on("click", "a.remove" , function() {
            if($(".uploadDoc").length>1){
                $(this).closest(".uploadDoc").remove();
            }else{
                alert("You have to upload at least one document.");
            } 
        });
    });
</script>
@endpush
