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
            driversName: btn.dataset.driversName || '—',
            vehicleNumber: btn.dataset.vehicleNumber || '—',
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
                doc.addImage(imageData, 'JPEG', 20, 30, 40, 40); // x, y, width, height
            } catch (error) {
                console.error('Error loading image:', error);
                // If error loading photo, draw empty rectangle as placeholder
                doc.rect(20, 30, 40, 40);
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

        // Add QR Code
        const qrCodeSize = 40;
        const qrX = doc.internal.pageSize.width - 60;
        const qrY = 30;

        // Create temporary container for QR code
        const qrContainer = document.createElement("div");
        const qr = new QRCode(qrContainer, {
            text: 'Aadhar Number :- ' + pilgrimData.aadhar,
            width: qrCodeSize * 4,
            height: qrCodeSize * 4
        });

        // Get QR code as data URL
        const canvas = qrContainer.querySelector('canvas');
        const qrCodeDataUrl = canvas.toDataURL("image/jpeg");

        // Add QR code to PDF
        doc.addImage(qrCodeDataUrl, 'JPEG', qrX, qrY, qrCodeSize, qrCodeSize);
        doc.setFontSize(8);
        doc.text('Scan for Aadhar', qrX + qrCodeSize / 2, qrY + qrCodeSize + 3, { align: 'center' });




        // Add pilgrim details in tabular format
        doc.setFontSize(10);
        const startY = 80;
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
        
        // Make address row taller with only vertical lines
        const addressHeight = lineHeight * 2; // Double the normal height
        // Draw only the vertical lines for borders
        doc.line(20, currentY - 5, 20, currentY + addressHeight + 4); // Left border
        doc.line(90, currentY - 5, 90, currentY + addressHeight + 4); // Middle divider
        doc.line(190, currentY - 5, 190, currentY + addressHeight + 4); // Right border
        
        // Add text
        doc.text('Address', 25, currentY);
        const splitAddress = doc.splitTextToSize(pilgrimData.address, 90);
        doc.text(splitAddress, 95, currentY);
        currentY += addressHeight;

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
        currentY += lineHeight;

        addRow(`Driver's Name`, pilgrimData.driversName, currentY);
        currentY += lineHeight;

        addRow('Vehicle Number', pilgrimData.vehicleNumber, currentY);
        currentY += lineHeight;

        // Add a new page
        doc.addPage();

        // Reset Y position for new page
        currentY = 20;

        // Add title for the new page
        doc.setFontSize(14);
        doc.setFont(undefined, 'bold');
        doc.setTextColor(0, 0, 0);
        doc.text('Important Directions', 105, currentY, { align: 'center' });

        currentY += 10;
        doc.setFontSize(10);

        // Add instructions
        doc.setFontSize(12);
        doc.text("1. Do and Don'ts -", 20, currentY);
        doc.setFont(undefined, 'normal');
        currentY += 15;

        // Create table headers
        doc.setFillColor(211, 211, 211); // Light gray background
        doc.rect(20, currentY - 5, 170, 10, 'F');
        doc.rect(20, currentY - 5, 170, 10, 'S'); // Border
        doc.rect(20, currentY - 5, 30, 10, 'S'); // S.No. column border
        doc.rect(50, currentY - 5, 70, 10, 'S'); // Do's column border

        doc.setFontSize(10);
        doc.text("S.No.", 25, currentY);
        doc.text("Do's", 80, currentY);
        doc.text("Don'ts", 125, currentY);
        currentY += 10;

        // Table content
        const tableContent = [
            ["1", "Compulsory Registration", "Do not Overspeed in Hills"],
            ["2", "Keep the Registration certificate ready at the verification point", "Do not Litter Garbage"],
            ["3", "Collect Dham darshan slot token for smooth and hassle free darshan", "Do not Consume Alcohol/Tobacco"],
            ["4", "Acclimatization strongly recommended for people suffering from chronic disease", "Do not Drink & Drive"],
            ["5", "Carry your prescribed medicines, if Any", "Do not use Private Vehicles as Taxi"],
            ["6", "Park the Vehicle in the Right Place", "Do not defecate in Open"]
        ];

        tableContent.forEach((row, index) => {
            // Draw row borders
            doc.rect(20, currentY - 5, 170, 10, 'S');
            doc.rect(20, currentY - 5, 30, 10, 'S');
            doc.rect(50, currentY - 5, 70, 10, 'S');

            // Add text
            doc.text(row[0], 25, currentY);

            // Handle multi-line text for Do's column
            const doText = doc.splitTextToSize(row[1], 65);
            doc.text(doText, 55, currentY);

            // Handle multi-line text for Don'ts column
            const dontText = doc.splitTextToSize(row[2], 65);
            doc.text(dontText, 125, currentY);

            currentY += 10;
        });

        currentY += 10;

        // Add Things to Carry section
        doc.setFontSize(12);
        doc.setFont(undefined, 'bold');
        doc.text("2. Things to Carry -", 20, currentY);
        doc.setFont(undefined, 'normal');
        doc.setFontSize(10);
        currentY += 10;

        const thingsToCarry = [
            "a) Warm Cloth (Jacket, Shawl, Gloves, etc)",
            "b) Valid Personal ID Proof"
        ];

        thingsToCarry.forEach(item => {
            doc.text(item, 20, currentY);
            currentY += 10;
        });

        //logo
        currentY += 10;
        doc.setLineWidth(0.5);
        doc.line(0, currentY, 560, currentY);
        // Add powered by section
        const poweredByY = currentY + 25; // Position at bottom
        const pageWidth = doc.internal.pageSize.width;

        // Add Uttarakhand logo on left
        doc.addImage('../images/logo.jpg', 'JPEG', 20, poweredByY - 20, 30, 20);

        // Add Ethics Infotech logo on right
        doc.addImage('../images/pdf_logo.png', 'PNG', pageWidth - 50, poweredByY - 20, 30, 20);

        // Add centered "Powered by" text
        doc.setFontSize(12);
        doc.setTextColor(0, 0, 0);
        doc.text('Powered by Ethics Infotech LLP', pageWidth / 2, poweredByY - 10, { align: 'center' });
        currentY += 35;
        doc.setLineWidth(0.5);
        doc.line(0, currentY, 560, currentY);
        // Add footer note
        doc.setFontSize(10);
        doc.setTextColor(0, 0, 0);
        doc.text('This is an official registration document. Please keep it with you during the pilgrimage.', 105, 280, { align: 'center' });

        // Save the PDF
        doc.save(`UTDB_Registration_${pilgrimData.regNo}.pdf`);
    });
});