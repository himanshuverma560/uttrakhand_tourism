@extends('admin.layouts.admin_layout')
@section('content')
    <br>
    <br>
    <div class="card">
        <div class="card-header">Contact Form Data</div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-4 row g-3">
                <div class="col-md-4">
                    <input type="text" name="mobile" class="form-control" placeholder="Search by Mobile"
                        value="{{ request('mobile') }}">
                </div>
                <div class="col-md-4">
                    <input type="text" name="email" class="form-control" placeholder="Search by Email"
                        value="{{ request('email') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Tour ID</th>
                        <th>Tour Date</th>
                        <th>Destination</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tours as $tour)
                        <tr>
                            <td>{{ $tour->name }}</td>
                            <td>{{ $tour->email }}</td>
                            <td>{{ $tour->mobile }}</td>
                            <td>{{ $tour->tour_id ?? 'N/A' }}</td>
                            <td>
                                @if ($tour->start_date && $tour->end_date)
                                    {{ \Carbon\Carbon::parse($tour->start_date)->format('d-m-Y') }} to
                                    {{ \Carbon\Carbon::parse($tour->end_date)->format('d-m-Y') }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                {{ $tour->date_wise_destination }}

                            </td>

                            <td>
                                @if (isset($tour->status) && $tour->status == 0)
                                    <form action="{{ route('admin.pilgrim.verify', $tour->id) }}" method="POST">
                                        @csrf

                                        <button type="submit" class="btn btn-success btn-sm">Verify</button>
                                    </form>
                                @endif
                                @if (isset($tour->status) && $tour->status == 1)
                                    <span class="badge bg-success">Verified</span>
                                    <button class="btn btn-warning btn-sm download-pdf" data-regno="{{ $tour->unique_id }}"
                                        data-group-id="{{ $tour->tour_id }}"
                                        data-destination="{{ $tour->destinations }}" data-tour-days="{{$tour->tour_days}}"
                                        data-selected-dates="{{ $tour->date_wise_destination }}"
                                        data-full-name="{{ $tour->name }}" data-gender="{{ $tour->gender }}"
                                        data-age="{{ $tour->age }}" data-diseases="NA"
                                        data-aadhar="{{ $tour->aadhar_card }}" data-email="{{ $tour->email }}"
                                        data-mobile="{{ $tour->mobile }}" data-address="{{ $tour->address }}"
                                        data-state="{{ $tour->state }}" data-photo-url="{{$tour->profile_image_path}}"
                                        data-qr-url="{{$tour->profile_image_path}}", data-city="{{ $tour->city }}",
                                        data-country="{{ $tour->country }}", data-district="{{ $tour->district }}",
                                        data-contact-number="{{ $tour->contact_number }}",
                                        data-contact-person="{{ $tour->contact_person }}",
                                        data-contact-relation="{{ $tour->contact_relation }}",
                                        data-vehicle-details="{{ $tour->vehicle_details }}",
                                        data-drivers-name="{{ $tour->driver_name }}",
                                        data-vehicle-number="{{ $tour->vehicle_number }}">
                                        Download PDF</button>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/download.js') }}"></script>
@endsection
