<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Product</li>
            <li class="{{ Request::routeIs('admin.product.*') ? 'active' : '' }}"><a href="{{ route('admin.product.index') }}"><i class="fa fa-calendar"></i> <span>Product</span></a></li>
            <li class="{{ Request::routeIs('admin.order.*') ? 'active' : '' }}"><a href="{{ route('admin.order.index') }}"><i class="fa fa-area-chart"></i> <span>Order</span>
                <span class="pull-right-container">
                    <small class="label pull-right bg-green">{{ resolve(App\Repositories\OrderRepository::class)->countOrder() }}</small>
                </span>
            </a></li>
            <li class="{{ Request::routeIs('admin.authenticate.*') ? 'active' : '' }}"><a href="{{ route('admin.authenticate.index') }}"><i class="fa fa-cog"></i> <span>Authenticate Product</span></a></li>
            <li class="header">Feed</li>
            <li class="{{ Request::routeIs('admin.up-comming.*') ? 'active' : '' }}"><a href="{{ route('admin.up-comming.index') }}"><i class="fa fa-calendar"></i> <span>Up Comming Event</span></a></li>
            <li class="{{ Request::routeIs('admin.art-work.*') ? 'active' : '' }}"><a href="{{ route('admin.art-work.index') }}"><i class="fa fa-area-chart"></i> <span>Art Work</span></a></li>
            <li class="header">Website Management</li>
            <li class="{{ Request::routeIs('admin.message.*') ? 'active' : '' }}"><a href="{{ route('admin.message.index') }}"><i class="fa fa-envelope"></i> <span>Message</span></a></li>
            <li class="{{ Request::routeIs('admin.slider.*') ? 'active' : '' }}"><a href="{{ route('admin.slider.index') }}"><i class="fa fa-image"></i> <span>Slider</span></a></li>
            <li class="{{ Request::routeIs('admin.category.*') ? 'active' : '' }}"><a href="{{ route('admin.category.index') }}"><i class="fa fa-bars"></i> <span>Category</span></a></li>
            <li class="{{ Request::routeIs('admin.variation.*') ? 'active' : '' }}"><a href="{{ route('admin.variation.index') }}"><i class="fa fa-tags"></i> <span>Variation</span></a></li>
            <li class="{{ Request::routeIs('admin.statement.*') ? 'active' : '' }}"><a href="{{ route('admin.statement.index') }}"><i class="fa fa-cog"></i> <span>Statement</span></a></li>
            <li class="{{ Request::routeIs('admin.cv.*') ? 'active' : '' }}"><a href="{{ route('admin.cv.index') }}"><i class="fa fa-cog"></i> <span>Curiculum Vitae</span></a></li>
            <li class="{{ Request::routeIs('admin.about.*') ? 'active' : '' }}"><a href="{{ route('admin.about.index') }}"><i class="fa fa-cog"></i> <span>Website Management</span></a></li>
            <li class="{{ Request::routeIs('admin.user.*') ? 'active' : '' }}"><a href="{{ route('admin.user.index') }}"><i class="fa fa-users"></i> <span>User</span></a></li>
            <li class="{{ Request::routeIs('admin.profile.*') ? 'active' : '' }}"><a href="{{ route('admin.user.profile') }}"><i class="fa fa-circle-o text-white "></i> <span>Profile</span></a></li>
        </ul>
    </section>
</aside>