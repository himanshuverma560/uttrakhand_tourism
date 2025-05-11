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
                                        action="{{ route('updatePligrim', ['id' => $id]) }}">
                                        @csrf

                                        <!-- Pilgrim's Personal Details -->
                                        <div class="section mb-4">
                                            <div
                                                class="section-header d-flex justify-content-between align-items-center bg-light p-3">
                                                <h6 class="mb-0">Pilgrim's Personal Details</h6>
                                                <i class="fas fa-chevron-up"></i>
                                            </div>
                                            <div class="section-content">
                                                <div class="alert alert-danger">
                                                    Note : This name will be used in "Yatri Darshan Certificate", so can
                                                    not be changed once you submit the registration!
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Full Name <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="name"
                                                            id="name" value="{{ old('name', $pilgrim->name) }}"
                                                            disabled>

                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Age <span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" name="age" id="age"
                                                            value="{{ $pilgrim->age }}" class="form-control"
                                                            placeholder="Enter Age" required disabled>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Gender <span
                                                                class="text-danger">*</span></label>
                                                        <div class="mt-2">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="gender" id="male" value="male"
                                                                    {{ $pilgrim->gender == 'male' ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="male">Male</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="gender" id="female" value="female"
                                                                    {{ $pilgrim->gender == 'female' ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="female">Female</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="gender" id="other" value="other"
                                                                    {{ $pilgrim->gender == 'other' ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="other">Other</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Aadhaar Card Number</label>
                                                        <input type="text" value="{{ $pilgrim->aadhar_card }}"
                                                            class="form-control" disabled name="aadhar_card"
                                                            placeholder="Enter Aadhaar Card Number" maxlength="12">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" class="form-control" name="email"
                                                            value="{{ $pilgrim->email }}"
                                                            placeholder="Enter Email Address">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Mobile Number of Tourist (To be
                                                            carried during yatra) <span
                                                                class="text-danger">*</span></label>
                                                        <input type="tel" class="form-control" name="mobile"
                                                            value="{{ $pilgrim->mobile }}"
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
                                                    <textarea class="form-control" disabled name="address" disabled rows="3" placeholder="Enter Full Address"
                                                        required>{{ $pilgrim->address }}</textarea>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <label class="form-label">City <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="city"
                                                            value="{{ $pilgrim->city }}" disabled name="city"
                                                            class="form-control" placeholder="Enter City" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">District Name <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="district"
                                                            value="{{ $pilgrim->district }}" disabled name="district"
                                                            class="form-control" placeholder="Enter District"
                                                            required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">State <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="state" disabled
                                                            value="{{ $pilgrim->state }}" name="state"
                                                            class="form-control" placeholder="Enter State" required>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Country <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-select" disabled name="country" required>

                                                            <option value="India">India</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Emergency Contact Details -->
                                        <div class="section mb-4">
                                            <div
                                                class="section-header d-flex justify-content-between align-items-center bg-light p-3">
                                                <h6 class="mb-0">Emergency Contact Details: (Who is not travelling
                                                    with you) <span class="text-danger">*</span></h6>
                                                <i class="fas fa-chevron-up"></i>
                                            </div>
                                            <div class="section-content">
                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Contact Person Name <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $pilgrim->contact_person }}"
                                                            name="contact_person" placeholder="Contact Person Name"
                                                            required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Emergency Contact Number <span
                                                                class="text-danger">*</span></label>
                                                        <input type="tel" class="form-control"
                                                            value="{{ $pilgrim->contact_number }}"
                                                            placeholder="Emergency Contact No" name="contact_number"
                                                            required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Contact Person Relation <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-select" required name="contact_relation">
                                                            <option value="">Select</option>
                                                            <option value="Father"
                                                                {{ $pilgrim->contact_relation == 'Father' ? 'selected' : '' }}>
                                                                Father</option>
                                                            <option value="Mother"
                                                                {{ $pilgrim->contact_relation == 'Mother' ? 'selected' : '' }}>
                                                                Mother</option>
                                                            <option value="Brother"
                                                                {{ $pilgrim->contact_relation == 'Brother' ? 'selected' : '' }}>
                                                                Brother</option>
                                                            <option value="Sister"
                                                                {{ $pilgrim->contact_relation == 'Sister' ? 'selected' : '' }}>
                                                                Sister</option>
                                                            <option value="Spouse"
                                                                {{ $pilgrim->contact_relation == 'Spouse' ? 'selected' : '' }}>
                                                                Spouse</option>
                                                            <option value="Son"
                                                                {{ $pilgrim->contact_relation == 'Son' ? 'selected' : '' }}>
                                                                Son</option>
                                                            <option value="Daughter"
                                                                {{ $pilgrim->contact_relation == 'Daughter' ? 'selected' : '' }}>
                                                                Daughter</option>
                                                            <option value="Friend"
                                                                {{ $pilgrim->contact_relation == 'Friend' ? 'selected' : '' }}>
                                                                Friend</option>
                                                            <option value="Other"
                                                                {{ $pilgrim->contact_relation == 'Other' ? 'selected' : '' }}>
                                                                Other</option>
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Medical Condition -->
                                        <div class="section mb-4">
                                            <div
                                                class="section-header d-flex justify-content-between align-items-center bg-light p-3">
                                                <h6 class="mb-0">Medical Condition <span
                                                        class="text-danger">*</span></h6>
                                                <i class="fas fa-chevron-up"></i>
                                            </div>
                                            @php $medical = json_decode( $pilgrim->medical, true); @endphp
                                            <div class="section-content">
                                                <div class="mb-3">
                                                    <label class="form-label">Select Medical Condition (If Any) <span
                                                            class="text-danger">*</span></label>
                                                    <div class="medical-conditions">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="cardiac" name="medical[]"
                                                                value="Cardiac/Heart Related Problem"
                                                                {{ in_array('Cardiac/Heart Related Problem', $medical) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="cardiac">Cardiac/Heart Related Problem</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="asthma" name="medical[]"
                                                                value="Asthma/Breathing Problem"
                                                                {{ in_array('Asthma/Breathing Problem', $medical) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="asthma">Asthma/Breathing Problem</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="diabetes" name="medical[]" value="Diabetes"
                                                                {{ in_array('Diabetes', $medical) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="diabetes">Diabetes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="other" name="medical[]" value="Other"
                                                                {{ in_array('Other', $medical) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="other">Other</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="na" name="medical[]" value="NA"
                                                                {{ in_array('NA', $medical) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="na">NA</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Select if you are from below
                                                        profession</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="doctor" name="doctor"
                                                            {{ $pilgrim->doctor == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="doctor">I am a
                                                            Doctor</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pilgrim Vehicle Details -->
                                        <div class="section mb-4">
                                            <div
                                                class="section-header d-flex justify-content-between align-items-center bg-light p-3">
                                                <h6 class="mb-0">Pilgrim Vehicle Details <span
                                                        class="text-danger">*</span></h6>
                                                <i class="fas fa-chevron-up"></i>
                                            </div>
                                            <div class="section-content">
                                                <div class="mb-3">
                                                    <label class="form-label">Select vehicle details for this pilgrim
                                                        <span class="text-danger">*</span></label>
                                                    <select class="form-select" required name="vehicle_details">
                                                        @for ($i = 1; $i <= 8; $i++)
                                                            <option value="taxi{{ $i }}"
                                                                {{ old('vehicle_details', $pilgrim->vehicle_details) == "taxi$i" ? 'selected' : '' }}>
                                                                Taxi/Maxi - {{ $i }}
                                                                ({{ $i }}/8)
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Upload Pilgrim's Details -->
                                        <div class="section mb-4">
                                            <div
                                                class="section-header d-flex justify-content-between align-items-center bg-light p-3">
                                                <h6 class="mb-0">Pilgrim's Photo Details <span
                                                        class="text-danger">*</span></h6>
                                                <i class="fas fa-chevron-up"></i>
                                            </div>
                                            <div class="section-content">
                                                <div class="mb-4">
                                                    <label class="form-label">Preview Passport Size Photo <span
                                                            class="text-danger">*</span></label>

                                                    <div class="passport-preview mt-3" id="passportPreview">
                                                        <img src="{{ $pilgrim->getProfileImageUrl() }}">
                                                    </div>
                                                </div>




                                            </div>
                                        </div>

                                        <div class="text-end">

                                            @if (request()->query('mode') !== 'view')
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            @endif
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
    @include('partials.user_footer')
    
</body>

</html>
