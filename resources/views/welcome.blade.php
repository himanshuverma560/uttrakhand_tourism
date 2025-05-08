@extends('layouts.website_layout')
@section('content')
<!-- Top social bar -->
@extends('partials.menu')

<!-- Hero Section -->
<section class="hero-section">
    <!-- Image Slider -->
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/hero1.jpg" class="d-block w-100" alt="Yamunotri Temple">
            </div>
            <div class="carousel-item">
                <img src="images/hero2.jpg" class="d-block w-100" alt="Gangotri Temple">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Latest Updates Section -->
    <div class="latest-updates">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-auto">
                    <span class="updates-label">Latest Updates</span>
                </div>
                <div class="col">
                    <div class="marquee-container">
                        <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
                            The Kapaat opening dates: Yamunotri Dham : 30th April 2025 Gangotri Dham: 30th April 2025 Kedarnath Dham: 2nd May 2025 Badrinath Dham: 4th May 2025 Hemkund Sahib: 25 May 2025. | 
                            The registration of the Yatra year 2025 has been started through Website.
                        </marquee>
                    </div>
                </div>
                <div class="col-auto">
                    <a href="registration.html" class="btn btn-registration">Registration Now</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Explore Uttarakhand Section -->
<section class="explore-section py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5">
            <span class="line"></span>
            Explore Uttarakhand
            <span class="line"></span>
        </h2>
        
        <div class="row g-4">
            <!-- Wildlife Card -->
            <div class="col-lg">
                <div class="explore-card">
                    <div class="explore-img">
                        <img src="images/explore/wildlife.jpg" alt="Wildlife in Uttarakhand" class="img-fluid">
                    </div>
                    <div class="explore-content">
                        <h3>Wildlife</h3>
                        <p>Conservation reserves, world heritage sites and national parks teeming with varied flora and fauna - Uttarakhand has it all.</p>
                    </div>
                </div>
            </div>

            <!-- Adventure Card -->
            <div class="col-lg">
                <div class="explore-card">
                    <div class="explore-img">
                        <img src="images/explore/adventure.jpg" alt="Adventure Activities" class="img-fluid">
                    </div>
                    <div class="explore-content">
                        <h3>Adventure</h3>
                        <p>From camping, skiing and river rafting to stargazing, trekking and bungee jumping - Uttarakhand is a heaven for thrill seekers.</p>
                    </div>
                </div>
            </div>

            <!-- Wellness Card -->
            <div class="col-lg">
                <div class="explore-card">
                    <div class="explore-img">
                        <img src="images/explore/wellness.jpg" alt="Wellness Activities" class="img-fluid">
                    </div>
                    <div class="explore-content">
                        <h3>Wellness</h3>
                        <p>Touted as the yoga capital of the world, Uttarakhand boasts a number of centres run by professionals and is known for spiritual wellness as well.</p>
                    </div>
                </div>
            </div>

            <!-- Spirituality Card -->
            <div class="col-lg">
                <div class="explore-card">
                    <div class="explore-img">
                        <img src="images/explore/spirituality.jpg" alt="Spiritual Places" class="img-fluid">
                    </div>
                    <div class="explore-content">
                        <h3>Spirituality</h3>
                        <p>Known as Devbhumi or land of the Gods, the state holds a prominent position in the country's religious map.</p>
                    </div>
                </div>
            </div>

            <!-- Leisure Card -->
            <div class="col-lg">
                <div class="explore-card">
                    <div class="explore-img">
                        <img src="images/explore/leisure.jpg" alt="Leisure Activities" class="img-fluid">
                    </div>
                    <div class="explore-content">
                        <h3>Leisure</h3>
                        <p>Uttarakhand is home to warm and friendly people whose cultures and traditions are likely to be seen or experienced anywhere else.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- What's Trending Section -->
<section class="trending-section py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5">
            <span class="line"></span>
            What's Trending
            <span class="line"></span>
        </h2>

        <!-- Category Icons -->
        <div class="category-icons text-center">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="category-icon active" data-category="Wildlife">
                        <i class="fas fa-paw"></i>
                        <span>Wildlife</span>
                    </div>
                </div>
                <div class="col">
                    <div class="category-icon" data-category="Adventure">
                        <i class="fas fa-mountain"></i>
                        <span>Adventure</span>
                    </div>
                </div>
                <div class="col">
                    <div class="category-icon" data-category="Wellness">
                        <i class="fas fa-leaf"></i>
                        <span>Wellness</span>
                    </div>
                </div>
                <div class="col">
                    <div class="category-icon" data-category="Spirituality">
                        <i class="fas fa-om"></i>
                        <span>Spirituality</span>
                    </div>
                </div>
                <div class="col">
                    <div class="category-icon" data-category="Leisure">
                        <i class="fas fa-hiking"></i>
                        <span>Leisure</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Article Container -->
        <div id="articleContainer" class="mt-4">
            <div class="row align-items-center bg-white rounded-4 overflow-hidden">
                <div class="col-lg-6">
                    <div class="article-image">
                        <img src="images/explore/wildlife.jpg" alt="Wildlife in Uttarakhand" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="article-content p-4 p-lg-5">
                        <h3 class="article-title">The Untamed Wilderness of Uttarakhand: A Biodiversity Hotspot</h3>
                        <p class="article-text">Uttarakhand, a picturesque state in northern India, is renowned for its rich wildlife and diverse ecosystems. Nestled in the foothills of the Himalayas, the state is home to a variety of habitats, from dense forests and alpine meadows to river valleys and high-altitude regions.</p>
                        <p class="article-text">This biodiversity supports an impressive array of wildlife, including iconic species like the Bengal tiger, Asian elephant, snow leopard, and musk deer.</p>
                        <a href="#" class="btn btn-read-more">Read more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Social Media Feed Section -->
