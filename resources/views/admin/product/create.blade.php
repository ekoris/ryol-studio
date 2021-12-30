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
	.upload {
		&__box {
			padding: 40px;
		}
		&__inputfile {
			width: .1px;
			height: .1px;
			opacity: 0;
			overflow: hidden;
			position: absolute;
			z-index: -1;
		}
		
		&__btn {
			display: inline-block;
			font-weight: 600;
			color: #fff;
			text-align: center;
			min-width: 116px;
			padding: 5px;
			transition: all .3s ease;
			cursor: pointer;
			border: 2px solid;
			background-color: #4045ba;
			border-color: #4045ba;
			border-radius: 10px;
			line-height: 26px;
			font-size: 14px;
			
			&:hover {
				background-color: unset;
				color: #4045ba;
				transition: all .3s ease;
			}
			
			&-box {
				margin-bottom: 10px;
			}
		}
		
		&__img {
			&-wrap {
				display: flex;
				flex-wrap: wrap;
				margin: 0 -10px;
			}
			
			&-box {
				width: 200px;
				padding: 0 10px;
				margin-bottom: 12px;
			}
			
			&-close {
				width: 24px;
				height: 24px;
				border-radius: 50%;
				background-color: rgba(0, 0, 0, 0.5);
				position: absolute;
				top: 10px;
				right: 10px;
				text-align: center;
				line-height: 24px;
				z-index: 1;
				cursor: pointer;
				
				&:after {
					content: '\2716';
					font-size: 14px;
					color: white;
				}
			}
		}
	}
	
	.img-bg {
		background-repeat: no-repeat;
		background-position: center;
		background-size: cover;
		position: relative;
		padding-bottom: 100%;
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
					<form role="form" method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
						@csrf
						<div class="box-body">
							<div class="form-group">
								<label for="exampleInputEmail1">Title</label>
								<input type="text" name="title" required class="form-control" placeholder="Enter Name" required>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Year</label>
								<input type="text" name="year" id="" class="datepicker-input form-control" name="name" placeholder="Year Work" required>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Production</label>
								<input type="text" name="date_production" id="" class="datepicker-month-year form-control" name="name" placeholder="Date Production" required>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Category</label>
								<select name="category_id" class="form-control" id="">
									@foreach (resolve(App\Repositories\Entities\Category::class)->where('type', CategoryType::PRODUCT)->get() as $item)
									<option value="{{ $item->id }}">{{ $item->title }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Image Thumbnail</label>
								<div class="input-group input-group-outline mb-3">
									<input type='file' name="image" onchange="readURL(this);"/>
									<br>
									<img id="blah" style="height: 200px;" src="{{ asset('assets/admin/image/image.jpg') }}" alt="your image" />
								</div>
							</div>
							<div class="form-group">
								<div class="upload__box" style="box-sizing: border-box;">
									<div class="upload__btn-box">
										<label class="upload__btn">
											<p>Others Image</p>
											<input type="file" multiple="" data-max_length="20" name="file[]" class="upload__inputfile">
										</label>
									</div>
									<div class="upload__img-wrap">
										<div class="upload__img-box">
											<div style="width:100%;">
												<div class="row img-preview">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Description</label>
								<textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Type Product ?</label>
								<div class="input-group input-group-outline mb-3">
									<input type="radio" name="type_product" value="0" class="type" id="" checked> All User
									<br>
									<input type="radio" name="type_product" value="1" class="type" id=""> Privilege
								</div>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">User Privilege</label>
								<select name="users[]" class="form-control users select2" disabled multiple id="" placeholder="Pilih User">
									@foreach (resolve(App\Repositories\Entities\User::class)->get() as $item)
									<option value="{{ $item->id }}">{{ $item->name.' - '.$item->email }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Available Variation</label>
								<select name="variations[]" class="form-control select2" multiple id="" placeholder="Choose Available Variation">
									@foreach (resolve(App\Repositories\Entities\Variation::class)->get() as $item)
									<option value="{{ $item->id }}">{{ $item->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Qurency ?</label>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="radio" name="qurency" value="Rp" id="" checked > Rp (IDR) 
                                    <input type="radio" name="qurency" value="$" id="" > Usd
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price</label>
                                <input type="number" class="form-control" name="price" value="" placeholder="Price">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sold ?</label>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="checkbox" name="is_sold" value="Rp" id="">
                                </div>
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
	jQuery(document).ready(function () {
		ImgUpload();
	});
	
	function ImgUpload() {
		var imgWrap = "";
		var imgArray = [];
		
		$('.upload__inputfile').each(function () {
			$(this).on('change', function (e) {
				imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap').find('.upload__img-box').find('.img-preview');
				var maxLength = $(this).attr('data-max_length');
				
				var files = e.target.files;
				var filesArr = Array.prototype.slice.call(files);
				var iterator = 0;
				
				
				filesArr.forEach(function (f, index) {
					
					if (!f.type.match('image.*')) {
						return;
					}
					
					if (imgArray.length > maxLength) {
						return false
					} else {
						var len = 0;
						for (var i = 0; i < imgArray.length; i++) {
							if (imgArray[i] !== undefined) {
								len++;
							}
						}
						if (len > maxLength) {
							return false;
						} else {
							imgArray.push(f);
							
							var reader = new FileReader();
							reader.onload = function (e) {
								var html = "<div class='col-md-2'><input type='hidden' name='images[]' value='" + e.target.result + "' ><img width='100%' src='" + e.target.result + "' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "'/><div class='upload__img-close' style='margin-top:30px'><button class='btn btn-danger btn-sm btn-block'>Remove</button></div></div>";
								imgWrap.append(html);
								iterator++;
							}
							reader.readAsDataURL(f);
						}
					}
				});
			});
		});
		
		$('body').on('click', ".upload__img-close", function (e) {
			var file = $(this).parent().data("file");
			for (var i = 0; i < imgArray.length; i++) {
				if (imgArray[i].name === file) {
					imgArray.splice(i, 1);
					break;
				}
			}
			$(this).parent().remove();
		});
	}
	
	$('.type').on('click', function () {
		if ($(this).val() === '1') {
			$('.users').attr('disabled', false);
		} else{
			$('.users').attr('disabled', true);
		}
	})
	
	$('.select2').select2();
	
	$(function () {
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
