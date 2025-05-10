<div class="col-md-3">
    <div class="sidebar-profile mb-4">
        <div class="profile-info bg-primary text-white p-4">
            <div class="text-center mb-3">
                <i class="fas fa-user-circle fa-3x"></i>
            </div>
            <h6 class="mb-1">{{ Auth::user()->user_type }}</h6>
            <h5 class="mb-1">{{ Auth::user()->name }}</h5>
            <p class="mb-0">{{ Auth::user()->mobile }}</p>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{route('dashboard')}}">
                    <i class="fas fa-home"></i>
                    Dashboard
                </a>
            </li>
        </ul>
    </div>
    <div class="sidebar-menu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('viewTour') ? 'active' : '' }}" href="{{route('viewTour')}}">
                    <i class="fas fa-plane"></i>
                    Manage Tour Info
                </a>
            </li>
        </ul>
    </div>
    <div class="sidebar-menu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('download') ? 'active' : '' }}" href="{{route('download')}}">
                    <i class="fas fa-download"></i>
                    Download Certificate
                </a>
            </li>
        </ul>
    </div>
    <div class="sidebar-menu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{route('logout')}}">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</div>