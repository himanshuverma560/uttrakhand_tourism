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
                        <!-- Download Registration -->
                        <div class="col-12 download-registration">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header text-white d-flex align-items-center mb-3">
                                        <h5 class="card-title">List of Pilgrims/Tourist</h5>
                                        <!-- <div class="d-flex align-items-center">
                                            <select class="form-select me-3" style="width: 200px;">
                                                <option value="">Select Tour</option>
                                                <option value="Tour_04052025">Tour_04052025</option>
                                            </select>
                                            <div class="search-box position-relative">
                                                <input type="text" class="form-control" placeholder="Search Here">
                                                <button class="btn btn-primary position-absolute end 0 top-0 bottom-0">Search</button>
                                            </div>
                                        </div> -->
                                    </div>
                                    
                                    <a href="addPilgrim.html" class="btn btn-add-pilgrim me-4 mb-3">
                                        Add New Pilgrim/Tourist
                                    </a>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Mobile Number</th>
                                                    <th>Vehicle No</th>
                                                    <th>Action</th>
                                                    <th>Download Registration Letter</th>
                                                    <th>Certificate</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><a href="#" class="text-primary">Tadhani Sahil Babubhai</a></td>
                                                    <td>9725300332</td>
                                                    <td></td>
                                                    <td>
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <button class="btn btn-sm btn-link p-0"><i class="fas fa-edit"></i></button>
                                                            <!-- <button class="btn btn-sm btn-link p-0"><i class="fas fa-eye"></i></button> -->
                                                        </div>
                                                    </td>
                                                    <td><button class="btn btn-danger download-pdf" data-pilgrim-name="Tadhani Sahil Babubhai" data-mobile="9725300332">Download PDF</button></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2 mt-3">
                                        <button class="btn btn-secondary">First</button>
                                        <button class="btn btn-secondary">Previous</button>
                                        <button class="btn btn-primary">1</button>
                                        <button class="btn btn-secondary">Next</button>
                                        <button class="btn btn-secondary">Last</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    @include('partials.user_footer')
</body>
</html>