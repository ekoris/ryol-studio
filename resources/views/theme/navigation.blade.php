<header id="header" class="fixed-top header-inner-pages" style="position: absolute;left: 0;right: 0;">
	<div class="container d-flex align-items-center justify-content-lg-between">
		{{-- <h1 class="logo me-auto me-lg-0"><a href="">Ryol Studio<span>.</span></a></h1> --}}
		<a href="/" class="logo me-auto me-lg-0"><img src="{{ asset('assets/frontend') }}/assets/img/logo.png" alt="" class="img-fluid"></a>
		<nav id="navbar" class="navbar order-last order-lg-0">
			<ul>
				<li class="dropdown"><a href="#"><span>Art Work</span> <i class="bi bi-chevron-down"></i></a>
					<ul>
						@foreach (resolve(App\Repositories\HomeRepository::class)->artWorkYearNavigation() as $item)
						<li><a href="{{ route('art-work', $item->year) }}">{{ $item->year }}</a></li>
						@endforeach
						<li class="dropdown"><a href="#"><span>Category</span> <i class="bi bi-chevron-right"></i></a>
							<ul>
								@foreach (resolve(App\Repositories\HomeRepository::class)->artWorkCategoryNavigation() as $item)
								<li><a href="{{ route('art-work', $item->category->slug) }}">{{ $item->category->title ?? '' }}</a></li>
								@endforeach
							</ul>
						</li>
					</ul>
				</li>
				<li class="dropdown"><a href="#"><span>Up-Comming Event</span> <i class="bi bi-chevron-down"></i></a>
					<ul>
						@foreach (resolve(App\Repositories\HomeRepository::class)->upCommingYearNavigation() as $item)
						<li><a href="{{ route('up-comming', $item->year) }}">{{ $item->year }}</a></li>
						@endforeach
						<li class="dropdown"><a href="#"><span>Category</span> <i class="bi bi-chevron-right"></i></a>
							<ul>
								@foreach (resolve(App\Repositories\HomeRepository::class)->upCommingCategoryNavigation() as $item)
								<li><a href="{{ route('up-comming', $item->category->slug) }}">{{ $item->category->title ?? '' }}</a></li>
								@endforeach
							</ul>
						</li>
					</ul>
				</li>
					<li><a class="nav-link scrollto" href="{{ route('store') }}">Store</a></li>
				<li class="dropdown"><a href="#"><span>About</span> <i class="bi bi-chevron-down"></i></a>
					<ul>
						<li><a href="{{ route('about.cv') }}">Statement CV</a></li>
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