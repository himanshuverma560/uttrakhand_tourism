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
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="row g-4">
                        <!-- Registration for Tour -->
                        <div class="tour-registration-section">
                            <div class="card">
                                <div
                                    class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Plan Your Tour</h5>
                                    <div class="language-select">
                                        <select class="form-select form-select-sm">
                                            <option selected>English</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form id="tourRegistrationForm" action="{{ route('tour.update', $tour->id) }}"
                                        method="post">
                                        @csrf
                                        <!-- Tour Duration Section -->
                                        <div class="tour-section mb-4">
                                            <div
                                                class="section-header p-3 d-flex justify-content-between align-items-center">
                                                <h6 class="mb-0">Select Tour Duration (Date of Entering/Leaving into
                                                    State) *</h6>
                                                <i class="fas fa-chevron-up"></i>
                                            </div>
                                            <div class="section-content">
                                                <div class="alert alert-danger">
                                                    Note : Tour duration can be for maximum of 15 days only!
                                                </div>
                                                <div class="row">

                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">Tour Start & End Date<span
                                                                class="text-danger">*</span></label>
                                                        <input type="date" name="start_date"
                                                            value="{{ \Carbon\Carbon::parse($tour->start_date)->format('Y-m-d') }}"
                                                            class="form-control" placeholder="Please Select Tour Date"
                                                            required>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">Tour Start & End Date<span
                                                                class="text-danger">*</span></label>
                                                        <input type="date" name="end_date"
                                                            value="{{ \Carbon\Carbon::parse($tour->end_date)->format('Y-m-d') }}"
                                                            class="form-control" placeholder="Please Select Tour Date"
                                                            required>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">No. of Tourists ( Max 6)<span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" class="form-control"
                                                            name="number_of_tourist" placeholder="No. of Tourists"
                                                            min="1" max="6"
                                                            value="{{ $tour->number_of_tourist }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Mode of Travel Section -->
                                        <div class="tour-section mb-4">
                                            <div
                                                class="section-header p-3 d-flex justify-content-between align-items-center">
                                                <h6 class="mb-0">Select Mode of Travel To Dham *</h6>
                                                <i class="fas fa-chevron-up"></i>
                                            </div>
                                            <div class="section-content">
                                                <div class="alert alert-danger">
                                                    Note : Selection of Mode of Travel will be considered as a Final
                                                    Boarding Vehicle, you can not change it later.
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Mode of Travel for Dham<span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-select" id="travelMode"
                                                            name="mode_of_travel">
                                                            <option value="">Select</option>
                                                            <option value="By Road"
                                                                {{ $tour->mode_of_travel == 'By Road' ? 'selected' : '' }}>
                                                                By Road</option>
                                                            <option value="By Helicopter"
                                                                {{ $tour->mode_of_travel == 'By Helicopter' ? 'selected' : '' }}>
                                                                By Helicopter</option>
                                                            <option value="By Walking"
                                                                {{ $tour->mode_of_travel == 'By Walking' ? 'selected' : '' }}>
                                                                By Walking</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Type of Transportation<span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-select" id="transportationType"
                                                            name="type_of_transport">
                                                            <option value="{{ $tour->type_of_transport }}">
                                                                {{ $tour->type_of_transport }}</option>
                                                        </select>
                                                    </div>

                                                    <div class="row d-flex align-items-end">
                                                        <div class="col-md-5 mb-3 vehicle-details" style="display: none;">
                                                            <label class="form-label">Driver's Name<span
                                                                    class="text-danger vehicle-required"
                                                                    style="display: none;">*</span></label>
                                                            <input type="text" class="form-control" id="driverName"
                                                                placeholder="Enter Driver's Name">
                                                        </div>
                                                        <div class="col-md-5 mb-3 vehicle-details" style="display: none;">
                                                            <label class="form-label">Vehicle Number<span
                                                                    class="text-danger vehicle-required"
                                                                    style="display: none;">*</span></label>
                                                            <input type="text" class="form-control" id="vehicleNumber"
                                                                placeholder="Enter Vehicle Number">
                                                        </div>
                                                        <div class="text-end vehicle-details col-md-2 mb-3"
                                                            style="display: none;">
                                                            <button type="button" class="btn btn-primary"
                                                                id="addVehicle">
                                                                <i class="fas fa-plus"></i> Add
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <!-- Vehicle Details Table -->
                                                    <?php $drivers = json_decode($tour->driver_name, true);  ?>
                                                    <div class="table-responsive mt-3" style="<?php if(empty($drivers)) echo "display: none"; ?>">
                                                        <table class="table table-bordered" id="vehicleTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>Mode of Travel for Dham</th>
                                                                    <th>Type of Transportation</th>
                                                                    <th>Driver's Name</th>
                                                                    <th>Vehicle Number</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                  
                                                                if (!empty($drivers)) {
                                                                    foreach ($drivers as $index=>$driver)
                                                                ?>
                                                                <tr>
                                                                    <td>{{$tour->mode_of_travel}}</td>
                                                                    <td>{{$tour->type_of_transport}}</td>
                                                                    <td>{{$driver['driver']}}<input type="hidden" name="drivers[]" value="{{$driver['driver']}}"></td>
                                                                    <td>{{$driver['vehicle']}}<input type="hidden" name="vehicle[]" value="{{$driver['vehicle']}}"></td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-sm btn-outline-primary edit-vehicle" data-index="{{$index}}">
                                                                            <i class="fas fa-edit"></i>
                                                                        </button>
                                                                        <button type="button" class="btn btn-sm btn-outline-danger delete-vehicle" data-index="{{$index}}">
                                                                            <i class="fas fa-trash"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- Date-wise Destination Section -->
                                        <div class="tour-section mb-4">
                                            <div
                                                class="section-header p-3 d-flex justify-content-between align-items-center">
                                                <h6 class="mb-0">Select Date-wise Destination *</h6>
                                                <i class="fas fa-chevron-up"></i>
                                            </div>
                                            <div class="section-content">
                                                <div class="alert alert-danger">
                                                    Note : The selection of date for specific dham should be in
                                                    incremental order.
                                                </div>
                                                <div id="destinationContainer">
                                                    @foreach (json_decode($tour->date_wise_destination, true) as $index => $destination)
                                                        <div class="destination-row row mb-2">
                                                            <div class="col-md-5">
                                                                <select class="form-select" name="dham[]">
                                                                    <option value="">Select Dham</option>
                                                                    @foreach (['Yamunotri', 'Gangotri', 'Kedarnath', 'Badrinath', 'Hemkund Sahib'] as $dham)
                                                                        <option value="{{ $dham }}"
                                                                            {{ $destination['dham'] == $dham ? 'selected' : '' }}>
                                                                            {{ $dham }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <input type="date" class="form-control"
                                                                    name="dhamDate[]"
                                                                    value="{{ $destination['date'] }}">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button type="button"
                                                                    class="btn btn-danger remove-destination">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
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
    <script>
        const tourForm = document.getElementById('tourRegistrationForm');
        if (tourForm) {
            console.log('Tour Registration Form Loaded');
            // Initialize jQuery daterangepicker

            // Mode of Travel dependency
            const travelModeSelect = document.getElementById('travelMode');
            const transportationSelect = document.getElementById('transportationType');
            const vehicleDetails = document.querySelectorAll('.vehicle-details');
            const vehicleRequired = document.querySelectorAll('.vehicle-required');
            const driverName = document.getElementById('driverName');
            const vehicleNumber = document.getElementById('vehicleNumber');

            // Initialize vehicles array to store all vehicles
            let vehicles = [];
            const vehicleTable = document.getElementById('vehicleTable');
            const addVehicleBtn = document.getElementById('addVehicle');

            // Initialize transportation select as disabled
            // if (transportationSelect) {
            //     transportationSelect.disabled = true;
            // } 

            travelModeSelect.addEventListener('change', function() {
                // First clear and enable the transportation select
                transportationSelect.innerHTML = '<option value="">Select</option>';
                transportationSelect.disabled = false;

                // Hide vehicle details by default
                vehicleDetails.forEach(detail => detail.style.display = 'none');
                vehicleRequired.forEach(req => req.style.display = 'none');
                driverName.required = false;
                vehicleNumber.required = false;

                // Add options based on selected travel mode
                switch (this.value) {
                    case 'By Road':
                        const roadOptions = [
                            'Bus/Mini Bus',
                            'Private Car',
                            'Taxi/Maxi',
                            'Two-wheeler'
                        ];
                        roadOptions.forEach(option => {
                            const optionElement = new Option(option, option);
                            transportationSelect.add(optionElement);
                        });
                        vehicleDetails.forEach(detail => detail.style.display = 'block');
                        break;

                    case 'By Helicopter':
                        transportationSelect.add(new Option('Chartered Helicopter', 'Chartered Helicopter'));
                        vehicleDetails.forEach(detail => detail.style.display = 'none');
                        break;

                    case 'By Walking':
                        transportationSelect.add(new Option('By Walking', 'By Walking'));
                        transportationSelect.value = 'By Walking';
                        vehicleDetails.forEach(detail => detail.style.display = 'none');
                        break;

                    default:
                        transportationSelect.disabled = true;
                        vehicleDetails.forEach(detail => detail.style.display = 'none');
                }
            });

            // Function to update vehicles table
            function updateVehiclesTable() {
                const tbody = vehicleTable.querySelector('tbody');
                const vehicleTableContainer = vehicleTable.closest('.table-responsive');
                vehicleTableContainer.style.display = vehicles.length > 0 ? 'block' : 'none';
                tbody.innerHTML = '';
                vehicles.forEach((vehicle, index) => {
                    const row = tbody.insertRow();
                    row.innerHTML = `
                        <td>${vehicle.mode}</td>
                        <td>${vehicle.type}</td>
                        <td>${vehicle.driverName}<input type="hidden" name="drivers[]" value="${vehicle.driverName}"></td>
                        <td>${vehicle.vehicleNumber}<input type="hidden" name="vehicle[]" value="${vehicle.vehicleNumber}"></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary edit-vehicle" data-index="${index}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger delete-vehicle" data-index="${index}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;
                });

                // Add event listeners for edit and delete buttons
                tbody.querySelectorAll('.edit-vehicle').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const index = this.dataset.index;
                        const vehicle = vehicles[index];
                        travelModeSelect.value = vehicle.mode;
                        travelModeSelect.dispatchEvent(new Event('change'));
                        transportationSelect.value = vehicle.type;
                        driverName.value = vehicle.driverName;
                        vehicleNumber.value = vehicle.vehicleNumber;
                        vehicles.splice(index, 1);
                        updateVehiclesTable();
                    });
                });

                tbody.querySelectorAll('.delete-vehicle').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const index = this.dataset.index;
                        vehicles.splice(index, 1);
                        updateVehiclesTable();
                    });
                });
            }

            // Add event listener for transportation type
            transportationSelect.addEventListener('change', function() {
                const requireFields = ['Private Car', 'Two-wheeler'].includes(this.value);
                vehicleRequired.forEach(req => {
                    req.style.display = requireFields ? 'inline' : 'none';
                });
            });

            // Add event listener for Add Vehicle button
            addVehicleBtn.addEventListener('click', function() {
                const mode = travelModeSelect.value;
                const type = transportationSelect.value;
                const driver = driverName.value;
                const vehNumber = vehicleNumber.value;

                // Validate inputs
                if (!mode || !type || (type !== 'By Walking' && (!driver || !vehNumber))) {
                    alert('Please fill all required fields');
                    return;
                }

                // Add vehicle to array
                vehicles.push({
                    mode: mode,
                    type: type,
                    driverName: driver,
                    vehicleNumber: vehNumber
                });

                // Update table
                updateVehiclesTable();

                // Clear inputs
                driverName.value = '';
                vehicleNumber.value = '';
            });


            // Add/Remove destination functionality
            const destinationContainer = document.getElementById('destinationContainer');
            const addDestinationBtn = document.getElementById('addDestination');

            addDestinationBtn.addEventListener('click', function() {
                const newRow = document.createElement('div');
                newRow.className = 'destination-row row mb-3';
                newRow.innerHTML = `
                    <div class="col-md-5">
                        <select class="form-select" name="dham[]" required>
                            <option value="">Plan your destination</option>
                            <option value="Yamunotri">Yamunotri</option>
                            <option value="Gangotri">Gangotri</option>
                            <option value="Kedarnath">Kedarnath</option>
                            <option value="Badrinath">Badrinath</option>
                            <option value="Hemkund Sahib">Hemkund Sahib</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <input type="date" class="form-control" name="dhamDate[]" required>
                    </div>
                    <div class="col-md-2 d-flex">
                        <button type="button" class="btn btn-danger remove-destination">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
                destinationContainer.appendChild(newRow);

                const removeBtn = newRow.querySelector('.remove-destination');
                removeBtn.addEventListener('click', function() {
                    newRow.remove();
                });
            });

            // Add remove functionality to initial destination row
            document.querySelectorAll('.remove-destination').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (destinationContainer.children.length > 1) {
                        this.closest('.destination-row').remove();
                    }
                });
            });

            // Form validation
            tourForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Basic validation
                //const dateRange = tourForm.querySelector('.daterange').value;
                const tourists = tourForm.querySelector('input[type="number"]').value;
                const travelMode = travelModeSelect.value;
                const transportation = transportationSelect.value;
                const destinations = tourForm.querySelectorAll('.destination-row');

                let isValid = true;
                let errorMessage = '';



                if (!tourists || tourists < 1 || tourists > 6) {
                    errorMessage += 'Number of tourists must be between 1 and 6\n';
                    isValid = false;
                }

                if (!travelMode) {
                    errorMessage += 'Please select mode of travel\n';
                    isValid = false;
                }

                if (!transportation && travelMode !== 'By Walking') {
                    errorMessage += 'Please select type of transportation\n';
                    isValid = false;
                }

                if (destinations.length < 1) {
                    errorMessage += 'Please add at least one destination\n';
                    isValid = false;
                }

                let hasInvalidDestination = false;
                destinations.forEach(dest => {
                    const dham = dest.querySelector('select[name="dham[]"]').value;
                    const date = dest.querySelector('input[name="dhamDate[]"]').value;
                    if (!dham || !date) {
                        hasInvalidDestination = true;
                    }
                });

                if (hasInvalidDestination) {
                    errorMessage += 'Please fill in all destination details\n';
                    isValid = false;
                }

                if (!isValid) {
                    alert(errorMessage);
                    return;
                }

                this.submit();
            });
        }
    </script>
    @include('partials.user_footer')
</body>

</html>
