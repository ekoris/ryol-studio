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
                    <form role="form" method="POST" action="{{ route('admin.product.update', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" name="title" required class="form-control" placeholder="Enter Name" value="{{ $product->title }}" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Year</label>
                                <input type="text" name="year" id="" class="datepicker-input form-control" value="{{ $product->year }}" placeholder="Year Work" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Production</label>
                                <input type="text" name="date_production" id="" class="datepicker-month-year form-control" value="{{ $product->date_production }}" name="name" placeholder="Date Production" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category</label>
                                <select name="category_id" class="form-control" id="">
                                    <option value="">Choose Category</option>
                                    @foreach (resolve(App\Repositories\Entities\Category::class)->where('type', CategoryType::PRODUCT)->get() as $item)
                                        <option value="{{ $item->id }}" {{ $product->category_id == $item->id ? 'selected' : '' }}>{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Image Thumbnail</label>
                                <div class="input-group input-group-outline mb-3">
                                    <input type='file' name="image" onchange="readURL(this);"/>
                                    <br>
                                    <img id="blah" style="height: 200px;" src="{{ $product->image_url }}" alt="your image" />
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
                                                    @forelse ($product->productPhotos as $key => $item)
                                                    <div class='col-md-2'>
                                                        <input type="hidden" name="images_before[]" value="{{ $item->image }}">
                                                        <img width="100%" src="{{ $item->image_url }}" data-number="{{ $key }}" data-file="{{ $key }}"/>
                                                        <div class="upload__img-close" style="margin-top:30px">
                                                            <button class="btn btn-danger btn-sm btn-block">Remove</button>
                                                        </div>
                                                    </div>
                                                    @empty
                                                        
                                                    @endforelse
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description</label>
                                <textarea name="description" class="form-control" id="" cols="30" rows="10">{{ $product->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Type Product ?</label>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="radio" name="type_product" value="0" class="type" id="" {{ $product->is_privilege == 0 ? 'checked' : '' }} > All User
                                    <br>
                                    <input type="radio" name="type_product" value="1" class="type" id="" {{ $product->is_privilege == 1 ? 'checked' : '' }}> Privilege
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">User Privilege</label>
                                <select name="users[]" class="form-control users select2" {{ $product->is_privilege == 1 ? '' : 'disabled' }} multiple id="" placeholder="Pilih User">
                                    @foreach (resolve(App\Repositories\Entities\User::class)->get() as $item)
                                        <option value="{{ $item->id }}" {{ in_array($item->id, ($product->productUserPrivileges->pluck('user_id')->toArray() ?? [])) ? 'selected' : '' }}>{{ $item->name.' - '.$item->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
								<label for="exampleInputEmail1">Available Variation</label>
                                @php
                                    $variations = resolve(App\Repositories\Entities\ProductVariation::class)->where('product_id', $product->id)->pluck('variation_id')->toArray();
                                @endphp
								<select name="variations[]" class="form-control select2" multiple id="" placeholder="Choose Available Variation">
									@foreach (resolve(App\Repositories\Entities\Variation::class)->get() as $item)
									<option value="{{ $item->id }}" {{ in_array($item->id, $variations) ? 'selected' : '' }}>{{ $item->name }}</option>
									@endforeach
								</select>
							</div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Qurency ?</label>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="radio" name="qurency" value="Rp" class="type" id="" {{ $product->qurency == 'Rp' ? 'checked' : '' }} > Rp (IDR) 
                                    <input type="radio" name="qurency" value="$" class="type" id="" {{ $product->qurency == '$' ? 'checked' : '' }}> Usd
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price</label>
                                <input type="number" class="form-control" name="price" value="{{ $product->price }}" placeholder="Price">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sold ?</label>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="checkbox" name="is_sold" value="Rp" class="type" id="" {{ $product->is_sold == 1 ? 'checked' : '' }} >
                                </div>
                            </div>
                            <div class="form-box upload-edition">
								<label for="">Product Edition</label>
								<div class="repeat-container">
									<div class="d-flex pb-8 repeat-row">
                                        @forelse ($product->productEditions as $key => $item)
										    <div class="row row-repeate">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="product_edition_exists[{{$item->id}}][]" value="{{ $item->edition }}" placeholder="Add Edition">
                                                    </div>
                                                </div>
                                                @if ($key == 0)
                                                    <div class="col-md-2">
                                                        <a href="" class="repeat-add ml-8 my-auto">
                                                            <button class="btn btn-warning btn-sm">Add Edition</button>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="col-md-2">
                                                        <a href="" class="repeat-remove ml-8 my-auto">
                                                            <button class="btn btn-danger btn-sm">Remove</button>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                            @empty
										    <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="product_edition[]" placeholder="Add Edition">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <a href="" class="repeat-add ml-8 my-auto">
                                                        <button class="btn btn-warning btn-sm">Add Edition</button>
                                                    </a>
                                                </div>    
                                            </div>
                                        @endforelse
									</div>
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

    $(document).on('click', '.upload-edition .repeat-add', function(e){
		e.preventDefault();
		let template = `
		<div class="d-flex pb-8 repeat-row">
			<div class="form-file__input w-100">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<input type="text" class="form-control" name="product_edition[]" placeholder="Add Edition">
						</div>
					</div>
					<div class="col-md-2">
						<a href="" class="repeat-add ml-8 my-auto">
							<button class="btn btn-warning btn-sm">Add Edition</button>
						</a>
					</div>
				</div>
			</div>
		</div>`;
		
		$(this).closest('.repeat-container').append(template);
		$(this).html('<button class="btn btn-danger btn-sm">remove</button><br>').attr('class', 'repeat-remove ml-8 my-auto')
	});

	$(document).on('click', '.repeat-remove', function(e){
		e.preventDefault()
		$(this).closest('.row-repeate').remove()
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
    $(function () {
        $('.select2').select2();
        
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
