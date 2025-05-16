<!DOCTYPE html>
<html lang="en">
@include('partials.user_head')

<body>
    @include('partials.user_nav')

    <!-- Main Content -->
    <div class="dashboard-content py-5">
        <div class="container-fluid px-4">
            <div class="row">
                <!-- Left Sidebar -->
                @include('partials.user_dashboard_nav')

                <!-- Main Dashboard Area -->
                <div class="col-md-8">
                    <div class="row g-4">
                        <!-- Registration for Tour -->
                        <div class="col-md-6">
                            <a href="{{route('tour')}}" class="text-decoration-none">
                                <div class="dashboard-card bg-white">
                                    <div class="card-body text-center">
                                        <div class="card-icon">
                                            <div class="icon-circle">
                                                <i class="fas fa-plane"></i>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <h4>Registration for Tour</h4>
                                            <p class="mb-0">यात्रा पंजीकरण करें</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- View/Modify Tour -->
                        <div class="col-md-6">
                            <a href="{{route('viewTour')}}" class="text-decoration-none">
                                <div class="dashboard-card bg-white">
                                    <div class="card-body text-center">
                                        <div class="card-icon">
                                            <div class="icon-circle">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <h4>View/Modify Tour</h4>
                                            <p class="mb-0">यात्रा देखें/संशोधित करें</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Registration User Manual -->
                        <!-- <div class="col-md-6">
                            <div class="dashboard-card bg-white h-100">
                                <div class="card-body p-4 text-center">
                                    <div class="icon-circle mb-3">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <h4>Registration User Manual</h4>
                                    <p class="mb-0">उपयोगकर्ता पंजीकरण नियमावली</p>
                                </div>
                            </div>
                        </div> -->

                        <!-- Download Registration Letter -->
                        <div class="col-md-6">
                            <a href="{{route(name: 'download')}}" class="text-decoration-none">
                                <div class="dashboard-card bg-white">
                                    <div class="card-body text-center">
                                        <div class="card-icon">
                                            <div class="icon-circle">
                                                <i class="fas fa-download"></i>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <h4>Download Registration Letter</h4>
                                            <p class="mb-0">पंजीकरण पत्र पत्र प्राप्त करें</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.user_footer')
</body>

</html>