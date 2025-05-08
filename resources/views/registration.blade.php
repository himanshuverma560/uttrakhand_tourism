@extends('layouts.website_layout')
@section('content')
    <!-- Top social bar -->
    @extends('partials.menu')
    <section class="auth-section py-5">
        <div class="container">
            <div class="row">
                <!-- Registration Form -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h3 class="card-title mb-4">Register for Chardham and Hemkund</h3>

                            <!-- Pilgrim Type Selection -->
                            <div class="pilgrim-type-buttons mb-4">
                                <button type="button" class="btn btn-primary pilgrim-type active" data-type="indian">Indian
                                    Pilgrim</button>
                                <button type="button" class="btn btn-secondary pilgrim-type" data-type="foreign">Foreign
                                    Pilgrim</button>
                            </div>

                            <form id="registrationForm" method="post" action="{{ route('registration.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name"
                                        required>
                                </div>
                                <div class="mb-3 mobile-input-group">
                                    <label class="form-label">Mobile No <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="country-select indian-mode">
                                            <span class="input-group-text country-code">🇮🇳 +91</span>
                                        </div>
                                        <div class="country-select foreign-mode" style="display: none;">
                                            <button type="button" class="input-group-text country-toggle">
                                                <span class="selected-country">🌍 Select</span>
                                                <i class="fas fa-chevron-down ms-2"></i>
                                            </button>
                                            <div class="country-dropdown" style="display: none;">
                                                <input type="text" class="form-control country-search"
                                                    placeholder="Search country..." name="country_code">
                                                <div class="country-list">
                                                    <div class="country-item" data-code="+1" data-flag="🇺🇸"><span
                                                            class="flag">🇺🇸</span> United States +1</div>
                                                    <div class="country-item" data-code="+44" data-flag="🇬🇧"><span
                                                            class="flag">🇬🇧</span> United Kingdom +44</div>
                                                    <div class="country-item" data-code="+61" data-flag="🇦🇺"><span
                                                            class="flag">🇦🇺</span> Australia +61</div>
                                                    <div class="country-item" data-code="+86" data-flag="🇨🇳"><span
                                                            class="flag">🇨🇳</span> China +86</div>
                                                    <div class="country-item" data-code="+49" data-flag="🇩🇪"><span
                                                            class="flag">🇩🇪</span> Germany +49</div>
                                                    <div class="country-item" data-code="+33" data-flag="🇫🇷"><span
                                                            class="flag">🇫🇷</span> France +33</div>
                                                    <div class="country-item" data-code="+81" data-flag="🇯🇵"><span
                                                            class="flag">🇯🇵</span> Japan +81</div>
                                                    <div class="country-item" data-code="+7" data-flag="🇷🇺"><span
                                                            class="flag">🇷🇺</span> Russia +7</div>
                                                    <div class="country-item" data-code="+39" data-flag="🇮🇹"><span
                                                            class="flag">🇮🇹</span> Italy +39</div>
                                                    <div class="country-item" data-code="+34" data-flag="🇪🇸"><span
                                                            class="flag">🇪🇸</span> Spain +34</div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="country_code" id="selected-country-code">
                                        <input type="hidden" name="pilgrim_type" id="pilgrim_type">
                                        <input type="tel"  name="mobile" class="form-control" placeholder="Enter Mobile No." required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email ID <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter Email ID"
                                        required>
                                </div>
                                <div class="mb-3 pilgrim-type-radios">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pilgrim_type"
                                            id="individual" value="Individual" checked>
                                        <label class="form-check-label" for="individual">Individual</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pilgrim_type"
                                            id="family" value="Family">
                                        <label class="form-check-label" for="family">Family</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Enter Password" required>
                                        <button class="btn btn-outline-secondary toggle-password" type="button">
                                            <i class="far fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password_confirmation"
                                            placeholder="Enter Confirm Password" required>
                                        <button class="btn btn-outline-secondary toggle-password" type="button">
                                            <i class="far fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="text-info mb-3">
                                    Password must be minimum of 6 characters. It must contain alphabets, special characters
                                    and numbers !!
                                </div>
                                <button type="submit" class="btn btn-primary">SIGN UP</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Login Form -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                            <h3 class="card-title mb-4">Login to Your Account!</h3>
                            <p class="text-muted mb-4">If you are already a registered user, then please login here.</p>
                            
                            <!-- Pilgrim Type Selection -->
                            <div class="pilgrim-type-buttons mb-4">
                                <button type="button" class="btn btn-primary pilgrim-type active"
                                    data-type="indian">Indian Pilgrim</button>
                                <button type="button" class="btn btn-secondary pilgrim-type" data-type="foreign">Foreign
                                    Pilgrim</button>
                            </div>

                            <form id="loginForm" action="{{ route('user.login') }}" method="post">
                                @csrf
                                <input type="hidden" name="pilgrim_type" id="pilgrim_type_login">
                                <div class="mb-3 login-input-group">
                                    
                                    <label class="form-label">Mobile No <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text country-code">🇮🇳 +91</span>
                                        <input type="tel" name="mobile" class="form-control"
                                            placeholder="Enter Mobile No." required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password" placeholder="Enter Password"
                                            required>
                                        <button class="btn btn-outline-secondary toggle-password" type="button">
                                            <i class="far fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="captcha-section d-flex align-items-center gap-2">
                                            <input type="number" required class="form-control" placeholder="Enter Captcha"
                                                style="width: 150px;">
                                            <span class="captcha-code"><?php echo mt_rand(9999,99999); ?></span>
                                            <button type="button" class="btn btn-link refresh-captcha p-0">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="submit" class="btn btn-primary">SIGN IN</button>
                                    {{-- <a href="#" class="text-primary" id="forgotPasswordLink">Forgot Password?</a> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Forgot Password Popup -->
    <div class="popup-overlay" id="forgotPasswordPopup">
        <div class="popup-container">
            <!-- Step 1: Mobile Number -->
            <div class="popup-step" id="stepMobile">
                <h4>Forgot Password</h4>
                <p>Enter your registered mobile number to receive OTP</p>
                <form id="mobileForm">
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text">🇮🇳 +91</span>
                            <input type="tel" class="form-control" placeholder="Enter Mobile No." required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Send OTP</button>
                        <button type="button" class="btn btn-secondary popup-close">Cancel</button>
                    </div>
                </form>
            </div>

            <!-- Step 2: OTP Verification -->
            <div class="popup-step" id="stepOTP" style="display: none;">
                <h4>Enter OTP</h4>
                <p>Please enter the OTP sent to your mobile number</p>
                <form id="otpForm">
                    <div class="mb-3">
                        <div class="otp-inputs">
                            <input type="text" maxlength="1" class="form-control otp-input" required>
                            <input type="text" maxlength="1" class="form-control otp-input" required>
                            <input type="text" maxlength="1" class="form-control otp-input" required>
                            <input type="text" maxlength="1" class="form-control otp-input" required>
                            <input type="text" maxlength="1" class="form-control otp-input" required>
                            <input type="text" maxlength="1" class="form-control otp-input" required>
                        </div>
                        <div class="text-center mt-2">
                            <span id="otpTimer" class="text-muted">02:00</span>
                            <button type="button" id="resendOTP" class="btn btn-link" disabled>Resend OTP</button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Verify OTP</button>
                        <button type="button" class="btn btn-secondary popup-close">Cancel</button>
                    </div>
                </form>
            </div>

            <!-- Step 3: Reset Password -->
            <div class="popup-step" id="stepResetPassword" style="display: none;">
                <h4>Reset Password</h4>
                <p>Enter your new password</p>
                <form id="resetPasswordForm">
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="Enter New Password" required>
                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="Confirm New Password" required>
                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="text-info mb-3">
                        Password must be minimum of 6 characters. It must contain alphabets, special characters and numbers
                        !!
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Reset Password</button>
                        <button type="button" class="btn btn-secondary popup-close">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
