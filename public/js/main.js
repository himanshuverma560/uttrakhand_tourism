document.addEventListener('DOMContentLoaded', function () {
    const categoryIcons = document.querySelectorAll('.category-icon');
    const articleContainer = document.getElementById('articleContainer');

    // Content for each category
    const articles = {
        'Wildlife': {
            title: 'The Untamed Wilderness of Uttarakhand: A Biodiversity Hotspot',
            image: 'images/explore/wildlife.jpg',
            text: ['Uttarakhand, a picturesque state in northern India, is renowned for its rich wildlife and diverse ecosystems. Nestled in the foothills of the Himalayas, the state is home to a variety of habitats, from dense forests and alpine meadows to river valleys and high-altitude regions.',
                'This biodiversity supports an impressive array of wildlife, including iconic species like the Bengal tiger, Asian elephant, snow leopard, and musk deer.']
        },
        'Adventure': {
            title: 'Thrilling Adventures in the Land of Gods',
            image: 'images/explore/adventure.jpg',
            text: ['Uttarakhand offers an incredible array of adventure activities throughout the year. From white water rafting in Rishikesh to trekking in the Himalayas, the state is a paradise for adventure enthusiasts.',
                'Experience the thrill of skiing in Auli, bungee jumping in Rishikesh, or mountaineering in the majestic peaks of the Himalayas.']
        },
        'Wellness': {
            title: 'Rejuvenate Your Mind, Body, and Soul',
            image: 'images/explore/wellness.jpg',
            text: ['Discover the ancient wisdom of Ayurveda and Yoga in Uttarakhand. The state is home to numerous wellness centers and ashrams that offer traditional healing practices.',
                'Experience the therapeutic benefits of natural hot springs, meditation, and holistic wellness treatments in serene surroundings.']
        },
        'Spirituality': {
            title: 'Sacred Journey Through Devbhumi',
            image: 'images/explore/spirituality.jpg',
            text: ['Embark on a spiritual journey through the holy land of Uttarakhand, also known as Devbhumi. Visit ancient temples, sacred rivers, and powerful spiritual centers.',
                'Experience the divine energy at the Char Dham sites, meditate in ancient caves, and participate in sacred rituals and ceremonies.']
        },
        'Leisure': {
            title: 'Peaceful Escapes in the Himalayan Haven',
            image: 'images/explore/leisure.jpg',
            text: ['Unwind in the tranquil hill stations of Uttarakhand, where nature\'s beauty meets modern comfort. Explore charming towns, local markets, and cultural heritage.',
                'Enjoy peaceful lake views, mountain vistas, and the warm hospitality of the local people.']
        }
    };

    // Add click event listeners to category icons
    categoryIcons.forEach(icon => {
        icon.addEventListener('click', function () {
            // Remove active class from all icons
            categoryIcons.forEach(i => i.classList.remove('active'));
            // Add active class to clicked icon
            this.classList.add('active');

            // Get category from data attribute
            const category = this.getAttribute('data-category');
            updateArticleContent(category);
        });
    });

    function updateArticleContent(category) {
        // Add fade-out class
        articleContainer.classList.add('fade-out');

        // Wait for fade-out animation
        setTimeout(() => {
            const article = articles[category];

            // Update the content
            articleContainer.innerHTML = `
                <div class="row align-items-center bg-white rounded-4 overflow-hidden">
                    <div class="col-lg-6">
                        <div class="article-image">
                            <img src="${article.image}" alt="${category} in Uttarakhand" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="article-content p-4 p-lg-5">
                            <h3 class="article-title">${article.title}</h3>
                            ${article.text.map(para => `<p class="article-text">${para}</p>`).join('')}
                            <a href="#" class="btn btn-read-more">Read more</a>
                        </div>
                    </div>
                </div>`;

            // Remove fade-out class
            setTimeout(() => {
                articleContainer.classList.remove('fade-out');
            }, 50);
        }, 300);
    }

    // Pilgrim type switching functionality
    const pilgrimTypeButtons = document.querySelectorAll('.pilgrim-type');
    const registrationForm = document.getElementById('registrationForm');
    const userTypeRadios = document.querySelector('.pilgrim-type-radios');

    // Additional fields for tour operator
    const tourOperatorFields = `
        <div class="mb-3 tour-operator-field">
            <label class="form-label">Tour Company Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="company_name" placeholder="Enter Tour Company Name" required>
        </div>
        <div class="mb-3 tour-operator-field">
            <label class="form-label">GST Number</label>
            <input type="text" class="form-control" name="gst_number" placeholder="Enter GST Number">
        </div>
        <div class="mb-3 tour-operator-field">
            <label class="form-label">State <span class="text-danger">*</span></label>
            <select class="form-control" required name="state">
            <option value="">Select State</option>
            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
            <option value="Andhra Pradesh">Andhra Pradesh</option>
            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
            <option value="Assam">Assam</option>
            <option value="Bihar">Bihar</option>
            <option value="Chandigarh">Chandigarh</option>
            <option value="Chhattisgarh">Chhattisgarh</option>
            <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
            <option value="Delhi">Delhi</option>
            <option value="Goa">Goa</option>
            <option value="Gujarat">Gujarat</option>
            <option value="Haryana">Haryana</option>
            <option value="Himachal Pradesh">Himachal Pradesh</option>
            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
            <option value="Jharkhand">Jharkhand</option>
            <option value="Karnataka">Karnataka</option>
            <option value="Kerala">Kerala</option>
            <option value="Ladakh">Ladakh</option>
            <option value="Lakshadweep">Lakshadweep</option>
            <option value="Madhya Pradesh">Madhya Pradesh</option>
            <option value="Maharashtra">Maharashtra</option>
            <option value="Manipur">Manipur</option>
            <option value="Meghalaya">Meghalaya</option>
            <option value="Mizoram">Mizoram</option>
            <option value="Nagaland">Nagaland</option>
            <option value="Odisha">Odisha</option>
            <option value="Puducherry">Puducherry</option>
            <option value="Punjab">Punjab</option>
            <option value="Rajasthan">Rajasthan</option>
            <option value="Sikkim">Sikkim</option>
            <option value="Tamil Nadu">Tamil Nadu</option>
            <option value="Telangana">Telangana</option>
            <option value="Tripura">Tripura</option>
            <option value="Uttar Pradesh">Uttar Pradesh</option>
            <option value="Uttarakhand">Uttarakhand</option>
            <option value="West Bengal">West Bengal</option>
        </select>

        </div>
    `;

    // Initialize both registration and login form pilgrim types
    const forms = ['registration', 'login'];
    forms.forEach(formType => {
        const pilgrimButtons = document.querySelector(`#${formType}Form`).closest('.card').querySelectorAll('.pilgrim-type');
        updatePilgrimType('indian', pilgrimButtons);

        pilgrimButtons.forEach(button => {
            button.addEventListener('click', function () {
                updatePilgrimType(this.dataset.type, pilgrimButtons);
            });
        });
    });

    function updatePilgrimType(type, buttons) {
        // Update button styles
        buttons.forEach(btn => {
            btn.classList.remove('active', 'btn-primary');
            btn.classList.add('btn-secondary');
        });
        const activeButton = Array.from(buttons).find(btn => btn.dataset.type === type);
        activeButton.classList.add('active', 'btn-primary');
        activeButton.classList.remove('btn-secondary');

        const form = buttons[0].closest('.card').querySelector('form');

        if (form.id === 'registrationForm') {
            const mobileInputGroup = form.querySelector('.mobile-input-group');
            if (type === 'indian') {
                mobileInputGroup.querySelector('.indian-mode').style.display = 'block';
                mobileInputGroup.querySelector('.foreign-mode').style.display = 'none';
            } else {
                mobileInputGroup.querySelector('.indian-mode').style.display = 'none';
                mobileInputGroup.querySelector('.foreign-mode').style.display = 'block';
            }

            // Handle user type radios for registration form
            const userTypeRadios = form.querySelector('.pilgrim-type-radios');
            if (type === 'indian') {
                userTypeRadios.innerHTML = `
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="userType" id="tourOperator" value="tourOperator">
                        <label class="form-check-label" for="tourOperator">Tour Operator</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="userType" id="individual" value="individual" checked>
                        <label class="form-check-label" for="individual">Individual</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="userType" id="family" value="family">
                        <label class="form-check-label" for="family">Family</label>
                    </div>
                `;
                document.getElementById('pilgrim_type').value = 'Indian Pilgrim';
            } else {
                userTypeRadios.innerHTML = `
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="userType" id="individual" value="individual" checked>
                        <label class="form-check-label" for="individual">Individual</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="userType" id="family" value="family">
                        <label class="form-check-label" for="family">Family</label>
                    </div>
                `;
                document.getElementById('pilgrim_type').value = 'Foreign Pilgrim';
            }

            // Set up country code dropdown handlers
            setupCountryDropdown(form);

            // Set up tour operator field handlers
            if (type === 'indian') {
                const userTypeRadios = form.querySelectorAll('input[name="userType"]');
                userTypeRadios.forEach(radio => {
                    radio.addEventListener('change', function () {
                        handleTourOperatorFields(this.value === 'tourOperator', form);
                    });
                });
            } else {
                handleTourOperatorFields(false, form);
            }
        } else if (form.id === 'loginForm') {
            const loginInputGroup = form.querySelector('.login-input-group');

            if (loginInputGroup) {
                if (type === 'indian') {
                    loginInputGroup.innerHTML = `
                        <label class="form-label">Mobile No <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text country-code">🇮🇳 +91</span>
                            <input type="tel" class="form-control" name="mobile" placeholder="Enter Mobile No." required>
                        </div>
                    `;
                    document.getElementById('pilgrim_type_login').value = 'Indian Pilgrim';
                } else {
                    loginInputGroup.innerHTML = `
                        <label class="form-label">Email ID <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" placeholder="Enter Email ID" required>
                    `;
                    document.getElementById('pilgrim_type_login').value = 'Foreign Pilgrim';
                }
            }
        }
    }

    function setupCountryDropdown(form) {
        const foreignMode = form.querySelector('.foreign-mode');
        if (!foreignMode) return;

        const countryDropdown = foreignMode.querySelector('.country-dropdown');
        const countryToggle = foreignMode.querySelector('.country-toggle');
        const countrySearch = foreignMode.querySelector('.country-search');
        const countryList = foreignMode.querySelector('.country-list');
        const countryItems = foreignMode.querySelectorAll('.country-item');
        const selectedCountry = foreignMode.querySelector('.selected-country');

        // Toggle dropdown
        countryToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            countryDropdown.style.display = countryDropdown.style.display === 'block' ? 'none' : 'block';
        });

        // Handle search
        countrySearch.addEventListener('click', function (e) {
            e.stopPropagation();
        });

        countrySearch.addEventListener('input', function () {
            const searchText = this.value.toLowerCase();
            countryItems.forEach(item => {
                const text = item.textContent.toLowerCase();
                item.style.display = text.includes(searchText) ? 'flex' : 'none';
            });
        });

        // Handle country selection
        countryItems.forEach(item => {
            item.addEventListener('click', function () {
                const code = this.dataset.code;
                const flag = this.dataset.flag;
                selectedCountry.innerHTML = `${flag} ${code}`;
                countryDropdown.style.display = 'none';
                countrySearch.value = '';
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function () {
            if (countryDropdown) {
                countryDropdown.style.display = 'none';
            }
        });
    }

    function handleTourOperatorFields(show, form) {
        const existingFields = form.querySelectorAll('.tour-operator-field');
        existingFields.forEach(field => field.remove());

        if (show) {
            const insertPoint = form.querySelector('.pilgrim-type-radios');
            insertPoint.insertAdjacentHTML('afterend', tourOperatorFields);
        }
    }

    // Country code dropdown functionality
    document.querySelectorAll('.country-select.foreign-mode').forEach(foreignMode => {
        const countryDropdown = foreignMode.querySelector('.country-dropdown');
        const countrySearch = foreignMode.querySelector('.country-search');
        const countryList = foreignMode.querySelector('.country-list');
        const countryItems = foreignMode.querySelectorAll('.country-item');
        const countryToggle = foreignMode.querySelector('.country-toggle');

        countryToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            countryDropdown.style.display = countryDropdown.style.display === 'block' ? 'none' : 'block';
        });

        countrySearch.addEventListener('click', function (e) {
            e.stopPropagation();
        });

        countrySearch.addEventListener('input', function () {
            const searchText = this.value.toLowerCase();
            countryItems.forEach(item => {
                const text = item.textContent.toLowerCase();
                item.style.display = text.includes(searchText) ? 'flex' : 'none';
            });
        });

        countryItems.forEach(item => {
            item.addEventListener('click', function () {
                const code = this.dataset.code;
                const flag = this.dataset.flag;
                const selectedText = `${flag} ${code}`;
                foreignMode.querySelector('.country-code').innerHTML = selectedText;
                countryDropdown.style.display = 'none';
                document.getElementById('selected-country-code').value = code;
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function () {
            countryDropdown.style.display = 'none';
        });
    });

    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function () {
            const input = this.previousElementSibling;
            const icon = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
});
// Forgot Password Popup
const forgotPasswordLink = document.getElementById('forgotPasswordLink');
const popup = document.getElementById('forgotPasswordPopup');
const popupCloseButtons = document.querySelectorAll('.popup-close');
const mobileForm = document.getElementById('mobileForm');
const otpForm = document.getElementById('otpForm');
const resetPasswordForm = document.getElementById('resetPasswordForm');

if (forgotPasswordLink) {
    forgotPasswordLink.addEventListener('click', function (e) {
        e.preventDefault();
        popup.style.display = 'flex';
        document.getElementById('stepMobile').style.display = 'block';
        document.getElementById('stepOTP').style.display = 'none';
        document.getElementById('stepResetPassword').style.display = 'none';
    });
}

popupCloseButtons.forEach(button => {
    button.addEventListener('click', function () {
        popup.style.display = 'none';
    });
});

// Handle OTP inputs
const otpInputs = document.querySelectorAll('.otp-input');
otpInputs.forEach((input, index) => {
    input.addEventListener('input', function () {
        if (this.value.length === 1) {
            if (index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }
        }
    });

    input.addEventListener('keydown', function (e) {
        if (e.key === 'Backspace' && !this.value) {
            if (index > 0) {
                otpInputs[index - 1].focus();
            }
        }
    });
});


// Form submissions
if (mobileForm) {
    mobileForm.addEventListener('submit', function (e) {
        e.preventDefault();
        document.getElementById('stepMobile').style.display = 'none';
        document.getElementById('stepOTP').style.display = 'block';
        startOTPTimer();
    });

    otpForm.addEventListener('submit', function (e) {
        e.preventDefault();
        document.getElementById('stepOTP').style.display = 'none';
        document.getElementById('stepResetPassword').style.display = 'block';
    });
}

if (resetPasswordForm) {
    resetPasswordForm.addEventListener('submit', function (e) {
        e.preventDefault();
        // Add password validation here
        popup.style.display = 'none';
        // Show success message
    });
}







// Handle navbar transparency on scroll
const dashboardNav = document.querySelector('.dashboard-nav');
if (dashboardNav) {
    window.addEventListener('scroll', function () {
        if (window.scrollY > 50) {
            dashboardNav.classList.add('scrolled');
        } else {
            dashboardNav.classList.remove('scrolled');
        }
    });
}
// Collapsible sections
document.querySelectorAll('.section-header').forEach(header => {
    header.addEventListener('click', function () {
        const icon = this.querySelector('i');
        const sectionContent = this.parentElement.querySelector('.section-content');

        if (sectionContent.style.display === 'block') {
            sectionContent.style.display = 'none';
            sectionContent.style.marginBottom = '0';
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        } else {
            sectionContent.style.display = 'block';
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');

        }
    });
});


// File Upload Preview Functionality
const passportPhotoInput = document.getElementById('passportPhoto');
const aadhaarFrontInput = document.getElementById('aadhaarFront');
const aadhaarBackInput = document.getElementById('aadhaarBack');
const passportPreviewContainer = document.getElementById('passportPreview');
const aadhaarPreviewContainer = document.getElementById('aadhaarPreview');

// Handle passport photo preview
if (passportPhotoInput && passportPreviewContainer) {
    passportPhotoInput.addEventListener('change', function (e) {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                if (file.type === 'application/pdf') {
                    passportPreviewContainer.innerHTML = `
                        <div class="preview-item">
                            <i class="far fa-file-pdf fa-3x text-danger"></i>
                            <p class="mt-2">${file.name}</p>
                        </div>
                    `;
                } else {
                    passportPreviewContainer.innerHTML = `
                        <div class="preview-item">
                            <img src="${e.target.result}" alt="Passport Preview" style="max-height: 150px; max-width: 100%;">
                        </div>
                    `;
                }
            };
            passportPreviewContainer.style.padding = '10px';
            reader.readAsDataURL(file);
        }
    });
}

// Function to handle Aadhaar card preview
function handleAadhaarPreview(file, side) {
    if (!file || !aadhaarPreviewContainer) return;

    const reader = new FileReader();
    reader.onload = function (e) {
        // Remove existing preview for this side if it exists
        const existingPreview = aadhaarPreviewContainer.querySelector(`[data-side="${side}"]`);
        if (existingPreview) {
            existingPreview.remove();
        }

        const previewDiv = document.createElement('div');
        previewDiv.className = 'preview-item';
        previewDiv.setAttribute('data-side', side);

        if (file.type === 'application/pdf') {
            previewDiv.innerHTML = `
                <div class="side-label">${side}</div>
                <i class="far fa-file-pdf fa-3x text-danger"></i>
                <p class="mt-2">${file.name}</p>
            `;
        } else {
            previewDiv.innerHTML = `
                <div class="side-label">${side}</div>
                <img src="${e.target.result}" alt="Aadhaar ${side}" style="max-height: 150px; max-width: 100%;">
            `;
        }
        previewDiv.style.padding = '10px';
        aadhaarPreviewContainer.appendChild(previewDiv);
    };
    reader.readAsDataURL(file);
}

// Handle Aadhaar front side preview
if (aadhaarFrontInput) {
    aadhaarFrontInput.addEventListener('change', function (e) {
        const file = this.files[0];
        if (file) {
            handleAadhaarPreview(file, 'Front Side');
        }
    });
}

// Handle Aadhaar back side preview
if (aadhaarBackInput) {
    aadhaarBackInput.addEventListener('change', function (e) {
        const file = this.files[0];
        if (file) {
            handleAadhaarPreview(file, 'Back Side');
        }
    });
}

// Initialize jsPDF
window.jsPDF = window.jspdf.jsPDF;

// PDF Download functionality
document.querySelectorAll('.download-pdf').forEach(button => {
    button.addEventListener('click', async function () {
        const btn = this;
        const pilgrimData = {
            regNo: btn.dataset.regno,
            groupId: btn.dataset.groupId,
            destination: btn.dataset.destination,
            tourDays: btn.dataset.tourDays,
            selectedDates: btn.dataset.selectedDates,
            fullName: btn.dataset.fullName,
            gender: btn.dataset.gender,
            age: btn.dataset.age,
            diseases: btn.dataset.diseases || 'NA',
            aadhar: btn.dataset.aadhar,
            email: btn.dataset.email,
            mobile: btn.dataset.mobile,
            address: btn.dataset.address,
            state: btn.dataset.state,
            photoUrl: btn.dataset.photoUrl,
            qrUrl: btn.dataset.qrUrl,
            country: btn.dataset.country,
            city: btn.dataset.city,
            state: btn.dataset.state,
            district: btn.dataset.district,
            contactNumber: btn.dataset.contactNumber,
            contactPerson: btn.dataset.contactPerson,
            contactRelation: btn.dataset.contactRelation,
            vehicleDetails: btn.dataset.vehicleDetails,
        };

        // Create PDF
        const doc = new jsPDF();

        // Add header
        doc.setFontSize(16);
        doc.setTextColor(0, 0, 0);
        doc.text('Uttarakhand Tourism Development Board - Yatra Registration Letter', 105, 20, { align: 'center' });


        const photoInput = { value: pilgrimData.photoUrl }
        if (photoInput && photoInput.value) {
            try {
                // Fetch the image from URL
                const response = await fetch(photoInput.value);
                const blob = await response.blob();

                // Convert blob to base64
                const imageData = await new Promise((resolve) => {
                    const reader = new FileReader();
                    reader.onload = (e) => resolve(e.target.result);
                    reader.readAsDataURL(blob);
                });

                // Add the photo to the PDF
                doc.addImage(imageData, 'JPEG', 20, 40, 40, 40); // x, y, width, height
            } catch (error) {
                console.error('Error loading image:', error);
                // If error loading photo, draw empty rectangle as placeholder
                doc.rect(20, 40, 40, 40);
                doc.setFontSize(8);
                doc.text('Error loading photo', 40, 85, { align: 'center' });
            }
        } else {
            // If no photo URL, draw empty rectangle as placeholder
            doc.rect(20, 40, 40, 40);
            doc.setFontSize(8);
            doc.text('Pilgrim Photo', 40, 85, { align: 'center' });
        }

        // Add QR Code placeholder



        // Add pilgrim details in tabular format
        doc.setFontSize(10);
        const startY = 90;
        const lineHeight = 9;

        // Function to add a row with border
        const addRow = (label, value, y) => {
            const splitValue = doc.splitTextToSize(value, 90);
            doc.rect(20, y - 5, 170, lineHeight + 9); // Add border
            doc.setDrawColor(0);
            doc.line(90, y - 5, 90, y + lineHeight); // Vertical line between label and value
            doc.text(label, 25, y);
            doc.text(splitValue, 95, y);

        };

        let currentY = startY;

        addRow('Unique Registration No', pilgrimData.regNo, currentY);
        currentY += lineHeight;

        addRow('Group ID', pilgrimData.groupId, currentY);
        currentY += lineHeight;

        addRow('Destination', pilgrimData.destination, currentY);
        currentY += lineHeight;

        addRow('Tour Days', pilgrimData.tourDays, currentY);
        currentY += lineHeight;

        addRow('Destination Date', pilgrimData.selectedDates, currentY);
        currentY += lineHeight;

        addRow('Full Name', pilgrimData.fullName, currentY);
        currentY += lineHeight;

        addRow('Gender', pilgrimData.gender, currentY);
        currentY += lineHeight;

        addRow('Age', pilgrimData.age, currentY);
        currentY += lineHeight;

        addRow('Diseases', pilgrimData.diseases, currentY);
        currentY += lineHeight;

        addRow('Aadhar Card Number', pilgrimData.aadhar, currentY);
        currentY += lineHeight;

        addRow('Email Address', pilgrimData.email, currentY);
        currentY += lineHeight;

        addRow('Mobile Number', pilgrimData.mobile, currentY);
        currentY += lineHeight;

        addRow('Country', pilgrimData.country, currentY);
        currentY += lineHeight;

        addRow('Address', pilgrimData.address, currentY);
        currentY += lineHeight;

        addRow('City', pilgrimData.city, currentY);
        currentY += lineHeight;

        addRow('District Name', pilgrimData.district, currentY);
        currentY += lineHeight;

        addRow('State', pilgrimData.state, currentY);
        currentY += lineHeight;

        addRow('Emergency Contact No', pilgrimData.contactNumber, currentY);
        currentY += lineHeight;

        addRow('Contact Person Name', pilgrimData.contactPerson, currentY);
        currentY += lineHeight;

        addRow('Contact Person Relation', pilgrimData.contactRelation, currentY);
        currentY += lineHeight;

        addRow('Mode of Travel for Dham', pilgrimData.vehicleDetails, currentY);


        // Add footer note
        doc.setFontSize(10);
        doc.setTextColor(0, 0, 0);
        doc.text('This is an official registration document. Please keep it with you during the pilgrimage.', 105, 280, { align: 'center' });

        // Save the PDF
        doc.save(`UTDB_Registration_${pilgrimData.regNo}.pdf`);
    });
});

