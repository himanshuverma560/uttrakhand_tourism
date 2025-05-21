<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Yatra Registration Letter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }

        ul {
            margin: 0;
            padding-left: 20px;
        }
    </style>
</head>

<body>

  {{-- Heading Centered on Top --}}
<div style="text-align: center; margin-bottom: 10px;">
    <h2 style="margin: 0;">Uttarakhand Tourism Development Board Yatra Registration Letter</h2>
</div>

{{-- Table-based layout for DOMPDF reliability --}}
<table width="100%">
    <tr>
        {{-- Profile Image on Left --}}
        <td width="25%" align="left">
            <img src="{{ $data['profile_image_path'] }}" alt="Profile Photo"
                 style="width: 120px; height: 150px; object-fit: cover;">
        </td>

        {{-- Empty space in center --}}
        <td width="25%"></td>
        

        {{-- QR Code on Right --}}
        <td width="25%" align="right">
            <img src="{{ $data['qr_code'] }}" alt="QR Code"
                 style="width: 150px; height: 150px; object-fit: contain;">
        </td>

        <td width="25%"></td>
    </tr>
</table>


    <table>
        <tr>
            <td><strong>Unique Registration No</strong></td>
            <td>{{ $data['unique_id'] }}</td>
        </tr>
        <tr>
            <td><strong>Group ID</strong></td>
            <td>{{ $data['tour_id'] }}</td>
        </tr>
        <tr>
            <td><strong>Destination</strong></td>
            <td>{{ $data['destinations'] }}</td>
        </tr>
        <tr>
            <td><strong>Tour Days</strong></td>
            <td>{{ $data['tour_days'] }}</td>
        </tr>
        <tr>
            <td><strong>Selected Dham Destination Date</strong></td>
            <td>{!! nl2br(e($data['date_wise_destination'])) !!}</td>
        </tr>
        <tr>
            <td><strong>Full Name</strong></td>
            <td>{{ $data['name'] }}</td>
        </tr>
        <tr>
            <td><strong>Gender</strong></td>
            <td>{{ $data['gender'] }}</td>
        </tr>
        <tr>
            <td><strong>Age</strong></td>
            <td>{{ $data['age'] }}</td>
        </tr>
        <tr>
            <td><strong>Diseases</strong></td>
            <td>{{ $data['status'] ?? 'NA' }}</td>
        </tr>
        <tr>
            <td><strong>Aadhar Card Number</strong></td>
            <td>{{ $data['aadhar_card'] }}</td>
        </tr>
        <tr>
            <td><strong>Email Address</strong></td>
            <td>{{ $data['email'] ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Mobile Number</strong></td>
            <td>{{ $data['mobile'] }}</td>
        </tr>
        <tr>
            <td><strong>Country</strong></td>
            <td>{{ $data['country'] }}</td>
        </tr>
        <tr>
            <td><strong>Address</strong></td>
            <td>{{ $data['address'] }}</td>
        </tr>
        <tr>
            <td><strong>City</strong></td>
            <td>{{ $data['city'] }}</td>
        </tr>
        <tr>
            <td><strong>District Name</strong></td>
            <td>{{ $data['district'] }}</td>
        </tr>
        <tr>
            <td><strong>State</strong></td>
            <td>{{ $data['state'] }}</td>
        </tr>
        <tr>
            <td><strong>Emergency Contact No</strong></td>
            <td>{{ $data['contact_number'] }}</td>
        </tr>
        <tr>
            <td><strong>Contact Person Name</strong></td>
            <td>{{ $data['contact_person'] }}</td>
        </tr>
        <tr>
            <td><strong>Contact Person Relation</strong></td>
            <td>{{ $data['contact_relation'] }}</td>
        </tr>
        <tr>
            <td><strong>Profession</strong></td>
            <td>{{ $data['profession'] ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Mode of Travel for Dham</strong></td>
            <td>{{ $data['vehicle_details'] ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Driver's Name</strong></td>
            <td>{{ $data['driver_name'] ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Vehicle Number</strong></td>
            <td>{{ $data['vehicle_number'] ?? '-' }}</td>
        </tr>
    </table>

    <h4>Important Directions:-</h4>

    <h5>1. Do and Don'ts -</h5>
    <table>
        <thead>
            <tr>
                <th>S.No.</th>
                <th>Do's</th>
                <th>Don'ts</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Compulsory Registration</td>
                <td>Do not Overspeed in Hills</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Keep the Registration certificate ready at the verification point</td>
                <td>Do not Litter Garbage</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Collect Dham darshan slot token for smooth and hassle free darshan</td>
                <td>Do not Consume Alcohol/Tobacco</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Acclimatization strongly recommended for people suffering from chronic disease</td>
                <td>Do not Drink & Drive</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Carry your prescribed medicines, if Any</td>
                <td>Do not use Private Vehicles as Taxi</td>
            </tr>
            <tr>
                <td>6</td>
                <td>Park the Vehicle in the Right Place</td>
                <td>Do not defecate in Open</td>
            </tr>
        </tbody>
    </table>

    <h5>2. Things to Carry -</h5>
    <ul>
        <li>a) Warm Cloth (Jacket, Shawl, Gloves, etc)</li>
        <li>b) Valid Personal ID Proof</li>
    </ul>

</body>

</html>
