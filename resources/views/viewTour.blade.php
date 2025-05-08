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
                <div class="col-md-9">
                    <div class="row g-4">
                        <!-- View Tours -->
                        <div class="tour-listing-section">
                            <div class="card">
                                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Plan Your Tour</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a href="tourRegister.html" class="btn btn-info text-white">Add New Tour</a>
                                        <div class="d-flex gap-2 align-items-center">
                                            <input type="text" class="form-control" placeholder="Search By Tour Name">
                                            <button class="btn btn-info text-white">Search</button>
                                        </div>
                                    </div>

                                    <div class="alert alert-danger">
                                        Note : Tours without any pilgrim registration will be deleted in 3 days.
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>Created date</th>
                                                    <th>Group ID</th>
                                                    <th>Tour Name</th>
                                                    <th>Tour Date</th>
                                                    <th>Your Destination</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>07-05-2025</td>
                                                    <td>GP123456</td>
                                                    <td>Char Dham Yatra</td>
                                                    <td>10-05-2025 to 20-05-2025</td>
                                                    <td>Kedarnath, Badrinath</td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <button class="btn btn-sm btn-info view-pilgrims" data-bs-toggle="modal" data-bs-target="#pilgrimDetailsModal">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-primary">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <a href="{{route('addPligrim')}}" class="btn btn-sm btn-success">
                                                                Add Pilgrim
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pilgrim Details Modal -->
    <div class="modal fade" id="pilgrimDetailsModal" tabindex="-1" aria-labelledby="pilgrimDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pilgrimDetailsModalLabel">Pilgrim Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Sr No</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Mobile</th>
                                    <th>Aadhaar</th>
                                    <th>Medical Condition</th>
                                    <th>Vehicle</th>
                                </tr>
                            </thead>
                            <tbody id="pilgrimDetailsTableBody">
                                <!-- Pilgrim details will be populated here dynamically -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @include('partials.user_footer')
</body>
</html>