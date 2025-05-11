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