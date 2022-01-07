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

      a:hover {
        color: red;
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
                <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
                  <i class="checkmark">✓</i>
                </div>
                  <h2>Authenticity Data</h2> 
                  <ul style="text-align: left !important">
                    @foreach ($orders as $item)
                        <li>{{ date('F Y', strtotime($item->product->date_production ?? '')) .' / ' }} <a href="{{ route('detail-product-store', optional($item->product)->slug) }}" target="_blank">{{ optional($item->product)->title ?? '-'.' / ' }}</a>{{ $order->edition ?? '' }}</li>
                    @endforeach
                    @foreach ($ordersExtends as $item)
                        <li>{{ date('d F Y', strtotime($item->date ?? '')) .' / ' }} <a href="{{ $item->url ?? '#' }}">{{ $item->name ?? '-' }}</li>
                    @endforeach

                    @if ($orders->count() == 0 && $ordersExtends->count() == 0)
                      <li> You haven't bought this product yet !!</li>
                    @endif
                  </ul>
                  <br>
                  <div style="text-align: right !important"> 
                    <a href="{{ route('authentication.product') }}" style="text-align: right !important">
                      <button class="btn btn-dark btn-sm">Finish</button>
                    </a>
                  </div>
            </div>
        </div>
    </section>
</section>
@endsection

@push('scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
</script>
@endpush