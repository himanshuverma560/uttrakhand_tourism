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
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px 6px;
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

    <div style="border: 1px solid #000;">
        <div style="width: 100%;height: 170px;">
            <div style="">
                <img src="{{ $data['profile_image_path'] }}" alt="Profile Photo"
                    style="width: 120px; height: 150px; object-fit: cover; float: left;margin-right:250px">
            </div>
            <div>
                <img src="{{ $data['qr_code'] }}" alt="QR Code"
                    style="width: 150px; height: 150px; object-fit: contain; float: left;">
            </div>
        </div>
        <table>
            <tr>
                <td style="width: 50%;">Unique Registration No</td>
                <td>{{ $data['unique_id'] }}</td>
            </tr>
            <tr>
                <td style="width: 50%;">Group ID</td>
                <td>{{ $data['tour_id'] }}</td>
            </tr>
            <tr>
                <td style="width: 50%;">Destination</td>
                <td>{{ $data['destinations'] }}</td>
            </tr>
            <tr>
                <td style="width: 50%;">Tour Days</td>
                <td>{{ $data['tour_days'] }}</td>
            </tr>
            <tr>
                <td style="width: 50%;">Selected Dham Destination Date</td>
                <td>{!! nl2br(e($data['date_wise_destination'])) !!}</td>
            </tr>
            <tr>
                <td style="width: 50%;">Full Name</td>
                <td>{{ $data['name'] }}</td>
            </tr>
            <tr>
                <td style="width: 50%;">Gender</td>
                <td>{{ $data['gender'] }}</td>
            </tr>
            <tr>
                <td style="width: 50%;">Age</td>
                <td>{{ $data['age'] }}</td>
            </tr>
            <tr>
                <td style="width: 50%;">Diseases</td>
                <td>{{ $data['status'] ?? 'NA' }}</td>
            </tr>
            <tr>
                <td style="width: 50%;">Aadhar Card Number</td>
                <td>{{ $data['aadhar_card'] }}</td>
            </tr>
            <tr>
                <td style="width: 50%;">Email Address</td>
                <td>{{ $data['email'] ?? '-' }}</td>
            </tr>
            <tr>
                <td style="width: 50%;">Mobile Number</td>
                <td>{{ $data['mobile'] }}</td>
            </tr>
            <tr>
                <td style="width: 50%;">Country</td>
                <td>{{ $data['country'] }}</td>
            </tr>
            <tr>
                <td style="width: 50%;">Address</td>
                <td>{{ $data['address'] }}</td>
            </tr>
            <tr>
                <td style="width: 50%;">City</td>
                <td>{{ $data['city'] }}</td>
            </tr>
            <tr>
                <td style="width: 50%;">District Name</td>
                <td>{{ $data['district'] }}</td>
            </tr>
            <tr>
                <td style="width: 50%;">State</td>
                <td>{{ $data['state'] }}</td>
            </tr>
            <tr>
                <td style="width: 50%;">Emergency Contact No</td>
                <td>{{ $data['contact_number'] }}</td>
            </tr>
            <tr>
                <td style="width: 50%;">Contact Person Name</td>
                <td>{{ $data['contact_person'] }}</td>
            </tr>
            <tr>
                <td style="width: 50%;">Contact Person Relation</td>
                <td>{{ $data['contact_relation'] }}</td>
            </tr>
            <tr>
                <td style="width: 50%;">Profession</td>
                <td>{{ $data['profession'] ?? '-' }}</td>
            </tr>
            <tr>
                <td style="width: 50%;">Mode of Travel for Dham</td>
                <td>{{ $data['vehicle_details'] ?? '-' }}</td>
            </tr>
            <tr>
                <td style="width: 50%;">Driver's Name</td>
                <td>{{ $data['driver_name'] ?? '-' }}</td>
            </tr>
            <tr>
                <td style="width: 50%;">Vehicle Number</td>
                <td>{{ $data['vehicle_number'] ?? '-' }}</td>
            </tr>
        </table>
    </div>
    <h2 style="text-align: left;">Important Directions:-</h2>

    <h4>1. Do and Don'ts -</h4>
    <table>
        <thead>
            <tr>
                <th style="width: 10%;">S.No.</th>
                <th style="width: 55%;">Do's</th>
                <th style="width: 35%;">Don'ts</th>
            </tr>
        </thead>
        <tbody>
            <tr style="text-align: center;">
                <td>1</td>
                <td>Compulsory Registration</td>
                <td>Do not Overspeed in Hills</td>
            </tr>
            <tr style="text-align: center;">
                <td>2</td>
                <td>Keep the Registration certificate ready at the verification point</td>
                <td>Do not Litter Garbage</td>
            </tr>
            <tr style="text-align: center;">
                <td>3</td>
                <td>Collect Dham darshan slot token for smooth and hassle free darshan</td>
                <td>Do not Consume Alcohol/Tobacco</td>
            </tr>
            <tr style="text-align: center;">
                <td>4</td>
                <td>Acclimatization strongly recommended for people suffering from chronic disease</td>
                <td>Do not Drink & Drive</td>
            </tr>
            <tr style="text-align: center;">
                <td>5</td>
                <td>Carry your prescribed medicines, if Any</td>
                <td>Do not use Private Vehicles as Taxi</td>
            </tr>
            <tr style="text-align: center;">
                <td>6</td>
                <td>Park the Vehicle in the Right Place</td>
                <td>Do not defecate in Open</td>
            </tr>
        </tbody>
    </table>

    <h4 style="margin-bottom: 5px;">2. Things to Carry -</h4>
    <ul style="list-style: none;font-size: 16px;margin-bottom:20px">
        <li>a) Warm Cloth (Jacket, Shawl, Gloves, etc)</li>
        <li>b) Valid Personal ID Proof</li>
    </ul>
<hr style="width: 113%;margin-left:-6.5%">
<div style="width: 100%;display:flex;margin-top:10px;margin-bottom:10px;">
        <img src="../../public/images/logo_vertical.png" style="float: left;margin-right:170px;" alt="">
        <h3 style="float: left;margin-right:170px;margin-top:20px">Powered by Ethics Infotech LLP</h3>
        <img src="../../public/images/pdf_logo.png" style="float: left;" alt="">
</div>
<hr style="width: 113%;margin-left:-6.5%;margin-top:80px;">
</body>

</html>