<section class="social-feed-section py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5">
            <span class="line"></span>
            Find Us on Social Media
            <span class="line"></span>
        </h2>
        
        <div class="row g-4">
            <!-- Social Media Feed Grid -->
            <div class="col-lg-2 col-md-3 col-6">
                <div class="social-card">
                    <img src="images/social/1.jpeg" alt="Social media post 1" class="img-fluid">
                    <div class="social-overlay">
                        <i class="fab fa-instagram"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-6">
                <div class="social-card">
                    <img src="images/social/2.jpeg" alt="Social media post 2" class="img-fluid">
                    <div class="social-overlay">
                        <i class="fab fa-instagram"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-6">
                <div class="social-card">
                    <img src="images/social/3.jpeg" alt="Social media post 3" class="img-fluid">
                    <div class="social-overlay">
                        <i class="fab fa-instagram"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-6">
                <div class="social-card">
                    <img src="images/social/4.jpeg" alt="Social media post 4" class="img-fluid">
                    <div class="social-overlay">
                        <i class="fab fa-instagram"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-6">
                <div class="social-card">
                    <img src="images/social/5.jpeg" alt="Social media post 5" class="img-fluid">
                    <div class="social-overlay">
                        <i class="fab fa-instagram"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-6">
                <div class="social-card">
                    <img src="images/social/6.jpeg" alt="Social media post 6" class="img-fluid">
                    <div class="social-overlay">
                        <i class="fab fa-instagram"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-6">
                <div class="social-card">
                    <img src="images/social/7.jpeg" alt="Social media post 7" class="img-fluid">
                    <div class="social-overlay">
                        <i class="fab fa-instagram"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-6">
                <div class="social-card">
                    <img src="images/social/8.jpeg" alt="Social media post 8" class="img-fluid">
                    <div class="social-overlay">
                        <i class="fab fa-instagram"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-6">
                <div class="social-card">
                    <img src="images/social/9.jpeg" alt="Social media post 9" class="img-fluid">
                    <div class="social-overlay">
                        <i class="fab fa-instagram"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-6">
                <div class="social-card">
                    <img src="images/social/10.jpeg" alt="Social media post 10" class="img-fluid">
                    <div class="social-overlay">
                        <i class="fab fa-instagram"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-6">
                <div class="social-card">
                    <img src="images/social/11.jpeg" alt="Social media post 11" class="img-fluid">
                    <div class="social-overlay">
                        <i class="fab fa-instagram"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-6">
                <div class="social-card">
                    <img src="images/social/12.jpeg" alt="Social media post 12" class="img-fluid">
                    <div class="social-overlay">
                        <i class="fab fa-instagram"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Check This Out Section -->
