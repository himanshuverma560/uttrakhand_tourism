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
                        <!-- Registration for Tour -->
                        <div class="tour-registration-section">
                            <div class="card">
                                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Plan Your Tour</h5>
                                    <div class="language-select">
                                        <select class="form-select form-select-sm">
                                            <option selected>English</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form id="tourRegistrationForm">
                                        <!-- Tour Duration Section -->
                                        <div class="tour-section mb-4">
                                            <div class="section-header p-3 d-flex justify-content-between align-items-center">
                                                <h6 class="mb-0">Select Tour Duration (Date of Entering/Leaving into State) *</h6>
                                                <i class="fas fa-chevron-up"></i>
                                            </div>
                                            <div class="section-content">
                                                <div class="alert alert-danger">
                                                    Note : Tour duration can be for maximum of 15 days only!
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Tour Start & End Date<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control daterange" placeholder="Please Select Tour Date" readonly>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">No. of Tourists ( Max 6)<span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control" placeholder="No. of Tourists" min="1" max="6">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Mode of Travel Section -->
                                        <div class="tour-section mb-4">
                                            <div class="section-header p-3 d-flex justify-content-between align-items-center">
                                                <h6 class="mb-0">Select Mode of Travel To Dham *</h6>
                                                <i class="fas fa-chevron-up"></i>
                                            </div>
                                            <div class="section-content">
                                                <div class="alert alert-danger">
                                                    Note : Selection of Mode of Travel will be considered as a Final Boarding Vehicle, you can not change it later.
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Mode of Travel for Dham<span class="text-danger">*</span></label>
                                                        <select class="form-select" id="travelMode">
                                                            <option value="">Select</option>
                                                            <option value="By Road">By Road</option>
                                                            <option value="By Helicopter">By Helicopter</option>
                                                            <option value="By Walking">By Walking</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Type of Transportation<span class="text-danger">*</span></label>
                                                        <select class="form-select" id="transportationType" disabled>
                                                            <option value="">Select</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Date-wise Destination Section -->
                                        <div class="tour-section mb-4">
                                            <div class="section-header p-3 d-flex justify-content-between align-items-center">
                                                <h6 class="mb-0">Select Date-wise Destination *</h6>
                                                <i class="fas fa-chevron-up"></i>
                                            </div>
                                            <div class="section-content">
                                                <div class="alert alert-danger">
                                                    Note : The selection of date for specific dham should be in incremental order.
                                                </div>
                                                <div id="destinationContainer">
                                                    <div class="destination-row row mb-3">
                                                        <div class="col-md-5">
                                                            <select class="form-select" name="dham">
                                                                <option value="">Plan your destination</option>
                                                                <option value="Yamunotri">Yamunotri</option>
                                                                <option value="Gangotri">Gangotri</option>
                                                                <option value="Kedarnath">Kedarnath</option>
                                                                <option value="Badrinath">Badrinath</option>
                                                                <option value="Hemkund Sahib">Hemkund Sahib</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="date" class="form-control" name="dhamDate">
                                                        </div>
                                                        <div class="col-md-2 d-flex">
                                                            <button type="button" class="btn btn-danger remove-destination">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary" id="addDestination">
                                                    <i class="fas fa-plus"></i> Add Destination
                                                </button>
                                            </div>
                                        </div>

                                        <div class="alert alert-danger mb-4">
                                            Note : Tours without any pilgrim registration will be deleted in 3 days.
                                        </div>

                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Save & Create Tour</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.user_footer')
</body>
</html>