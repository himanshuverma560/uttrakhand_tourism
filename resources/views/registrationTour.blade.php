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
                                <div
                                    class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Plan Your Tour </h5>
                                    <div class="language-select">
                                        <select class="form-select form-select-sm">
                                            <option selected>English</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form id="tourRegistrationForm" action="{{ route('store.tour') }}" method="post">
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
                                                        <label class="form-label">Tour Start Date<span
                                                                class="text-danger">*</span></label>
                                                        <input type="date" name="start_date" id="tourStartDate"
                                                            class="form-control" placeholder="Please Select Tour Date"
                                                            required min="{{ date('Y-m-d') }}"
                                                            onchange="updateEndDateMin(); checkFormFields();">
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">Tour End Date<span
                                                                class="text-danger">*</span></label>
                                                        <input type="date" name="end_date" id="tourEndDate"
                                                            class="form-control" placeholder="Please Select Tour Date"
                                                            required min="{{ date('Y-m-d') }}"
                                                            onchange="checkFormFields();">
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">No. of Tourists ( Max 6)<span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" class="form-control" id="touristCount"
                                                            name="number_of_tourist" placeholder="No. of Tourists"
                                                            min="1" max="6" onchange="checkFormFields();">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-12">
                                                        <button type="button" class="btn btn-primary"
                                                            id="checkAvailability" style="display: none;">
                                                            <i class="fas fa-calendar-check"></i> Check Availability
                                                        </button>
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
                                                    <div class="col-md-5 mb-3">
                                                        <label class="form-label">Mode of Travel for Dham<span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-select" id="travelMode"
                                                            name="mode_of_travel">
                                                            <option value="">Select</option>
                                                            <option value="By Road">By Road</option>
                                                            <option value="By Helicopter">By Helicopter</option>
                                                            <option value="By Walking">By Walking</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-5 mb-3">
                                                        <label class="form-label">Type of Transportation<span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-select" id="transportationType"
                                                            name="type_of_transport" disabled>
                                                            <option value="">Select</option>
                                                        </select>
                                                    </div>
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
                                                <div class="table-responsive mt-3" style="display: none;">
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
                                                        <tbody></tbody>
                                                    </table>
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
                                                    <div class="destination-row row mb-3">
                                                        <div class="col-md-5">
                                                            <select class="form-select" name="dham[]">
                                                                <option value="">Plan your destination</option>
                                                                <option value="Yamunotri">Yamunotri</option>
                                                                <option value="Gangotri">Gangotri</option>
                                                                <option value="Kedarnath">Kedarnath</option>
                                                                <option value="Badrinath">Badrinath</option>
                                                                <option value="Hemkund Sahib">Hemkund Sahib</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="date" class="form-control dham-date"
                                                                name="dhamDate[]">
                                                        </div>
                                                        <div class="col-md-2 d-flex">
                                                            <button type="button"
                                                                class="btn btn-danger remove-destination">
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

    <!-- Availability Modal -->
    <div class="modal fade availabilityModal" id="availabilityModal" tabindex="-1" aria-labelledby="availabilityModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="availabilityModalLabel">Available Slots</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h4 class="mb-0 me-3" id="currentMonthDisplay"></h4>
                        <div>
                            <button class="btn btn-sm btn-outline-secondary me-2" id="prevMonth"><i
                                    class="fas fa-chevron-left"></i></button>
                            <button class="btn btn-sm btn-outline-secondary" id="nextMonth"><i
                                    class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                    <div id="availabilityGrid" class="row g-3">
                        <!-- Calendar boxes will be added here dynamically -->
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
                <input type="date" class="form-control dham-date" name="dhamDate[]" required>
            </div>
            <div class="col-md-2 d-flex">
                <button type="button" class="btn btn-danger remove-destination">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
                destinationContainer.appendChild(newRow);

                // Set min/max dates for the new dham date input
                const dhamDateInput = newRow.querySelector('.dham-date');
                const tourStartDate = document.getElementById('tourStartDate').value;
                const tourEndDate = document.getElementById('tourEndDate').value;
                if (tourStartDate) dhamDateInput.min = tourStartDate;
                if (tourEndDate) dhamDateInput.max = tourEndDate;

                const removeBtn = newRow.querySelector('.remove-destination');
                removeBtn.addEventListener('click', function() {
                    newRow.remove();
                });
            });

            // Function to update all dham date constraints
            function updateDhamDateConstraints() {
                const startDate = document.getElementById('tourStartDate').value;
                const endDate = document.getElementById('tourEndDate').value;
                document.querySelectorAll('.dham-date').forEach(input => {
                    if (startDate) input.min = startDate;
                    if (endDate) input.max = endDate;
                    // If current value is outside new constraints, clear it
                    if ((startDate && input.value < startDate) || (endDate && input.value > endDate)) {
                        input.value = '';
                    }
                });
            }

            // Add event listeners for tour date changes
            document.getElementById('tourStartDate').addEventListener('change', function() {
                updateEndDateMin();
                updateDhamDateConstraints();
            });

            document.getElementById('tourEndDate').addEventListener('change', updateDhamDateConstraints);

            // Add remove functionality to initial destination row
            document.querySelectorAll('.remove-destination').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (destinationContainer.children.length > 1) {
                        this.closest('.destination-row').remove();
                    }
                });
            });

            // Update initial destination row class
            document.querySelector('input[name="dhamDate[]"]').classList.add('dham-date');

            // Form validation
            tourForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Basic validation
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

                if (travelMode === 'By Road' && vehicles.length === 0) {
                    errorMessage += 'Please add at least one vehicle\n';
                    isValid = false;
                }

                // Add vehicles data to form before submit
                if (vehicles.length > 0) {
                    const vehiclesInput = document.createElement('input');
                    vehiclesInput.type = 'hidden';
                    vehiclesInput.name = 'vehicles';
                    vehiclesInput.value = JSON.stringify(vehicles);
                    this.appendChild(vehiclesInput);
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

            // Update minimum end date based on start date
            function updateEndDateMin() {
                const startDate = document.getElementById('tourStartDate').value;
                const endDateInput = document.getElementById('tourEndDate');
                if (startDate) {
                    endDateInput.min = startDate;
                    // If current end date is before new min date, clear it
                    if (endDateInput.value && endDateInput.value < startDate) {
                        endDateInput.value = '';
                    }
                }
            }

            // Initialize date constraints on page load
            updateEndDateMin();
            updateDhamDateConstraints();

            // Check form fields to toggle availability button visibility
            function checkFormFields() {
                const startDate = document.getElementById('tourStartDate').value;
                const endDate = document.getElementById('tourEndDate').value;
                const touristCount = document.getElementById('touristCount').value;
                const checkAvailabilityButton = document.getElementById('checkAvailability');
                checkAvailabilityButton.style.display = 'block';
                // if (startDate && endDate && touristCount) {
                //     checkAvailabilityButton.style.display = 'inline-block';
                // } else {
                //     checkAvailabilityButton.style.display = 'none';
                // }
            }
        }

        // Availability Calendar functionality
        let currentYear = new Date().getFullYear();
        let currentMonth = new Date().getMonth();
        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September",
            "October", "November", "December"
        ];

        function generateMonthCard(date, month, year) {

            const box = document.createElement('div');
            box.className = 'col-lg-2 col-md-6 mb-3';

            // Check if date is before today
            const currentDate = new Date();
            const cardDate = new Date(year, month, date);
            const isPastDate = cardDate < new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate());
            const bgColor = isPastDate ? '#ff6b6b' : '#9ed7ab';

            box.innerHTML = `
                    <div class="date-card">
                        <div class="date-header">
                            Date :- ${date>9?date:`0${date}`}-${month+1>9?month+1:`0${month+1}`}-${year}
                        </div>
                        <div class="date-body">
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="slot-item">
                                    <div class="dham-name" style="background-color: ${bgColor};">Yamunotri</div>
                                </div>
                                <div class="slot-item">
                                    <div class="dham-name" style="background-color: ${bgColor};">Gangotri</div>
                                </div>
                                <div class="slot-item">
                                    <div class="dham-name" style="background-color: ${bgColor};">Kedarnath</div>
                                </div>
                                <div class="slot-item">
                                    <div class="dham-name" style="background-color: ${bgColor};">Badrinath</div>
                                </div>
                                <div class="slot-item">
                                    <div class="dham-name" style="background-color: ${bgColor};">Hemkund Sahib</div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            return box;
        }

        function updateCalendarDisplay() {
            const availabilityGrid = document.getElementById('availabilityGrid');
            const currentMonthDisplay = document.getElementById('currentMonthDisplay');

            availabilityGrid.innerHTML = '';
            currentMonthDisplay.textContent = monthNames[currentMonth];
            let lastDate = new Date(currentYear, currentMonth + 1, 0).getDate();
            const isAvailableMonth = currentMonth >= 4 && currentMonth <= 9; // May (4) to October (9)
            if (isAvailableMonth) {
                // Generate all 12 months
                for (let date = 1; date <= lastDate; date++) {
                    availabilityGrid.appendChild(generateMonthCard(date, currentMonth, currentYear));
                }
            } else {
                availabilityGrid.innerHTML = `
                    <div class="date-card h-100">
                        <div class="date-body no-data">
                            <div class="text-center py-4">
                                <p class="text-muted mb-0">No tours available in this month</p>
                                <small class="text-muted">(Tours only available from May to October)</small>
                            </div>
                        </div>
                    </div>
                `;
            }
        }

        // Event listener for the check availability button
        document.getElementById('checkAvailability').addEventListener('click', function() {
            updateCalendarDisplay();
            const modal = new bootstrap.Modal(document.getElementById('availabilityModal'));
            modal.show();
        });

        // Event listeners for year navigation
        document.getElementById('prevMonth').addEventListener('click', function() {
            currentMonth--;
            updateCalendarDisplay();
        });

        document.getElementById('nextMonth').addEventListener('click', function() {
            currentMonth++;
            updateCalendarDisplay();
        });

        box.innerHTML = `
                    <div class="date-card">
                        <div class="date-header">
                            Date: ${formattedDate}
                        </div>
                        <div class="date-body">
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="slot-item">
                                    <div class="dham-name">Yamunotri</div>
                                </div>
                                <div class="slot-item">
                                    <div class="dham-name">Gangotri</div>
                                </div>
                                <div class="slot-item">
                                    <div class="dham-name">Kedarnath</div>
                                </div>
                                <div class="slot-item">
                                    <div class="dham-name">Badrinath</div>
                                </div>
                                <div class="slot-item">
                                    <div class="dham-name">Hemkund Sahib</div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

        availabilityGrid.appendChild(box);


        // Show the modal
        const modal = new bootstrap.Modal(document.getElementById('availabilityModal'));
        modal.show();
    </script>

    <style>
        /* Vehicle table styles */
        #vehicleTable {
            margin-bottom: 1.5rem;
        }

        #vehicleTable th {
            background-color: #f8f9fa;
            font-weight: 500;
            padding: 8px;
        }

        #vehicleTable td {
            padding: 8px;
            vertical-align: middle;
        }

        #vehicleTable .btn-sm {
            padding: 0.25rem 0.5rem;
            margin: 0 2px;
        }

        /* Mode of travel section styles */
        .vehicle-details .form-control,
        .vehicle-details .form-select {
            height: calc(2.5rem + 2px);
        }

        #availabilityModalLabel {
            margin-left: 50%;
            transform: translateX(-50%);
        }

        .modal-dialog {
            width: 75%;
            min-height: 5%;
            overflow-y: scroll;
            margin: auto;
            margin-top: 4%;
        }

        .slot-grid {
            display: grid;
            /* gap: 0.5rem; */
        }

        .date-body {
            width: 100%;
        }

        .date-body>div {
            width: 100%;
        }

        .slot-item {
            width: 50%;
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 0.25rem;
            /* padding: 0.25rem; */
            font-size: 0.9rem;
            border-bottom: 1px solid #fff;
        }

        .slot-item:nth-of-type(2n+1) {
            border-right: 1px solid #fff;
        }

        .slot-item:last-child {
            width: 100%;
            border-bottom: none;
        }

        .slot-item>* {
            padding: 2px 5px;
            text-align: center;
        }

        .slot-item .dham-name {
            background-color: #9ed7ab;
            color: #fff;
            font-weight: 500;
        }

        #availabilityModal .modal-dialog {
            max-width: 80%;
        }

        .badge {
            font-weight: normal;
            font-size: 0.9rem;
        }

        .date-card {
            border: 1px solid #dee2e6;
            border-radius: 4px;
            overflow: hidden;
        }

        .date-header {
            background-color: #f8f9fa;
            padding: 2px 5px;
            border-bottom: 1px solid #dee2e6;
            font-size: 12px;
        }

        #availabilityGrid>div {
            margin: 6px 0px !important;
        }
    </style>

    @include('partials.user_footer')
</body>
@if (request('success') && request('tour_id'))
        <script>
            window.onload = function() {
                alert("{{ addslashes(request('success')) }}");
                window.location.href = "{{ route('addPligrim', ['id' => request('tour_id')]) }}";
            };
        </script>
    @endif
</html>
