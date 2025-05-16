<div class="top-bar">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-pinterest"></i></a>
            </div>
            <div class="text-controls">
                <button class="btn btn-sm">A</button>
                <button class="btn btn-sm">A+</button>
                <button class="btn btn-sm">A-</button>
                <select class="language-select">
                    <option>English</option>
                </select>
            </div>
        </div>
    </div>
</div>
<!-- Top Navigation -->
<nav class="navbar navbar-expand-lg fixed-top py-2 dashboard-nav">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="index.html">
            <img src="{{ asset('images/logo_vertical.png') }}" alt="Uttarakhand Tourism" height="50">
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{'/'}}">HOME</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link my-account" href="{{route('dashboard')}}">
                        <i class="fas fa-user"></i>
                        MY ACCOUNT(मेरा खाता)
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Dashboard Header -->
<div class="dashboard-header">
    <div class="bg-overlay"></div>
    <h1 class="text-white">Dashboard</h1>
</div>