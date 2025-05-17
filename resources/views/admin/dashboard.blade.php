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
            <table class="table">
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
                                @php
                                    $decoded = json_decode($tour->date_wise_destination ?? '', true);
                                    // Decode again if it's still a string
                                    if (is_string($decoded)) {
                                        $decoded = json_decode($decoded, true);
                                    }

                                    if (is_array($decoded)) {
                                        foreach ($decoded as $destination) {
                                            echo $destination['dham'] . '-' . $destination['date'] . '<br>';
                                        }
                                    }
                                @endphp

                            </td>

                            <td>
                                @if ($tour->status && $tour->status == 0)
                                    <form action="{{ route('admin.pilgrim.verify', $tour->id) }}" method="POST">
                                        @csrf

                                        <button type="submit" class="btn btn-success btn-sm">Verify</button>
                                    </form>
                                @endif
                                @if ($tour->status == 1)
                                    <span class="badge bg-success">Verified</span>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div>

    </div>
@endsection
