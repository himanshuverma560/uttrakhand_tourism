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
                                                        <input type="date" name="start_date" id="tourStartDate" class="form-control"
                                                            placeholder="Please Select Tour Date" required
                                                            min="{{ date('Y-m-d') }}"
                                                            onchange="updateEndDateMin(); checkFormFields();">
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">Tour End Date<span
                                                                class="text-danger">*</span></label>
                                                        <input type="date" name="end_date" id="tourEndDate" class="form-control"
                                                            placeholder="Please Select Tour Date" required
                                                            min="{{ date('Y-m-d') }}"
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
                                                        <button type="button" class="btn btn-primary" id="checkAvailability" style="display: none;">
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
                                                    <div class="col-md-6 mb-3">
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
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Type of Transportation<span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-select" id="transportationType"
                                                            name="type_of_transport" disabled>
                                                            <option value="">Select</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3 vehicle-details" style="display: none;">
                                                        <label class="form-label">Driver's Name<span class="text-danger vehicle-required" style="display: none;">*</span></label>
                                                        <input type="text" class="form-control" name="driver_name" id="driverName" placeholder="Enter Driver's Name">
                                                    </div>
                                                    <div class="col-md-6 mb-3 vehicle-details" style="display: none;">
                                                        <label class="form-label">Vehicle Number<span class="text-danger vehicle-required" style="display: none;">*</span></label>
                                                        <input type="text" class="form-control" name="vehicle_number" id="vehicleNumber" placeholder="Enter Vehicle Number">
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
    <div class="modal fade" id="availabilityModal" tabindex="-1" aria-labelledby="availabilityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="availabilityModalLabel">Available Slots</h5>
                    <div class="d-flex align-items-center">
                        <!-- <h4 class="mb-0 me-3">May 2025</h4> -->
                        <!-- <div>
                            <button class="btn btn-sm btn-outline-secondary me-2" id="prevMonth"><i class="fas fa-chevron-left"></i></button>
                            <button class="btn btn-sm btn-outline-secondary" id="nextMonth"><i class="fas fa-chevron-right"></i></button>
                        </div> -->
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                        break;

                    case 'By Walking':
                        transportationSelect.add(new Option('By Walking', 'By Walking'));
                        transportationSelect.value = 'By Walking';
                        break;

                    default:
                        transportationSelect.disabled = true;
                }
            });

            // Add event listener for transportation type
            transportationSelect.addEventListener('change', function() {
                const requireFields = ['Private Car', 'Two-wheeler'].includes(this.value);
                driverName.required = requireFields;
                vehicleNumber.required = requireFields;
                vehicleRequired.forEach(req => {
                    req.style.display = requireFields ? 'inline' : 'none';
                });
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
                const driverName = document.getElementById('driverName').value;
                const vehicleNumber = document.getElementById('vehicleNumber').value;
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

                if (travelMode === 'By Road' && (!driverName || !vehicleNumber)) {
                    errorMessage += 'Please provide driver\'s name and vehicle number\n';
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

                if (startDate && endDate && touristCount) {
                    checkAvailabilityButton.style.display = 'inline-block';
                } else {
                    checkAvailabilityButton.style.display = 'none';
                }
            }
        }

        // Availability Calendar functionality
        document.getElementById('checkAvailability').addEventListener('click', function() {
            const availabilityGrid = document.getElementById('availabilityGrid');
            availabilityGrid.innerHTML = ''; // Clear existing content
            
            // Get current date
            const today = new Date();
            
            // Generate next 15 days availability boxes
            for (let i = 0; i < 15; i++) {
                const date = new Date(today);
                date.setDate(date.getDate() + i);
                
                const box = document.createElement('div');
                box.className = 'col-lg-3 mb-3';
                
                // Format date as DD-MM-YYYY
                const formattedDate = date.toLocaleDateString('en-GB', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                });
                
                box.innerHTML = `
                    <div class="date-card">
                        <div class="date-header">
                            Date: ${formattedDate}
                        </div>
                        <div class="date-body">
                            <div class="d-flex flex-wrap align-items-center mb-2">
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
            }
            
            // Show the modal
            const modal = new bootstrap.Modal(document.getElementById('availabilityModal'));
            modal.show();
        });
    </script>

    <style>
        .slot-grid {
            display: grid;
            gap: 0.5rem;
        }
        
        .slot-item {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 0.25rem;
            padding: 0.25rem;
            font-size: 0.9rem;
        }
        
        .slot-item > * {
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            text-align: center;
        }
        
        .slot-item .dham-name {
            background-color: #9ed7ab;
            color: #fff;
            font-weight: 500;
        }
        
        #availabilityModal .modal-dialog {
            max-width: 90%;
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
            padding: 0.5rem;
            border-bottom: 1px solid #dee2e6;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .date-body {
            padding: 0.5rem;
        }
    </style>

    @include('partials.user_footer')
</body>

</html>
