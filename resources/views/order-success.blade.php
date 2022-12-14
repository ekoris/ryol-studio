@extends('theme.master')

@php
@endphp

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
	h1 {
		color: #88B04B;
		font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
		font-weight: 900;
		font-size: 40px;
		margin-bottom: 10px;
	}
	p {
		color: #404F5E;
		font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
		font-size:20px;
		margin: 0;
	}
	i {
		color: #9ABC66;
		font-size: 100px;
		line-height: 200px;
		margin-left:-15px;
	}
	.card {
		background: white;
		padding: 60px;
		border-radius: 4px;
		box-shadow: 0 2px 3px #C8D0D8;
		display: inline-block;
		margin: 0 auto;
	}
</style>
@endpush

@section('body')
<section class="breadcrumbs">
	<section id="portfolio-details" class="portfolio-details">
		<div class="container" style="text-align: center">
			<div class="card" style="text-align: center">
				@if (!Session::get('sold_out'))
					<div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
						<i class="checkmark">✓</i>
					</div>
					<h1>Success</h1> 
					<p>We received your purchase request;<br/> we'll be in touch shortly!</p>
				@else
					<div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
						<i class="times">X</i>
					</div>
					<h1>I Know You Sad. Sorry :(</h1> 
					<p>This Product already reserved in few minute !</p>
				@endif
			</div>
		</div>
	</section><!-- End Portfolio Details Section -->
</section>
@endsection

@push('scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
</script>
@endpush