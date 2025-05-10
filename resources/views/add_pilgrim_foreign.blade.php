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
                                    <form id="pilgrimForm">

                                        <!-- Aadhaar Verification Section -->
                                        <div class="aadhaar-section">
                                            <h5 class="mb-3">Fill Person Information With Aadhaar Details</h5>
                                            <p class="text-muted small">(If You Do Not Have An Aadhaar Card, Visit Registration Centre At Haridwar Or Rishikesh Or Vikash Nagar.)</p>
                                            
                                            <div class="form-group mb-3">
                                                <label class="form-label">Aadhaar Card Number : <span class="text-danger">*</span></label>
                                                <input type="text" id="aadhaarNumber" class="form-control" placeholder="••••••••••••">
                                                <input type="hidden" id="request_id" name="request_id">
                                            </div>

                                            <div class="form-check mb-3">
                                                <input type="checkbox" class="form-check-input" id="consentCheckbox">
                                                <label class="form-check-label small" for="consentCheckbox">
                                                    Consent : I voluntarily hereby agree to provide my Aadhaar/VID number for authentication and eKYC on the Uttarakhand Chardham Registration Portal/Mobile App for Yatra registration only. I understand that my information will be used solely for identity verification while ensuring security and confidentiality.
                                                </label>
                                            </div>

                                            <div class="d-grid gap-2">
                                                <button class="btn btn-primary" type="button" id="requestOtpBtn" onclick="requestOTP()">Request OTP</button>
                                            </div>

                                            <div id="otpSection" class="mt-3" style="display: none;">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Enter OTP</label>
                                                    <input type="text" id="otpInput" class="form-control" placeholder="Enter OTP">
                                                </div>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-primary" type="button" onclick="verifyOTP()">Verify OTP</button>
                                                    <button class="btn btn-outline-secondary" type="button" onclick="resendOTP()">Resend OTP</button>
                                                    <span class="align-self-center ms-2" id="otpTimer"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Pilgrim's Personal Details -->
                                        <div class="section mb-4">
                                            <div class="section-header d-flex justify-content-between align-items-center bg-light p-3">
                                                <h6 class="mb-0">Pilgrim's Personal Details</h6>
                                                <i class="fas fa-chevron-up"></i>
                                            </div>
                                            <div class="section-content">
                                                <div class="alert alert-danger">
                                                    Note : This name will be used in "Yatri Darshan Certificate", so can not be changed once you submit the registration!
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" placeholder="Enter Full Name" required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Age <span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control" placeholder="Enter Age" required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Gender <span class="text-danger">*</span></label>
                                                        <div class="mt-2">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="gender" id="male" value="male" checked>
                                                                <label class="form-check-label" for="male">Male</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                                                                <label class="form-check-label" for="female">Female</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="gender" id="other" value="other">
                                                                <label class="form-check-label" for="other">Other</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Aadhaar Card Number</label>
                                                        <input type="text" class="form-control" placeholder="Enter Aadhaar Card Number" maxlength="12">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" class="form-control" placeholder="Enter Email Address">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Mobile Number of Tourist (To be carried during yatra) <span class="text-danger">*</span></label>
                                                        <input type="tel" class="form-control" placeholder="Enter Mobile Number" required>
                                                    </div>
                                                    <div class="col-md-6 d-flex align-items-end">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="isWhatsapp">
                                                            <label class="form-check-label" for="isWhatsapp">
                                                                Is this WhatsApp number too?<br>
                                                                (Registration details will be shared on this number. Please re-check)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Address <span class="text-danger">*</span></label>
                                                    <textarea class="form-control" rows="3" placeholder="Enter Full Address" required></textarea>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <label class="form-label">City <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" placeholder="Enter City" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">District Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" placeholder="Enter District" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">State <span class="text-danger">*</span></label>
                                                        <select class="form-select" required>
                                                            <option value="">Select State</option>
                                                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                            <option value="Assam">Assam</option>
                                                            <option value="Bihar">Bihar</option>
                                                            <option value="Chhattisgarh">Chhattisgarh</option>
                                                            <option value="Goa">Goa</option>
                                                            <option value="Gujarat">Gujarat</option>
                                                            <option value="Haryana">Haryana</option>
                                                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                            <option value="Jharkhand">Jharkhand</option>
                                                            <option value="Karnataka">Karnataka</option>
                                                            <option value="Kerala">Kerala</option>
                                                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                            <option value="Maharashtra">Maharashtra</option>
                                                            <option value="Manipur">Manipur</option>
                                                            <option value="Meghalaya">Meghalaya</option>
                                                            <option value="Mizoram">Mizoram</option>
                                                            <option value="Nagaland">Nagaland</option>
                                                            <option value="Odisha">Odisha</option>
                                                            <option value="Punjab">Punjab</option>
                                                            <option value="Rajasthan">Rajasthan</option>
                                                            <option value="Sikkim">Sikkim</option>
                                                            <option value="Tamil Nadu">Tamil Nadu</option>
                                                            <option value="Telangana">Telangana</option>
                                                            <option value="Tripura">Tripura</option>
                                                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                            <option value="Uttarakhand">Uttarakhand</option>
                                                            <option value="West Bengal">West Bengal</option>
                                                            <!-- Union Territories -->
                                                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                                            <option value="Chandigarh">Chandigarh</option>
                                                            <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
                                                            <option value="Delhi">Delhi</option>
                                                            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                                            <option value="Ladakh">Ladakh</option>
                                                            <option value="Lakshadweep">Lakshadweep</option>
                                                            <option value="Puducherry">Puducherry</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Country <span class="text-danger">*</span></label>
                                                        <select class="form-select" required>
                                                            <!-- <option value="">Select Country</option> -->
                                                            <option value="India">India</option>
                                                            <!-- Add other countries as needed -->
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Emergency Contact Details -->
                                        <div class="section mb-4">
                                            <div class="section-header d-flex justify-content-between align-items-center bg-light p-3">
                                                <h6 class="mb-0">Emergency Contact Details: (Who is not travelling with you) <span class="text-danger">*</span></h6>
                                                <i class="fas fa-chevron-up"></i>
                                            </div>
                                            <div class="section-content">
                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Contact Person Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" placeholder="Contact Person Name" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Emergency Contact Number <span class="text-danger">*</span></label>
                                                        <input type="tel" class="form-control" placeholder="Emergency Contact No" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Contact Person Relation <span class="text-danger">*</span></label>
                                                        <select class="form-select" required>
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
                                            <div class="section-header d-flex justify-content-between align-items-center bg-light p-3">
                                                <h6 class="mb-0">Medical Condition <span class="text-danger">*</span></h6>
                                                <i class="fas fa-chevron-up"></i>
                                            </div>
                                            <div class="section-content">
                                                <div class="mb-3">
                                                    <label class="form-label">Select Medical Condition (If Any) <span class="text-danger">*</span></label>
                                                    <div class="medical-conditions">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="cardiac" value="Cardiac/Heart Related Problem">
                                                            <label class="form-check-label" for="cardiac">Cardiac/Heart Related Problem</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="asthma" value="Asthma/Breathing Problem">
                                                            <label class="form-check-label" for="asthma">Asthma/Breathing Problem</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="diabetes" value="Diabetes">
                                                            <label class="form-check-label" for="diabetes">Diabetes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="other" value="Other">
                                                            <label class="form-check-label" for="other">Other</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="na" value="NA" checked>
                                                            <label class="form-check-label" for="na">NA</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Select if you are from below profession</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="doctor">
                                                        <label class="form-check-label" for="doctor">I am a Doctor</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pilgrim Vehicle Details -->
                                        <div class="section mb-4">
                                            <div class="section-header d-flex justify-content-between align-items-center bg-light p-3">
                                                <h6 class="mb-0">Pilgrim Vehicle Details <span class="text-danger">*</span></h6>
                                                <i class="fas fa-chevron-up"></i>
                                            </div>
                                            <div class="section-content">
                                                <div class="mb-3">
                                                    <label class="form-label">Select vehicle details for this pilgrim <span class="text-danger">*</span></label>
                                                    <select class="form-select" required>
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
                                            <div class="section-header d-flex justify-content-between align-items-center bg-light p-3">
                                                <h6 class="mb-0">Upload Pilgrim's Details <span class="text-danger">*</span></h6>
                                                <i class="fas fa-chevron-up"></i>
                                            </div>
                                            <div class="section-content">
                                                <div class="mb-4">
                                                    <label class="form-label">Upload Passport Size Photo <span class="text-danger">*</span></label>
                                                    <div class="row align-items-center">
                                                        <div class="col-md-6">
                                                            <input type="file" class="form-control" id="passportPhoto" accept=".jpg,.jpeg,.png,.pdf" required>
                                                        </div>
                                                        <!-- <div class="col-md-6">
                                                            <button type="button" class="btn btn-secondary">Take Profile Picture</button>
                                                        </div> -->
                                                    </div>
                                                    <div class="passport-preview mt-3" id="passportPreview">
                                                        <!-- Preview will be shown here -->
                                                    </div>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="form-label">Upload Aadhaar Card <span class="text-danger">*</span></label>
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Front Side <span class="text-danger">*</span></label>
                                                            <input type="file" class="form-control" id="aadhaarFront" accept=".jpg,.jpeg,.png,.pdf" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Back Side <span class="text-danger">*</span></label>
                                                            <input type="file" class="form-control" id="aadhaarBack" accept=".jpg,.jpeg,.png,.pdf" required>
                                                        </div>
                                                        <!-- <div class="col-md-12">
                                                            <button type="button" class="btn btn-secondary">Take Identity Proof</button>
                                                        </div> -->
                                                    </div>
                                                    <div class="aadhaar-preview mt-3" id="aadhaarPreview">
                                                        <!-- Preview will be shown here -->
                                                    </div>
                                                </div>

                                                <div class="alert alert-danger">
                                                    Note: Only .jpg, .jpeg, .png, and pdf files are allowed to upload.
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

    @include('partials.user_footer')
    <script>
        window.csrfToken = '{{ csrf_token() }}';
    </script>
</body>
</html>