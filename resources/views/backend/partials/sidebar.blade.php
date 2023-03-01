<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="{{ route('dashboard') }}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>DarkPan</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{(!empty(Auth::user()->profile_photo_path))? url('upload/user_images/'.Auth::user()->profile_photo_path): url('backend/img/testimonial-1.jpg')}}" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>

            <div class="ms-3">
                <h6 class="mb-0 text-uppercase">{{ Auth::user()->name }}</h6>
                <span>{{ Auth::user()->email }}</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            @php
                $prefix = Request::route()->getPrefix();
                $route = Route::current()->getName();
            @endphp
            <a href="{{ url('/dashboard') }}" class="nav-item nav-link {{ ( $route == 'dashboard')?'active':''  }}"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ ($prefix == '/user')?'active':''}}" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('sample') }}" class="dropdown-item {{ ( $route == 'sample')?'active':''  }}">Sign In</a>
                    <a href="signup.html" class="dropdown-item">Sign Up</a>
                    <a href="404.html" class="dropdown-item">404 Error</a>
                    <a href="blank.html" class="dropdown-item">Blank Page</a>
                </div>
            </div>
        </div>
    </nav>
</div>