<section class="check-this-out py-5 bg-dark">
    <div class="container">
        <h2 class="section-title text-center mb-5 text-white">
            CHECK THIS OUT
        </h2>
        
        <div class="row g-4">
            <!-- Card 1 -->
            <div class="col-lg-3 col-md-6">
                <div class="blog-card">
                    <div class="blog-image">
                        <img src="images/check/1.jpg" alt="Best adventures" class="img-fluid">
                        <div class="tags">
                            <span class="tag adventure">Adventure</span>
                            <span class="tag spiritual">Spiritual</span>
                            <span class="tag wildlife">Wildlife</span>
                        </div>
                    </div>
                    <div class="blog-content">
                        <div class="date">December 23rd, 2024</div>
                        <h3>Best adventures to try in Uttarakhand</h3>
                        <p>Uttarakhand offers varied activities to keep the adventure enthusiasts busy. Here's one state in...</p>
                        <div class="categories">
                            <span class="category">Adventure</span>
                            <span class="category">Spiritual</span>
                            <span class="category">Places</span>
                        </div>
                        <a href="#" class="read-more">Read more <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-lg-3 col-md-6">
                <div class="blog-card">
                    <div class="blog-image">
                        <img src="images/check/2.jpg" alt="Kumbh Mela" class="img-fluid">
                        <div class="tags">
                            <span class="tag spiritual">Spiritual</span>
                        </div>
                    </div>
                    <div class="blog-content">
                        <div class="date">December 23rd, 2024</div>
                        <h3>Kumbh Mela Leap of Faith</h3>
                        <p>What makes attending a Kumbh Mela a once-in-a-lifetime opportunity? One of the largest human...</p>
                        <div class="categories">
                            <span class="category">Spiritual</span>
                            <span class="category">Events</span>
                        </div>
                        <a href="#" class="read-more">Read more <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-lg-3 col-md-6">
                <div class="blog-card">
                    <div class="blog-image">
                        <img src="images/check/3.jpg" alt="Beatles tour" class="img-fluid">
                        <div class="tags">
                            <span class="tag adventure">Adventure</span>
                        </div>
                    </div>
                    <div class="blog-content">
                        <div class="date">December 23rd, 2024</div>
                        <h3>Beatles magical tour of India</h3>
                        <p>Some facts that made headlines during and after the visit Beatles to India in February 1968. Begin...</p>
                        <div class="categories">
                            <span class="category">Adventure</span>
                            <span class="category">Places</span>
                            <span class="category">Events</span>
                        </div>
                        <a href="#" class="read-more">Read more <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-lg-3 col-md-6">
                <div class="blog-card">
                    <div class="blog-image">
                        <img src="images/check/4.jpg" alt="Tiger safari" class="img-fluid">
                        <div class="tags">
                            <span class="tag wildlife">Wildlife</span>
                        </div>
                    </div>
                    <div class="blog-content">
                        <div class="date">December 24th, 2024</div>
                        <h3>A day with the tiger</h3>
                        <p>Travel blogger Lareen Smith enjoys a wildlife safari in Corbett at 4 am in the morning and fi...</p>
                        <div class="categories">
                            <span class="category">Wildlife</span>
                        </div>
                        <a href="#" class="read-more">Read more <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="col-lg-3 col-md-6">
                <div class="blog-card">
                    <div class="blog-image">
                        <img src="images/check/5.jpg" alt="Offbeat experiences" class="img-fluid">
                        <div class="tags">
                            <span class="tag adventure">Adventure</span>
                        </div>
                    </div>
                    <div class="blog-content">
                        <div class="date">December 24th, 2024</div>
                        <h3>Offbeat experiences near Corbett</h3>
                        <p>This is a hike of approximately 3 kilometers through seemingly beautiful nature's realm of...</p>
                        <div class="categories">
                            <span class="category">Adventure</span>
                        </div>
                        <a href="#" class="read-more">Read more <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Card 6 -->
            <div class="col-lg-3 col-md-6">
                <div class="blog-card">
                    <div class="blog-image">
                        <img src="images/check/6.jpg" alt="Nainital" class="img-fluid">
                        <div class="tags">
                            <span class="tag adventure">Adventure</span>
                        </div>
                    </div>
                    <div class="blog-content">
                        <div class="date">December 24th, 2024</div>
                        <h3>Legends of Nainital</h3>
                        <p>The British may have "accidentally" stumbled upon the serene lake in Nainital and built a...</p>
                        <div class="categories">
                            <span class="category">Adventure</span>
                        </div>
                        <a href="#" class="read-more">Read more <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Card 7 -->
            <div class="col-lg-3 col-md-6">
                <div class="blog-card">
                    <div class="blog-image">
                        <img src="images/check/7.jpg" alt="Mussoorie monsoon" class="img-fluid">
                        <div class="tags">
                            <span class="tag adventure">Adventure</span>
                        </div>
                    </div>
                    <div class="blog-content">
                        <div class="date">December 24th, 2024</div>
                        <h3>Monsoon in Mussoorie</h3>
                        <p>Outside the car window, the clouds seem to be floating along with us. Dodging the mountain...</p>
                        <div class="categories">
                            <span class="category">Adventure</span>
                        </div>
                        <a href="#" class="read-more">Read more <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Card 8 -->
            <div class="col-lg-3 col-md-6">
                <div class="blog-card">
                    <div class="blog-image">
                        <img src="images/check/8.jpg" alt="Bob Dylan" class="img-fluid">
                        <div class="tags">
                            <span class="tag adventure">Adventure</span>
                        </div>
                    </div>
                    <div class="blog-content">
                        <div class="date">December 24th, 2024</div>
                        <h3>Where Bob Dylan fell in love</h3>
                        <p>In Almora, is hidden the mystical CreamĂ˘â‚¬â„˘s Ridge, where DH Lawrence holidayed and then...</p>
                        <div class="categories">
                            <span class="category">Adventure</span>
                        </div>
                        <a href="#" class="read-more">Read more <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="#" class="btn btn-view-all">VIEW ALL</a>
        </div>
    </div>
</section>

<!-- Main Content Section -->
<main>
    <!-- Add your home page content here -->
</main>
@endsection