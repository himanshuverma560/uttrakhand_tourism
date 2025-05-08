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

<!-- Main header -->
<header class="header">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="images/logo.jpg" alt="Uttarakhand Tourism Simply Heaven" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">HOME</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="/registration">CHARDHAM REGISTRATION</a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="/user/dashboard">DASHBOARD</a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>
</header>
