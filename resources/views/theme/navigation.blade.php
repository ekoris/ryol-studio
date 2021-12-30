@php
    $website = resolve(App\Repositories\Entities\WebsiteManagement::class)->first();
@endphp

<header id="header" class="fixed-top header-inner-pages" style="position: absolute;left: 0;right: 0;">
	<div class="container d-flex align-items-center justify-content-lg-between">
		{{-- <h1 class="logo me-auto me-lg-0"><a href="">Ryol Studio<span>.</span></a></h1> --}}
		<a href="/" class="logo me-auto me-lg-0"><img src="{{ $website->logo_url }}" alt="" class="img-fluid"></a>
		<nav id="navbar" class="navbar order-last order-lg-0">
			<ul>
				<li class="dropdown"><a href="#"><span>Art Work</span></a>
					<ul>
						@foreach (resolve(App\Repositories\HomeRepository::class)->artWorkYearNavigation() as $item)
							<li><a href="{{ route('art-work', $item->year) }}">{{ $item->year }}</a></li>
						@endforeach
					</ul>
				</li>
				<li class="dropdown"><a href="#"><span>Up-Comming Event</span></a>
					<ul>
						@foreach (resolve(App\Repositories\Entities\Category::class)->where('type', 2)->get() as $item)
							<li><a href="{{ route('up-comming', $item->slug) }}">{{ $item->title }}</a></li>
						@endforeach
					</ul>
				</li>
					<li><a class="nav-link scrollto" href="{{ route('store') }}">Store</a></li>
				<li class="dropdown"><a href="#"><span>About</span></a>
					<ul>
						<li><a href="{{ route('about.cv') }}">Statement</a></li>
						<li><a href="{{ route('about.cv.periodic') }}">Curriculum Vitae</a></li>
						<li><a href="{{ route('about.contact-us') }}">Contact Us</a></li>
					</ul>
				</li>
				@if (logged_in_user() && logged_in_user()->hasRole('user'))
					<li><a class="nav-link scrollto" href="{{ route('auth.profile') }}">Profile</a></li>
					<li><a class="nav-link scrollto" href="{{ route('auth.logout') }}">Sign Out</a></li>
				@else
					<li><a class="nav-link scrollto" href="{{ route('auth.login') }}">Login</a></li>
				@endif
			</ul>
			<i class="bi bi-list mobile-nav-toggle"></i>
		</nav>
	</div>
</header>