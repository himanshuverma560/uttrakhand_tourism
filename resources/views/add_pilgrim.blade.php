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
                        <!-- Add Pilgrim -->
                        <div class="pilgrim-registration-section">
                            <div class="card">
                                <div class="card-header text-white d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Pilgrim's Registration Details</h5>
                                </div>
                                <div class="card-body">
                                    <form id="pilgrimForm" method="post"
                                        action="{{ route('createPligrim', ['id' => $id]) }}">
                                        @csrf
                                        <!-- Aadhaar Verification Section -->
                                        <div class="aadhaar-section">
                                            <h5 class="mb-3">Fill Person Information With Aadhaar Details</h5>
                                            <p class="text-muted small">(If You Do Not Have An Aadhaar Card, Visit
                                                Registration Centre At Haridwar Or Rishikesh Or Vikash Nagar.)</p>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Aadhaar Card Number : <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="aadhaarNumber" class="form-control"
                                                    placeholder="••••••••••••">
                                                <input type="hidden" id="request_id" name="request_id">
                                                <input type="hidden" id="tour_id" name="tour_id"
                                                    value="{{ $id }}">
                                            </div>

                                            <div class="form-check mb-3">
                                                <input type="checkbox" class="form-check-input" id="consentCheckbox">
                                                <label class="form-check-label small" for="consentCheckbox">
                                                    Consent : I voluntarily hereby agree to provide my Aadhaar/VID
                                                    number for authentication and eKYC on the Uttarakhand Chardham
                                                    Registration Portal/Mobile App for Yatra registration only. I
                                                    understand that my information will be used solely for identity
                                                    verification while ensuring security and confidentiality.
                                                </label>
                                            </div>

                                            <div class="d-grid gap-2">
                                                <button class="btn btn-primary" type="button" id="requestOtpBtn"
                                                    onclick="requestOTP()">Request OTP</button>
                                            </div>

                                            <div id="otpSection" class="mt-3" style="display: none;">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Enter OTP</label>
                                                    <input type="text" id="otpInput" class="form-control"
                                                        placeholder="Enter OTP">
                                                </div>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-primary" type="button"
                                                        onclick="verifyOTP()">Verify OTP</button>
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        onclick="resendOTP()">Resend OTP</button>
                                                    <span class="align-self-center ms-2" id="otpTimer"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Pilgrim's Personal Details -->
                                        <div class="section mb-4">
                                            <div class="section-header d-flex justify-content-between align-items-center bg-light p-3"
                                                id="section-header">
                                                <h6 class="mb-0">Pilgrim's Personal Details</h6>
                                                <i class="fas fa-chevron-up"></i>
                                            </div>
                                            <div class="section-content" id="section-content">
                                                <div class="alert alert-danger">
                                                    Note : This name will be used in "Yatri Darshan Certificate", so can
                                                    not be changed once you submit the registration!
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Full Name <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="name"
                                                            id="name" readonly placeholder="Enter Full Name"
                                                            required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Age <span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" name="age" id="age"
                                                            class="form-control" placeholder="Enter Age" required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Gender <span
                                                                class="text-danger">*</span></label>
                                                        <div class="mt-2">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="gender" id="male" value="male"
                                                                    checked>
                                                                <label class="form-check-label"
                                                                    for="male">Male</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="gender" id="female" value="female">
                                                                <label class="form-check-label"
                                                                    for="female">Female</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="gender" id="other" value="other">
                                                                <label class="form-check-label"
                                                                    for="other">Other</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Aadhaar Card Number</label>
                                                        <input type="text" class="form-control" readonly
                                                            name="aadhar_card" id="aadhaarCardNumber"
                                                            placeholder="Enter Aadhaar Card Number" maxlength="12">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" class="form-control" name="email"
                                                            value="{{ Auth::user()->email }}"
                                                            placeholder="Enter Email Address">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Mobile Number of Tourist (To be
                                                            carried during yatra) <span
                                                                class="text-danger">*</span></label>
                                                        <input type="tel" class="form-control" name="mobile"
                                                            value="{{ Auth::user()->mobile }}"
                                                            placeholder="Enter Mobile Number" required>
                                                    </div>
                                                    <div class="col-md-6 d-flex align-items-end">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="isWhatsapp">
                                                            <label class="form-check-label" for="isWhatsapp">
                                                                Is this WhatsApp number too?<br>
                                                                (Registration details will be shared on this number.
                                                                Please re-check)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Address <span
                                                            class="text-danger">*</span></label>
                                                    <textarea class="form-control" readonly name="address" id="address" rows="3"
                                                        placeholder="Enter Full Address" required></textarea>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <label class="form-label">City <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="city" readonly name="city"
                                                            class="form-control" placeholder="Enter City" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">District Name <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="district" readonly name="district"
                                                            class="form-control" placeholder="Enter District"
                                                            required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">State <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="state" readonly name="state"
                                                            class="form-control" placeholder="Enter State" required>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Country <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-select" readonly name="country" required>

                                                            <option value="India">India</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Emergency Contact Details -->
                                        <div class="section mb-4">
                                            <div class="section-header d-flex justify-content-between align-items-center bg-light p-3"
                                                id="section-header">
                                                <h6 class="mb-0">Emergency Contact Details: (Who is not travelling
                                                    with you) <span class="text-danger">*</span></h6>
                                                <i class="fas fa-chevron-up"></i>
                                            </div>
                                            <div class="section-content" id="section-content">
                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Contact Person Name <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            name="contact_person" placeholder="Contact Person Name"
                                                            required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Emergency Contact Number <span
                                                                class="text-danger">*</span></label>
                                                        <input type="tel" class="form-control"
                                                            placeholder="Emergency Contact No" name="contact_number"
                                                            required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Contact Person Relation <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-select" required name="contact_relation">
                                                            <option value="">Select</option>
                                                            <option value="Father">Father</option>
                                                            <option value="Mother">Mother</option>
                                                            <option value="Brother">Brother</option>
                                                            <option value="Sister">Sister</option>
                                                            <option value="Spouse">Spouse</option>
                                                            <option value="Son">Son</option>
                                                            <option value="Daughter">Daughter</option>
                                                            <option value="Friend">Friend</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Medical Condition -->
                                        <div class="section mb-4">
                                            <div class="section-header d-flex justify-content-between align-items-center bg-light p-3"
                                                id="section-header">
                                                <h6 class="mb-0">Medical Condition <span
                                                        class="text-danger">*</span></h6>
                                                <i class="fas fa-chevron-up"></i>
                                            </div>
                                            <div class="section-content" id="section-content">
                                                <div class="mb-3">
                                                    <label class="form-label">Select Medical Condition (If Any) <span
                                                            class="text-danger">*</span></label>
                                                    <div class="medical-conditions">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="cardiac" name="medical[]"
                                                                value="Cardiac/Heart Related Problem">
                                                            <label class="form-check-label"
                                                                for="cardiac">Cardiac/Heart Related Problem</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="asthma" name="medical[]"
                                                                value="Asthma/Breathing Problem">
                                                            <label class="form-check-label"
                                                                for="asthma">Asthma/Breathing Problem</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="diabetes" name="medical[]" value="Diabetes">
                                                            <label class="form-check-label"
                                                                for="diabetes">Diabetes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="other" name="medical[]" value="Other">
                                                            <label class="form-check-label"
                                                                for="other">Other</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="na" name="medical[]" value="NA"
                                                                checked>
                                                            <label class="form-check-label" for="na">NA</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Select if you are from below
                                                        profession</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="doctor" name="doctor">
                                                        <label class="form-check-label" for="doctor">I am a
                                                            Doctor</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pilgrim Vehicle Details -->
                                        <div class="section mb-4">
                                            <div class="section-header d-flex justify-content-between align-items-center bg-light p-3"
                                                id="section-header">
                                                <h6 class="mb-0">Pilgrim Vehicle Details <span
                                                        class="text-danger">*</span></h6>
                                                <i class="fas fa-chevron-up"></i>
                                            </div>
                                            <div class="section-content" id="section-content">
                                                <div class="mb-3">
                                                    <label class="form-label">Select vehicle details for this pilgrim
                                                        <span class="text-danger">*</span></label>
                                                    <select class="form-select" required name="vehicle_details">
                                                        <option value="">Select vehicle</option>
                                                        <option value="taxi1">Taxi/Maxi - 1 (1/8)</option>
                                                        <option value="taxi2">Taxi/Maxi - 2 (2/8)</option>
                                                        <option value="taxi3">Taxi/Maxi - 3 (3/8)</option>
                                                        <option value="taxi4">Taxi/Maxi - 4 (4/8)</option>
                                                        <option value="taxi5">Taxi/Maxi - 5 (5/8)</option>
                                                        <option value="taxi6">Taxi/Maxi - 6 (6/8)</option>
                                                        <option value="taxi7">Taxi/Maxi - 7 (7/8)</option>
                                                        <option value="taxi8">Taxi/Maxi - 8 (8/8)</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Upload Pilgrim's Details -->
                                        <div class="section mb-4">
                                            <div class="section-header d-flex justify-content-between align-items-center bg-light p-3"
                                                id="section-header">
                                                <h6 class="mb-0">Pilgrim's Photo Details <span
                                                        class="text-danger">*</span></h6>
                                                <i class="fas fa-chevron-up"></i>
                                            </div>
                                            <div class="section-content" id="section-content">
                                                <div class="mb-4">
                                                    <label class="form-label">Preview Passport Size Photo <span
                                                            class="text-danger">*</span></label>

                                                    <div class="passport-preview mt-3" id="passportPreview">
                                                        <!-- Preview will be shown here -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Save & Add Pilgrim</button>
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
        window.csrfToken = '{{ csrf_token() }}';
    </script>

    <script>
        const TIMER_DURATION = 60; // 60 seconds for OTP validity
        let timerInterval;

        function startOTPTimer() {
            let timeLeft = TIMER_DURATION;
            const timerElement = document.getElementById('otpTimer');

            clearInterval(timerInterval);

            timerInterval = setInterval(() => {
                timeLeft--;
                timerElement.textContent = `Resend OTP in ${timeLeft}s`;

                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    timerElement.textContent = '';
                    document.getElementById('requestOtpBtn').disabled = false;
                }
            }, 1000);
        }

        function resendOTP() {
            requestOTP();
        }


        // OTP related functionality

        function requestOTP() {
            const aadhaarNumber = document.getElementById('aadhaarNumber').value;
            const consentCheckbox = document.getElementById('consentCheckbox');

            if (!aadhaarNumber || aadhaarNumber.length !== 12) {
                alert('Please enter a valid 12-digit Aadhaar number');
                return;
            }

            if (!consentCheckbox.checked) {
                alert('Please provide your consent to proceed');
                return;
            }



            // Start OTP timer
            startOTPTimer();

            $.ajax({
                url: '/user/aadhaar/generate-otp',
                method: 'POST',
                data: {
                    id_number: aadhaarNumber,
                    _token: window.csrfToken
                },
                success: function(response) {
                    console.log('OTP response:', response);
                    if (response.request_id && response.status == 'success') {
                        document.getElementById('request_id').value = response.request_id;
                        // Show OTP section
                        document.getElementById('otpSection').style.display = 'block';
                        document.getElementById('requestOtpBtn').disabled = true;
                        alert('OTP has been sent to your registered mobile number');
                    } else {
                        alert(response.message);
                        document.getElementById('requestOtpBtn').disabled = false;
                    }
                },
                error: function(xhr) {
                    alert('Error sending OTP');
                    console.error(xhr);
                    document.getElementById('requestOtpBtn').disabled = false;
                }
            });
        }


        function verifyOTP() {
            const otp = document.getElementById('otpInput').value;
            const requestId = document.getElementById('request_id').value;
            const tour_id = document.getElementById('tour_id').value;
            if (!otp || otp.length !== 6) {
                alert('Please enter a valid 6-digit OTP');
                return;
            }


            $.ajax({
                url: '/user/aadhaar/verify-otp',
                type: 'POST',
                data: {
                    request_id: requestId,
                    otp: otp,
                    _token: window.csrfToken,
                    tour_id: tour_id
                },
                success: function(res) {

                    if (res.status == 'error') {
                        alert(res.message);
                        return false;
                    }

                    document.getElementById('aadhaarCardNumber').value = res.data.aadhaar_number;
                    document.getElementById('name').value = res.data.name;
                    document.getElementById('age').value = res.data.age;
                    $('input[name="gender"][value="' + res.data.gender + '"]').prop('checked', true);
                    document.getElementById('address').value = res.data.formatted_address;
                    document.getElementById('city').value = res.data.street;
                    document.getElementById('district').value = res.data.district;
                    document.getElementById('state').value = res.data.state;

                    // Automatically preview the Aadhaar card image
                    var imageUrl = res.data.profile_image_url; // The image URL returned from the server
                    if (imageUrl) {
                        $('#passportPreview').html(
                            '<img src="' + imageUrl + '" alt="Aadhaar Card Preview" class="img-fluid">'
                            );
                    } else {
                        $('#passportPreview').html('<p>No image available.</p>');
                    }

                    console.log(res);

                    alert('OTP verified and form filled successfully!');
                },
                error: function(err) {
                    alert('OTP verification failed.');
                    console.error(err);
                }
            });
            collapsAll('block');
            clearInterval(timerInterval);
        }

        // collaps all section default
        function collapsAll(value) {
            const sections = document.querySelectorAll('.section');

            sections.forEach((section, index) => {
                const header = section.querySelector('#section-header');
                const content = section.querySelector('#section-content');
                const icon = header.querySelector('i');

                content.style.display = value;
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
                if (value == 'none') {
                    header.style.pointerEvents = 'none';
                    header.style.opacity = '0.5';
                    header.style.cursor = 'not-allowed';
                }

            });
        }
        collapsAll('none');
        @include('partials.user_footer')

            <
            /body> <
            /html>
